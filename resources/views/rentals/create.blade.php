@extends('layouts.app')

@section('title', 'Buat Rental')
@section('subtitle', 'Tambah transaksi rental baru')

@section('content')

<div class="max-w-2xl">
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <form action="{{ route('rentals.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Penyewa</label>
                <select name="user_id"
                        class="w-full border border-slate-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('user_id') border-red-400 @enderror">
                    <option value="">-- Pilih Penyewa --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
                @error('user_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Peralatan</label>
                <select name="equipment_id"
                        class="w-full border border-slate-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('equipment_id') border-red-400 @enderror">
                    <option value="">-- Pilih Peralatan --</option>
                    @foreach($equipments as $eq)
                        <option value="{{ $eq->id }}" {{ old('equipment_id') == $eq->id ? 'selected' : '' }}>
                            {{ $eq->equipment_name }} — Rp {{ number_format($eq->rental_price_per_day, 0, ',', '.') }}/hari
                        </option>
                    @endforeach
                </select>
                @error('equipment_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Tanggal Sewa</label>
                    <input type="date" name="rental_date" value="{{ old('rental_date') }}"
                           class="w-full border border-slate-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('rental_date') border-red-400 @enderror">
                    @error('rental_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Tanggal Kembali</label>
                    <input type="date" name="return_date" value="{{ old('return_date') }}"
                           class="w-full border border-slate-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('return_date') border-red-400 @enderror">
                    @error('return_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Jaminan</label>
                <input type="text" name="guarantee" value="{{ old('guarantee') }}"
                       placeholder="Contoh: KTP, SIM, Kartu Mahasiswa"
                       class="w-full border border-slate-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('guarantee') border-red-400 @enderror">
                @error('guarantee') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit"
                        style="background:#2D5A27;color:#F5F5DC;font-size:13px;font-weight:600;padding:10px 24px;border-radius:10px;border:none;cursor:pointer;"
                        onmouseover="this.style.background='#1e3d1a'" onmouseout="this.style.background='#2D5A27'">
                    Simpan
                </button>
                <a href="{{ route('rentals.index') }}"
                   style="font-size:13px;font-weight:500;padding:10px 16px;border-radius:10px;color:#4B3621;text-decoration:none;background:#f0ede4;border:1px solid #d4cfc0;"
                   onmouseover="this.style.background='#e0ddd0'" onmouseout="this.style.background='#f0ede4'">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
