@extends('layouts.app')
@section('title', 'Profil Saya')
@section('subtitle', 'Kelola informasi akun Anda')

@section('content')

{{-- Container Utama: Menggunakan max-width yang jauh lebih besar agar sejajar penuh dengan layout --}}
<div style="max-width: 1300px; margin: 30px auto; padding: 0 20px;">
    
    {{-- Pembungkus Kartu Besar (Ukuran Maksimal) --}}
    <div style="width: 100%; background:#fff; border-radius:20px; border:1px solid #e0ddd0; overflow:hidden; box-shadow:0 4px 20px rgba(0,0,0,.08);">

        {{-- Banner --}}
        <div style="height:130px;background:linear-gradient(135deg,#1e3d1a 0%,#2D5A27 60%,#4a7a44 100%);position:relative;">
            <div style="position:absolute;inset:0;opacity:.1;background-image:radial-gradient(circle,#fff 1px,transparent 1px);background-size:20px 20px;"></div>
        </div>

        {{-- Avatar + Nama + Badge --}}
        <div style="padding:0 45px 24px;border-bottom:1px solid #f0ede4;">
            <div style="display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:12px;">
                <div style="display:flex;align-items:flex-end;gap:24px;">
                    {{-- Posisi Huruf A tetap aman berada di depan dan tidak terpotong --}}
                    <div style="width:90px;height:90px;border-radius:18px;background:#1e3d1a;border:4px solid #fff;display:flex;align-items:center;justify-content:center;font-size:36px;font-weight:800;color:#7bc67a;margin-top:-30px;position:relative;z-index:10;box-shadow:0 4px 16px rgba(0,0,0,.18);flex-shrink:0;">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div style="padding-bottom:4px;">
                        <p style="font-size:24px;font-weight:800;color:#1e3d1a;margin:0 0 3px;">{{ $user->name }}</p>
                        <p style="font-size:15px;color:#7a9e75;margin:0;">{{ $user->email }}</p>
                    </div>
                </div>
                <span style="font-size:13px;padding:6px 18px;border-radius:999px;font-weight:700;background:#e8f5e4;color:#2D5A27;border:1px solid #a8d5a0;margin-bottom:4px;">● Aktif</span>
            </div>
        </div>

        {{-- Stats --}}
        <div style="display:grid;grid-template-columns:repeat(3,1fr);border-bottom:1px solid #f0ede4;">
            <div style="text-align:center;padding:26px 12px;">
                <p style="font-size:30px;font-weight:800;color:#1e3d1a;margin:0;">{{ $user->rentals()->count() }}</p>
                <p style="font-size:13px;color:#7a9e75;margin:5px 0 0;">Total Rental</p>
            </div>
            <div style="text-align:center;padding:26px 12px;border-left:1px solid #f0ede4;border-right:1px solid #f0ede4;">
                <p style="font-size:30px;font-weight:800;color:#1e3d1a;margin:0;">{{ $user->created_at->format('Y') }}</p>
                <p style="font-size:13px;color:#7a9e75;margin:5px 0 0;">Bergabung</p>
            </div>
            <div style="text-align:center;padding:26px 12px;">
                <p style="font-size:22px;font-weight:700;color:#1e3d1a;margin:0;">{{ $user->created_at->diffForHumans(null, true) }}</p>
                <p style="font-size:13px;color:#7a9e75;margin:5px 0 0;">Lama bergabung</p>
            </div>
        </div>

        {{-- Informasi Akun --}}
        <div style="border-bottom:1px solid #f0ede4;">
            <div style="padding:24px 45px;border-bottom:1px solid #f0ede4;background:#faf9f6;display:flex;align-items:center;gap:12px;">
                <div style="width:4px;height:26px;border-radius:4px;background:#2D5A27;"></div>
                <span style="font-size:17px;font-weight:700;color:#1e3d1a;">Informasi Akun</span>
            </div>
            <form action="{{ route('profile.update') }}" method="POST" style="padding:36px 45px;">
                @csrf @method('PUT')

                @if(session('status') === 'profile-updated')
                <div style="background:#e8f5e4;border:1px solid #a8d5a0;border-radius:10px;padding:12px 16px;font-size:13px;color:#2D5A27;font-weight:600;margin-bottom:20px;">
                    ✓ Profil berhasil diperbarui.
                </div>
                @endif

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:30px;margin-bottom:24px;">
                    <div>
                        <label style="display:block;font-size:13px;font-weight:600;color:#4B3621;margin-bottom:8px;">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                               style="width:100%;border:1.5px solid #d4cfc0;border-radius:10px;padding:13px 18px;font-size:14px;color:#1e3d1a;background:#faf9f6;outline:none;box-sizing:border-box;"
                               onfocus="this.style.borderColor='#2D5A27';this.style.boxShadow='0 0 0 3px rgba(45,90,39,.1)'"
                               onblur="this.style.borderColor='#d4cfc0';this.style.boxShadow='none'">
                        @error('name')<p style="color:#dc2626;font-size:12px;margin:4px 0 0;">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label style="display:block;font-size:13px;font-weight:600;color:#4B3621;margin-bottom:8px;">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                               style="width:100%;border:1.5px solid #d4cfc0;border-radius:10px;padding:13px 18px;font-size:14px;color:#1e3d1a;background:#faf9f6;outline:none;box-sizing:border-box;"
                               onfocus="this.style.borderColor='#2D5A27';this.style.boxShadow='0 0 0 3px rgba(45,90,39,.1)'"
                               onblur="this.style.borderColor='#d4cfc0';this.style.boxShadow='none'">
                        @error('email')<p style="color:#dc2626;font-size:12px;margin:4px 0 0;">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div style="display:flex;justify-content:flex-end;">
                    <button type="submit"
                            style="padding:13px 36px;border-radius:10px;font-size:14px;font-weight:700;background:#2D5A27;color:#fff;border:none;cursor:pointer;"
                            onmouseover="this.style.background='#1e3d1a'" onmouseout="this.style.background='#2D5A27'">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

@endsection