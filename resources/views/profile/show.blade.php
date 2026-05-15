@extends('layouts.app')
@section('title', 'Profil Saya')
@section('subtitle', 'Kelola informasi akun Anda')

@section('content')
<div style="max-width:768px; width:100%; display:flex; flex-direction:column; gap:20px;">

    {{-- Profile Header Card --}}
    <div style="border-radius:16px; border:1px solid #e0ddd0; background:#fff;">
        {{-- Banner --}}
        <div style="height:80px; border-radius:16px 16px 0 0; background:linear-gradient(135deg, #1e3d1a 0%, #2D5A27 50%, #3a7232 100%);"></div>
        {{-- Content below banner --}}
        <div style="padding:16px 24px 20px;">
            {{-- Avatar + name row --}}
            <div style="display:flex; align-items:center; gap:16px; margin-bottom:20px;">
                <div style="width:60px; height:60px; border-radius:12px; background:#4B3621; border:3px solid #fff; display:flex; align-items:center; justify-content:center; font-size:24px; font-weight:700; color:#F5F5DC; flex-shrink:0; margin-top:-46px; box-shadow:0 2px 8px rgba(0,0,0,0.15);">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div style="flex:1;">
                    <div style="font-weight:700; font-size:16px; color:#1e3d1a;">{{ $user->name }}</div>
                    <div style="font-size:13px; color:#7a9e75;">{{ $user->email }}</div>
                </div>
                <span style="font-size:11px; padding:4px 12px; border-radius:999px; font-weight:600; background:#e8f5e4; color:#2D5A27; border:1px solid #a8d5a0;">Aktif</span>
            </div>
            {{-- Stats --}}
            <div style="display:grid; grid-template-columns:repeat(3,1fr); border-top:1px solid #f0ede4; padding-top:16px;">
                <div style="text-align:center;">
                    <div style="font-size:20px; font-weight:700; color:#1e3d1a;">{{ $user->rentals()->count() }}</div>
                    <div style="font-size:11px; color:#7a9e75; margin-top:2px;">Total Rental</div>
                </div>
                <div style="text-align:center; border-left:1px solid #f0ede4; border-right:1px solid #f0ede4;">
                    <div style="font-size:20px; font-weight:700; color:#1e3d1a;">{{ $user->created_at->format('Y') }}</div>
                    <div style="font-size:11px; color:#7a9e75; margin-top:2px;">Bergabung</div>
                </div>
                <div style="text-align:center;">
                    <div style="font-size:15px; font-weight:700; color:#1e3d1a;">{{ $user->created_at->diffForHumans(null, true) }}</div>
                    <div style="font-size:11px; color:#7a9e75; margin-top:2px;">Lama bergabung</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Profile --}}
    <div style="border-radius:16px; border:1px solid #e0ddd0; background:#fff; overflow:hidden;">
        <div style="padding:14px 24px; border-bottom:1px solid #e0ddd0; background:#faf9f4; display:flex; align-items:center; gap:8px;">
            <div style="width:4px; height:20px; border-radius:4px; background:#2D5A27;"></div>
            <span style="font-weight:600; font-size:14px; color:#1e3d1a;">Informasi Akun</span>
        </div>
        <form action="{{ route('profile.update') }}" method="POST" style="padding:24px;">
            @csrf @method('PUT')
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:16px;">
                <div>
                    <label style="display:block; font-size:13px; font-weight:500; color:#4B3621; margin-bottom:6px;">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                           style="width:100%; border:1px solid #d4cfc0; border-radius:10px; padding:10px 14px; font-size:13px; color:#1e3d1a; background:#faf9f4; outline:none; box-sizing:border-box;"
                           onfocus="this.style.borderColor='#2D5A27';this.style.boxShadow='0 0 0 3px rgba(45,90,39,0.1)'"
                           onblur="this.style.borderColor='#d4cfc0';this.style.boxShadow='none'">
                    @error('name') <p style="color:#dc2626;font-size:11px;margin-top:4px;">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label style="display:block; font-size:13px; font-weight:500; color:#4B3621; margin-bottom:6px;">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                           style="width:100%; border:1px solid #d4cfc0; border-radius:10px; padding:10px 14px; font-size:13px; color:#1e3d1a; background:#faf9f4; outline:none; box-sizing:border-box;"
                           onfocus="this.style.borderColor='#2D5A27';this.style.boxShadow='0 0 0 3px rgba(45,90,39,0.1)'"
                           onblur="this.style.borderColor='#d4cfc0';this.style.boxShadow='none'">
                    @error('email') <p style="color:#dc2626;font-size:11px;margin-top:4px;">{{ $message }}</p> @enderror
                </div>
            </div>
            <div style="display:flex; justify-content:flex-end;">
                <button type="submit"
                        style="padding:10px 24px; border-radius:10px; font-size:13px; font-weight:600; background:#2D5A27; color:#F5F5DC; border:none; cursor:pointer;"
                        onmouseover="this.style.background='#1e3d1a'" onmouseout="this.style.background='#2D5A27'">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    {{-- Change Password --}}
    <div style="border-radius:16px; border:1px solid #e0ddd0; background:#fff; overflow:hidden;">
        <div style="padding:14px 24px; border-bottom:1px solid #e0ddd0; background:#faf9f4; display:flex; align-items:center; gap:8px;">
            <div style="width:4px; height:20px; border-radius:4px; background:#4B3621;"></div>
            <span style="font-weight:600; font-size:14px; color:#1e3d1a;">Ubah Password</span>
        </div>
        <form action="{{ route('profile.password') }}" method="POST" style="padding:24px;">
            @csrf @method('PUT')
            <div style="margin-bottom:16px;">
                <label style="display:block; font-size:13px; font-weight:500; color:#4B3621; margin-bottom:6px;">Password Saat Ini</label>
                <input type="password" name="current_password" placeholder="••••••••"
                       style="width:100%; border:1px solid #d4cfc0; border-radius:10px; padding:10px 14px; font-size:13px; color:#1e3d1a; background:#faf9f4; outline:none; box-sizing:border-box;"
                       onfocus="this.style.borderColor='#2D5A27';this.style.boxShadow='0 0 0 3px rgba(45,90,39,0.1)'"
                       onblur="this.style.borderColor='#d4cfc0';this.style.boxShadow='none'">
                @error('current_password') <p style="color:#dc2626;font-size:11px;margin-top:4px;">{{ $message }}</p> @enderror
            </div>
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:16px;">
                <div>
                    <label style="display:block; font-size:13px; font-weight:500; color:#4B3621; margin-bottom:6px;">Password Baru</label>
                    <input type="password" name="password" placeholder="Min. 8 karakter"
                           style="width:100%; border:1px solid #d4cfc0; border-radius:10px; padding:10px 14px; font-size:13px; color:#1e3d1a; background:#faf9f4; outline:none; box-sizing:border-box;"
                           onfocus="this.style.borderColor='#2D5A27';this.style.boxShadow='0 0 0 3px rgba(45,90,39,0.1)'"
                           onblur="this.style.borderColor='#d4cfc0';this.style.boxShadow='none'">
                    @error('password') <p style="color:#dc2626;font-size:11px;margin-top:4px;">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label style="display:block; font-size:13px; font-weight:500; color:#4B3621; margin-bottom:6px;">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" placeholder="Ulangi password baru"
                           style="width:100%; border:1px solid #d4cfc0; border-radius:10px; padding:10px 14px; font-size:13px; color:#1e3d1a; background:#faf9f4; outline:none; box-sizing:border-box;"
                           onfocus="this.style.borderColor='#2D5A27';this.style.boxShadow='0 0 0 3px rgba(45,90,39,0.1)'"
                           onblur="this.style.borderColor='#d4cfc0';this.style.boxShadow='none'">
                </div>
            </div>
            <div style="display:flex; justify-content:flex-end;">
                <button type="submit"
                        style="padding:10px 24px; border-radius:10px; font-size:13px; font-weight:600; background:#4B3621; color:#F5F5DC; border:none; cursor:pointer;"
                        onmouseover="this.style.background='#2e2013'" onmouseout="this.style.background='#4B3621'">
                    Perbarui Password
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
