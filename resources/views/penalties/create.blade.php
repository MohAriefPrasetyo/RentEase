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
                            #{{ $rental->id }} — {{ $rental->user->name }} ({{ $rental->equipment->equipment_name }})
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
                        style="background:#2D5A27;color:#F5F5DC;font-size:13px;font-weight:600;padding:10px 24px;border-radius:10px;border:none;cursor:pointer;"
                        onmouseover="this.style.background='#1e3d1a'" onmouseout="this.style.background='#2D5A27'">
                    Simpan
                </button>
                <a href="{{ route('penalties.index') }}"
                   style="font-size:13px;font-weight:500;padding:10px 16px;border-radius:10px;color:#4B3621;text-decoration:none;background:#f0ede4;border:1px solid #d4cfc0;"
                   onmouseover="this.style.background='#e0ddd0'" onmouseout="this.style.background='#f0ede4'">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
