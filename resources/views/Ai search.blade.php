@extends('layouts.app')

@section('title', 'AI Smart Search')
@section('subtitle', 'Cari peralatan dengan bahasa natural')

@section('content')

{{-- Search Bar --}}
<div style="background:linear-gradient(135deg,#1a3518,#2D5A27);border-radius:20px;padding:36px;margin-bottom:28px;position:relative;overflow:hidden;">
    <div style="position:absolute;top:-40px;right:-40px;width:200px;height:200px;border-radius:50%;background:rgba(255,255,255,0.04);"></div>
    <div style="position:absolute;bottom:-60px;left:-20px;width:180px;height:180px;border-radius:50%;background:rgba(255,255,255,0.03);"></div>

    <div style="position:relative;z-index:1;">
        <div style="display:flex;align-items:center;gap:10px;margin-bottom:8px;">
            <div style="width:36px;height:36px;border-radius:10px;background:rgba(255,255,255,0.15);display:flex;align-items:center;justify-content:center;">
                <svg width="18" height="18" fill="none" stroke="#ffffff" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                </svg>
            </div>
            <h2 style="font-size:20px;font-weight:700;color:#ffffff;margin:0;">AI Smart Search</h2>
        </div>
        <p style="font-size:13px;color:#a8c8a4;margin:0 0 24px;">Ketik kebutuhanmu dengan bahasa bebas, AI akan menemukan peralatan yang paling cocok</p>

        <form action="{{ route('ai-search.search') }}" method="POST">
            @csrf
            <div style="display:flex;gap:12px;flex-wrap:wrap;">
                <div style="flex:1;min-width:240px;position:relative;">
                    <svg width="18" height="18" fill="none" stroke="#9ca3af" viewBox="0 0 24 24"
                         style="position:absolute;left:14px;top:50%;transform:translateY(-50%);pointer-events:none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" name="query"
                           value="{{ old('query', $query) }}"
                           placeholder="Contoh: alat camping untuk 5 orang, tenda murah, peralatan mendaki..."
                           required
                           style="width:100%;padding:14px 16px 14px 44px;border-radius:12px;border:none;font-size:14px;background:rgba(255,255,255,0.95);color:#1e3d1a;outline:none;box-sizing:border-box;">
                </div>
                <button type="submit"
                        style="padding:14px 28px;border-radius:12px;background:#F5F5DC;color:#1a3518;font-weight:700;font-size:14px;border:none;cursor:pointer;white-space:nowrap;display:flex;align-items:center;gap:8px;"
                        onmouseover="this.style.background='#e8e8c8'" onmouseout="this.style.background='#F5F5DC'">
                    <svg width="16" height="16" fill="none" stroke="#1a3518" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Cari dengan AI
                </button>
            </div>
        </form>

        {{-- Contoh pencarian --}}
        <div style="margin-top:16px;display:flex;flex-wrap:wrap;gap:8px;">
            <span style="font-size:12px;color:#7aaa74;align-self:center;">Coba:</span>
            @foreach(['tenda untuk camping', 'alat mendaki murah di bawah 100 ribu', 'peralatan masak outdoor', 'sleeping bag hangat'] as $example)
            <button type="button"
                    onclick="document.querySelector('input[name=query]').value='{{ $example }}'"
                    style="font-size:12px;padding:5px 12px;border-radius:20px;border:1px solid rgba(255,255,255,0.25);background:rgba(255,255,255,0.1);color:#d4edda;cursor:pointer;">
                {{ $example }}
            </button>
            @endforeach
        </div>
    </div>
</div>

@if($results !== null)
{{-- AI Message --}}
<div style="background:#e8f5e4;border:1px solid #a8d5a0;border-radius:14px;padding:14px 18px;margin-bottom:20px;display:flex;align-items:flex-start;gap:12px;">
    <div style="width:32px;height:32px;border-radius:8px;background:#2D5A27;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:2px;">
        <svg width="16" height="16" fill="none" stroke="#ffffff" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
        </svg>
    </div>
    <div>
        <div style="font-size:12px;font-weight:600;color:#2D5A27;margin-bottom:2px;">Analisis AI</div>
        <div style="font-size:14px;color:#1e3d1a;">{{ $aiMessage }}</div>
    </div>
</div>

{{-- Results --}}
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;">
    <h3 style="font-size:15px;font-weight:600;color:#1e3d1a;margin:0;">
        Hasil untuk <span style="color:#2D5A27;">"{{ $query }}"</span>
        <span style="font-size:13px;font-weight:400;color:#7a9e75;"> — {{ $results->count() }} peralatan ditemukan</span>
    </h3>
    <a href="{{ route('equipment.index') }}"
       style="font-size:13px;color:#2D5A27;text-decoration:none;display:flex;align-items:center;gap:4px;">
        ← Lihat semua
    </a>
</div>

@if($results->count() > 0)
<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:16px;">
    @foreach($results as $item)
    <div style="background:#ffffff;border-radius:16px;border:1px solid #e0ddd0;overflow:hidden;transition:box-shadow 0.2s;"
         onmouseover="this.style.boxShadow='0 4px 20px rgba(45,90,39,0.12)'"
         onmouseout="this.style.boxShadow='none'">

        {{-- Card Header --}}
        <div style="background:linear-gradient(135deg,#e8f5e4,#f0ede4);padding:20px;display:flex;align-items:center;gap:12px;">
            <div style="width:48px;height:48px;border-radius:12px;background:#2D5A27;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <svg width="22" height="22" fill="none" stroke="#ffffff" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
            </div>
            <div style="min-width:0;">
                <div style="font-weight:600;font-size:15px;color:#1e3d1a;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $item->equipment_name }}</div>
                <div style="font-size:12px;color:#7a9e75;margin-top:2px;">{{ $item->category->category_name ?? '-' }}</div>
            </div>
        </div>

        {{-- Card Body --}}
        <div style="padding:16px;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;">
                <div>
                    <div style="font-size:11px;color:#9ca3af;margin-bottom:2px;">Harga sewa</div>
                    <div style="font-size:18px;font-weight:700;color:#2D5A27;">Rp {{ number_format($item->rental_price_per_day, 0, ',', '.') }}</div>
                    <div style="font-size:11px;color:#9ca3af;">per hari</div>
                </div>
                <div>
                    @if($item->availability_status === 'available')
                        <span style="display:inline-flex;align-items:center;gap:5px;background:#e8f5e4;color:#2D5A27;font-size:12px;font-weight:600;padding:6px 12px;border-radius:20px;">
                            <span style="width:7px;height:7px;border-radius:50%;background:#2D5A27;"></span> Tersedia
                        </span>
                    @elseif($item->availability_status === 'rented')
                        <span style="display:inline-flex;align-items:center;gap:5px;background:#dbeafe;color:#1d4ed8;font-size:12px;font-weight:600;padding:6px 12px;border-radius:20px;">
                            <span style="width:7px;height:7px;border-radius:50%;background:#1d4ed8;"></span> Disewa
                        </span>
                    @else
                        <span style="display:inline-flex;align-items:center;gap:5px;background:#fef9c3;color:#a16207;font-size:12px;font-weight:600;padding:6px 12px;border-radius:20px;">
                            <span style="width:7px;height:7px;border-radius:50%;background:#a16207;"></span> Maintenance
                        </span>
                    @endif
                </div>
            </div>

            @if($item->availability_status === 'available')
            @can('store-data')
            <a href="{{ route('rentals.create') }}?equipment_id={{ $item->id }}"
               style="display:flex;align-items:center;justify-content:center;gap:6px;width:100%;padding:10px;border-radius:10px;background:#2D5A27;color:#ffffff;font-size:13px;font-weight:600;text-decoration:none;box-sizing:border-box;"
               onmouseover="this.style.background='#1e3d1a'" onmouseout="this.style.background='#2D5A27'">
                <svg width="14" height="14" fill="none" stroke="#ffffff" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Sewa Sekarang
            </a>
            @endcan
            @endif
        </div>
    </div>
    @endforeach
</div>

@else
<div style="background:#ffffff;border-radius:16px;border:1px solid #e0ddd0;padding:60px;text-align:center;">
    <div style="width:64px;height:64px;border-radius:16px;background:#f0ede4;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
        <svg width="28" height="28" fill="none" stroke="#9ca3af" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
    </div>
    <div style="font-size:16px;font-weight:600;color:#374151;margin-bottom:6px;">Tidak ada peralatan ditemukan</div>
    <div style="font-size:13px;color:#9ca3af;">Coba kata kunci yang berbeda atau lebih umum</div>
</div>
@endif

@else
{{-- State awal sebelum search --}}
<div style="background:#ffffff;border-radius:16px;border:1px solid #e0ddd0;padding:60px;text-align:center;">
    <div style="width:72px;height:72px;border-radius:20px;background:linear-gradient(135deg,#e8f5e4,#f0ede4);display:flex;align-items:center;justify-content:center;margin:0 auto 20px;">
        <svg width="32" height="32" fill="none" stroke="#2D5A27" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
        </svg>
    </div>
    <div style="font-size:18px;font-weight:700;color:#1e3d1a;margin-bottom:8px;">Cari Peralatan dengan AI</div>
    <div style="font-size:14px;color:#7a9e75;max-width:400px;margin:0 auto;">
        Ketik kebutuhanmu dengan bahasa bebas seperti <em>"tenda untuk 5 orang"</em> atau <em>"alat masak murah"</em> dan biarkan AI menemukan yang terbaik untukmu.
    </div>
</div>
@endif

@endsection