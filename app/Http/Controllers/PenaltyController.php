<?php

namespace App\Http\Controllers;

use App\Models\Penalty;
use App\Models\Rental;
use Illuminate\Http\Request;

class PenaltyController extends Controller
{
    public function index()
    {
        $this->authorize('admin-only');
        return view('penalties.index', [
            'penalties' => Penalty::with(['rental.equipment', 'rental.user'])->latest()->paginate(10),
        ]);
    }

    public function create()
    {
        $this->authorize('admin-only');
        return view('penalties.create', [
            'rentals' => Rental::with('equipment')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('admin-only');
        $request->validate([
            'rental_id'          => 'required|exists:rentals,id',
            'damage_description' => 'required|string',
            'penalty_fee'        => 'required|integer|min:0',
        ]);

        Penalty::create($request->all());

        return redirect()->route('penalties.index')->with('success', 'Penalti berhasil ditambahkan.');
    }

    public function destroy(Penalty $penalty)
    {
        $this->authorize('admin-only');
        $penalty->delete();

        return redirect()->route('penalties.index')->with('success', 'Penalti berhasil dihapus.');
    }
}
