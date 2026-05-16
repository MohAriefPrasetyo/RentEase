@extends('layouts.app')

@section('title', 'Edit Peralatan')
@section('subtitle', 'Perbarui data peralatan')

@section('content')

<div class="max-w-2xl">
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <form action="{{ route('equipment.update', $equipment) }}" method="POST" class="space-y-5">
            @csrf @method('PUT')

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Kategori</label>
                <select name="equipment_category_id"
                        class="w-full border border-slate-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('equipment_category_id') border-red-400 @enderror">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('equipment_category_id', $equipment->equipment_category_id) == $cat->id ? 'selected' : '' }}>
                            {{ $cat->category_name }}
                        </option>
                    @endforeach
                </select>
                @error('equipment_category_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Nama Peralatan</label>
                <input type="text" name="equipment_name"
                       value="{{ old('equipment_name', $equipment->equipment_name) }}"
                       class="w-full border border-slate-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('equipment_name') border-red-400 @enderror">
                @error('equipment_name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Harga Sewa per Hari (Rp)</label>
                <input type="number" name="rental_price_per_day"
                       value="{{ old('rental_price_per_day', $equipment->rental_price_per_day) }}" min="0"
                       class="w-full border border-slate-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('rental_price_per_day') border-red-400 @enderror">
                @error('rental_price_per_day')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Status</label>
                <select name="availability_status"
                        class="w-full border border-slate-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="available" {{ old('availability_status', $equipment->availability_status) == 'available' ? 'selected' : '' }}>Tersedia</option>
                    <option value="rented" {{ old('availability_status', $equipment->availability_status) == 'rented' ? 'selected' : '' }}>Disewa</option>
                    <option value="maintenance" {{ old('availability_status', $equipment->availability_status) == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                </select>
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit"
                        style="background:#2D5A27;color:#F5F5DC;font-size:13px;font-weight:600;padding:10px 24px;border-radius:10px;border:none;cursor:pointer;"
                        onmouseover="this.style.background='#1e3d1a'" onmouseout="this.style.background='#2D5A27'">
                    Perbarui
                </button>
                <a href="{{ route('equipment.index') }}"
                   style="font-size:13px;font-weight:500;padding:10px 16px;border-radius:10px;color:#4B3621;text-decoration:none;background:#f0ede4;border:1px solid #d4cfc0;"
                   onmouseover="this.style.background='#e0ddd0'" onmouseout="this.style.background='#f0ede4'">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
