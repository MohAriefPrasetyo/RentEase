<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\EquipmentCategory;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    public function index()
    {
        return view('equipment.index', [
            'equipments' => Equipment::with('category')->latest()->paginate(10),
        ]);
    }

    public function create()
    {
        return view('equipment.create', [
            'categories' => EquipmentCategory::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'equipment_category_id' => 'required|exists:equipment_categories,id',
            'equipment_name'        => 'required|string|max:255',
            'rental_price_per_day'  => 'required|integer|min:0',
            'availability_status'   => 'required|in:available,rented,maintenance',
        ]);

        Equipment::create($request->all());

        return redirect()->route('equipment.index')->with('success', 'Equipment berhasil ditambahkan.');
    }

    public function edit(Equipment $equipment)
    {
        return view('equipment.edit', [
            'equipment'  => $equipment,
            'categories' => EquipmentCategory::all(),
        ]);
    }

    public function update(Request $request, Equipment $equipment)
    {
        $request->validate([
            'equipment_category_id' => 'required|exists:equipment_categories,id',
            'equipment_name'        => 'required|string|max:255',
            'rental_price_per_day'  => 'required|integer|min:0',
            'availability_status'   => 'required|in:available,rented,maintenance',
        ]);

        $equipment->update($request->all());

        return redirect()->route('equipment.index')->with('success', 'Equipment berhasil diperbarui.');
    }

    public function destroy(Equipment $equipment)
    {
        $equipment->delete();

        return redirect()->route('equipment.index')->with('success', 'Equipment berhasil dihapus.');
    }
}
