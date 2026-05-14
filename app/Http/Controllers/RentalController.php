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
        $rentals = Rental::with(['user', 'equipment'])->latest()->paginate(10);
        return view('rentals.index', compact('rentals'));
    }

    public function create()
    {
        $equipments = Equipment::where('availability_status', 'available')->get();
        $users = User::all();
        return view('rentals.create', compact('equipments', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'equipment_id' => 'required|exists:equipments,id',
            'rental_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:rental_date',
            'guarantee' => 'required|string|max:255',
        ]);

        $equipment = Equipment::findOrFail($request->equipment_id);
        $days = \Carbon\Carbon::parse($request->rental_date)->diffInDays(\Carbon\Carbon::parse($request->return_date)) ?: 1;
        $total = $days * $equipment->rental_price_per_day;

        Rental::create(array_merge($request->all(), ['total_price' => $total]));
        $equipment->update(['availability_status' => 'rented']);

        return redirect()->route('rentals.index')->with('success', 'Rental berhasil dibuat.');
    }

    public function show(Rental $rental)
    {
        $rental->load(['user', 'equipment', 'penalties']);
        return view('rentals.show', compact('rental'));
    }

    public function destroy(Rental $rental)
    {
        $rental->equipment->update(['availability_status' => 'available']);
        $rental->delete();
        return redirect()->route('rentals.index')->with('success', 'Rental berhasil dihapus.');
    }
}
