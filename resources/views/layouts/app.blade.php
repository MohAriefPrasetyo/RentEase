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
        [x-cloak] { display: none !important; }
        body { font-family: 'Inter', sans-serif; }
        .sidebar-gradient { background: linear-gradient(180deg, #0f172a 0%, #1e293b 100%); }
        .nav-active { background: linear-gradient(135deg, #3b82f6, #6366f1); box-shadow: 0 4px 15px rgba(99,102,241,0.4); }
        .nav-item:hover:not(.nav-active) { background: rgba(255,255,255,0.07); }
        .glass-card { background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); }
    </style>
</head>
<body class="bg-slate-50 min-h-screen" x-data="{ sidebarOpen: false }">

    {{-- Mobile overlay --}}
    <div x-show="sidebarOpen" x-cloak @click="sidebarOpen = false"
         class="fixed inset-0 bg-black/60 backdrop-blur-sm z-20 lg:hidden"></div>

    {{-- Sidebar --}}
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
           class="sidebar-gradient fixed top-0 left-0 h-full w-64 z-30 transition-transform duration-300 lg:translate-x-0 flex flex-col">

        {{-- Logo --}}
        <div class="px-5 py-6">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0"
                     style="background: linear-gradient(135deg, #3b82f6, #6366f1);">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-white font-bold text-base leading-none tracking-wide">RentEase</h1>
                    <p class="text-slate-400 text-xs mt-0.5">Rental Management</p>
                </div>
            </div>
        </div>

        {{-- User Card --}}
        <div class="mx-4 mb-4 glass-card rounded-xl px-4 py-3 flex items-center gap-3">
            <div class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0 text-white text-sm font-bold"
                 style="background: linear-gradient(135deg, #f59e0b, #ef4444);">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div class="min-w-0">
                <p class="text-white text-sm font-medium truncate">{{ auth()->user()->name }}</p>
                <p class="text-slate-400 text-xs truncate">{{ auth()->user()->email }}</p>
            </div>
        </div>

        {{-- Nav --}}
        <nav class="flex-1 px-3 space-y-1 overflow-y-auto">
            <p class="text-slate-500 text-xs font-semibold uppercase tracking-widest px-3 mb-3">Menu</p>

            <a href="{{ route('dashboard') }}"
               class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 group
                      {{ request()->routeIs('dashboard') ? 'nav-active text-white' : 'text-slate-400 hover:text-white' }}">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0 transition-all
                            {{ request()->routeIs('dashboard') ? 'bg-white/20' : 'bg-white/5 group-hover:bg-white/10' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h4a1 1 0 011 1v5a1 1 0 01-1 1H5a1 1 0 01-1-1V5zm10 0a1 1 0 011-1h4a1 1 0 011 1v2a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM4 15a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1v-4zm10-3a1 1 0 011-1h4a1 1 0 011 1v7a1 1 0 01-1 1h-4a1 1 0 01-1-1v-7z"/>
                    </svg>
                </div>
                <span>Dashboard</span>
                @if(request()->routeIs('dashboard'))
                    <div class="ml-auto w-1.5 h-1.5 rounded-full bg-white"></div>
                @endif
            </a>

            <a href="{{ route('equipment.index') }}"
               class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 group
                      {{ request()->routeIs('equipment.*') ? 'nav-active text-white' : 'text-slate-400 hover:text-white' }}">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0 transition-all
                            {{ request()->routeIs('equipment.*') ? 'bg-white/20' : 'bg-white/5 group-hover:bg-white/10' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                </div>
                <span>Peralatan</span>
                @if(request()->routeIs('equipment.*'))
                    <div class="ml-auto w-1.5 h-1.5 rounded-full bg-white"></div>
                @endif
            </a>

            <a href="{{ route('rentals.index') }}"
               class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 group
                      {{ request()->routeIs('rentals.*') ? 'nav-active text-white' : 'text-slate-400 hover:text-white' }}">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0 transition-all
                            {{ request()->routeIs('rentals.*') ? 'bg-white/20' : 'bg-white/5 group-hover:bg-white/10' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                    </svg>
                </div>
                <span>Rental</span>
                @if(request()->routeIs('rentals.*'))
                    <div class="ml-auto w-1.5 h-1.5 rounded-full bg-white"></div>
                @endif
            </a>

            <a href="{{ route('penalties.index') }}"
               class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 group
                      {{ request()->routeIs('penalties.*') ? 'nav-active text-white' : 'text-slate-400 hover:text-white' }}">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0 transition-all
                            {{ request()->routeIs('penalties.*') ? 'bg-white/20' : 'bg-white/5 group-hover:bg-white/10' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <span>Denda</span>
                @if(request()->routeIs('penalties.*'))
                    <div class="ml-auto w-1.5 h-1.5 rounded-full bg-white"></div>
                @endif
            </a>
        </nav>

        {{-- Logout --}}
        <div class="p-4 border-t border-white/5">
            <form action="{{ route('auth.logout') }}" method="POST">
                @csrf @method('DELETE')
                <button type="submit"
                        class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-400 hover:text-white hover:bg-red-500/20 transition-all duration-200 text-sm font-medium group">
                    <div class="w-8 h-8 rounded-lg bg-white/5 group-hover:bg-red-500/30 flex items-center justify-center flex-shrink-0 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                    </div>
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    {{-- Main --}}
    <div class="lg:ml-64 min-h-screen flex flex-col">

        {{-- Topbar --}}
        <header class="bg-white border-b border-slate-200 px-4 lg:px-6 py-3.5 flex items-center justify-between sticky top-0 z-10">
            <div class="flex items-center gap-3">
                <button @click="sidebarOpen = !sidebarOpen"
                        class="lg:hidden p-2 rounded-lg hover:bg-slate-100 text-slate-500 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <div>
                    <h2 class="font-semibold text-slate-800 text-sm">@yield('title', 'Dashboard')</h2>
                    <p class="text-slate-400 text-xs hidden sm:block">@yield('subtitle', 'Selamat datang di RentEase')</p>
                </div>
            </div>

            {{-- Breadcrumb / Right side --}}
            <div class="flex items-center gap-2">
                <div class="hidden sm:flex items-center gap-2 bg-slate-50 border border-slate-200 rounded-lg px-3 py-1.5">
                    <div class="w-6 h-6 rounded-md flex items-center justify-center text-white text-xs font-bold flex-shrink-0"
                         style="background: linear-gradient(135deg, #f59e0b, #ef4444);">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <span class="text-slate-700 text-xs font-medium">{{ auth()->user()->name }}</span>
                </div>
            </div>
        </header>

        {{-- Content --}}
        <main class="flex-1 p-4 lg:p-6">
            @if(session('success'))
                <div class="mb-5 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl flex items-center gap-2.5 text-sm">
                    <svg class="w-4 h-4 flex-shrink-0 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

</body>
</html>
