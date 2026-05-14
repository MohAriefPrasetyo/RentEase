@extends('layouts.app')

@section('title', 'Dashboard')
@section('subtitle', 'Ringkasan data rental peralatan')

@section('content')

{{-- Stats Cards --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-200">
        <div class="flex items-center justify-between mb-3">
            <p class="text-slate-500 text-sm">Total Peralatan</p>
            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-bold text-slate-800">{{ $totalEquipment }}</p>
        <p class="text-xs text-slate-400 mt-1">Unit terdaftar</p>
    </div>

    <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-200">
        <div class="flex items-center justify-between mb-3">
            <p class="text-slate-500 text-sm">Tersedia</p>
            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-bold text-slate-800">{{ $availableEquipment }}</p>
        <p class="text-xs text-green-500 mt-1">Siap disewa</p>
    </div>

    <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-200">
        <div class="flex items-center justify-between mb-3">
            <p class="text-slate-500 text-sm">Total Rental</p>
            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-bold text-slate-800">{{ $totalRentals }}</p>
        <p class="text-xs text-slate-400 mt-1">Transaksi</p>
    </div>

    <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-200">
        <div class="flex items-center justify-between mb-3">
            <p class="text-slate-500 text-sm">Total Denda</p>
            <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-bold text-slate-800">Rp {{ number_format($totalPenalties, 0, ',', '.') }}</p>
        <p class="text-xs text-red-400 mt-1">Akumulasi denda</p>
    </div>
</div>

{{-- Recent Rentals --}}
<div class="bg-white rounded-xl shadow-sm border border-slate-200">
    <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
        <h3 class="font-semibold text-slate-800">Rental Terbaru</h3>
        <a href="{{ route('rentals.index') }}" class="text-blue-600 text-sm hover:underline">Lihat semua</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-slate-50 text-slate-500 text-xs uppercase tracking-wider">
                    <th class="px-6 py-3 text-left">Penyewa</th>
                    <th class="px-6 py-3 text-left">Peralatan</th>
                    <th class="px-6 py-3 text-left">Tanggal Sewa</th>
                    <th class="px-6 py-3 text-left">Tanggal Kembali</th>
                    <th class="px-6 py-3 text-right">Total</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($recentRentals as $rental)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-4 font-medium text-slate-800">{{ $rental->user->name }}</td>
                    <td class="px-6 py-4 text-slate-600">{{ $rental->equipment->equipment_name }}</td>
                    <td class="px-6 py-4 text-slate-500">{{ \Carbon\Carbon::parse($rental->rental_date)->format('d M Y') }}</td>
                    <td class="px-6 py-4 text-slate-500">{{ \Carbon\Carbon::parse($rental->return_date)->format('d M Y') }}</td>
                    <td class="px-6 py-4 text-right font-semibold text-slate-800">Rp {{ number_format($rental->total_price, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-10 text-center text-slate-400">Belum ada data rental.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
