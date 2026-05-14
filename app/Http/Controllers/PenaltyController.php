<?php

namespace App\Http\Controllers;

use App\Models\Penalty;
use App\Models\Rental;
use Illuminate\Http\Request;

class PenaltyController extends Controller
{
    public function index()
    {
        $penalties = Penalty::with(['rental.user', 'rental.equipment'])->latest()->paginate(10);
        return view('penalties.index', compact('penalties'));
    }

    public function create()
    {
        $rentals = Rental::with(['user', 'equipment'])->get();
        return view('penalties.create', compact('rentals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'rental_id' => 'required|exists:rentals,id',
            'damage_description' => 'required|string',
            'penalty_fee' => 'required|integer|min:0',
        ]);

        Penalty::create($request->all());
        return redirect()->route('penalties.index')->with('success', 'Denda berhasil ditambahkan.');
    }

    public function destroy(Penalty $penalty)
    {
        $penalty->delete();
        return redirect()->route('penalties.index')->with('success', 'Denda berhasil dihapus.');
    }
}
