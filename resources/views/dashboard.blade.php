@extends('layouts.app')
@section('title', 'Dashboard')
@section('subtitle', 'Ringkasan data rental peralatan')

@section('content')

{{-- ── Banner Denda ── --}}
<div style="background:#fff;border-top:4px solid #fff;border-bottom:1px solid #c5dfc0;padding:36px 20px;text-align:center;margin:-28px -32px 40px -32px;">
    <h2 style="font-size:22px;font-weight:800;color:#1e3d1a;margin:0 0 8px;">Lihat Denda Saya</h2>
    <p style="font-size:14px;color:#4a7a44;margin:0 0 20px;max-width:480px;display:inline-block;line-height:1.6;">Cek denda kamu terlebih dahulu sebelum melakukan pemesanan ulang. Selesaikan denda agar bisa booking kembali!</p>
    <br>
    <a href="{{ route('penalties.index') }}"
       style="display:inline-block;padding:12px 32px;border-radius:50px;font-size:14px;font-weight:700;background:#2D5A27;color:#fff;text-decoration:none;"
       onmouseover="this.style.background='#1e3d1a'" onmouseout="this.style.background='#2D5A27'">
        Lihat Denda
    </a>
</div>

{{-- ── Section Peralatan — background hijau muda ── --}}
<div style="background:#f7f6f0;border:1px solid #e0ddd0;border-radius:20px;padding:28px 28px 32px;border-top:4px solid #2D5A27;">

    {{-- Header --}}
    <div style="text-align:center;margin-bottom:24px;position:relative;">
        <p style="font-size:12px;font-weight:700;letter-spacing:.1em;color:#3a7a34;text-transform:uppercase;margin:0 0 4px;">Yang Kami Sediakan</p>
        <h2 style="font-size:24px;font-weight:800;color:#1e3d1a;margin:0;">Peralatan Camping</h2>
        <a href="{{ route('equipment.index') }}"
           style="position:absolute;right:0;bottom:0;font-size:13px;font-weight:600;color:#2D5A27;text-decoration:none;border:1.5px solid #2D5A27;padding:7px 16px;border-radius:50px;background:#fff;"
           onmouseover="this.style.background='#e8f5e4'" onmouseout="this.style.background='#fff'">
            Lihat Semua →
        </a>
    </div>

    {{-- Grid Kartu --}}
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:20px;">
        @forelse($equipments as $item)
        <div style="background:#fff;border-radius:16px;overflow:hidden;cursor:pointer;transition:transform .2s,box-shadow .2s;box-shadow:0 2px 6px rgba(0,0,0,.06);"
             onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 12px 28px #2D5A27'"
             onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 2px 6px rgba(0,0,0,.06)'"
             onclick="window.location='{{ route('equipment.index') }}'">

            {{-- Foto — background putih --}}
            <div style="position:relative;width:100%;aspect-ratio:4/3;background:#e0ddd0;overflow:hidden;border-bottom:1px solid #d4d0c4;">
                <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;">
                    <svg width="56" height="56" fill="none" stroke="#b0c8ac" opacity=".6" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2"
                              d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                @if($item->image)
                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->equipment_name }}"
                         style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;">
                @endif
                {{-- Badge status --}}
                <div style="position:absolute;top:10px;left:10px;">
                    @if($item->availability_status === 'available')
                        <span style="background:rgba(255,255,255,.95);color:#2D5A27;font-size:11px;font-weight:700;padding:3px 9px;border-radius:20px;display:inline-flex;align-items:center;gap:4px;box-shadow:0 1px 4px rgba(0,0,0,.1);">
                            <span style="width:5px;height:5px;border-radius:50%;background:#2D5A27;display:inline-block;"></span> Tersedia
                        </span>
                    @elseif($item->availability_status === 'rented')
                        <span style="background:rgba(255,255,255,.95);color:#1d4ed8;font-size:11px;font-weight:700;padding:3px 9px;border-radius:20px;display:inline-flex;align-items:center;gap:4px;box-shadow:0 1px 4px rgba(0,0,0,.1);">
                            <span style="width:5px;height:5px;border-radius:50%;background:#1d4ed8;display:inline-block;"></span> Disewa
                        </span>
                    @else
                        <span style="background:rgba(255,255,255,.95);color:#b45309;font-size:11px;font-weight:700;padding:3px 9px;border-radius:20px;display:inline-flex;align-items:center;gap:4px;box-shadow:0 1px 4px rgba(0,0,0,.1);">
                            <span style="width:5px;height:5px;border-radius:50%;background:#b45309;display:inline-block;"></span> Maintenance
                        </span>
                    @endif
                </div>
            </div>

            {{-- Info --}}
            <div style="padding:12px 14px 14px;">
                <p style="font-size:14px;font-weight:700;color:#1e3d1a;margin:0 0 3px;line-height:1.3;">{{ $item->equipment_name }}</p>
                <p style="font-size:12px;color:#7a9e75;margin:0 0 8px;">{{ $item->category->category_name }}</p>
                <p style="font-size:14px;color:#1e3d1a;margin:0;">
                    <strong>Rp {{ number_format($item->rental_price_per_day, 0, ',', '.') }}</strong>
                    <span style="font-size:12px;color:#a0b89a;font-weight:400;"> / hari</span>
                </p>
            </div>
        </div>
        @empty
        <div style="grid-column:1/-1;text-align:center;padding:50px 20px;color:#7a9e75;">
            <svg width="48" height="48" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="margin:0 auto 10px;opacity:.4;display:block;">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
            </svg>
            <p style="font-size:14px;">Belum ada peralatan tersedia.</p>
        </div>
        @endforelse
    </div>

    {{-- ── Pagination ── --}}
    @if($equipments->hasPages())
    <div style="display:flex;justify-content:center;margin-top:28px;">
        <div style="display:inline-flex;align-items:center;gap:4px;background:#fff;border:1px solid #ddd;border-radius:12px;padding:6px;">

            {{-- Prev --}}
            @if($equipments->onFirstPage())
                <span style="width:36px;height:36px;display:flex;align-items:center;justify-content:center;border-radius:8px;color:#ccc;cursor:default;">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </span>
            @else
                <a href="{{ $equipments->previousPageUrl() }}" style="width:36px;height:36px;display:flex;align-items:center;justify-content:center;border-radius:8px;color:#2D5A27;text-decoration:none;transition:background .15s;"
                   onmouseover="this.style.background='#e8f5e4'" onmouseout="this.style.background='transparent'">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </a>
            @endif

            {{-- Page Numbers --}}
            @foreach($equipments->getUrlRange(1, $equipments->lastPage()) as $page => $url)
                @if($page == $equipments->currentPage())
                    <span style="width:36px;height:36px;display:flex;align-items:center;justify-content:center;border-radius:8px;background:#2D5A27;color:#fff;font-size:14px;font-weight:600;">
                        {{ $page }}
                    </span>
                @else
                    <a href="{{ $url }}" style="width:36px;height:36px;display:flex;align-items:center;justify-content:center;border-radius:8px;color:#4a5568;font-size:14px;font-weight:500;text-decoration:none;transition:background .15s;"
                       onmouseover="this.style.background='#e8f5e4';this.style.color='#2D5A27'" onmouseout="this.style.background='transparent';this.style.color='#4a5568'">
                        {{ $page }}
                    </a>
                @endif
            @endforeach

            {{-- Next --}}
            @if($equipments->hasMorePages())
                <a href="{{ $equipments->nextPageUrl() }}" style="width:36px;height:36px;display:flex;align-items:center;justify-content:center;border-radius:8px;color:#2D5A27;text-decoration:none;transition:background .15s;"
                   onmouseover="this.style.background='#e8f5e4'" onmouseout="this.style.background='transparent'">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            @else
                <span style="width:36px;height:36px;display:flex;align-items:center;justify-content:center;border-radius:8px;color:#ccc;cursor:default;">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </span>
            @endif

        </div>
    </div>
    @endif

</div>

{{-- ── Section Tentang RentEase ── --}}
<div style="margin-top:32px;background:#1e3d1a;border-radius:20px;overflow:hidden;padding:52px 52px;">
    <div style="display:flex;align-items:center;gap:52px;flex-wrap:wrap;">

        {{-- Teks Kiri --}}
        <div style="flex:1;min-width:280px;">
            <p style="font-size:11px;font-weight:700;letter-spacing:.15em;text-transform:uppercase;color:#7bc67a;margin:0 0 10px;">Cerita Kami</p>
            <h2 style="font-size:32px;font-weight:800;color:#fff;margin:0 0 20px;line-height:1.2;">Tentang <span style="color:#ffffffcc;">Rent</span><span style="color:#7bc67a;">Ease</span></h2>
            <p style="font-size:15px;color:#ffffffcc;line-height:1.75;margin:0 0 16px;">
                RentEase hadir dari kecintaan terhadap alam bebas dan semangat berbagi pengalaman camping kepada semua orang. Kami percaya bahwa keterbatasan peralatan tidak boleh menghalangi siapapun untuk menjelajahi alam.
            </p>
            <p style="font-size:15px;color:#ffffffbf;line-height:1.75;margin:0 0 32px;">
                Setiap peralatan yang kami sediakan telah melalui seleksi ketat — dari tenda, carrier, hingga sleeping bag — agar petualangan kamu aman, nyaman, dan tak terlupakan.
            </p>

            {{-- Stats --}}
            <div style="display:flex;gap:36px;flex-wrap:wrap;">
                <div>
                    <p style="font-size:28px;font-weight:800;color:#7bc67a;margin:0;">{{ $totalEquipment }}+</p>
                    <p style="font-size:13px;color:rgba(255,255,255,.65);margin:4px 0 0;">Unit Peralatan</p>
                </div>
                <div>
                    <p style="font-size:28px;font-weight:800;color:#7bc67a;margin:0;">{{ $availableEquipment }}+</p>
                    <p style="font-size:13px;color:rgba(255,255,255,.65);margin:4px 0 0;">Siap Disewa</p>
                </div>
                <div>
                    <p style="font-size:28px;font-weight:800;color:#7bc67a;margin:0;">{{ $totalRentals }}+</p>
                    <p style="font-size:13px;color:rgba(255,255,255,.65);margin:4px 0 0;">Transaksi</p>
                </div>
            </div>
        </div>

        {{-- Gambar Kanan --}}
    <div style="flex-shrink:0;width:340px;max-width:100%;">
    <div style="border-radius:16px;overflow:hidden;aspect-ratio:4/3;box-shadow:0 20px 50px rgba(0,0,0,.4);">
    <img src="{{ asset('image/bg_1.jpg') }}" alt="RentEase"
             style="width:100%;height:100%;object-fit:cover;">
    </div>
</div>
    </div>
</div>

{{-- ── Section Keunggulan ── --}}
<div style="margin-top:32px;background:#fff;border-radius:20px;padding:52px 40px;text-align:center;">
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:40px;">

        {{-- Item 1 --}}
        <div>
            <div style="width:52px;height:52px;background:#e4f3e0;border-radius:14px;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                <svg width="24" height="24" fill="none" stroke="#2D5A27" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
            </div>
            <h3 style="font-size:16px;font-weight:700;color:#1e3d1a;margin:0 0 10px;">Peralatan Berkualitas</h3>
            <p style="font-size:14px;color:#7a9e75;line-height:1.7;margin:0;">
                Kami hanya menyediakan peralatan camping berkualitas tinggi yang telah dicek dan dirawat secara rutin.
            </p>
        </div>

        {{-- Item 2 --}}
        <div>
            <div style="width:52px;height:52px;background:#e4f3e0;border-radius:14px;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                <svg width="24" height="24" fill="none" stroke="#2D5A27" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h3 style="font-size:16px;font-weight:700;color:#1e3d1a;margin:0 0 10px;">Booking Mudah</h3>
            <p style="font-size:14px;color:#7a9e75;line-height:1.7;margin:0;">
                Pesan peralatan kapan saja dan di mana saja lewat website. Proses cepat, transparan, dan tanpa ribet.
            </p>
        </div>

        {{-- Item 3 --}}
        <div>
            <div style="width:52px;height:52px;background:#e4f3e0;border-radius:14px;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                <svg width="24" height="24" fill="none" stroke="#2D5A27" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2z"/>
                </svg>
            </div>
            <h3 style="font-size:16px;font-weight:700;color:#1e3d1a;margin:0 0 10px;">Harga Terjangkau</h3>
            <p style="font-size:14px;color:#7a9e75;line-height:1.7;margin:0;">
                Nikmati pengalaman camping terbaik dengan harga sewa yang bersahabat. Hemat biaya, maksimal pengalaman.
            </p>
        </div>

    </div>
</div>
@endsection