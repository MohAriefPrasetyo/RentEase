@extends('layouts.app')

@section('title', 'Tambah Denda')
@section('subtitle', 'Catat denda kerusakan peralatan')

@section('content')

<div class="max-w-2xl">
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <form action="{{ route('penalties.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Rental</label>
                <select name="rental_id"
                        class="w-full border border-slate-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('rental_id') border-red-400 @enderror">
                    <option value="">-- Pilih Rental --</option>
                    @foreach($rentals as $rental)
                        <option value="{{ $rental->id }}" {{ old('rental_id') == $rental->id ? 'selected' : '' }}>
                            #{{ $rental->id }} — {{ $rental->renter_name }} ({{ $rental->items->pluck('equipment.equipment_name')->join(', ') }})
                        </option>
                    @endforeach
                </select>
                @error('rental_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Deskripsi Kerusakan</label>
                <textarea name="damage_description" rows="3"
                          placeholder="Jelaskan kerusakan yang terjadi..."
                          class="w-full border border-slate-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none @error('damage_description') border-red-400 @enderror">{{ old('damage_description') }}</textarea>
                @error('damage_description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Biaya Denda (Rp)</label>
                <input type="number" name="penalty_fee" value="{{ old('penalty_fee') }}"
                       placeholder="Contoh: 50000" min="0"
                       class="w-full border border-slate-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('penalty_fee') border-red-400 @enderror">
                @error('penalty_fee') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-6 py-2.5 rounded-lg transition-colors">
                    Simpan
                </button>
                <a href="{{ route('penalties.index') }}"
                   class="text-slate-600 hover:text-slate-800 text-sm font-medium px-4 py-2.5 rounded-lg hover:bg-slate-100 transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
