@extends('layouts.app')
@section('title', 'Manajemen Rental')
@section('subtitle', 'Semua transaksi rental yang masuk')

@section('content')

<div class="bg-white rounded-xl shadow-sm border border-slate-200">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-slate-50 text-slate-500 text-xs uppercase tracking-wider">
                    <th class="px-6 py-3 text-left">#</th>
                    <th class="px-6 py-3 text-left">Penyewa</th>
                    <th class="px-6 py-3 text-left">Akun</th>
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
                    <td class="px-6 py-4 font-medium text-slate-800">{{ $rental->renter_name }}</td>
                    <td class="px-6 py-4 text-slate-500 text-xs">{{ $rental->user->email }}</td>
                    <td class="px-6 py-4 text-slate-600">
                        {{ $rental->items->pluck('equipment.equipment_name')->join(', ') }}
                    </td>
                    <td class="px-6 py-4 text-slate-500">{{ \Carbon\Carbon::parse($rental->rental_date)->format('d M Y') }}</td>
                    <td class="px-6 py-4 text-slate-500">{{ \Carbon\Carbon::parse($rental->return_date)->format('d M Y') }}</td>
                    <td class="px-6 py-4 text-slate-600">{{ $rental->guarantee }}</td>
                    <td class="px-6 py-4 text-right font-semibold text-slate-800">Rp {{ number_format($rental->total_price, 0, ',', '.') }}</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('rentals.show', $rental) }}"
                               class="inline-flex items-center gap-1 text-xs bg-slate-100 hover:bg-blue-100 hover:text-blue-700 text-slate-600 px-3 py-1.5 rounded-lg transition-colors font-medium">
                                Detail
                            </a>
                            <form action="{{ route('rentals.destroy', $rental) }}" method="POST"
                                  onsubmit="return confirm('Hapus rental ini?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center gap-1 text-xs bg-slate-100 hover:bg-red-100 hover:text-red-700 text-slate-600 px-3 py-1.5 rounded-lg transition-colors font-medium">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="px-6 py-10 text-center text-slate-400">Belum ada data rental.</td>
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
