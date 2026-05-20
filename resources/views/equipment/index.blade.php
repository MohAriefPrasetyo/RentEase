@extends('layouts.app')
@section('title', 'Peralatan')
@section('subtitle', 'Daftar peralatan yang tersedia untuk disewa')

@section('content')

{{-- ── Stats Cards ── --}}
<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:28px;">
    <div style="background:#fff;border-radius:16px;padding:20px;border:1.5px solid #e0ddd0;">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:14px;">
            <p style="font-size:13px;font-weight:500;color:#7a9e75;margin:0;">Total Peralatan</p>
            <div style="width:36px;height:36px;border-radius:10px;background:#e8f0e6;display:flex;align-items:center;justify-content:center;">
                <svg width="18" height="18" fill="none" stroke="#2D5A27" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
            </div>
        </div>
        <p style="font-size:28px;font-weight:800;color:#1e3d1a;margin:0 0 4px;">{{ $totalEquipment }}</p>
        <p style="font-size:12px;color:#a0b89a;margin:0;">Unit terdaftar</p>
    </div>

    <div style="background:#fff;border-radius:16px;padding:20px;border:1.5px solid #e0ddd0;">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:14px;">
            <p style="font-size:13px;font-weight:500;color:#7a9e75;margin:0;">Tersedia</p>
            <div style="width:36px;height:36px;border-radius:10px;background:#d4edda;display:flex;align-items:center;justify-content:center;">
                <svg width="18" height="18" fill="none" stroke="#2D5A27" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
        <p style="font-size:28px;font-weight:800;color:#1e3d1a;margin:0 0 4px;">{{ $availableEquipment }}</p>
        <p style="font-size:12px;color:#2D5A27;margin:0;">Siap disewa</p>
    </div>

    <div style="background:#fff;border-radius:16px;padding:20px;border:1.5px solid #e0ddd0;">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:14px;">
            <p style="font-size:13px;font-weight:500;color:#7a9e75;margin:0;">Total Rental</p>
            <div style="width:36px;height:36px;border-radius:10px;background:#f0e8dc;display:flex;align-items:center;justify-content:center;">
                <svg width="18" height="18" fill="none" stroke="#4B3621" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
        </div>
        <p style="font-size:28px;font-weight:800;color:#1e3d1a;margin:0 0 4px;">{{ $totalRentals }}</p>
        <p style="font-size:12px;color:#a0b89a;margin:0;">Transaksi</p>
    </div>
</div>

{{-- Header --}}
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;gap:16px;flex-wrap:wrap;">
    <p style="font-size:13px;color:#7a9e75;margin:0;">Katalog peralatan — untuk menyewa, kunjungi menu <a href="{{ route('rentals.index') }}" style="color:#2D5A27;font-weight:600;text-decoration:none;">Rental</a></p>

    <div style="display:flex;align-items:center;gap:12px;flex-wrap:wrap;margin:0;">
        {{-- Pencarian AI --}}
        <form action="{{ route('ai-search.search') }}" method="POST" style="display:flex;align-items:center;gap:8px;margin:0;">
            @csrf
            <div style="position:relative;width:240px;">
                <svg width="16" height="16" fill="none" stroke="#7a9e75" viewBox="0 0 24 24" style="position:absolute;left:12px;top:50%;transform:translateY(-50%);pointer-events:none;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text" name="query" placeholder="Cari pakai AI..." required
                       style="width:100%;padding:9px 12px 9px 36px;border-radius:10px;border:1.5px solid #d4cfc0;font-size:13px;color:#1e3d1a;outline:none;background:#ffffff;box-sizing:border-box;transition:border-color .15s,box-shadow .15s;"
                       onfocus="this.style.borderColor='#2D5A27';this.style.boxShadow='0 0 0 3px rgba(45,90,39,0.1)'"
                       onblur="this.style.borderColor='#d4cfc0';this.style.boxShadow='none'">
            </div>
            <button type="submit" style="background:#2D5A27;color:#F5F5DC;font-size:13px;font-weight:700;padding:9px 16px;border-radius:10px;border:none;cursor:pointer;">Cari</button>
        </form>

        @can('store-data')
        <a href="{{ route('equipment.create') }}" style="background:#2D5A27;color:#F5F5DC;font-size:13px;font-weight:600;padding:9px 16px;border-radius:10px;display:inline-flex;align-items:center;gap:6px;text-decoration:none;">
            <svg width="15" height="15" fill="none" stroke="#F5F5DC" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Peralatan
        </a>
        @endcan
    </div>
</div>

{{-- Grid Katalog (view-only) --}}
<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:24px;">
    @forelse($equipments as $item)
    <div style="background:#fff;border:1px solid #d4cfc0;border-radius:16px;overflow:hidden;position:relative;padding:10px;box-shadow:0 2px 8px #0000000f;">

        {{-- Gambar / placeholder --}}
        <div style="position:relative;width:100%;aspect-ratio:4/3;background:linear-gradient(135deg,#c8dfc4 0%,#e8f0e6 100%);overflow:hidden;border-radius:12px;">
            <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;">
                <svg width="64" height="64" fill="none" stroke="#2D5A27" opacity=".25" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
            </div>
            @if($item->image)
                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->equipment_name }}" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;">
            @endif

            {{-- Status badge --}}
            <div style="position:absolute;top:12px;left:12px;">
                @if($item->availability_status === 'available')
                    <span style="background:rgba(255,255,255,.92);backdrop-filter:blur(4px);color:#2D5A27;font-size:11px;font-weight:700;padding:4px 10px;border-radius:20px;display:inline-flex;align-items:center;gap:4px;">
                        <span style="width:6px;height:6px;border-radius:50%;background:#2D5A27;display:inline-block;"></span> Tersedia
                    </span>
                @elseif($item->availability_status === 'rented')
                    <span style="background:rgba(255,255,255,.92);backdrop-filter:blur(4px);color:#1d4ed8;font-size:11px;font-weight:700;padding:4px 10px;border-radius:20px;display:inline-flex;align-items:center;gap:4px;">
                        <span style="width:6px;height:6px;border-radius:50%;background:#1d4ed8;display:inline-block;"></span> Disewa
                    </span>
                @else
                    <span style="background:rgba(255,255,255,.92);backdrop-filter:blur(4px);color:#b45309;font-size:11px;font-weight:700;padding:4px 10px;border-radius:20px;display:inline-flex;align-items:center;gap:4px;">
                        <span style="width:6px;height:6px;border-radius:50%;background:#b45309;display:inline-block;"></span> Maintenance
                    </span>
                @endif
            </div>
        </div>

        {{-- Info --}}
        <div style="padding:14px 16px 16px;">
            <div style="font-size:14px;font-weight:700;color:#1e3d1a;line-height:1.3;margin-bottom:2px;">{{ $item->equipment_name }}</div>
            <div style="font-size:12px;color:#7a9e75;margin-bottom:8px;">{{ $item->category->category_name }}</div>
            <div style="font-size:14px;color:#1e3d1a;">
                <span style="font-weight:700;">Rp {{ number_format($item->rental_price_per_day, 0, ',', '.') }}</span>
                <span style="font-weight:400;color:#7a9e75;"> / hari</span>
            </div>

            @can('edit-data')
            <div style="display:flex;gap:6px;margin-top:12px;padding-top:12px;border-top:1px solid #f0ede4;">
                <a href="{{ route('equipment.edit', $item) }}" style="flex:1;text-align:center;font-size:11px;font-weight:600;padding:6px 0;border-radius:8px;background:#e8f5e4;color:#2D5A27;border:1px solid #a8d5a0;text-decoration:none;">Edit</a>
                <form action="{{ route('equipment.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus peralatan ini?')" style="flex:1;">
                    @csrf @method('DELETE')
                    <button type="submit" style="width:100%;font-size:11px;font-weight:600;padding:6px 0;border-radius:8px;background:#fde8e8;color:#b91c1c;border:1px solid #fca5a5;cursor:pointer;">Hapus</button>
                </form>
            </div>
            @endcan
        </div>
    </div>
    @empty
    <div style="grid-column:1/-1;text-align:center;padding:64px;color:#a0b89a;font-size:14px;">
        Belum ada peralatan terdaftar.
    </div>
    @endforelse
</div>

@if($equipments->hasPages())
<div style="margin-top:28px;">{{ $equipments->links() }}</div>
@endif

@endsection
