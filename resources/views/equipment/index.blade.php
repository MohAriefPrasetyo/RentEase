@extends('layouts.app')
@section('title', 'Peralatan')
@section('subtitle', 'Pilih peralatan untuk disewa')

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
    
    {{-- Info teks di sebelah kiri --}}
    <p style="font-size:13px;color:#7a9e75;margin:0;">Klik kartu peralatan untuk booking</p>
    
    {{-- Kontainer Kanan (Form Cari + Tombol Tambah Peralatan) --}}
    <div style="display:flex;align-items:center;gap:12px;flex-wrap:wrap;margin:0;">
        
        {{-- Form Pencarian AI --}}
        <form action="{{ route('ai-search.search') }}" method="POST" style="display:flex;align-items:center;gap:8px;margin:0;">
            @csrf
            <div style="position:relative;width:240px;">
                <svg width="16" height="16" fill="none" stroke="#7a9e75" viewBox="0 0 24 24"
                     style="position:absolute;left:12px;top:50%;transform:translateY(-50%);pointer-events:none;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text" name="query" placeholder="Cari pakai AI..." required
                       style="width:100%;padding:9px 12px 9px 36px;border-radius:10px;border:1.5px solid #d4cfc0;font-size:13px;color:#1e3d1a;outline:none;background:#ffffff;box-sizing:border-box;transition:border-color .15s, box-shadow .15s;"
                       onfocus="this.style.borderColor='#2D5A27';this.style.boxShadow='0 0 0 3px rgba(45,90,39,0.1)'" 
                       onblur="this.style.borderColor='#d4cfc0';this.style.boxShadow='none'">
            </div>
            <button type="submit"
                    style="background:#2D5A27;color:#F5F5DC;font-size:13px;font-weight:700;padding:9px 16px;border-radius:10px;border:none;cursor:pointer;transition:background .15s, transform .1s;"
                    onmouseover="this.style.background='#1e3d1a'" onmouseout="this.style.background='#2D5A27'"
                    onmousedown="this.style.transform='scale(0.98)'" onmouseup="this.style.transform='scale(1)'">
                Cari
            </button>
        </form>

        {{-- Tombol Tambah Peralatan (jika admin) --}}
        @can('store-data')
        <a href="{{ route('equipment.create') }}"
           style="background:#2D5A27;color:#F5F5DC;font-size:13px;font-weight:600;padding:9px 16px;border-radius:10px;display:inline-flex;align-items:center;gap:6px;text-decoration:none;transition:background .15s, transform .1s;"
           onmouseover="this.style.background='#1e3d1a'" onmouseout="this.style.background='#2D5A27'"
           onmousedown="this.style.transform='scale(0.98)'" onmouseup="this.style.transform='scale(1)'">
            <svg width="15" height="15" fill="none" stroke="#F5F5DC" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Peralatan
        </a>
        @endcan

    </div>
</div>

{{-- Grid kartu gaya Airbnb --}}
<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:24px;">
    @forelse($equipments as $item)
    <div onclick="openBooking({{ $item->id }}, '{{ addslashes($item->equipment_name) }}', '{{ $item->category->category_name }}', {{ $item->rental_price_per_day }}, '{{ $item->availability_status }}', '{{ $item->image ? asset('storage/' . $item->image) : '' }}')"
         style="background:#fff; border: 1px solid #d4cfc0; border-radius: 16px; overflow: hidden; cursor: pointer; transition: transform .2s, box-shadow .2s; position: relative; padding: 10px; box-shadow: 0 2px 8px #0000000f;"
         onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 32px #2D5A27'"
         onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px #0000000f'">
        {{-- Gambar / placeholder --}}
        <div style="position:relative;width:100%;aspect-ratio:4/3;background:linear-gradient(135deg,#c8dfc4 0%,#e8f0e6 100%);overflow:hidden;">

            {{-- Placeholder icon camping (tampil jika tidak ada foto) --}}
            <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;">
                <svg width="64" height="64" fill="none" stroke="#2D5A27" opacity=".25" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2"
                          d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
            </div>

            {{-- Foto asli jika ada --}}
            @if($item->image)
                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->equipment_name }}"
                     style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;">
            @endif

            {{-- Status badge kiri atas --}}
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

            {{-- Ikon simpan kanan atas --}}
            @if($item->availability_status === 'available')
            <div style="position:absolute;top:12px;right:12px;">
                <div style="width:32px;height:32px;border-radius:50%;background:rgba(255,255,255,.85);backdrop-filter:blur(4px);display:flex;align-items:center;justify-content:center;">
                    <svg width="16" height="16" fill="none" stroke="#1e3d1a" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
            @endif
        </div>

        {{-- Info di bawah gambar --}}
        <div style="padding:14px 16px 16px;">
            <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:8px;margin-bottom:2px;">
                <div style="font-size:14px;font-weight:700;color:#1e3d1a;line-height:1.3;">{{ $item->equipment_name }}</div>
            </div>
            <div style="font-size:12px;color:#7a9e75;margin-bottom:8px;">{{ $item->category->category_name }}</div>
            <div style="font-size:14px;color:#1e3d1a;">
                <span style="font-weight:700;">Rp {{ number_format($item->rental_price_per_day, 0, ',', '.') }}</span>
                <span style="font-weight:400;color:#7a9e75;"> / hari</span>
            </div>

            {{-- Tombol edit/hapus admin --}}
            @can('edit-data')
            <div style="display:flex;gap:6px;margin-top:12px;padding-top:12px;border-top:1px solid #f0ede4;" onclick="event.stopPropagation()">
                <a href="{{ route('equipment.edit', $item) }}"
                   style="flex:1;text-align:center;font-size:11px;font-weight:600;padding:6px 0;border-radius:8px;background:#e8f5e4;color:#2D5A27;border:1px solid #a8d5a0;text-decoration:none;"
                   onmouseover="this.style.background='#d4edda'" onmouseout="this.style.background='#e8f5e4'">Edit</a>
                <form action="{{ route('equipment.destroy', $item) }}" method="POST"
                      onsubmit="return confirm('Hapus peralatan ini?')" style="flex:1;">
                    @csrf @method('DELETE')
                    <button type="submit"
                            style="width:100%;font-size:11px;font-weight:600;padding:6px 0;border-radius:8px;background:#fde8e8;color:#b91c1c;border:1px solid #fca5a5;cursor:pointer;"
                            onmouseover="this.style.background='#fecaca'" onmouseout="this.style.background='#fde8e8'">Hapus</button>
                </form>
            </div>
            @endcan
        </div>
    </div>
    @empty
    <div style="grid-column:1/-1;text-align:center;padding:64px;color:#a0b89a;font-size:14px;">
        <svg width="48" height="48" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="margin:0 auto 12px;opacity:.3;display:block;">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
        </svg>
        Belum ada peralatan terdaftar.
    </div>
    @endforelse
</div>
</div>
@if($equipments->hasPages())
<div style="margin-top:28px;">{{ $equipments->links() }}</div>
@endif

{{-- ══════════════════════════════════════════════ --}}
{{-- MODAL BOOKING FULL LAYAR 2 KOLOM               --}}
{{-- ══════════════════════════════════════════════ --}}
<div id="bookingOverlay"
     style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:200;align-items:center;justify-content:center;backdrop-filter:blur(4px);"
     onclick="closeBooking(event)">

    <div style="background:#fff;border-radius:24px;width:calc(100% - 48px);max-width:900px;max-height:90vh;overflow:hidden;box-shadow:0 32px 80px rgba(0,0,0,.25);animation:slideUp .25s ease;display:flex;">

        {{-- ── Kolom Kiri: Foto + Info Alat ── --}}
        <div style="width:45%;background:#1e3d1a;display:flex;flex-direction:column;position:relative;overflow:hidden;">

            {{-- Foto --}}
            <div id="modalImageWrap" style="width:100%;flex:1;position:relative;min-height:260px;">
                <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;">
                    <svg width="72" height="72" fill="none" stroke="#7bc67a" opacity=".2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2"
                              d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <img id="modalImage" src="" alt=""
                     style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;display:none;">
                <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(30,61,26,.95) 0%,rgba(30,61,26,.2) 60%);"></div>
            </div>

            {{-- Info Alat --}}
            <div style="padding:28px;position:relative;z-index:1;">
                <p style="font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#7bc67a;margin:0 0 8px;">Booking Peralatan</p>
                <p id="modalName" style="font-size:22px;font-weight:800;color:#fff;margin:0 0 6px;line-height:1.2;"></p>
                <p id="modalCategory" style="font-size:13px;color:rgba(255,255,255,.6);margin:0 0 16px;"></p>
                <div style="display:inline-flex;align-items:center;gap:6px;background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.15);border-radius:10px;padding:8px 14px;">
                    <svg width="14" height="14" fill="none" stroke="#7bc67a" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span id="modalPrice" style="font-size:14px;font-weight:700;color:#7bc67a;"></span>
                </div>
            </div>
        </div>

        {{-- ── Kolom Kanan: Form Booking ── --}}
        <div style="flex:1;display:flex;flex-direction:column;overflow-y:auto;">

            {{-- Header kanan --}}
            <div style="padding:24px 28px 0;display:flex;justify-content:space-between;align-items:center;border-bottom:1px solid #f0ede4;padding-bottom:20px;">
                <div>
                    <p style="font-size:16px;font-weight:800;color:#1e3d1a;margin:0;">Form Pemesanan</p>
                    <p style="font-size:12px;color:#7a9e75;margin:4px 0 0;">Isi data di bawah ini untuk memesan</p>
                </div>
                <button onclick="closeBooking()" style="background:#f0ede4;border:none;border-radius:10px;width:36px;height:36px;cursor:pointer;display:flex;align-items:center;justify-content:center;"
                        onmouseover="this.style.background='#e0ddd0'" onmouseout="this.style.background='#f0ede4'">
                    <svg width="16" height="16" fill="none" stroke="#4B3621" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            {{-- Form --}}
            <form action="{{ route('rentals.store') }}" method="POST" style="padding:24px 28px;display:flex;flex-direction:column;gap:16px;flex:1;">
                @csrf
                <input type="hidden" name="equipment_ids[]" id="modalEquipmentId">

                <div>
                    <label style="display:block;font-size:12px;font-weight:600;color:#4B3621;margin-bottom:6px;">Nama Penyewa</label>
                    <input type="text" name="renter_name" value="{{ auth()->user()->name }}" required
                           style="width:100%;border:1.5px solid #d4cfc0;border-radius:10px;padding:10px 14px;font-size:13px;color:#1e3d1a;outline:none;box-sizing:border-box;"
                           onfocus="this.style.borderColor='#2D5A27'" onblur="this.style.borderColor='#d4cfc0'">
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
                    <div>
                        <label style="display:block;font-size:12px;font-weight:600;color:#4B3621;margin-bottom:6px;">Tanggal Sewa</label>
                        <input type="date" name="rental_date" required id="rentalDate"
                               style="width:100%;border:1.5px solid #d4cfc0;border-radius:10px;padding:10px 14px;font-size:13px;color:#1e3d1a;outline:none;box-sizing:border-box;"
                               onfocus="this.style.borderColor='#2D5A27'" onblur="this.style.borderColor='#d4cfc0'"
                               oninput="calcTotal()">
                    </div>
                    <div>
                        <label style="display:block;font-size:12px;font-weight:600;color:#4B3621;margin-bottom:6px;">Tanggal Kembali</label>
                        <input type="date" name="return_date" required id="returnDate"
                               style="width:100%;border:1.5px solid #d4cfc0;border-radius:10px;padding:10px 14px;font-size:13px;color:#1e3d1a;outline:none;box-sizing:border-box;"
                               onfocus="this.style.borderColor='#2D5A27'" onblur="this.style.borderColor='#d4cfc0'"
                               oninput="calcTotal()">
                    </div>
                </div>

                <div>
                    <label style="display:block;font-size:12px;font-weight:600;color:#4B3621;margin-bottom:6px;">Jaminan</label>
                    <input type="text" name="guarantee" placeholder="Contoh: KTP, SIM, Kartu Mahasiswa" required
                           style="width:100%;border:1.5px solid #d4cfc0;border-radius:10px;padding:10px 14px;font-size:13px;color:#1e3d1a;outline:none;box-sizing:border-box;"
                           onfocus="this.style.borderColor='#2D5A27'" onblur="this.style.borderColor='#d4cfc0'">
                </div>

                {{-- Estimasi Total --}}
                <div id="totalBox" style="display:none;background:#f0f7ee;border:1.5px solid #c5dfc0;border-radius:12px;padding:16px;">
                    <p style="font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:#7a9e75;margin:0 0 4px;">Estimasi Total</p>
                    <p id="totalAmount" style="font-size:24px;font-weight:800;color:#2D5A27;margin:0;"></p>
                    <p id="totalDays" style="font-size:11px;color:#a0b89a;margin:4px 0 0;"></p>
                </div>

                {{-- Tombol --}}
                <div style="display:flex;gap:10px;margin-top:auto;padding-top:8px;">
                    <button type="submit"
                            style="flex:1;padding:13px;border-radius:12px;background:#2D5A27;color:#fff;font-size:14px;font-weight:700;border:none;cursor:pointer;"
                            onmouseover="this.style.background='#1e3d1a'" onmouseout="this.style.background='#2D5A27'">
                        ✓ Konfirmasi Booking
                    </button>
                    <button type="button" onclick="closeBooking()"
                            style="padding:13px 20px;border-radius:12px;background:#f0ede4;color:#4B3621;font-size:14px;font-weight:600;border:1px solid #d4cfc0;cursor:pointer;"
                            onmouseover="this.style.background='#e0ddd0'" onmouseout="this.style.background='#f0ede4'">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
@keyframes slideUp {
    from { opacity:0; transform:translateY(30px); }
    to   { opacity:1; transform:translateY(0); }
}
</style>

<script>
let currentPrice = 0;

document.addEventListener('DOMContentLoaded', () => {
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('rentalDate').min = today;
    document.getElementById('returnDate').min = today;
});

function openBooking(id, name, category, price, status, image) {
    if (status !== 'available') {
        alert('Peralatan ini tidak tersedia untuk dibooking saat ini.');
        return;
    }
    currentPrice = price;
    document.getElementById('modalEquipmentId').value = id;
    document.getElementById('modalName').textContent = name;
    document.getElementById('modalCategory').textContent = category;
    document.getElementById('modalPrice').textContent = 'Rp ' + price.toLocaleString('id-ID') + ' / hari';
    document.getElementById('rentalDate').value = '';
    document.getElementById('returnDate').value = '';
    document.getElementById('totalBox').style.display = 'none';

    // Set image
    const img = document.getElementById('modalImage');
    if (image) {
        img.src = image;
        img.style.display = 'block';
    } else {
        img.style.display = 'none';
    }

    const overlay = document.getElementById('bookingOverlay');
    overlay.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeBooking(e) {
    if (e && e.target !== document.getElementById('bookingOverlay')) return;
    document.getElementById('bookingOverlay').style.display = 'none';
    document.body.style.overflow = '';
}

function calcTotal() {
    const start = new Date(document.getElementById('rentalDate').value);
    const end   = new Date(document.getElementById('returnDate').value);
    if (!start || !end || end <= start) { document.getElementById('totalBox').style.display = 'none'; return; }

    const days  = Math.ceil((end - start) / (1000 * 60 * 60 * 24));
    const total = days * currentPrice;

    document.getElementById('totalDays').textContent  = days + ' hari × Rp ' + currentPrice.toLocaleString('id-ID');
    document.getElementById('totalAmount').textContent = 'Rp ' + total.toLocaleString('id-ID');
    document.getElementById('totalBox').style.display  = 'block';
}
</script>

@endsection