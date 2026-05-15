@extends('layouts.app')

@section('title', 'Rental')
@section('subtitle', 'Kelola transaksi rental peralatan')

@section('content')

<div class="flex items-center justify-between mb-6">
    <div></div>
    <a href="{{ route('rentals.create') }}"
       style="background:#2D5A27; color:#F5F5DC; font-size:13px; font-weight:600; padding:10px 18px; border-radius:10px; display:inline-flex; align-items:center; gap:8px; text-decoration:none;"
       onmouseover="this.style.background='#1e3d1a'" onmouseout="this.style.background='#2D5A27'">
        <svg width="16" height="16" fill="none" stroke="#F5F5DC" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Buat Rental
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-slate-200">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-slate-50 text-slate-500 text-xs uppercase tracking-wider">
                    <th class="px-6 py-3 text-left">#</th>
                    <th class="px-6 py-3 text-left">Penyewa</th>
                    <th class="px-6 py-3 text-left">Peralatan</th>
                    <th class="px-6 py-3 text-left">Tgl Sewa</th>
                    <th class="px-6 py-3 text-left">Tgl Kembali</th>
                    <th class="px-6 py-3 text-left">Jaminan</th>
                    <th class="px-6 py-3 text-right">Total</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($rentals as $rental)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-4 text-slate-400">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 font-medium text-slate-800">{{ $rental->user->name }}</td>
                    <td class="px-6 py-4 text-slate-600">{{ $rental->equipment->equipment_name }}</td>
                    <td class="px-6 py-4 text-slate-500">{{ \Carbon\Carbon::parse($rental->rental_date)->format('d M Y') }}</td>
                    <td class="px-6 py-4 text-slate-500">{{ \Carbon\Carbon::parse($rental->return_date)->format('d M Y') }}</td>
                    <td class="px-6 py-4 text-slate-600">{{ $rental->guarantee }}</td>
                    <td class="px-6 py-4 text-right font-semibold text-slate-800">Rp {{ number_format($rental->total_price, 0, ',', '.') }}</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('rentals.show', $rental) }}"
                               style="display:inline-flex;align-items:center;gap:4px;font-size:12px;font-weight:600;padding:6px 12px;border-radius:8px;background:#e8f5e4;color:#2D5A27;border:1px solid #a8d5a0;text-decoration:none;"
                               onmouseover="this.style.background='#d4edda'" onmouseout="this.style.background='#e8f5e4'">
                                <svg width="13" height="13" fill="none" stroke="#2D5A27" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                Detail
                            </a>
                            <form action="{{ route('rentals.destroy', $rental) }}" method="POST"
                                  onsubmit="return confirm('Hapus rental ini?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        style="display:inline-flex;align-items:center;gap:4px;font-size:12px;font-weight:600;padding:6px 12px;border-radius:8px;background:#fde8e8;color:#b91c1c;border:1px solid #fca5a5;cursor:pointer;"
                                        onmouseover="this.style.background='#fecaca'" onmouseout="this.style.background='#fde8e8'">
                                    <svg width="13" height="13" fill="none" stroke="#b91c1c" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-6 py-10 text-center text-slate-400">Belum ada data rental.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($rentals->hasPages())
    <div class="px-6 py-4 border-t border-slate-100">
        {{ $rentals->links() }}
    </div>
    @endif
</div>

@endsection
