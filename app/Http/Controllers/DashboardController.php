<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Rental;
use App\Models\Penalty;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'equipments'         => Equipment::with('category')->latest()->paginate(8),
            'totalEquipment'     => Equipment::count(),
            'availableEquipment' => Equipment::where('availability_status', 'available')->count(),
            'totalRentals'       => Rental::count(),
            'totalPenalties'     => Penalty::sum('penalty_fee'),
            'recentRentals'      => Rental::with(['user', 'items.equipment'])->latest()->take(5)->get(),
        ]);
    }
}