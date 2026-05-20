@extends('layouts.app')
@section('title', 'Profil Saya')
@section('subtitle', 'Kelola informasi akun Anda')

@section('content')

<div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;align-items:start;">

    {{-- ── Kolom Kiri: Kartu Profil ── --}}
    <div style="display:flex;flex-direction:column;gap:20px;">

        {{-- Profile Card --}}
        <div style="border-radius:20px;border:1px solid #e0ddd0;background:#fff;overflow:hidden;box-shadow:0 2px 12px rgba(0,0,0,.06);">
            {{-- Banner --}}
            <div style="height:100px;background:linear-gradient(135deg,#1e3d1a 0%,#2D5A27 60%,#4a7a44 100%);position:relative;">
                <div style="position:absolute;inset:0;opacity:.15;background-image:radial-gradient(circle at 20% 50%,#fff 1px,transparent 1px),radial-gradient(circle at 80% 20%,#fff 1px,transparent 1px);background-size:24px 24px;"></div>
            </div>

            {{-- Avatar + Info --}}
            <div style="padding:0 28px 24px;">
                <div style="display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:16px;">
                    <div style="width:72px;height:72px;border-radius:16px;background:#1e3d1a;border:4px solid #fff;display:flex;align-items:center;justify-content:center;font-size:28px;font-weight:800;color:#7bc67a;margin-top:-36px;box-shadow:0 4px 16px rgba(0,0,0,.15);">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <span style="font-size:11px;padding:5px 14px;border-radius:999px;font-weight:700;background:#e8f5e4;color:#2D5A27;border:1px solid #a8d5a0;">● Aktif</span>
                </div>
                <p style="font-size:20px;font-weight:800;color:#1e3d1a;margin:0 0 4px;">{{ $user->name }}</p>
                <p style="font-size:13px;color:#7a9e75;margin:0;">{{ $user->email }}</p>
            </div>

            {{-- Stats --}}
            <div style="display:grid;grid-template-columns:repeat(3,1fr);border-top:1px solid #f0ede4;">
                <div style="text-align:center;padding:18px 12px;">
                    <p style="font-size:24px;font-weight:800;color:#1e3d1a;margin:0;">{{ $user->rentals()->count() }}</p>
                    <p style="font-size:11px;color:#7a9e75;margin:4px 0 0;">Total Rental</p>
                </div>
                <div style="text-align:center;padding:18px 12px;border-left:1px solid #f0ede4;border-right:1px solid #f0ede4;">
                    <p style="font-size:24px;font-weight:800;color:#1e3d1a;margin:0;">{{ $user->created_at->format('Y') }}</p>
                    <p style="font-size:11px;color:#7a9e75;margin:4px 0 0;">Bergabung</p>
                </div>
                <div style="text-align:center;padding:18px 12px;">
                    <p style="font-size:16px;font-weight:700;color:#1e3d1a;margin:0;">{{ $user->created_at->diffForHumans(null, true) }}</p>
                    <p style="font-size:11px;color:#7a9e75;margin:4px 0 0;">Lama bergabung</p>
                </div>
            </div>
        </div>

        {{-- Info singkat --}}
        <div style="background:#f0f7ee;border:1.5px solid #c5dfc0;border-radius:16px;padding:20px 22px;display:flex;align-items:flex-start;gap:14px;">
            <div style="width:36px;height:36px;border-radius:10px;background:#2D5A27;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <svg width="18" height="18" fill="none" stroke="#fff" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p style="font-size:13px;font-weight:700;color:#1e3d1a;margin:0 0 4px;">Tips Keamanan</p>
                <p style="font-size:12px;color:#4a7a44;margin:0;line-height:1.6;">Gunakan password yang kuat dan unik. Jangan bagikan informasi akun kamu kepada siapapun.</p>
            </div>
        </div>

    </div>

    {{-- ── Kolom Kanan: Form ── --}}
    <div style="display:flex;flex-direction:column;gap:20px;">

        {{-- Informasi Akun --}}
        <div style="border-radius:20px;border:1px solid #e0ddd0;background:#fff;overflow:hidden;box-shadow:0 2px 12px rgba(0,0,0,.06);">
            <div style="padding:18px 28px;border-bottom:1px solid #f0ede4;display:flex;align-items:center;gap:10px;background:#faf9f6;">
                <div style="width:4px;height:22px;border-radius:4px;background:#2D5A27;"></div>
                <span style="font-size:15px;font-weight:700;color:#1e3d1a;">Informasi Akun</span>
            </div>
            <form action="{{ route('profile.update') }}" method="POST" style="padding:24px;">
                @csrf @method('PUT')

                @if(session('status') === 'profile-updated')
                <div style="background:#e8f5e4;border:1px solid #a8d5a0;border-radius:10px;padding:10px 14px;font-size:12px;color:#2D5A27;font-weight:600;margin-bottom:16px;">
                    ✓ Profil berhasil diperbarui.
                </div>
                @endif

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:20px;">
                    <div>
                        <label style="display:block;font-size:12px;font-weight:600;color:#4B3621;margin-bottom:6px;">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                               style="width:100%;border:1.5px solid #d4cfc0;border-radius:10px;padding:10px 14px;font-size:13px;color:#1e3d1a;background:#faf9f6;outline:none;box-sizing:border-box;"
                               onfocus="this.style.borderColor='#2D5A27';this.style.boxShadow='0 0 0 3px rgba(45,90,39,.1)'"
                               onblur="this.style.borderColor='#d4cfc0';this.style.boxShadow='none'">
                        @error('name')<p style="color:#dc2626;font-size:11px;margin:4px 0 0;">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label style="display:block;font-size:12px;font-weight:600;color:#4B3621;margin-bottom:6px;">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                               style="width:100%;border:1.5px solid #d4cfc0;border-radius:10px;padding:10px 14px;font-size:13px;color:#1e3d1a;background:#faf9f6;outline:none;box-sizing:border-box;"
                               onfocus="this.style.borderColor='#2D5A27';this.style.boxShadow='0 0 0 3px rgba(45,90,39,.1)'"
                               onblur="this.style.borderColor='#d4cfc0';this.style.boxShadow='none'">
                        @error('email')<p style="color:#dc2626;font-size:11px;margin:4px 0 0;">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div style="display:flex;justify-content:flex-end;">
                    <button type="submit"
                            style="padding:11px 28px;border-radius:10px;font-size:13px;font-weight:700;background:#2D5A27;color:#fff;border:none;cursor:pointer;"
                            onmouseover="this.style.background='#1e3d1a'" onmouseout="this.style.background='#2D5A27'">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        {{-- Ubah Password --}}
        <div style="border-radius:20px;border:1px solid #e0ddd0;background:#fff;overflow:hidden;box-shadow:0 2px 12px rgba(0,0,0,.06);">
            <div style="padding:18px 28px;border-bottom:1px solid #f0ede4;display:flex;align-items:center;gap:10px;background:#faf9f6;">
                <div style="width:4px;height:22px;border-radius:4px;background:#4B3621;"></div>
                <span style="font-size:15px;font-weight:700;color:#1e3d1a;">Ubah Password</span>
            </div>
            <form action="{{ route('profile.password') }}" method="POST" style="padding:24px;">
                @csrf @method('PUT')

                @if(session('status') === 'password-updated')
                <div style="background:#e8f5e4;border:1px solid #a8d5a0;border-radius:10px;padding:10px 14px;font-size:12px;color:#2D5A27;font-weight:600;margin-bottom:16px;">
                    ✓ Password berhasil diperbarui.
                </div>
                @endif

                <div style="margin-bottom:16px;">
                    <label style="display:block;font-size:12px;font-weight:600;color:#4B3621;margin-bottom:6px;">Password Saat Ini</label>
                    <input type="password" name="current_password" placeholder="••••••••"
                           style="width:100%;border:1.5px solid #d4cfc0;border-radius:10px;padding:10px 14px;font-size:13px;color:#1e3d1a;background:#faf9f6;outline:none;box-sizing:border-box;"
                           onfocus="this.style.borderColor='#2D5A27';this.style.boxShadow='0 0 0 3px rgba(45,90,39,.1)'"
                           onblur="this.style.borderColor='#d4cfc0';this.style.boxShadow='none'">
                    @error('current_password')<p style="color:#dc2626;font-size:11px;margin:4px 0 0;">{{ $message }}</p>@enderror
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:20px;">
                    <div>
                        <label style="display:block;font-size:12px;font-weight:600;color:#4B3621;margin-bottom:6px;">Password Baru</label>
                        <input type="password" name="password" placeholder="Min. 8 karakter"
                               style="width:100%;border:1.5px solid #d4cfc0;border-radius:10px;padding:10px 14px;font-size:13px;color:#1e3d1a;background:#faf9f6;outline:none;box-sizing:border-box;"
                               onfocus="this.style.borderColor='#2D5A27';this.style.boxShadow='0 0 0 3px rgba(45,90,39,.1)'"
                               onblur="this.style.borderColor='#d4cfc0';this.style.boxShadow='none'">
                        @error('password')<p style="color:#dc2626;font-size:11px;margin:4px 0 0;">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label style="display:block;font-size:12px;font-weight:600;color:#4B3621;margin-bottom:6px;">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" placeholder="Ulangi password baru"
                               style="width:100%;border:1.5px solid #d4cfc0;border-radius:10px;padding:10px 14px;font-size:13px;color:#1e3d1a;background:#faf9f6;outline:none;box-sizing:border-box;"
                               onfocus="this.style.borderColor='#2D5A27';this.style.boxShadow='0 0 0 3px rgba(45,90,39,.1)'"
                               onblur="this.style.borderColor='#d4cfc0';this.style.boxShadow='none'">
                    </div>
                </div>
                <div style="display:flex;justify-content:flex-end;">
                    <button type="submit"
                            style="padding:11px 28px;border-radius:10px;font-size:13px;font-weight:700;background:#1e3d1a;color:#fff;border:none;cursor:pointer;"
                            onmouseover="this.style.background='#111f0e'" onmouseout="this.style.background='#1e3d1a'">
                        Perbarui Password
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

@endsection