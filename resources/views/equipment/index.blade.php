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
    <p style="font-size:13px;color:#7a9e75;margin:0;">Klik kartu peralatan untuk memilih beberapa barang sekaligus</p>
    
    <div style="display:flex;align-items:center;gap:12px;flex-wrap:wrap;margin:0;">
        {{-- Form Pencarian AI --}}
        <form action="{{ route('ai-search.search') }}" method="POST" style="display:flex;align-items:center;gap:8px;margin:0;">
            @csrf
            <div style="position:relative;width:240px;">
                <svg width="16" height="16" fill="none" stroke="#7a9e75" viewBox="0 0 24 24" style="position:absolute;left:12px;top:50%;transform:translateY(-50%);pointer-events:none;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text" name="query" placeholder="Cari pakai AI..." required
                       style="width:100%;padding:9px 12px 9px 36px;border-radius:10px;border:1.5px solid #d4cfc0;font-size:13px;color:#1e3d1a;outline:none;background:#ffffff;box-sizing:border-box;transition:border-color .15s, box-shadow .15s;"
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

{{-- Grid kartu gaya Airbnb --}}
<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:24px;">
    @forelse($equipments as $item)
    <div id="card-{{ $item->id }}" 
         onclick="toggleSelectItem({{ $item->id }}, '{{ addslashes($item->equipment_name) }}', {{ $item->rental_price_per_day }}, '{{ $item->availability_status }}', '{{ $item->image ? asset(&quot;storage/&quot; . $item->image) : &quot;&quot; }}')"
         style="background:#fff; border: 1px solid #d4cfc0; border-radius: 16px; overflow: hidden; cursor: pointer; transition: all .2s; position: relative; padding: 10px; box-shadow: 0 2px 8px #0000000f;">
        
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

            {{-- Ikon Nomor Antrean Kanan Atas --}}
            <div style="position:absolute;top:12px;right:12px;">
                <div id="badge-{{ $item->id }}" class="item-badge" style="width:28px;height:28px;border-radius:50%;background:rgba(255,255,255,.85);backdrop-filter:blur(4px);display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:800;color:#2D5A27;border:1.5px solid transparent;transition:all 0.2s;">
                    {{-- Diisi nomor urut lewat JavaScript --}}
                </div>
            </div>
        </div>

        {{-- Info di bawah gambar --}}
        <div style="padding:14px 16px 16px;">
            <div style="font-size:14px;font-weight:700;color:#1e3d1a;line-height:1.3;margin-bottom:2px;">{{ $item->equipment_name }}</div>
            <div style="font-size:12px;color:#7a9e75;margin-bottom:8px;">{{ $item->category->category_name }}</div>
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
    @empty
    <div style="grid-column:1/-1;text-align:center;padding:64px;color:#a0b89a;font-size:14px;">
        Belum ada peralatan terdaftar.
    </div>
    @endforelse
</div>

@if($equipments->hasPages())
<div style="margin-top:28px;">{{ $equipments->links() }}</div>
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
            
            {{-- Wrapper List Item --}}
            <div id="modalSelectedItemsList" style="flex:1;overflow-y:auto;display:flex;flex-direction:column;gap:12px;margin-bottom:20px;padding-right:4px;">
                {{-- Di-render dinamis melalui JS --}}
            </div>

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
                {{-- Input Hidden Penampung IDs Alat untuk Controller Laravel --}}
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

                {{-- Estimasi Total Pembayaran Akumulasi --}}
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
// State Management Array Belanjaan
let selectedItems = [];

document.addEventListener('DOMContentLoaded', () => {
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('rentalDate').min = today;
    document.getElementById('returnDate').min = today;
});

// Aksi Klik Kartu
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

// Sinkronisasi UI Nomor Urut & Floating Button
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
            badgeElement.textContent = index + 1; // Mengisi Angka Antrean 1, 2, dst.
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

// Buka Modal Pemesanan Massal
function openMultiBookingModal() {
    if (selectedItems.length === 0) return;

    const listContainer = document.getElementById('modalSelectedItemsList');
    const hiddenIdContainer = document.getElementById('hiddenIdContainer');
    
    listContainer.innerHTML = '';
    hiddenIdContainer.innerHTML = '';
    
    let totalAccumulatedPricePerDay = 0;

    selectedItems.forEach(item => {
        totalAccumulatedPricePerDay += item.price;

        // Buat input hidden array untuk data POST request Laravel
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'equipment_ids[]';
        hiddenInput.value = item.id;
        hiddenIdContainer.appendChild(hiddenInput);

        // Append item ke kolom kiri modal
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

// Kalkulasi Total Akumulasi Harga * Hari
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

    document.getElementById('totalDays').textContent  = `${days} hari × Rp ${totalPricePerDay.toLocaleString('id-ID')} (Total Unit)`;
    document.getElementById('totalAmount').textContent = 'Rp ' + totalGrand.toLocaleString('id-ID');
    document.getElementById('totalBox').style.display  = 'block';
}
</script>

@endsection