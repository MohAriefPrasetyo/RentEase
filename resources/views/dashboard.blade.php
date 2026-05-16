@extends('layouts.app')
@section('title', 'Dashboard')
@section('subtitle', 'Ringkasan data rental peralatan')

@section('content')

{{-- Stats --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <div class="rounded-2xl p-5 border" style="background:#fff; border-color:#e0ddd0;">
        <div class="flex items-center justify-between mb-3">
            <p class="text-sm font-medium" style="color:#7a9e75;">Total Peralatan</p>
            <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background:#e8f0e6;">
                <svg class="w-5 h-5" fill="none" stroke="#2D5A27" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-bold" style="color:#1e3d1a;">{{ $totalEquipment }}</p>
        <p class="text-xs mt-1" style="color:#a0b89a;">Unit terdaftar</p>
    </div>

    <div class="rounded-2xl p-5 border" style="background:#fff; border-color:#e0ddd0;">
        <div class="flex items-center justify-between mb-3">
            <p class="text-sm font-medium" style="color:#7a9e75;">Tersedia</p>
            <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background:#d4edda;">
                <svg class="w-5 h-5" fill="none" stroke="#2D5A27" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-bold" style="color:#1e3d1a;">{{ $availableEquipment }}</p>
        <p class="text-xs mt-1" style="color:#2D5A27;">Siap disewa</p>
    </div>

    <div class="rounded-2xl p-5 border" style="background:#fff; border-color:#e0ddd0;">
        <div class="flex items-center justify-between mb-3">
            <p class="text-sm font-medium" style="color:#7a9e75;">Total Rental</p>
            <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background:#f0e8dc;">
                <svg class="w-5 h-5" fill="none" stroke="#4B3621" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-bold" style="color:#1e3d1a;">{{ $totalRentals }}</p>
        <p class="text-xs mt-1" style="color:#a0b89a;">Transaksi</p>
    </div>

    <div class="rounded-2xl p-5 border" style="background:#fff; border-color:#e0ddd0;">
        <div class="flex items-center justify-between mb-3">
            <p class="text-sm font-medium" style="color:#7a9e75;">Total Denda</p>
            <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background:#fde8e8;">
                <svg class="w-5 h-5" fill="none" stroke="#b91c1c" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
        </div>
        <p class="text-2xl font-bold" style="color:#1e3d1a;">Rp {{ number_format($totalPenalties, 0, ',', '.') }}</p>
        <p class="text-xs mt-1" style="color:#e57373;">Akumulasi denda</p>
    </div>
</div>

{{-- Recent Rentals --}}
<div class="rounded-2xl border overflow-hidden" style="background:#fff; border-color:#e0ddd0;">
    <div class="flex items-center justify-between px-6 py-4 border-b" style="border-color:#e0ddd0; background:#faf9f4;">
        <div class="flex items-center gap-2">
            <div class="w-1 h-5 rounded-full" style="background:#2D5A27;"></div>
            <h3 class="font-semibold text-sm" style="color:#1e3d1a;">Rental Terbaru</h3>
        </div>
        <a href="{{ route('rentals.index') }}" class="text-xs font-medium px-3 py-1.5 rounded-lg border transition-colors"
           style="color:#2D5A27; border-color:#a8d5a0; background:#e8f5e4;"
           onmouseover="this.style.background='#d4edda'" onmouseout="this.style.background='#e8f5e4'">
            Lihat semua →
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr style="background:#faf9f4; color:#7a9e75;">
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Penyewa</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Peralatan</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Tgl Sewa</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Tgl Kembali</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider">Total</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentRentals as $rental)
                <tr class="border-t transition-colors" style="border-color:#f0ede4;"
                    onmouseover="this.style.background='#faf9f4'" onmouseout="this.style.background='transparent'">
                    <td class="px-6 py-4 font-medium" style="color:#1e3d1a;">{{ $rental->renter_name }}</td>
                    <td class="px-6 py-4" style="color:#4B3621;">{{ $rental->items->pluck('equipment.equipment_name')->join(', ') }}</td>
                    <td class="px-6 py-4" style="color:#7a9e75;">{{ \Carbon\Carbon::parse($rental->rental_date)->format('d M Y') }}</td>
                    <td class="px-6 py-4" style="color:#7a9e75;">{{ \Carbon\Carbon::parse($rental->return_date)->format('d M Y') }}</td>
                    <td class="px-6 py-4 text-right font-semibold" style="color:#2D5A27;">Rp {{ number_format($rental->total_price, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-sm" style="color:#a0b89a;">
                        <svg class="w-10 h-10 mx-auto mb-2 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        Belum ada data rental.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
