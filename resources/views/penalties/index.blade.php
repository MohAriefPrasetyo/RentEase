@extends('layouts.app')

@section('title', 'Denda')
@section('subtitle', 'Kelola data denda kerusakan')

@section('content')

<div class="flex items-center justify-between mb-6">
    <div></div>
    <a href="{{ route('penalties.create') }}"
       style="background:#2D5A27; color:#F5F5DC; font-size:13px; font-weight:600; padding:10px 18px; border-radius:10px; display:inline-flex; align-items:center; gap:8px; text-decoration:none;"
       onmouseover="this.style.background='#1e3d1a'" onmouseout="this.style.background='#2D5A27'">
        <svg width="16" height="16" fill="none" stroke="#F5F5DC" viewBox="0 0 24 24">
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
                    <td class="px-6 py-4 font-medium text-slate-800">{{ $penalty->rental->user->name }}</td>
                    <td class="px-6 py-4 text-slate-600">{{ $penalty->rental->equipment->equipment_name }}</td>
                    <td class="px-6 py-4 text-slate-600 max-w-xs">{{ Str::limit($penalty->damage_description, 60) }}</td>
                    <td class="px-6 py-4 text-right font-semibold text-red-600">Rp {{ number_format($penalty->penalty_fee, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 text-center">
                        <form action="{{ route('penalties.destroy', $penalty) }}" method="POST"
                              onsubmit="return confirm('Hapus denda ini?')">
                            @csrf @method('DELETE')
                            <button type="submit"
                                    style="display:inline-flex;align-items:center;gap:4px;font-size:12px;font-weight:600;padding:6px 12px;border-radius:8px;background:#fde8e8;color:#b91c1c;border:1px solid #fca5a5;cursor:pointer;"
                                    onmouseover="this.style.background='#fecaca'" onmouseout="this.style.background='#fde8e8'">
                                <svg width="13" height="13" fill="none" stroke="#b91c1c" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
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
