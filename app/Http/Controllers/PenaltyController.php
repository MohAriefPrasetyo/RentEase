<?php

namespace App\Http\Controllers;

use App\Models\Penalty;
use App\Models\Rental;
use Illuminate\Http\Request;

class PenaltyController extends Controller
{
    public function index()
    {
        $this->authorize('view-data');
        $user = auth()->user();

        // Total barang yang sedang/pernah disewa oleh user ini
        $myRentals = $user->role === 'admin'
            ? \App\Models\Rental::with('items')->get()
            : \App\Models\Rental::with('items')->where('user_id', $user->id)->get();

        $totalMyItems   = $myRentals->sum(fn($r) => $r->items->count());
        $totalMyRentals = $myRentals->count();
        $totalPenalties = $user->role === 'admin'
            ? Penalty::sum('penalty_fee')
            : Penalty::whereHas('rental', fn($q) => $q->where('user_id', $user->id))->sum('penalty_fee');
        $totalPenaltyCount = $user->role === 'admin'
            ? Penalty::count()
            : Penalty::whereHas('rental', fn($q) => $q->where('user_id', $user->id))->count();

        return view('penalties.index', [
            'penalties'        => Penalty::with(['rental.items.equipment', 'rental.user'])->latest()->paginate(10),
            'totalMyItems'     => $totalMyItems,
            'totalMyRentals'   => $totalMyRentals,
            'totalPenalties'   => $totalPenalties,
            'totalPenaltyCount'=> $totalPenaltyCount,
        ]);
    }

    public function create()
    {
        $this->authorize('store-data');
        return view('penalties.create', [
            'rentals' => Rental::with(['items.equipment'])->get(),
        ]);
    }

public function store(Request $request)
{
    $this->authorize('store-data');

    $validated = $request->validate([
        'rental_id'          => 'required|exists:rentals,id',
        'damage_description' => 'required|string|max:1000',
        'penalty_fee'        => 'required|integer|min:0',
    ]);

    Penalty::create($validated); // gunakan $validated, bukan $request->all()

    return redirect()->route('penalties.index')->with('success', 'Penalti berhasil ditambahkan.');
}
    public function destroy(Penalty $penalty)
    {
        $this->authorize('destroy-data');
        $penalty->delete();

        return redirect()->route('penalties.index')->with('success', 'Penalti berhasil dihapus.');
    }
}