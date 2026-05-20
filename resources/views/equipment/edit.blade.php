@extends('layouts.app')
@section('title', 'Edit Peralatan')
@section('subtitle', 'Perbarui data peralatan')

@section('content')

<style>
    .form-label { display:block; font-size:12px; font-weight:600; color:#4B3621; margin-bottom:7px; letter-spacing:.3px; text-transform:uppercase; }
    .form-input {
        width:100%; border:1.5px solid #ddd9cc; border-radius:10px;
        padding:10px 14px; font-size:14px; color:#1e3d1a;
        background:#faf9f4; outline:none; transition:border .15s, box-shadow .15s;
        font-family:inherit; appearance:none; -webkit-appearance:none;
    }
    .form-input:focus { border-color:#2D5A27; box-shadow:0 0 0 3px rgba(45,90,39,0.1); }
    .form-input.error { border-color:#dc2626; }
    .form-error { font-size:12px; color:#dc2626; margin-top:5px; }
    
    /* ── Menghilangkan Tanda Panah Atas-Bawah Pada Input Number ── */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    input[type=number] {
        -moz-appearance: textfield;
    }

    .upload-area {
        border:2px dashed #c8c0ac; border-radius:14px;
        background:#faf9f4; cursor:pointer;
        transition:border .2s, background .2s;
        display:flex; align-items:center; justify-content:center;
        min-height:160px;
    }
    .upload-area:hover, .upload-area.dragover { border-color:#2D5A27; background:#f0f7ee; }
    .btn-primary {
        display:inline-flex; align-items:center; gap:8px;
        padding:11px 24px; border-radius:10px; font-size:14px;
        font-weight:600; background:#2D5A27; color:#fff;
        border:none; cursor:pointer; transition:background .15s; font-family:inherit;
    }
    .btn-primary:hover { background:#1a3a15; }
    .btn-ghost {
        display:inline-flex; align-items:center; gap:8px;
        padding:11px 20px; border-radius:10px; font-size:14px;
        font-weight:500; color:#6b7280; text-decoration:none;
        border:1.5px solid #e0ddd0; transition:all .15s; background:#fff;
    }
    .btn-ghost:hover { border-color:#2D5A27; color:#2D5A27; }
    select.form-input {
        background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%236b7280' stroke-width='2'%3E%3Cpath d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
        background-repeat:no-repeat; background-position:right 14px center; padding-right:36px;
    }
</style>

{{-- Breadcrumb --}}
<div style="display:flex;align-items:center;gap:8px;font-size:13px;color:#8D8474;margin-bottom:20px;">
    <a href="{{ route('equipment.index') }}" style="color:#2D5A27;text-decoration:none;font-weight:600;">Peralatan</a>
    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
    </svg>
    <span>Edit — {{ $equipment->equipment_name }}</span>
</div>

<form action="{{ route('equipment.update', $equipment) }}" method="POST" enctype="multipart/form-data">
@csrf @method('PUT')

{{-- ═══ GRID DUA KOLOM ═══ --}}
<div style="display:grid; grid-template-columns:340px 1fr; gap:24px; align-items:start;">

    {{-- KOLOM KIRI: Foto --}}
    <div style="background:#fff; border-radius:16px; border:1px solid #e0ddd0; overflow:hidden; box-shadow:0 2px 8px rgba(0,0,0,0.04);">
        <div style="padding:16px 20px; border-bottom:1px solid #f0ede4; background:#faf9f4; display:flex;align-items:center;gap:8px;">
            <div style="width:4px;height:18px;border-radius:4px;background:#2D5A27;"></div>
            <span style="font-size:14px;font-weight:600;color:#1e3d1a;">Foto Peralatan</span>
        </div>
        <div style="padding:20px;display:flex;flex-direction:column;gap:14px;">

            {{-- Foto saat ini --}}
            @if($equipment->image)
            <div id="current-image-block" style="border:1.5px solid #e0ddd0;border-radius:12px;padding:14px;background:#faf9f4;display:flex;align-items:center;gap:12px;">
                <img id="current-thumb" src="{{ asset('storage/' . $equipment->image) }}" alt="Foto saat ini"
                     style="width:72px;height:72px;object-fit:cover;border-radius:10px;border:1px solid #e0ddd0;flex-shrink:0;transition:all .2s;">
                <div style="flex:1;min-width:0;">
                    <p style="font-size:13px;font-weight:600;color:#1e3d1a;margin:0 0 2px;">Foto saat ini</p>
                    <p style="font-size:11px;color:#8D8474;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;margin:0 0 10px;">
                        {{ basename($equipment->image) }}
                    </p>
                    <label style="display:inline-flex;align-items:center;gap:6px;cursor:pointer;background:#fff0f0;border:1px solid #fca5a5;border-radius:6px;padding:5px 10px;">
                        <input type="checkbox" name="remove_image" value="1" id="remove-checkbox"
                               onchange="toggleRemove(this)"
                               style="width:13px;height:13px;accent-color:#dc2626;">
                        <span style="font-size:12px;color:#dc2626;font-weight:600;">Hapus foto</span>
                    </label>
                </div>
            </div>
            @endif

            {{-- Upload baru --}}
            <div id="drop-zone" class="upload-area" style="flex-direction:column;gap:0;padding:20px 16px;"
                 onclick="document.getElementById('image-input').click()"
                 ondragover="event.preventDefault();this.classList.add('dragover')"
                 ondragleave="this.classList.remove('dragover')"
                 ondrop="handleDrop(event)">
                <div id="upload-placeholder" style="display:flex;flex-direction:column;align-items:center;gap:10px;">
                    <div style="width:56px;height:56px;border-radius:12px;background:#e8f5e4;display:flex;align-items:center;justify-content:center;">
                        <svg width="26" height="26" fill="none" stroke="#2D5A27" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 16M14 8h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div style="text-align:center;">
                        <p style="font-size:13px;font-weight:600;color:#2D5A27;margin:0 0 3px;">
                            {{ $equipment->image ? 'Ganti dengan foto baru' : 'Klik atau seret foto ke sini' }}
                        </p>
                        <p style="font-size:11px;color:#8D8474;margin:0;">JPG, PNG, WebP — maks. 2MB</p>
                    </div>
                </div>
                <div id="preview-wrapper" style="display:none;flex-direction:column;align-items:center;gap:8px;width:100%;">
                    <img id="image-preview" src="" alt="Preview"
                         style="max-height:160px;max-width:100%;border-radius:10px;object-fit:contain;">
                    <p id="preview-name" style="font-size:12px;color:#2D5A27;font-weight:600;margin:0;text-align:center;"></p>
                    <button type="button" onclick="clearImage(event)"
                            style="font-size:12px;color:#dc2626;background:#fff0f0;border:1px solid #fecaca;border-radius:6px;padding:5px 12px;cursor:pointer;font-weight:600;">
                        ✕ Batal pilih foto baru
                    </button>
                </div>
            </div>
            <input type="file" id="image-input" name="image" accept="image/*" style="display:none;" onchange="previewImage(this)">
            @error('image') <p class="form-error">{{ $message }}</p> @enderror
        </div>
    </div>

    {{-- KOLOM KANAN: Detail --}}
    <div style="display:flex;flex-direction:column;gap:16px;">

        {{-- Card Header --}}
        <div style="background:#fff; border-radius:16px; border:1px solid #e0ddd0; overflow:hidden; box-shadow:0 2px 8px rgba(0,0,0,0.04);">
            <div style="padding:16px 24px; border-bottom:1px solid #f0ede4; background:#faf9f4; display:flex;align-items:center;gap:12px;">
                @if($equipment->image)
                    <img src="{{ asset('storage/' . $equipment->image) }}" alt="{{ $equipment->equipment_name }}"
                         style="width:40px;height:40px;border-radius:10px;object-fit:cover;border:2px solid #e0ddd0;flex-shrink:0;">
                @else
                    <div style="width:40px;height:40px;border-radius:10px;background:#e4f3e0;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg width="18" height="18" fill="none" stroke="#2D5A27" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </div>
                @endif
                <div>
                    <h2 style="font-size:15px;font-weight:700;color:#1e3d1a;margin:0;">{{ $equipment->equipment_name }}</h2>
                    <p style="font-size:12px;color:#8D8474;margin:2px 0 0;">{{ $equipment->category->category_name ?? '-' }}</p>
                </div>
            </div>

            <div style="padding:24px;display:flex;flex-direction:column;gap:18px;">

                {{-- Nama --}}
                <div>
                    <label class="form-label">Nama Peralatan <span style="color:#dc2626;">*</span></label>
                    <input type="text" name="equipment_name"
                           value="{{ old('equipment_name', $equipment->equipment_name) }}"
                           class="form-input {{ $errors->has('equipment_name') ? 'error' : '' }}">
                    @error('equipment_name') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                {{-- Kategori + Status --}}
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                    <div>
                        <label class="form-label">Kategori <span style="color:#dc2626;">*</span></label>
                        <select name="equipment_category_id"
                                class="form-input {{ $errors->has('equipment_category_id') ? 'error' : '' }}">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}"
                                    {{ old('equipment_category_id', $equipment->equipment_category_id) == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->category_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('equipment_category_id') <p class="form-error">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="form-label">Status <span style="color:#dc2626;">*</span></label>
                        <select name="availability_status" class="form-input">
                            <option value="available"   {{ old('availability_status', $equipment->availability_status) == 'available'   ? 'selected' : '' }}>✅ Tersedia</option>
                            <option value="rented"      {{ old('availability_status', $equipment->availability_status) == 'rented'      ? 'selected' : '' }}>📦 Disewa</option>
                            <option value="maintenance" {{ old('availability_status', $equipment->availability_status) == 'maintenance' ? 'selected' : '' }}>🔧 Maintenance</option>
                        </select>
                    </div>
                </div>

                {{-- Harga --}}
                <div>
                    <label class="form-label">Harga Sewa per Hari (Rp) <span style="color:#dc2626;">*</span></label>
                    <div style="position:relative;">
                        <span style="position:absolute;left:14px;top:50%;transform:translateY(-50%);font-size:13px;font-weight:600;color:#8D8474;">Rp</span>
                        <input type="number" name="rental_price_per_day"
                               value="{{ old('rental_price_per_day', $equipment->rental_price_per_day) }}"
                               min="0"
                               class="form-input {{ $errors->has('rental_price_per_day') ? 'error' : '' }}"
                               style="padding-left:42px;">
                    </div>
                    @error('rental_price_per_day') <p class="form-error">{{ $message }}</p> @enderror
                </div>

            </div>
        </div>

        {{-- Action Buttons --}}
        <div style="display:flex;align-items:center;gap:12px;justify-content:flex-end;">
            <a href="{{ route('equipment.index') }}" class="btn-ghost">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
                Batal
            </a>
            <button type="submit" class="btn-primary">
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Perbarui Peralatan
            </button>
        </div>

    </div>
</div>
</form>

<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => showPreview(e.target.result, input.files[0].name);
        reader.readAsDataURL(input.files[0]);
        const cb = document.getElementById('remove-checkbox');
        if (cb) cb.checked = false;
        toggleRemove({ checked: false });
    }
}
function showPreview(src, name) {
    document.getElementById('upload-placeholder').style.display = 'none';
    const pw = document.getElementById('preview-wrapper');
    pw.style.display = 'flex';
    document.getElementById('image-preview').src = src;
    document.getElementById('preview-name').textContent = name;
}
function clearImage(e) {
    e.stopPropagation();
    document.getElementById('image-input').value = '';
    document.getElementById('upload-placeholder').style.display = 'flex';
    document.getElementById('preview-wrapper').style.display = 'none';
}
function handleDrop(e) {
    e.preventDefault();
    document.getElementById('drop-zone').classList.remove('dragover');
    const file = e.dataTransfer.files[0];
    if (file && file.type.startsWith('image/')) {
        const dt = new DataTransfer();
        dt.items.add(file);
        document.getElementById('image-input').files = dt.files;
        const reader = new FileReader();
        reader.onload = ev => showPreview(ev.target.result, file.name);
        reader.readAsDataURL(file);
    }
}
function toggleRemove(cb) {
    const thumb = document.getElementById('current-thumb');
    if (thumb) {
        thumb.style.opacity = cb.checked ? '.35' : '1';
        thumb.style.filter  = cb.checked ? 'grayscale(100%)' : 'none';
    }
    if (cb.checked) clearImage({ stopPropagation: () => {} });
}
</script>

@endsection