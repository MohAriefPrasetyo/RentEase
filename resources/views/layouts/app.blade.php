<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentEase - @yield('title', 'Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background-color: #ffffff; margin: 0; }
        [x-cloak] { display: none !important; }

        /* ─── NAVBAR (Disesuaikan dengan Logo) ───────────────── */
        #navbar {
            position: sticky; top: 0; z-index: 50;
            background: #2A5A32; /* Hijau Utama dari Logo */
            border-bottom: 1px solid #1E3F24;
            padding: 0 32px; height: 64px;
            display: flex; align-items: center; justify-content: space-between;
        }
        .navbar-brand {
            font-weight: 700; font-size: 20px; color: #F1EDE0;
            letter-spacing: -0.3px; text-decoration: none; flex-shrink: 0;
        }
        .navbar-brand span.brand-ease { color: #8FCE95; } /* Aksen hijau terang pada logo */
        
        .navbar-nav { display: flex; align-items: center; gap: 4px; }
        .nav-item {
            padding: 7px 14px; border-radius: 8px; font-size: 14px;
            font-weight: 500; color: rgba(241, 237, 224, 0.8); text-decoration: none;
            transition: background .15s, color .15s; white-space: nowrap;
        }
        .nav-item:hover  { background: #1E3F24; color: #F1EDE0; }
        .nav-item.active { background: #1E3F24; color: #F1EDE0; font-weight: 600; }
        
        .navbar-right { display: flex; align-items: center; gap: 12px; flex-shrink: 0; }
        
        .user-badge {
            display: flex; align-items: center; gap: 8px;
            padding: 6px 12px; border-radius: 8px;
            background: #F1EDE0; border: 1px solid #E3DDD0;
            cursor: pointer; position: relative;
        }
        .dropdown-menu {
            position: absolute; top: calc(100% + 8px); right: 0;
            background: #fff; border: 1px solid #e0ddd0; border-radius: 12px;
            padding: 6px; min-width: 180px;
            box-shadow: 0 8px 24px rgba(0,0,0,.10); z-index: 100;
        }
        .dropdown-item {
            display: flex; align-items: center; gap: 8px;
            padding: 8px 12px; border-radius: 8px; font-size: 13px;
            color: #4a5568; text-decoration: none; transition: background .15s; cursor: pointer;
        }
        .dropdown-item:hover { background: #F1EDE0; color: #2A5A32; }
        .dropdown-divider { border-top: 1px solid #e0ddd0; margin: 4px 0; }

        /* ─── HERO BANNER — full bleed, tanpa batas ───── */
        .hero-banner {
            position: relative;
            width: 100%;
            min-height: calc(100vh - 64px);
            display: flex; align-items: center;
            overflow: hidden;
            background-image: url('../image/bg2_dashboard.jpg');
            background-size: cover;
            background-position: center bottom;
        }
        .hero-overlay {
            position: absolute; inset: 0;
            background: linear-gradient(90deg,
                rgba(10,30,8,.85) 0%,
                rgba(10,30,8,.55) 55%,
                rgba(10,30,8,.20) 100%);
        }
        .hero-inner {
            position: relative; z-index: 2; width: 100%;
            display: flex; align-items: center;
            justify-content: space-between;
            padding: 44px 52px; gap: 40px;
        }
        .hero-text { flex: 1; min-width: 0; }
        .hero-eyebrow {
            font-size: 11px; font-weight: 700; letter-spacing: 2.5px;
            text-transform: uppercase; color: #8fcf8a; margin-bottom: 12px;
        }
        .hero-text h1 {
            font-size: 42px; font-weight: 800; color: #fff;
            margin: 0 0 10px; line-height: 1.1; letter-spacing: -0.5px;
        }
        .hero-text h1 span { color: #7bc67a; }
        .hero-text p {
            font-size: 15px; color: rgba(255,255,255,.80);
            margin: 0; max-width: 400px; line-height: 1.65;
        }
        .hero-logo-slot {
            flex-shrink: 0;
            width: 240px; height: 160px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            overflow: hidden;
        }

        /* ─── PAGE HEADER (halaman lain) ──────────────── */
        .page-header { margin-bottom: 24px; }
        .page-header h1 { font-size: 22px; font-weight: 700; color: #1e3d1a; margin: 0 0 4px; }
        .page-header p  { font-size: 13px; color: #7a9e75; margin: 0; }

        /* ─── MOBILE ──────────────────────────────────── */
        .hamburger { display: none; }
        .mobile-menu {
            display: none; flex-direction: column;
            background: #2A5A32; border-bottom: 1px solid #1E3F24;
            padding: 12px 20px; gap: 4px;
        }
        .mobile-menu.open { display: flex; }
        @media (max-width: 768px) {
            #navbar { padding: 0 16px; }
            .navbar-nav { display: none; }
            .hero-inner { padding: 32px 24px; flex-direction: column; align-items: flex-start; }
            .hero-logo-slot { display: none; }
            .hero-text h1 { font-size: 26px; }
            .hamburger {
                display: flex; align-items: center; justify-content: center;
                padding: 8px; border: none; background: transparent;
                cursor: pointer; border-radius: 8px;
            }
            .hamburger:hover { background: #1E3F24; }
        }
    </style>
</head>
<body x-data="{ userOpen: false, mobileOpen: false }" @click.away="userOpen = false">

{{-- ═══ NAVBAR ════════════════════════════════════════ --}}
<nav id="navbar">
    <a href="{{ route('dashboard') }}" class="navbar-brand">
        <span>Rent</span><span class="brand-ease">Ease</span>
    </a>

    <div class="navbar-right">
        <div class="navbar-nav">
            @php
            $navItems = [
                ['route' => 'dashboard',       'label' => 'Dashboard', 'match' => 'dashboard'],
                ['route' => 'equipment.index', 'label' => 'Peralatan', 'match' => 'equipment.*'],
                ['route' => 'penalties.index', 'label' => 'Denda',     'match' => 'penalties.*'],
                ];
            @endphp
            @foreach($navItems as $item)
                <a href="{{ route($item['route']) }}"
                   class="nav-item {{ request()->routeIs($item['match']) ? 'active' : '' }}">
                    {{ $item['label'] }}
                </a>
            @endforeach
        </div>

        {{-- Akun --}}
        <div class="user-badge" @click.stop="userOpen = !userOpen">
            <div style="width:28px;height:28px;border-radius:7px;background:#2A5A32;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:700;color:#F1EDE0;flex-shrink:0;">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <span style="font-size:13px;font-weight:600;color:#2A5A32;">{{ auth()->user()->name }}</span>
            <svg width="14" height="14" fill="none" stroke="#2A5A32" viewBox="0 0 24 24"
                 style="transition:transform .2s;" :style="userOpen ? 'transform:rotate(180deg)' : ''">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>

            <div class="dropdown-menu" x-show="userOpen" x-cloak @click.stop>
                <div style="padding:8px 12px 10px;border-bottom:1px solid #e0ddd0;margin-bottom:4px;">
                    <div style="font-size:13px;font-weight:600;color:#2A5A32;">{{ auth()->user()->name }}</div>
                    <div style="font-size:11px;color:#7a9e75;margin-top:2px;">{{ auth()->user()->email }}</div>
                </div>
                <a href="{{ route('profile.show') }}" class="dropdown-item">
                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Profil Saya
                </a>
                <div class="dropdown-divider"></div>
                <form action="{{ route('auth.logout') }}" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" class="dropdown-item" style="width:100%;border:none;background:none;text-align:left;color:#b91c1c;">
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Keluar
                    </button>
                </form>
            </div>
        </div>

        {{-- Hamburger (Hanya muncul di mobile) --}}
        <button class="hamburger" @click="mobileOpen = !mobileOpen">
            <svg width="20" height="20" fill="none" stroke="#F1EDE0" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>
</nav>

{{-- Mobile menu --}}
<div class="mobile-menu" x-show="mobileOpen" x-cloak :class="{ 'open': mobileOpen }">
    @foreach($navItems as $item)
        <a href="{{ route($item['route']) }}"
           style="padding:10px 12px; border-radius:8px; font-size:14px; font-weight:600; text-decoration:none;
                  color:#F1EDE0;
                  background:{{ request()->routeIs($item['match']) ? '#1E3F24' : 'transparent' }};">
            {{ $item['label'] }}
        </a>
    @endforeach
</div>

{{-- ═══ MAIN ════════════════════════════════════════════ --}}
@if(request()->routeIs('dashboard'))
    <div class="hero-banner">
        <div class="hero-overlay"></div>
        <div class="hero-inner">
            <div class="hero-text">
                <div class="hero-eyebrow">Selamat Datang di</div>
                <h1>Rent<span>Ease</span></h1>
                <p>Tempat peminjaman alat kemping aman dan terpecaya dengan menggunakan website sebagai fitur boking.</p>
            </div>
            <div class="hero-logo-slot">
                <img src="../image/logo.jpg" alt="Logo RentEase" style="width:100%;height:100%;object-fit:cover;">
            </div>
        </div>
    </div>
    <main style="min-height: calc(100vh - 64px - 380px); padding: 28px 32px;">
@else
    <main style="min-height: calc(100vh - 64px); padding: 28px 32px;">
        <div class="page-header">
            <h1>@yield('title', 'Halaman')</h1>
            <p>@yield('subtitle', '')</p>
        </div>
@endif

    {{-- Flash success --}}
    @if(session('success'))
        <div style="margin-bottom:20px;padding:12px 16px;border-radius:12px;background:#e8f5e4;border:1px solid #a8d5a0;color:#2D5A27;font-size:14px;display:flex;align-items:center;gap:8px;">
            <svg width="16" height="16" fill="#2D5A27" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    @yield('content')
</main>

<footer style="text-align:center;padding:16px;font-size:12px;color:#f0ede4;border-top:1px solid #2D5A27;background:#2D5A27;">
    © 2026 RentEase. All rights reserved.
</footer>
</body>
</html>