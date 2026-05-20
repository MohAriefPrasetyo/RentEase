<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\EquipmentCategory;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EquipmentController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $rentals = $user->role === 'admin'
            ? Rental::with(['user', 'items.equipment'])->latest()->paginate(10)
            : Rental::with(['user', 'items.equipment'])->where('user_id', $user->id)->latest()->paginate(10);

        return view('equipment.index', [
            'equipments'        => Equipment::with('category')->latest()->paginate(12),
            'rentals'           => $rentals,
            'totalEquipment'    => Equipment::count(),
            'availableEquipment'=> Equipment::where('availability_status', 'available')->count(),
            'totalRentals'      => Rental::count(),
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
            'image'                 => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('equipment', 'public');
        }

        Equipment::create($data);

        return redirect()->route('equipment.index')->with('success', 'Equipment berhasil ditambahkan.');
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
            'image'                 => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->except(['image', 'remove_image']);

        // Hapus foto lama jika checkbox dicentang
        if ($request->boolean('remove_image') && $equipment->image) {
            Storage::disk('public')->delete($equipment->image);
            $data['image'] = null;
        }

        // Upload foto baru (menggantikan foto lama jika ada)
        if ($request->hasFile('image')) {
            if ($equipment->image) {
                Storage::disk('public')->delete($equipment->image);
            }
            $data['image'] = $request->file('image')->store('equipment', 'public');
        }

        $equipment->update($data);

        return redirect()->route('equipment.index')->with('success', 'Equipment berhasil diperbarui.');
    }

    public function destroy(Equipment $equipment)
    {
        $this->authorize('destroy-data');

        if ($equipment->image) {
            Storage::disk('public')->delete($equipment->image);
        }

        $equipment->delete();

        return redirect()->route('equipment.index')->with('success', 'Equipment berhasil dihapus.');
    }
}