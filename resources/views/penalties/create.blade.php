@extends('layouts.app')

@section('title', 'Tambah Denda')
@section('subtitle', 'Catat denda kerusakan peralatan')

@section('content')

{{-- Container dibuat centering dengan max-width yang rapi --}}
<div style="max-width: 800px; margin: 0 auto; padding: 0 16px;">
    
    {{-- Card Wrapper --}}
    <div style="border-radius: 20px; border: 1px solid #e0ddd0; background: #fff; overflow: hidden; box-shadow: 0 2px 12px rgba(0,0,0,.06);">
        
        {{-- Header Internal Card --}}
        <div style="padding: 18px 28px; border-bottom: 1px solid #f0ede4; display: flex; align-items: center; gap: 10px; background: #faf9f6;">
            <div style="width: 4px; height: 22px; border-radius: 4px; background: #2D5A27;"></div>
            <span style="font-size: 15px; font-weight: 700; color: #1e3d1a;">Formulir Data Kerusakan</span>
        </div>

        {{-- Form Area --}}
        <form action="{{ route('penalties.store') }}" method="POST" style="padding: 28px; display: flex; flex-direction: column; gap: 20px;">
            @csrf

            {{-- Input Rental --}}
            <div>
                <label style="display: block; font-size: 12px; font-weight: 600; color: #4B3621; margin-bottom: 6px;">Pilih Transaksi Rental <span style="color: #dc2626;">*</span></label>
                <select name="rental_id"
                        style="width: 100%; border: 1.5px solid #d4cfc0; border-radius: 10px; padding: 11px 14px; font-size: 13px; color: #1e3d1a; background: #faf9f6; outline: none; box-sizing: border-box; transition: all 0.2s;"
                        onfocus="this.style.borderColor='#2D5A27'; this.style.boxShadow='0 0 0 3px rgba(45,90,39,.1)';"
                        onblur="this.style.borderColor='#d4cfc0'; this.style.boxShadow='none';"
                        class="@error('rental_id') border-red-400 @enderror">
                    <option value="">-- Pilih Transaksi Rental --</option>
                    @foreach($rentals as $rental)
                        <option value="{{ $rental->id }}" {{ old('rental_id') == $rental->id ? 'selected' : '' }}>
                            #{{ $rental->id }} — {{ $rental->renter_name }} ({{ $rental->items->pluck('equipment.equipment_name')->join(', ') }})
                        </option>
                    @endforeach
                </select>
                @error('rental_id') <p style="color: #dc2626; font-size: 11px; margin: 4px 0 0;">{{ $message }}</p> @enderror
            </div>

            {{-- Input Biaya Denda --}}
            <div>
                <label style="display: block; font-size: 12px; font-weight: 600; color: #4B3621; margin-bottom: 6px;">Biaya Denda (Rp) <span style="color: #dc2626;">*</span></label>
                <div style="position: relative; display: flex; align-items: center;">
                    <span style="position: absolute; left: 14px; font-size: 13px; font-weight: 600; color: #7a9e75;">Rp</span>
                    <input type="number" name="penalty_fee" value="{{ old('penalty_fee') }}"
                           placeholder="Contoh: 50000" min="0"
                           style="width: 100%; border: 1.5px solid #d4cfc0; border-radius: 10px; padding: 11px 14px 11px 38px; font-size: 13px; color: #1e3d1a; background: #faf9f6; outline: none; box-sizing: border-box; transition: all 0.2s;"
                           onfocus="this.style.borderColor='#2D5A27'; this.style.boxShadow='0 0 0 3px rgba(45,90,39,.1)';"
                           onblur="this.style.borderColor='#d4cfc0'; this.style.boxShadow='none';"
                           class="@error('penalty_fee') border-red-400 @enderror">
                </div>
                @error('penalty_fee') <p style="color: #dc2626; font-size: 11px; margin: 4px 0 0;">{{ $message }}</p> @enderror
            </div>

            {{-- Input Deskripsi Kerusakan --}}
            <div>
                <label style="display: block; font-size: 12px; font-weight: 600; color: #4B3621; margin-bottom: 6px;">Deskripsi Kerusakan <span style="color: #dc2626;">*</span></label>
                <textarea name="damage_description" rows="4"
                          placeholder="Jelaskan secara detail mengenai kerusakan kelengkapan atau unit barang..."
                          style="width: 100%; border: 1.5px solid #d4cfc0; border-radius: 10px; padding: 11px 14px; font-size: 13px; color: #1e3d1a; background: #faf9f6; outline: none; box-sizing: border-box; resize: none; transition: all 0.2s;"
                          onfocus="this.style.borderColor='#2D5A27'; this.style.boxShadow='0 0 0 3px rgba(45,90,39,.1)';"
                          onblur="this.style.borderColor='#d4cfc0'; this.style.boxShadow='none';"
                          class="@error('damage_description') border-red-400 @enderror">{{ old('damage_description') }}</textarea>
                @error('damage_description') <p style="color: #dc2626; font-size: 11px; margin: 4px 0 0;">{{ $message }}</p> @enderror
            </div>

            {{-- Tombol Aksi --}}
            <div style="display: flex; justify-content: flex-end; align-items: center; gap: 12px; padding-top: 10px; border-top: 1px solid #f0ede4;">
                <a href="{{ route('penalties.index') }}"
                   style="font-size: 13px; font-weight: 700; padding: 11px 24px; border-radius: 10px; color: #4B3621; text-decoration: none; background: #f0ede4; border: 1px solid #d4cfc0; transition: all 0.2s;"
                   onmouseover="this.style.background='#e0ddd0'" onmouseout="this.style.background='#f0ede4'">
                    Batal
                </a>
                <button type="submit"
                        style="padding: 11px 28px; border-radius: 10px; font-size: 13px; font-weight: 700; background: #2D5A27; color: #fff; border: none; cursor: pointer; transition: all 0.2s;"
                        onmouseover="this.style.background='#1e3d1a'" onmouseout="this.style.background='#2D5A27'">
                    Simpan Alat & Denda
                </button>
            </div>
        </form>
    </div>
</div>

@endsection