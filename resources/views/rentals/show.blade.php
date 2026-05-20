@extends('layouts.app')

@section('title', 'Detail Rental')
@section('subtitle', 'Informasi lengkap transaksi rental')

@section('content')

<div style="display:flex;flex-direction:column;gap:20px;">

    {{-- ── Informasi Rental ── --}}
    <div style="background:#fff;border-radius:16px;border:1px solid #e5e7eb;padding:28px;">
        <h3 style="font-size:16px;font-weight:700;color:#111827;margin:0 0 24px;">Informasi Rental</h3>

        {{-- Foto Peralatan --}}
        @php $firstItem = $rental->items->first(); @endphp
        @if($firstItem && $firstItem->equipment->image)
        <div style="width:100%;border-radius:12px;overflow:hidden;aspect-ratio:16/5;margin-bottom:24px;">
            <img src="{{ asset('storage/' . $firstItem->equipment->image) }}"
                 alt="{{ $firstItem->equipment->equipment_name }}"
                 style="width:100%;height:100%;object-fit:cover;">
        </div>
        @else
        <div style="width:100%;border-radius:12px;overflow:hidden;aspect-ratio:16/5;margin-bottom:24px;background:linear-gradient(135deg,#c8dfc4,#e8f0e6);display:flex;align-items:center;justify-content:center;">
            <svg width="56" height="56" fill="none" stroke="#2D5A27" opacity=".25" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2"
                      d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
            </svg>
        </div>
        @endif

        {{-- Fields --}}
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:0;">

            <div style="padding:14px 0;border-bottom:1px solid #f3f4f6;">
                <p style="font-size:12px;color:#9ca3af;margin:0 0 4px;">Penyewa</p>
                <p style="font-size:14px;font-weight:600;color:#111827;margin:0;">{{ $rental->renter_name }}</p>
            </div>
            <div style="padding:14px 0;border-bottom:1px solid #f3f4f6;">
                <p style="font-size:12px;color:#9ca3af;margin:0 0 4px;">Akun</p>
                <p style="font-size:14px;font-weight:600;color:#111827;margin:0;">{{ $rental->user->email }}</p>
            </div>

            <div style="padding:14px 0;border-bottom:1px solid #f3f4f6;grid-column:span 2;">
                <p style="font-size:12px;color:#9ca3af;margin:0 0 6px;">Peralatan</p>
                @foreach($rental->items as $item)
                <div style="display:flex;justify-content:space-between;align-items:center;padding:4px 0;">
                    <p style="font-size:14px;font-weight:600;color:#111827;margin:0;">{{ $item->equipment->equipment_name }}</p>
                    <p style="font-size:14px;color:#6b7280;margin:0;">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                </div>
                @endforeach
            </div>

            <div style="padding:14px 0;border-bottom:1px solid #f3f4f6;">
                <p style="font-size:12px;color:#9ca3af;margin:0 0 4px;">Jaminan</p>
                <p style="font-size:14px;font-weight:600;color:#111827;margin:0;">{{ $rental->guarantee }}</p>
            </div>
            <div style="padding:14px 0;border-bottom:1px solid #f3f4f6;">
                <p style="font-size:12px;color:#9ca3af;margin:0 0 4px;">Tanggal Sewa</p>
                <p style="font-size:14px;font-weight:600;color:#111827;margin:0;">{{ \Carbon\Carbon::parse($rental->rental_date)->format('d M Y') }}</p>
            </div>

            <div style="padding:14px 0;border-bottom:1px solid #f3f4f6;">
                <p style="font-size:12px;color:#9ca3af;margin:0 0 4px;">Tanggal Kembali</p>
                <p style="font-size:14px;font-weight:600;color:#111827;margin:0;">{{ \Carbon\Carbon::parse($rental->return_date)->format('d M Y') }}</p>
            </div>
            <div style="padding:14px 0;border-bottom:1px solid #f3f4f6;">
                <p style="font-size:12px;color:#9ca3af;margin:0 0 4px;">Durasi</p>
                <p style="font-size:14px;font-weight:600;color:#111827;margin:0;">
                    {{ \Carbon\Carbon::parse($rental->rental_date)->diffInDays(\Carbon\Carbon::parse($rental->return_date)) }} hari
                </p>
            </div>

            <div style="padding:18px 0;grid-column:span 2;">
                <p style="font-size:12px;color:#9ca3af;margin:0 0 6px;">Total Harga</p>
                <p style="font-size:26px;font-weight:800;color:#2D5A27;margin:0;">Rp {{ number_format($rental->total_price, 0, ',', '.') }}</p>
            </div>

        </div>
    </div>

    {{-- ── Denda ── --}}
    <div style="background:#fff;border-radius:16px;border:1px solid #e5e7eb;overflow:hidden;">
        <div style="padding:20px 28px;border-bottom:1px solid #f3f4f6;">
            <h3 style="font-size:16px;font-weight:700;color:#111827;margin:0;">Denda</h3>
        </div>
        @forelse($rental->penalties as $penalty)
        <div style="padding:16px 28px;display:flex;justify-content:space-between;align-items:center;border-bottom:1px solid #f9fafb;">
            <div>
                <p style="font-size:13px;color:#374151;margin:0 0 2px;">{{ $penalty->damage_description }}</p>
                <p style="font-size:12px;color:#9ca3af;margin:0;">{{ $penalty->created_at->format('d M Y') }}</p>
            </div>
            <p style="font-size:14px;font-weight:700;color:#dc2626;margin:0;">Rp {{ number_format($penalty->penalty_fee, 0, ',', '.') }}</p>
        </div>
        @empty
        <p style="text-align:center;padding:32px;font-size:13px;color:#9ca3af;margin:0;">Tidak ada denda.</p>
        @endforelse
    </div>

    {{-- Kembali --}}
    <a href="{{ route('rentals.index') }}"
       style="display:inline-flex;align-items:center;gap:6px;font-size:13px;font-weight:600;color:#2D5A27;text-decoration:none;">
        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        Kembali ke daftar rental
    </a>

</div>

@endsection