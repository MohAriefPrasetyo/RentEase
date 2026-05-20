@extends('layouts.app')
@section('title', 'Tambah Peralatan')
@section('subtitle', 'Tambah data peralatan baru ke katalog')
 
@section('content')
 
<div style="max-width:680px;">
 
    {{-- Breadcrumb --}}
    <div style="display:flex;align-items:center;gap:8px;font-size:13px;color:#8D8474;margin-bottom:20px;">
        <a href="{{ route('equipment.index') }}" style="color:#2D5A27;text-decoration:none;font-weight:600;">Peralatan</a>
        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        <span>Tambah Baru</span>
    </div>
 
    <div style="background:#fff;border-radius:20px;border:1px solid #EBE5D5;overflow:hidden;">
 
        {{-- Card Header --}}
        <div style="padding:22px 28px;border-bottom:1px solid #F5F1E8;background:#FAFAF7;display:flex;align-items:center;gap:12px;">
            <div style="width:40px;height:40px;border-radius:10px;background:#e4f3e0;display:flex;align-items:center;justify-content:center;">
                <svg width="20" height="20" fill="none" stroke="#2D5A27" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
            </div>
            <div>
                <h2 style="font-size:15px;font-weight:700;color:#1C3D1F;">Tambah Peralatan Baru</h2>
                <p style="font-size:12px;color:#8D8474;margin-top:1px;">Isi semua informasi peralatan</p>
            </div>
        </div>
 
        {{-- Form --}}
        <form action="{{ route('equipment.store') }}" method="POST" enctype="multipart/form-data" style="padding:28px;">
 
            @csrf
 
            {{-- Foto Upload --}}
            <div style="margin-bottom:22px;">
                <label class="form-label">Foto Peralatan</label>
                <div id="drop-zone" class="upload-area" onclick="document.getElementById('image-input').click()"
                     ondragover="event.preventDefault();this.classList.add('dragover')"
                     ondragleave="this.classList.remove('dragover')"
                     ondrop="handleDrop(event)">
                    <div id="upload-placeholder">
                        <svg class="upload-icon" fill="none" stroke="#8D8474" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 16M14 8h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p style="font-size:14px;font-weight:600;color:#5C3D1E;margin-bottom:4px;">Klik atau seret foto ke sini</p>
                        <p style="font-size:12px;color:#8D8474;">JPG, PNG, WebP — maks. 2MB</p>
                    </div>
                    <div id="preview-wrapper" style="display:none;">
                        <img id="image-preview" src="" alt="Preview"
                             style="max-height:200px;max-width:100%;border-radius:10px;object-fit:contain;">
                        <p id="preview-name" style="font-size:12px;color:#5C3D1E;margin-top:8px;font-weight:600;"></p>
                        <button type="button" onclick="clearImage(event)"
                                style="margin-top:8px;font-size:12px;color:#C0392B;background:none;border:none;cursor:pointer;font-weight:600;">
                            ✕ Hapus foto
                        </button>
                    </div>
                </div>
                <input type="file" id="image-input" name="image" accept="image/*"
                       style="display:none;" onchange="previewImage(this)">
                @error('image')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>
 
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:18px;margin-bottom:18px;">
                {{-- Nama Peralatan --}}
                <div style="grid-column:1/-1;">
                    <label class="form-label">Nama Peralatan <span style="color:#C0392B;">*</span></label>
                    <input type="text" name="equipment_name" value="{{ old('equipment_name') }}"
                           placeholder="Contoh: Tenda Eiger 4P"
                           class="form-input @error('equipment_name') error @enderror">
                    @error('equipment_name')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
 
                {{-- Kategori --}}
                <div>
                    <label class="form-label">Kategori <span style="color:#C0392B;">*</span></label>
                    <select name="equipment_category_id"
                            class="form-input @error('equipment_category_id') error @enderror">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('equipment_category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->category_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('equipment_category_id')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
 
                {{-- Status --}}
                <div>
                    <label class="form-label">Status <span style="color:#C0392B;">*</span></label>
                    <select name="availability_status" class="form-input">
                        <option value="available" {{ old('availability_status') == 'available' ? 'selected' : '' }}>✅ Tersedia</option>
                        <option value="rented"    {{ old('availability_status') == 'rented'    ? 'selected' : '' }}>📦 Disewa</option>
                        <option value="maintenance" {{ old('availability_status') == 'maintenance' ? 'selected' : '' }}>🔧 Maintenance</option>
                    </select>
                </div>
 
                {{-- Harga --}}
                <div style="grid-column:1/-1;">
                    <label class="form-label">Harga Sewa per Hari (Rp) <span style="color:#C0392B;">*</span></label>
                    <div style="position:relative;">
                        <span style="position:absolute;left:14px;top:50%;transform:translateY(-50%);font-size:13px;font-weight:600;color:#8D8474;">Rp</span>
                        <input type="number" name="rental_price_per_day" value="{{ old('rental_price_per_day') }}"
                               placeholder="75000" min="0"
                               class="form-input @error('rental_price_per_day') error @enderror"
                               style="padding-left:42px;">
                    </div>
                    @error('rental_price_per_day')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>
 
            {{-- Buttons --}}
            <div style="display:flex;align-items:center;gap:12px;padding-top:8px;border-top:1px solid #F5F1E8;">
                <button type="submit" class="btn-primary">
                    <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Peralatan
                </button>
                <a href="{{ route('equipment.index') }}" class="btn-ghost">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
 
<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        const file = input.files[0];
        const reader = new FileReader();
        reader.onload = e => showPreview(e.target.result, file.name);
        reader.readAsDataURL(file);
    }
}
 
function showPreview(src, name) {
    document.getElementById('upload-placeholder').style.display = 'none';
    document.getElementById('preview-wrapper').style.display = 'block';
    document.getElementById('image-preview').src = src;
    document.getElementById('preview-name').textContent = name;
}
 
function clearImage(e) {
    e.stopPropagation();
    document.getElementById('image-input').value = '';
    document.getElementById('upload-placeholder').style.display = 'block';
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
</script>
 
@endsection
 