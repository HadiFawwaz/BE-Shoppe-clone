<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>masuk sekarang. - Shopee Clone</title>
    <!-- Font Plus Jakarta Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#f8fAfc] antialiased min-h-screen flex flex-col overflow-hidden">

    <!-- 1. MINIMALIST FLOATING HEADER -->
    <div class="fixed top-0 left-0 right-0 z-50 bg-white/60 backdrop-blur-md border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-6 md:px-12 py-4 flex items-center justify-between">
            <!-- Logo Lebih Besar & Sejajar -->
            <a href="{{ url('/') }}" class="flex items-center gap-3 text-[#ee4d2d] group transition-transform duration-300">
                <div class="bg-[#ee4d2d]/10 p-2.5 rounded-xl group-hover:scale-110 transition duration-300">
                    <svg class="w-7 h-7 md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </div>
                <h1 class="text-2xl md:text-3xl font-extrabold tracking-tighter">shopee.</h1>
            </a>
            <!-- Warna Konsisten dengan Link Daftar -->
            <a href="#" class="text-[#ee4d2d] text-sm hover:text-[#d73211] transition font-bold">butuh bantuan?</a>
        </div>
    </div>

    <!-- 2. SPLIT SCREEN LAYOUT -->
    <div class="flex-grow grid grid-cols-1 lg:grid-cols-12 min-h-screen">
        
        <!-- LEFT SIDE: IMAGE & TAGLINE (COL-SPAN-7) -->
        <div class="hidden lg:block lg:col-span-7 relative overflow-hidden">
            <img src="https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?q=80&w=2070" class="absolute inset-0 w-full h-full object-cover" alt="Login Background">
            
            <!-- Dark Overlay Lebih Pekat di Sisi Teks -->
            <div class="absolute inset-0 bg-gradient-to-r from-black/85 via-black/50 to-transparent"></div>
            
            <div class="absolute inset-0 flex flex-col justify-center px-24 z-10">
                <h2 class="text-6xl font-extrabold text-white leading-tight tracking-tighter mb-6 drop-shadow-2xl">
                    belanja apapun, <br>
                    <span class="text-[#ee4d2d]">kapanpun.</span>
                </h2>
                <p class="text-white/80 text-xl max-w-md font-medium leading-relaxed">
                    nikmati kemudahan transaksi dan promo eksklusif setiap harinya hanya di genggamanmu.
                </p>
            </div>

            <!-- Stats dengan Teks Deskripsi Lebih Terang -->
            <div class="absolute bottom-12 left-24 flex items-center gap-8 text-white/90">
                <div class="flex flex-col">
                    <span class="text-3xl font-extrabold text-white">10M+</span>
                    <span class="text-[10px] uppercase font-black tracking-[0.2em] text-white/90">pengguna aktif.</span>
                </div>
                <div class="h-10 w-px bg-white/30"></div>
                <div class="flex flex-col">
                    <span class="text-3xl font-extrabold text-white">24/7</span>
                    <span class="text-[10px] uppercase font-black tracking-[0.2em] text-white/90">dukungan teknis.</span>
                </div>
            </div>
        </div>

        <!-- RIGHT SIDE: LOGIN FORM (COL-SPAN-5) -->
        <div class="col-span-1 lg:col-span-5 flex items-center justify-center p-6 lg:p-12 bg-orange-50/20">
            
            <!-- GLASSMORPHISM CONTAINER -->
            <div class="w-full max-w-[440px] bg-white/90 backdrop-blur-3xl border border-white/40 shadow-[0_30px_60px_rgba(0,0,0,0.08)] rounded-[40px] p-10 lg:p-12 hover:shadow-[0_30px_70px_rgba(238,77,45,0.12)] transition-all duration-500">
                
                <!-- Header Lebih Rapat ke Input -->
                <div class="mb-8">
                    <h3 class="text-3xl font-extrabold text-gray-900 tracking-tighter mb-1">masuk sekarang.</h3>
                    <p class="text-gray-400 font-semibold text-sm">selamat datang kembali di shopee.</p>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf
                    
                    <!-- Email Input dengan Micro-interaction -->
                    <div class="space-y-1.5">
                        <label class="text-[11px] font-black text-gray-600 uppercase tracking-widest ml-1">email address.</label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="masukkan email anda" required autofocus 
                            class="w-full px-6 py-4 bg-gray-100/60 border-2 border-transparent rounded-2xl focus:bg-white focus:border-[#ee4d2d]/30 focus:ring-4 focus:ring-[#ee4d2d]/5 text-sm font-bold transition-all duration-300 outline-none placeholder:text-gray-400">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password Input -->
                    <div class="space-y-1.5">
                        <label class="text-[11px] font-black text-gray-600 uppercase tracking-widest ml-1">password.</label>
                        <input type="password" name="password" placeholder="••••••••" required 
                            class="w-full px-6 py-4 bg-gray-100/60 border-2 border-transparent rounded-2xl focus:bg-white focus:border-[#ee4d2d]/30 focus:ring-4 focus:ring-[#ee4d2d]/5 text-sm font-bold transition-all duration-300 outline-none placeholder:text-gray-400">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="flex justify-end">
                        <a href="#" class="text-xs font-black text-[#ee4d2d] hover:text-[#d73211] transition">lupa password?</a>
                    </div>

                    <!-- CTA Button -->
                    <button type="submit" class="w-full bg-[#ee4d2d] text-white font-extrabold py-4 rounded-full shadow-xl shadow-[#ee4d2d]/25 hover:scale-[1.03] hover:bg-[#d73211] active:scale-95 transition-all duration-300 uppercase tracking-widest text-sm">
                        masuk sekarang
                    </button>

                    <!-- SOCIAL LOGIN (GOOGLE) dengan Hitbox Seimbang -->
                    <div class="relative py-2">
                        <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-gray-100"></div></div>
                        <div class="relative flex justify-center text-[10px] uppercase font-black"><span class="bg-white px-4 text-gray-300 tracking-tighter">atau gunakan</span></div>
                    </div>

                    <button type="button" class="w-full flex items-center justify-center gap-3 bg-white border border-gray-100 py-4 rounded-full shadow-sm hover:bg-gray-50 active:scale-95 transition-all font-black text-gray-700 text-xs uppercase tracking-widest group">
                        <svg class="w-5 h-5 group-hover:scale-110 transition" viewBox="0 0 48 48"><path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/><path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/><path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"/><path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/></svg>
                        google
                    </button>
                </form>

                <div class="mt-10 text-center text-sm font-bold text-gray-400">
                    baru di shopee? <a href="{{ route('register') }}" class="text-[#ee4d2d] font-black hover:underline ml-1">daftar.</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>