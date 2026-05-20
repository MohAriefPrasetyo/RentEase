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
                    <svg width="18" height="18" fill="none" stroke="#9ca3af" viewBox="0 0 24 24" style="position:absolute;left:14px;top:50%;transform:translateY(-50%);pointer-events:none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" name="query" value="{{ old('query', $query) }}" placeholder="Contoh: alat camping untuk 5 orang, tenda murah, peralatan mendaki..." required style="width:100%;padding:14px 16px 14px 44px;border-radius:12px;border:none;font-size:14px;background:rgba(255,255,255,0.95);color:#1e3d1a;outline:none;box-sizing:border-box;">
                </div>
                <button type="submit" style="padding:14px 28px;border-radius:12px;background:#F5F5DC;color:#1a3518;font-weight:700;font-size:14px;border:none;cursor:pointer;white-space:nowrap;display:flex;align-items:center;gap:8px;" onmouseover="this.style.background='#e8e8c8'" onmouseout="this.style.background='#F5F5DC'">
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
            <button type="button" onclick="document.querySelector('input[name=query]').value='{{ $example }}'" style="font-size:12px;padding:5px 12px;border-radius:20px;border:1px solid rgba(255,255,255,0.25);background:rgba(255,255,255,0.1);color:#d4edda;cursor:pointer;">
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

    {{-- Results Header --}}
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;">
        <h3 style="font-size:15px;font-weight:600;color:#1e3d1a;margin:0;">
            Hasil untuk <span style="color:#2D5A27;">"{{ $query }}"</span>
            <span style="font-size:13px;font-weight:400;color:#7a9e75;"> — {{ $results->count() }} peralatan ditemukan</span>
        </h3>
        <a href="{{ route('equipment.index') }}" style="font-size:13px;color:#2D5A27;text-decoration:none;display:flex;align-items:center;gap:4px;">
            ← Lihat semua
        </a>
    </div>

    @if($results->count() > 0)
    {{-- Grid Kartu Katalog Gaya Airbnb --}}
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:24px;margin-bottom:40px;">
        @foreach($results as $item)
        <div id="card-{{ $item->id }}" 
             onclick="toggleSelectItem({{ $item->id }}, '{{ addslashes($item->equipment_name) }}', {{ $item->rental_price_per_day }}, '{{ $item->availability_status }}', '{{ $item->image ? asset('storage/' . $item->image) : '' }}')"
             style="background:#fff; border: 1px solid #d4cfc0; border-radius: 16px; overflow: hidden; cursor: pointer; transition: all .2s; position: relative; padding: 10px; box-shadow: 0 2px 8px #0000000f;">
            
            {{-- Bagian Gambar / Box-art --}}
            <div style="position:relative;width:100%;aspect-ratio:4/3;background:linear-gradient(135deg,#c8dfc4 0%,#e8f0e6 100%);overflow:hidden;border-radius:12px;">
                <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;">
                    <svg width="64" height="64" fill="none" stroke="#2D5A27" opacity=".25" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>

                @if($item->image)
                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->equipment_name }}" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;">
                @endif

                {{-- Status Badge kiri atas --}}
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

                {{-- Badge Nomor Urut Antrean Kanan Atas --}}
                <div style="position:absolute;top:12px;right:12px;">
                    <div id="badge-{{ $item->id }}" class="item-badge" style="width:28px;height:28px;border-radius:50%;background:rgba(255,255,255,.85);backdrop-filter:blur(4px);display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:800;color:#2D5A27;border:1.5px solid transparent;transition:all 0.2s;">
                        {{-- Diisi secara dinamis dengan nomor indeks melalui javascript --}}
                    </div>
                </div>
            </div>

            {{-- Deskripsi/Info di bawah gambar produk --}}
            <div style="padding:14px 16px 16px;">
                <div style="font-size:14px;font-weight:700;color:#1e3d1a;line-height:1.3;margin-bottom:2px;">{{ $item->equipment_name }}</div>
                <div style="font-size:12px;color:#7a9e75;margin-bottom:8px;">{{ $item->category->category_name ?? '-' }}</div>
                <div style="font-size:14px;color:#1e3d1a;">
                    <span style="font-weight:700;">Rp {{ number_format($item->rental_price_per_day, 0, ',', '.') }}</span>
                    <span style="font-weight:400;color:#7a9e75;"> / hari</span>
                </div>

                @can('edit-data')
                <div style="display:flex;gap:6px;margin-top:12px;padding-top:12px;border-top:1px solid #f0ede4;" onclick="event.stopPropagation()">
                    <a href="{{ route('equipment.edit', $item) }}" style="flex:1;text-align:center;font-size:11px;font-weight:600;padding:6px 0;border-radius:8px;background:#e8f5e4;color:#2D5A27;border:1px solid #a8d5a0;text-decoration:none;">Edit</a>
                    <form action="{{ route('equipment.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus peralatan ini?')" style="flex:1;">
                        @csrf @method('DELETE')
                        <button type="submit" style="width:100%;font-size:11px;font-weight:600;padding:6px 0;border-radius:8px;background:#fde8e8;color:#b91c1c;border:1px solid #fca5a5;cursor:pointer;">Hapus</button>
                    </form>
                </div>
                @endcan
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
    {{-- State awal sebelum user mengetikkan pencarian --}}
    <div style="background:#ffffff;border-radius:16px;border:1px solid #e0ddd0;padding:60px;text-align:center;">
        <div style="width:72px;height:72px;border-radius:20px;background:linear-gradient(135deg,#e8f5e4,#f0ede4);display:flex;align-items:center;justify-content:center;margin:0 auto 20px;">
            <svg width="32" height="32" fill="none" stroke="#2D5A27" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
            </svg>
        </div>
        <div style="font-size:18px;font-weight:700;color:#1e3d1a;margin-bottom:8px;">Cari Peralatan dengan AI</div>
        <div style="font-size:14px;color:#7a9e75;max-width:400px;margin:0 auto;">
            Ketik kebutuhanmu dengan bahasa bebas seperti <em>"tenda untuk 10 orang"</em> atau <em>"alat masak outdoor"</em> dan biarkan AI menemukan yang terbaik untukmu.
        </div>
    </div>
@endif

{{-- ══════════════════════════════════════════════ --}}
{{-- FLOATING ACTION BUTTON (SEWA DI TENGAH BAWAH) --}}
{{-- ══════════════════════════════════════════════ --}}
<div id="floatingSewaBtn" onclick="openMultiBookingModal()" 
     style="display:none; position:fixed; bottom:32px; left:50%; transform:translateX(-50%); background:#2D5A27; color:#fff; padding:16px 28px; border-radius:50px; box-shadow:0 12px 36px rgba(45,90,39,0.4); cursor:pointer; z-index:150; align-items:center; gap:12px; font-weight:700; font-size:15px; transition: background 0.2s, bottom 0.2s; animation:popInTengah 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);">
    <div style="position:relative; display:flex; align-items:center;">
        <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.3" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 0a2 2 0 100 4 2 2 0 000-4z"/>
        </svg>
        <span id="floatingCartCount" style="position:absolute; top:-10px; right:-12px; background:#b91c1c; color:#fff; font-size:11px; font-weight:800; border-radius:10px; padding:2px 7px; min-width:12px; text-align:center; box-shadow:0 2px 5px rgba(0,0,0,0.2);">0</span>
    </div>
    <span>Sewa Sekarang</span>
</div>

{{-- ══════════════════════════════════════════════ --}}
{{-- MODAL BOOKING MULTI-ITEM                     --}}
{{-- ══════════════════════════════════════════════ --}}
<div id="bookingOverlay" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:200;align-items:center;justify-content:center;backdrop-filter:blur(4px);" onclick="closeBooking(event)">
    <div style="background:#fff;border-radius:24px;width:calc(100% - 48px);max-width:900px;max-height:90vh;overflow:hidden;box-shadow:0 32px 80px rgba(0,0,0,.25);animation:slideUp .25s ease;display:flex;">

        {{-- ── Kolom Kiri: Ringkasan Daftar Barang Terpilih ── --}}
        <div style="width:45%;background:#1e3d1a;display:flex;flex-direction:column;padding:32px;box-sizing:border-box;color:#fff;">
            <p style="font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#7bc67a;margin:0 0 4px;">Daftar Sewa</p>
            <h3 style="font-size:22px;font-weight:800;margin:0 0 16px;line-height:1.2;">Multi-Item Rental</h3>
            
            {{-- Wrapper List Item dinamis --}}
            <div id="modalSelectedItemsList" style="flex:1;overflow-y:auto;display:flex;flex-direction:column;gap:12px;margin-bottom:20px;padding-right:4px;"></div>

            <div style="border-top:1.5px dashed rgba(255,255,255,0.15);padding-top:16px;">
                <div style="display:flex;justify-content:space-between;font-size:13px;color:rgba(255,255,255,.6);margin-bottom:4px;">
                    <span>Total Harga Barang:</span>
                    <span id="modalSummaryBasePrice">Rp 0/hari</span>
                </div>
            </div>
        </div>

        {{-- ── Kolom Kanan: Form Booking ── --}}
        <div style="flex:1;display:flex;flex-direction:column;overflow-y:auto;">
            <div style="padding:24px 28px 0;display:flex;justify-content:space-between;align-items:center;border-bottom:1px solid #f0ede4;padding-bottom:20px;">
                <div>
                    <p style="font-size:16px;font-weight:800;color:#1e3d1a;margin:0;">Form Pemesanan</p>
                    <p style="font-size:12px;color:#7a9e75;margin:4px 0 0;">Isi data di bawah ini untuk memproses sewa massal</p>
                </div>
                <button onclick="closeBooking()" style="background:#f0ede4;border:none;border-radius:10px;width:36px;height:36px;cursor:pointer;display:flex;align-items:center;justify-content:center;">
                    <svg width="16" height="16" fill="none" stroke="#4B3621" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <form action="{{ route('rentals.store') }}" method="POST" style="padding:24px 28px;display:flex;flex-direction:column;gap:16px;flex:1;">
                @csrf
                {{-- Input Hidden Penampung IDs Alat untuk Controller --}}
                <div id="hiddenIdContainer"></div>

                <div>
                    <label style="display:block;font-size:12px;font-weight:600;color:#4B3621;margin-bottom:6px;">Nama Penyewa</label>
                    <input type="text" name="renter_name" value="{{ auth()->user()->name }}" required style="width:100%;border:1.5px solid #d4cfc0;border-radius:10px;padding:10px 14px;font-size:13px;color:#1e3d1a;outline:none;box-sizing:border-box;">
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
                    <div>
                        <label style="display:block;font-size:12px;font-weight:600;color:#4B3621;margin-bottom:6px;">Tanggal Sewa</label>
                        <input type="date" name="rental_date" required id="rentalDate" style="width:100%;border:1.5px solid #d4cfc0;border-radius:10px;padding:10px 14px;font-size:13px;color:#1e3d1a;outline:none;" oninput="calcTotal()">
                    </div>
                    <div>
                        <label style="display:block;font-size:12px;font-weight:600;color:#4B3621;margin-bottom:6px;">Tanggal Kembali</label>
                        <input type="date" name="return_date" required id="returnDate" style="width:100%;border:1.5px solid #d4cfc0;border-radius:10px;padding:10px 14px;font-size:13px;color:#1e3d1a;outline:none;" oninput="calcTotal()">
                    </div>
                </div>

                <div>
                    <label style="display:block;font-size:12px;font-weight:600;color:#4B3621;margin-bottom:6px;">Jaminan</label>
                    <input type="text" name="guarantee" placeholder="Contoh: KTP, SIM, Kartu Mahasiswa" required style="width:100%;border:1.5px solid #d4cfc0;border-radius:10px;padding:10px 14px;font-size:13px;color:#1e3d1a;outline:none;">
                </div>

                {{-- Estimasi Total Ringkasan Akumulasi --}}
                <div id="totalBox" style="display:none;background:#f0f7ee;border:1.5px solid #c5dfc0;border-radius:12px;padding:16px;">
                    <p style="font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:#7a9e75;margin:0 0 4px;">Estimasi Total Pembayaran</p>
                    <p id="totalAmount" style="font-size:24px;font-weight:800;color:#2D5A27;margin:0;"></p>
                    <p id="totalDays" style="font-size:11px;color:#a0b89a;margin:4px 0 0;"></p>
                </div>

                <div style="display:flex;gap:10px;margin-top:auto;padding-top:8px;">
                    <button type="submit" style="flex:1;padding:13px;border-radius:12px;background:#2D5A27;color:#fff;font-size:14px;font-weight:700;border:none;cursor:pointer;">✓ Konfirmasi Booking</button>
                    <button type="button" onclick="closeBooking()" style="padding:13px 20px;border-radius:12px;background:#f0ede4;color:#4B3621;font-size:14px;font-weight:600;border:1px solid #d4cfc0;cursor:pointer;">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
@keyframes slideUp { 
    from { opacity:0; transform:translateY(30px); } 
    to { opacity:1; transform:translateY(0); } 
}
@keyframes popInTengah { 
    from { opacity:0; transform:translate(-50%, 20px) scale(0.8); } 
    to { opacity:1; transform:translate(-50%, 0) scale(1); } 
}
.selected-card { 
    border-color: #2D5A27 !important; 
    background: #f4faf2 !important; 
    transform: translateY(-4px); 
    box-shadow: 0 10px 24px rgba(45,90,39,0.15) !important; 
}
</style>

<script>
let selectedItems = [];

document.addEventListener('DOMContentLoaded', () => {
    const today = new Date().toISOString().split('T')[0];
    const rDate = document.getElementById('rentalDate');
    const bDate = document.getElementById('returnDate');
    if(rDate && bDate) {
        rDate.min = today;
        bDate.min = today;
    }
});

// Handler seleksi kartu barang
function toggleSelectItem(id, name, price, status, image) {
    if (status !== 'available') {
        alert('Peralatan ini sedang tidak tersedia untuk disewa.');
        return;
    }

    const index = selectedItems.findIndex(item => item.id === id);

    if (index > -1) {
        selectedItems.splice(index, 1);
        document.getElementById(`card-${id}`).classList.remove('selected-card');
    } else {
        selectedItems.push({ id, name, price, image });
        document.getElementById(`card-${id}`).classList.add('selected-card');
    }

    updateBadgesAndFloatingButton();
}

// Sinkronisasi angka badge urutan & trigger floating action button di tengah bawah
function updateBadgesAndFloatingButton() {
    document.querySelectorAll('.item-badge').forEach(badge => {
        badge.textContent = '';
        badge.style.background = 'rgba(255,255,255,.85)';
        badge.style.borderColor = 'transparent';
        badge.style.color = '#2D5A27';
    });

    selectedItems.forEach((item, index) => {
        const badgeElement = document.getElementById(`badge-${item.id}`);
        if (badgeElement) {
            badgeElement.textContent = index + 1;
            badgeElement.style.background = '#2D5A27';
            badgeElement.style.color = '#ffffff';
            badgeElement.style.borderColor = '#2D5A27';
        }
    });

    const floatingBtn = document.getElementById('floatingSewaBtn');
    const cartCount = document.getElementById('floatingCartCount');
    
    if (selectedItems.length > 0) {
        floatingBtn.style.display = 'flex';
        cartCount.textContent = selectedItems.length;
    } else {
        floatingBtn.style.display = 'none';
    }
}

// Olah data array belanjaan untuk dimasukkan ke dalam modal
function openMultiBookingModal() {
    if (selectedItems.length === 0) return;

    const listContainer = document.getElementById('modalSelectedItemsList');
    const hiddenIdContainer = document.getElementById('hiddenIdContainer');
    
    listContainer.innerHTML = '';
    hiddenIdContainer.innerHTML = '';
    
    let totalAccumulatedPricePerDay = 0;

    selectedItems.forEach(item => {
        totalAccumulatedPricePerDay += item.price;

        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'equipment_ids[]';
        hiddenInput.value = item.id;
        hiddenIdContainer.appendChild(hiddenInput);

        const itemRow = document.createElement('div');
        itemRow.style.cssText = "display:flex;align-items:center;gap:12px;background:rgba(255,255,255,0.08);padding:10px;border-radius:12px;border:1px solid rgba(255,255,255,0.1);";
        
        const imgHtml = item.image 
            ? `<img src="${item.image}" style="width:45px;height:45px;object-fit:cover;border-radius:8px;">`
            : `<div style="width:45px;height:45px;background:rgba(255,255,255,0.1);border-radius:8px;display:flex;align-items:center;justify-content:center;"><svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg></div>`;

        itemRow.innerHTML = `
            ${imgHtml}
            <div style="flex:1;min-width:0;">
                <p style="font-size:13px;font-weight:700;margin:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">${item.name}</p>
                <p style="font-size:11px;color:#7bc67a;margin:2px 0 0;">Rp ${item.price.toLocaleString('id-ID')} / hari</p>
            </div>
        `;
        listContainer.appendChild(itemRow);
    });

    document.getElementById('modalSummaryBasePrice').textContent = 'Rp ' + totalAccumulatedPricePerDay.toLocaleString('id-ID') + ' / hari';
    
    document.getElementById('rentalDate').value = '';
    document.getElementById('returnDate').value = '';
    document.getElementById('totalBox').style.display = 'none';

    document.getElementById('bookingOverlay').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeBooking(e) {
    if (e && e.target !== document.getElementById('bookingOverlay')) return;
    document.getElementById('bookingOverlay').style.display = 'none';
    document.body.style.overflow = '';
}

// Hitung total akumulasi harga sewa dikali durasi hari
function calcTotal() {
    const start = new Date(document.getElementById('rentalDate').value);
    const end   = new Date(document.getElementById('returnDate').value);
    
    if (!start || !end || end <= start) { 
        document.getElementById('totalBox').style.display = 'none'; 
        return; 
    }

    const days = Math.ceil((end - start) / (1000 * 60 * 60 * 24));
    let totalPricePerDay = selectedItems.reduce((sum, item) => sum + item.price, 0);
    const totalGrand = days * totalPricePerDay;

    document.getElementById('totalDays').textContent  = `${days} hari × Rp ${totalPricePerDay.toLocaleString('id-ID')} (Total Kompilasi)`;
    document.getElementById('totalAmount').textContent = 'Rp ' + totalGrand.toLocaleString('id-ID');
    document.getElementById('totalBox').style.display  = 'block';
}
</script>

@endsection