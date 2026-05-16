<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentEase - @yield('title', 'Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background-color: #f7f6f0; margin: 0; }
        [x-cloak] { display: none !important; }

        #sidebar {
            position: fixed;
            top: 0; left: 0;
            height: 100%;
            width: 256px;
            background: linear-gradient(180deg, #1a3518 0%, #2D5A27 55%, #3a7232 100%);
            z-index: 30;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease;
        }
        #sidebar * { color: #ffffff !important; }
        #sidebar .muted { color: #a8c8a4 !important; }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 16px;
            border-radius: 0 12px 12px 0;
            border-left: 3px solid transparent;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            transition: background 0.2s;
            color: #ffffff !important;
        }
        .nav-link:hover { background: rgba(255,255,255,0.1); border-left-color: rgba(255,255,255,0.5); }
        .nav-link.active { background: rgba(255,255,255,0.18); border-left-color: #F5F5DC; }
        .nav-link svg { flex-shrink: 0; }

        #main-content { margin-left: 256px; min-height: 100vh; display: flex; flex-direction: column; }

        @media (max-width: 1023px) {
            #sidebar { transform: translateX(-100%); }
            #sidebar.open { transform: translateX(0); }
            #main-content { margin-left: 0; }
        }
    </style>
</head>
<body x-data="{ sidebarOpen: false }"
      @keydown.escape="sidebarOpen = false">

    {{-- Overlay --}}
    <div x-show="sidebarOpen" x-cloak
         @click="sidebarOpen = false"
         style="position:fixed;inset:0;background:rgba(0,0,0,0.5);z-index:20;"
         class="lg:hidden"></div>

    {{-- SIDEBAR --}}
    <div id="sidebar" :class="sidebarOpen ? 'open' : ''">

        {{-- Logo --}}
        <div style="padding:24px 20px 20px; border-bottom:1px solid rgba(255,255,255,0.15);">
            <div style="display:flex; align-items:center; gap:12px;">
                <div style="width:44px;height:44px;border-radius:12px;background:rgba(255,255,255,0.15);border:1px solid rgba(255,255,255,0.3);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <svg width="22" height="22" fill="none" stroke="#ffffff" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <div>
                    <div style="font-weight:700;font-size:16px;color:#ffffff;">RentEase</div>
                    <div style="font-size:11px;color:#a8c8a4;margin-top:2px;">Outdoor Gear Rental</div>
                </div>
            </div>
        </div>

        {{-- User Card --}}
        <div style="margin:16px 12px;padding:12px;border-radius:12px;background:rgba(0,0,0,0.25);border:1px solid rgba(255,255,255,0.15);display:flex;align-items:center;gap:10px;">
            <div style="width:36px;height:36px;border-radius:8px;background:#4B3621;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:14px;color:#ffffff;flex-shrink:0;">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div style="min-width:0;">
                <div style="font-size:13px;font-weight:600;color:#ffffff;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ auth()->user()->name }}</div>
                <div style="font-size:11px;color:#a8c8a4;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ auth()->user()->email }}</div>
            </div>
        </div>

        {{-- Nav --}}
        <nav style="flex:1;padding:0 8px;overflow-y:auto;">
            <div style="font-size:10px;font-weight:600;text-transform:uppercase;letter-spacing:0.1em;color:#7aaa74;padding:0 16px;margin-bottom:8px;">Menu</div>

            @php
            $navItems = [
                ['route'=>'dashboard',       'label'=>'Dashboard',   'match'=>'dashboard',    'icon'=>'M4 5a1 1 0 011-1h4a1 1 0 011 1v5a1 1 0 01-1 1H5a1 1 0 01-1-1V5zm10 0a1 1 0 011-1h4a1 1 0 011 1v2a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM4 15a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1v-4zm10-3a1 1 0 011-1h4a1 1 0 011 1v7a1 1 0 01-1 1h-4a1 1 0 01-1-1v-7z'],
                ['route'=>'equipment.index', 'label'=>'Peralatan',   'match'=>'equipment.*',  'icon'=>'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10'],
                ['route'=>'rentals.index',   'label'=>'Rental',      'match'=>'rentals.*',    'icon'=>'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01'],
                ['route'=>'penalties.index', 'label'=>'Denda',       'match'=>'penalties.*',  'icon'=>'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z'],
                ['route'=>'profile.show',    'label'=>'Profil Saya', 'match'=>'profile.*',    'icon'=>'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'],
            ];
            @endphp

            @foreach($navItems as $item)
            @php $active = request()->routeIs($item['match']); @endphp
            @if($item['route'] === 'penalties.index')
                @can('store-data')
                <a href="{{ route($item['route']) }}" class="nav-link {{ $active ? 'active' : '' }}">
                    <svg width="18" height="18" fill="none" stroke="#ffffff" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="{{ $item['icon'] }}"/>
                    </svg>
                    {{ $item['label'] }}
                </a>
                @endcan
            @else
            <a href="{{ route($item['route']) }}" class="nav-link {{ $active ? 'active' : '' }}">
                <svg width="18" height="18" fill="none" stroke="#ffffff" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="{{ $item['icon'] }}"/>
                </svg>
                {{ $item['label'] }}
            </a>
            @endif
            @endforeach
        </nav>

        {{-- Logout --}}
        <div style="padding:12px;border-top:1px solid rgba(255,255,255,0.12);">
            <form action="{{ route('auth.logout') }}" method="POST">
                @csrf @method('DELETE')
                <button type="submit" class="nav-link" style="width:100%;background:none;border:none;cursor:pointer;text-align:left;">
                    <svg width="18" height="18" fill="none" stroke="#ffffff" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Keluar
                </button>
            </form>
            <div style="text-align:center;font-size:11px;color:#7aaa74;margin-top:10px;">© 2026 RentEase</div>
        </div>
    </div>

    {{-- MAIN --}}
    <div id="main-content">

        {{-- Topbar --}}
        <header style="background:#faf9f4;border-bottom:1px solid #e0ddd0;padding:14px 24px;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:10;">
            <div style="display:flex;align-items:center;gap:12px;">
                <button @click="sidebarOpen = !sidebarOpen"
                        style="display:none;padding:8px;border-radius:8px;border:none;background:transparent;cursor:pointer;color:#2D5A27;"
                        class="lg:hidden"
                        id="menu-btn">
                    <svg width="20" height="20" fill="none" stroke="#2D5A27" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <div>
                    <div style="font-weight:600;font-size:14px;color:#1e3d1a;">@yield('title', 'Dashboard')</div>
                    <div style="font-size:12px;color:#7a9e75;">@yield('subtitle', 'Selamat datang di RentEase')</div>
                </div>
            </div>
            <div style="display:flex;align-items:center;gap:8px;padding:6px 12px;border-radius:8px;background:#f0ede4;border:1px solid #d4cfc0;">
                <div style="width:26px;height:26px;border-radius:6px;background:#4B3621;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:700;color:#ffffff;flex-shrink:0;">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <span style="font-size:13px;font-weight:500;color:#4B3621;">{{ auth()->user()->name }}</span>
            </div>
        </header>

        <main style="flex:1; padding:24px; overflow-y:auto;">
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
    </div>

    <script>
        // Show menu button on mobile
        const menuBtn = document.getElementById('menu-btn');
        if (window.innerWidth < 1024) menuBtn.style.display = 'block';
        window.addEventListener('resize', () => {
            menuBtn.style.display = window.innerWidth < 1024 ? 'block' : 'none';
        });
    </script>

</body>
</html>
