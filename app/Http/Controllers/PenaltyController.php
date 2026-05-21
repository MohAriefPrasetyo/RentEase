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
        $user    = auth()->user();
        $isAdmin = $user->role === 'admin';

        if ($isAdmin) {
            $rentals   = Rental::with('items')->get();
            $penalties = Penalty::with(['rental.items.equipment', 'rental.user'])->latest()->paginate(10);
            $totalPenalties    = Penalty::sum('penalty_fee');
            $totalPenaltyCount = Penalty::count();
        } else {
            $rentals   = Rental::with('items')->where('user_id', $user->id)->get();
            $penalties = Penalty::with(['rental.items.equipment', 'rental.user'])
                            ->whereHas('rental', function ($q) use ($user) {
                                $q->where('user_id', $user->id);
                            })->latest()->paginate(10);
            $totalPenalties    = Penalty::whereHas('rental', function ($q) use ($user) {
                                    $q->where('user_id', $user->id);
                                })->sum('penalty_fee');
            $totalPenaltyCount = Penalty::whereHas('rental', function ($q) use ($user) {
                                    $q->where('user_id', $user->id);
                                })->count();
        }

        return view('penalties.index', [
            'penalties'         => $penalties,
            'totalMyRentals'    => $rentals->count(),
            'totalMyItems'      => $rentals->sum(fn($r) => $r->items->count()),
            'totalPenalties'    => $totalPenalties,
            'totalPenaltyCount' => $totalPenaltyCount,
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