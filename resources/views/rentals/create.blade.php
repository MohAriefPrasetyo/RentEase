@extends('layouts.app')
@section('title', 'Buat Rental')
@section('subtitle', 'Tambah transaksi rental baru')

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <form action="{{ route('rentals.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Nama Penyewa</label>
                <input type="text" name="renter_name" value="{{ old('renter_name', auth()->user()->name) }}"
                       placeholder="Tulis nama lengkap penyewa"
                       class="w-full border border-slate-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('renter_name') border-red-400 @enderror">
                @error('renter_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Pilih Peralatan <span class="text-slate-400 font-normal">(bisa lebih dari satu)</span></label>
                <div class="border border-slate-300 rounded-lg divide-y divide-slate-100 max-h-56 overflow-y-auto">
                    @foreach($equipments as $eq)
                    <label class="flex items-center gap-3 px-4 py-3 hover:bg-slate-50 cursor-pointer">
                        <input type="checkbox" name="equipment_ids[]" value="{{ $eq->id }}"
                               {{ in_array($eq->id, old('equipment_ids', [])) ? 'checked' : '' }}
                               class="w-4 h-4 text-blue-600 rounded">
                        <div class="flex-1">
                            <span class="text-sm font-medium text-slate-800">{{ $eq->equipment_name }}</span>
                            <span class="text-xs text-slate-400 ml-2">{{ $eq->category->category_name }}</span>
                        </div>
                        <span class="text-sm font-semibold text-slate-700">Rp {{ number_format($eq->rental_price_per_day, 0, ',', '.') }}/hari</span>
                    </label>
                    @endforeach
                </div>
                @error('equipment_ids') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Tanggal Sewa</label>
                    <input type="date" name="rental_date" value="{{ old('rental_date') }}"
                           class="w-full border border-slate-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('rental_date') border-red-400 @enderror">
                    @error('rental_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Tanggal Kembali</label>
                    <input type="date" name="return_date" value="{{ old('return_date') }}"
                           class="w-full border border-slate-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('return_date') border-red-400 @enderror">
                    @error('return_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Jaminan</label>
                <input type="text" name="guarantee" value="{{ old('guarantee') }}"
                       placeholder="Contoh: KTP, SIM, Kartu Mahasiswa"
                       class="w-full border border-slate-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('guarantee') border-red-400 @enderror">
                @error('guarantee') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-6 py-2.5 rounded-lg transition-colors">
                    Simpan
                </button>
                <a href="{{ route('rentals.index') }}"
                   class="text-slate-600 hover:text-slate-800 text-sm font-medium px-4 py-2.5 rounded-lg hover:bg-slate-100 transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
