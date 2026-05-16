@extends('layouts.app')

@section('title', 'Denda')
@section('subtitle', 'Kelola data denda kerusakan')

@section('content')

<div class="flex items-center justify-between mb-6">
    <div></div>
    <a href="{{ route('penalties.create') }}"
       class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2.5 rounded-lg transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Denda
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
                    <th class="px-6 py-3 text-left">Deskripsi Kerusakan</th>
                    <th class="px-6 py-3 text-right">Biaya Denda</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($penalties as $penalty)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-4 text-slate-400">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 font-medium text-slate-800">{{ $penalty->rental->renter_name }}</td>
                    <td class="px-6 py-4 text-slate-600">{{ $penalty->rental->items->pluck('equipment.equipment_name')->join(', ') }}</td>
                    <td class="px-6 py-4 text-slate-600 max-w-xs">{{ Str::limit($penalty->damage_description, 60) }}</td>
                    <td class="px-6 py-4 text-right font-semibold text-red-600">Rp {{ number_format($penalty->penalty_fee, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 text-center">
                        <form action="{{ route('penalties.destroy', $penalty) }}" method="POST"
                              onsubmit="return confirm('Hapus denda ini?')">
                            @csrf @method('DELETE')
                            <button type="submit"
                                    class="inline-flex items-center gap-1 text-xs bg-slate-100 hover:bg-red-100 hover:text-red-700 text-slate-600 px-3 py-1.5 rounded-lg transition-colors font-medium">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-10 text-center text-slate-400">Belum ada data denda.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($penalties->hasPages())
    <div class="px-6 py-4 border-t border-slate-100">
        {{ $penalties->links() }}
    </div>
    @endif
</div>

@endsection
