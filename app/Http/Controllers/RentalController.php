<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Equipment;
use App\Models\User;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    public function index()
    {
        return view('rentals.index', [
            'rentals' => Rental::with(['user', 'equipment'])->latest()->paginate(10),
        ]);
    }

    public function create()
    {
        return view('rentals.create', [
            'equipments' => Equipment::where('availability_status', 'available')->get(),
            'users'      => User::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'equipment_id' => 'required|exists:equipments,id',
            'rental_date'  => 'required|date',
            'return_date'  => 'required|date|after_or_equal:rental_date',
            'guarantee'    => 'required|string|max:255',
        ]);

        $equipment = Equipment::findOrFail($request->equipment_id);
        $days = \Carbon\Carbon::parse($request->rental_date)
                    ->diffInDays(\Carbon\Carbon::parse($request->return_date)) ?: 1;
        $totalPrice = $days * $equipment->rental_price_per_day;

        Rental::create([
            'user_id'      => auth()->id() ?? 1,
            'equipment_id' => $request->equipment_id,
            'rental_date'  => $request->rental_date,
            'return_date'  => $request->return_date,
            'guarantee'    => $request->guarantee,
            'total_price'  => $totalPrice,
        ]);

        $equipment->update(['availability_status' => 'rented']);

        return redirect()->route('rentals.index')->with('success', 'Rental berhasil dibuat.');
    }

    public function show(Rental $rental)
    {
        return view('rentals.show', [
            'rental' => $rental->load(['equipment', 'user', 'penalties']),
        ]);
    }

    public function destroy(Rental $rental)
    {
        $rental->equipment->update(['availability_status' => 'available']);
        $rental->delete();

        return redirect()->route('rentals.index')->with('success', 'Rental berhasil dihapus.');
    }
}
