@extends('layouts.app')

@section('title', 'Detail Rental')
@section('subtitle', 'Informasi lengkap transaksi rental')

@section('content')

<div class="max-w-3xl space-y-5">

    {{-- Rental Info --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <h3 class="font-semibold text-slate-800 mb-4">Informasi Rental</h3>
        <div class="grid grid-cols-2 gap-4 text-sm">
            <div>
                <p class="text-slate-400 mb-0.5">Penyewa</p>
                <p class="font-medium text-slate-800">{{ $rental->renter_name }}</p>
            </div>
            <div>
                <p class="text-slate-400 mb-0.5">Akun</p>
                <p class="font-medium text-slate-800">{{ $rental->user->email }}</p>
            </div>
            <div class="col-span-2">
                <p class="text-slate-400 mb-0.5">Peralatan</p>
                <div class="space-y-1">
                    @foreach($rental->items as $item)
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-800">{{ $item->equipment->equipment_name }}</span>
                        <span class="text-slate-500">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
            <div>
                <p class="text-slate-400 mb-0.5">Jaminan</p>
                <p class="font-medium text-slate-800">{{ $rental->guarantee }}</p>
            </div>
            <div>
                <p class="text-slate-400 mb-0.5">Tanggal Sewa</p>
                <p class="font-medium text-slate-800">{{ \Carbon\Carbon::parse($rental->rental_date)->format('d M Y') }}</p>
            </div>
            <div>
                <p class="text-slate-400 mb-0.5">Tanggal Kembali</p>
                <p class="font-medium text-slate-800">{{ \Carbon\Carbon::parse($rental->return_date)->format('d M Y') }}</p>
            </div>
            <div class="col-span-2 pt-2 border-t border-slate-100">
                <p class="text-slate-400 mb-0.5">Total Harga</p>
                <p class="text-2xl font-bold text-blue-600">Rp {{ number_format($rental->total_price, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>

    {{-- Penalties --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-200">
        <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
            <h3 class="font-semibold text-slate-800">Denda</h3>
        </div>
        <div class="divide-y divide-slate-100">
            @forelse($rental->penalties as $penalty)
            <div class="px-6 py-4 flex items-start justify-between gap-4">
                <div>
                    <p class="text-sm text-slate-700">{{ $penalty->damage_description }}</p>
                    <p class="text-xs text-slate-400 mt-0.5">{{ $penalty->created_at->format('d M Y') }}</p>
                </div>
                <p class="text-sm font-semibold text-red-600 flex-shrink-0">Rp {{ number_format($penalty->penalty_fee, 0, ',', '.') }}</p>
            </div>
            @empty
            <p class="px-6 py-6 text-center text-slate-400 text-sm">Tidak ada denda.</p>
            @endforelse
        </div>
    </div>

    <a href="{{ route('rentals.index') }}"
       class="inline-flex items-center gap-2 text-slate-600 hover:text-slate-800 text-sm font-medium">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        Kembali ke daftar rental
    </a>
</div>

@endsection
