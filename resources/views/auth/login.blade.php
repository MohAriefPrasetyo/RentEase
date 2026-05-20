<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentEase - Masuk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body 
    <body class="bg-[url('{{ asset('image/bg_login.jpg') }}')] bg-cover bg-center bg-no-repeat min-h-screen flex items-center justify-center p-4"></body>
    <div class="w-full max-w-md">
{{-- Logo --}}
<div class="text-center mb-8">
   <div class="bg-[url('{{ asset('image/logo.jpg') }}')] bg-cover bg-center bg-no-repeat w-32 h-32 rounded-2xl mx-auto mb-4 flex items-center justify-center border-2" style="border-color: hsla(60, 56%, 91%, 0.30);">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
    </svg>
    </div>
</div>
           <div class="rounded-3xl p-8 shadow-2xl backdrop-blur(2px)" style="background: rgba(255, 255, 255, 0.15); border: 2px solid rgba(255, 255, 255, 0.35);">
            <h2 class="text-lg font-bold mb-1" style="color:#2a2a2699;">Selamat Datang Kembali</h2>
            <p class="text-sm mb-6" style="color:#10100f99;">Masuk untuk mengelola rental peralatan</p>

            @if(session('error'))
                <div class="mb-4 px-4 py-3 rounded-xl text-sm border" style="background:#fde8e8; border-color:#fca5a5; color:#b91c1c;">
                    {{ session('error') }}
                </div>
            @endif
            @if(session('success'))
                <div class="mb-4 px-4 py-3 rounded-xl text-sm border" style="background:#e8f5e4; border-color:#a8d5a0; color:#2D5A27;">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('auth.authenticate') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium mb-1.5" style="color:#4B3621;">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="contoh@email.com"      
                    class="w-full rounded-xl px-4 py-2.5 text-sm border outline-none transition-all placeholder-gray-400"
                    style="border-color:#d4cfc0; background:#edf2f7; color:#1e3d1a;"
                    onfocus="this.style.borderColor='#2D5A27'; this.style.boxShadow='0 0 0 3px rgba(45,90,39,0.1)'"
                    onblur="this.style.borderColor='#d4cfc0'; this.style.boxShadow='none'">
                           @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1.5" style="color:#4B3621;">Password</label>
                    <input type="password" name="password" placeholder="••••••••"
                    class="w-full rounded-xl px-4 py-2.5 text-sm border outline-none transition-all placeholder-gray-400"
                    style="border-color:#d4cfc0; background:#edf2f7; color:#1e3d1a;"
                    onfocus="this.style.borderColor='#2D5A27'; this.style.boxShadow='0 0 0 3px rgba(45,90,39,0.1)'"
                    onblur="this.style.borderColor='#d4cfc0'; this.style.boxShadow='none'">
                    @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <button type="submit"
                        class="w-full py-2.5 rounded-xl text-sm font-semibold transition-all mt-2"
                        style="background:#2D5A27; color:#F5F5DC;"
                        onmouseover="this.style.background='#1e3d1a'" onmouseout="this.style.background='#2D5A27'">
                    Masuk
                </button>
            </form>

            <p class="text-center text-sm mt-6" style="color:2AA2A;">
                Belum punya akun?
                <a href="{{ route('auth.register') }}" class="font-semibold" style="color:#1e3d1a;">Daftar sekarang</a>
            </p>
        </div>
    </div>
</body>
</html>
