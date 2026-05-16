@extends('layouts.app')

@section('title', 'Peralatan')
@section('subtitle', 'Kelola data peralatan rental')

@section('content')

<div class="flex items-center justify-between mb-6">
    <div></div>
    @can('store-data')
    <a href="{{ route('equipment.create') }}"
       style="background:#2D5A27; color:#F5F5DC; font-size:13px; font-weight:600; padding:10px 18px; border-radius:10px; display:inline-flex; align-items:center; gap:8px; text-decoration:none;"
       onmouseover="this.style.background='#1e3d1a'" onmouseout="this.style.background='#2D5A27'">
        <svg width="16" height="16" fill="none" stroke="#F5F5DC" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Peralatan
    </a>
    @endcan
</div>

<div class="bg-white rounded-xl shadow-sm border border-slate-200">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-slate-50 text-slate-500 text-xs uppercase tracking-wider">
                    <th class="px-6 py-3 text-left">#</th>
                    <th class="px-6 py-3 text-left">Nama Peralatan</th>
                    <th class="px-6 py-3 text-left">Kategori</th>
                    <th class="px-6 py-3 text-left">Harga/Hari</th>
                    <th class="px-6 py-3 text-left">Status</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($equipments as $item)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-4 text-slate-400">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 font-medium text-slate-800">{{ $item->equipment_name }}</td>
                    <td class="px-6 py-4 text-slate-600">{{ $item->category->category_name }}</td>
                    <td class="px-6 py-4 text-slate-700 font-medium">Rp {{ number_format($item->rental_price_per_day, 0, ',', '.') }}</td>
                    <td class="px-6 py-4">
                        @if($item->availability_status === 'available')
                            <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 text-xs font-medium px-2.5 py-1 rounded-full">
                                <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> Tersedia
                            </span>
                        @elseif($item->availability_status === 'rented')
                            <span class="inline-flex items-center gap-1 bg-blue-100 text-blue-700 text-xs font-medium px-2.5 py-1 rounded-full">
                                <span class="w-1.5 h-1.5 bg-blue-500 rounded-full"></span> Disewa
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 bg-yellow-100 text-yellow-700 text-xs font-medium px-2.5 py-1 rounded-full">
                                <span class="w-1.5 h-1.5 bg-yellow-500 rounded-full"></span> Maintenance
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-center gap-2">
                            @can('edit-data')
                            <a href="{{ route('equipment.edit', $item) }}"
                               style="display:inline-flex;align-items:center;gap:4px;font-size:12px;font-weight:600;padding:6px 12px;border-radius:8px;background:#e8f5e4;color:#2D5A27;border:1px solid #a8d5a0;text-decoration:none;"
                               onmouseover="this.style.background='#d4edda'" onmouseout="this.style.background='#e8f5e4'">
                                <svg width="13" height="13" fill="none" stroke="#2D5A27" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Edit
                            </a>
                            <form action="{{ route('equipment.destroy', $item) }}" method="POST"
                                  onsubmit="return confirm('Hapus peralatan ini?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        style="display:inline-flex;align-items:center;gap:4px;font-size:12px;font-weight:600;padding:6px 12px;border-radius:8px;background:#fde8e8;color:#b91c1c;border:1px solid #fca5a5;cursor:pointer;"
                                        onmouseover="this.style.background='#fecaca'" onmouseout="this.style.background='#fde8e8'">
                                    <svg width="13" height="13" fill="none" stroke="#b91c1c" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                            @endcan
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-10 text-center text-slate-400">Belum ada data peralatan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($equipments->hasPages())
    <div class="px-6 py-4 border-t border-slate-100">
        {{ $equipments->links() }}
    </div>
    @endif
</div>

@endsection
