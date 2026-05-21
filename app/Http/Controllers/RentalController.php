<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\RentalItem;
use App\Models\Equipment;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            return view('rentals.index-admin', [
                'rentals' => Rental::with(['user', 'items.equipment'])->latest()->paginate(10),
            ]);
        }

        return view('rentals.index', [
            'equipments'         => Equipment::with('category')->latest()->paginate(12),
            'totalEquipment'     => Equipment::count(),
            'availableEquipment' => Equipment::where('availability_status', 'available')->count(),
            'totalRentals'       => Rental::where('user_id', $user->id)->count(),
        ]);
    }

    public function create()
    {
        $this->authorize('create-rental');
        return view('rentals.create', [
            'equipments' => Equipment::where('availability_status', 'available')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('create-rental');

        $request->validate([
            'renter_name'    => 'required|string|max:255',
            'rental_date'    => 'required|date',
            'return_date'    => 'required|date|after_or_equal:rental_date',
            'guarantee'      => 'required|string|max:255',
            'equipment_ids'  => 'required|array|min:1',
            'equipment_ids.*'=> 'exists:equipments,id',
        ]);

        $days = \Carbon\Carbon::parse($request->rental_date)
                    ->diffInDays(\Carbon\Carbon::parse($request->return_date)) ?: 1;

        $equipments = Equipment::whereIn('id', $request->equipment_ids)->get();
        $totalPrice = $equipments->sum(fn($eq) => $eq->rental_price_per_day * $days);

        $rental = Rental::create([
            'user_id'     => auth()->id(),
            'renter_name' => $request->renter_name,
            'rental_date' => $request->rental_date,
            'return_date' => $request->return_date,
            'guarantee'   => $request->guarantee,
            'total_price' => $totalPrice,
        ]);

        foreach ($equipments as $eq) {
            RentalItem::create([
                'rental_id'    => $rental->id,
                'equipment_id' => $eq->id,
                'subtotal'     => $eq->rental_price_per_day * $days,
            ]);
        }

        return redirect()->route('rentals.show', $rental)->with('success', 'Rental berhasil dibuat.');
    }

    public function show(Rental $rental)
    {
        if (auth()->user()->role === 'customer' && $rental->user_id !== auth()->id()) {
            abort(403);
        }
        return view('rentals.show', [
            'rental' => $rental->load(['items.equipment', 'user', 'penalties']),
        ]);
    }

    public function destroy(Rental $rental)
    {
        $this->authorize('destroy-data');
        foreach ($rental->items as $item) {
            $item->equipment->update(['availability_status' => 'available']);
        }
        $rental->delete();

        return redirect()->route('rentals.index')->with('success', 'Rental berhasil dihapus.');
    }
}