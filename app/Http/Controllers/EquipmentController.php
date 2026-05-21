<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\EquipmentCategory;
use App\Models\Rental;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    public function index()
    {
        return view('equipment.index', [
            'equipments'         => Equipment::with('category')->latest()->paginate(12),
            'totalEquipment'     => Equipment::count(),
            'availableEquipment' => Equipment::where('availability_status', 'available')->count(),
            'totalRentals'       => Rental::count(),
        ]);
    }

    public function create()
    {
        $this->authorize('store-data');
        return view('equipment.create', [
            'categories' => EquipmentCategory::all(),
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('store-data');
        $request->validate([
            'equipment_category_id' => 'required|exists:equipment_categories,id',
            'equipment_name'        => 'required|string|max:255',
            'rental_price_per_day'  => 'required|integer|min:0',
            'availability_status'   => 'required|in:available,rented,maintenance',
            'image'                 => 'nullable|string|max:255',
        ]);

        Equipment::create($request->only([
            'equipment_category_id', 'equipment_name', 'rental_price_per_day', 'availability_status', 'image'
        ]));

        return redirect()->route('equipment.index')->with('success', 'Peralatan berhasil ditambahkan.');
    }

    public function edit(Equipment $equipment)
    {
        $this->authorize('edit-data');
        return view('equipment.edit', [
            'equipment'  => $equipment,
            'categories' => EquipmentCategory::all(),
        ]);
    }

    public function update(Request $request, Equipment $equipment)
    {
        $this->authorize('edit-data');
        $request->validate([
            'equipment_category_id' => 'required|exists:equipment_categories,id',
            'equipment_name'        => 'required|string|max:255',
            'rental_price_per_day'  => 'required|integer|min:0',
            'availability_status'   => 'required|in:available,rented,maintenance',
            'image'                 => 'nullable|string|max:255',
        ]);

        $equipment->update($request->only([
            'equipment_category_id', 'equipment_name', 'rental_price_per_day', 'availability_status', 'image'
        ]));

        return redirect()->route('equipment.index')->with('success', 'Peralatan berhasil diperbarui.');
    }

    public function destroy(Equipment $equipment)
    {
        $this->authorize('destroy-data');
        $equipment->delete();

        return redirect()->route('equipment.index')->with('success', 'Peralatan berhasil dihapus.');
    }
}