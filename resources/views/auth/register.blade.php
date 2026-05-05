<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>buat akun sekarang. - Shopee Clone</title>
    <!-- Font Plus Jakarta Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #ee4d2d; border-radius: 10px; }
    </style>
</head>
<body class="bg-[#f8fAfc] antialiased min-h-screen flex flex-col overflow-x-hidden">

    <!-- 1. MINIMALIST FLOATING HEADER -->
    <div class="fixed top-0 left-0 right-0 z-50 bg-white/60 backdrop-blur-md border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-6 md:px-12 py-4 flex items-center justify-between">
            <a href="{{ url('/') }}" class="flex items-center gap-3 text-[#ee4d2d] group">
                <div class="bg-[#ee4d2d]/10 p-2.5 rounded-xl group-hover:scale-110 transition duration-300">
                    <svg class="w-7 h-7 md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </div>
                <h1 class="text-2xl md:text-3xl font-extrabold tracking-tighter">shopee.</h1>
            </a>
            <a href="#" class="text-[#ee4d2d] text-sm hover:text-[#d73211] transition font-bold">butuh bantuan?</a>
        </div>
    </div>

    <!-- 2. SPLIT SCREEN LAYOUT -->
    <div class="flex-grow grid grid-cols-1 lg:grid-cols-12 min-h-screen">
        
        <!-- LEFT SIDE (BRANDING) -->
        <div class="hidden lg:block lg:col-span-7 relative overflow-hidden">
            <img src="https://images.unsplash.com/photo-1607082349566-187342175e2f?q=80&w=2070" class="absolute inset-0 w-full h-full object-cover" alt="Register Background">
            <div class="absolute inset-0 bg-black/65"></div>
            
            <div class="absolute inset-0 flex flex-col justify-center px-24 z-10">
                <h2 class="text-6xl font-extrabold text-white leading-tight tracking-tighter mb-6 drop-shadow-2xl">
                    mulai jualan & <br>
                    <span class="text-[#ee4d2d]">belanja seru.</span>
                </h2>
                <p class="text-white/70 text-xl max-w-md font-medium leading-relaxed">
                    daftarkan dirimu dan nikmati ribuan promo menarik serta kemudahan dalam mengelola tokomu sendiri.
                </p>
            </div>

            <div class="absolute bottom-12 left-24 flex items-center gap-8 text-white/90">
                <div class="flex flex-col">
                    <span class="text-3xl font-extrabold text-white">10M+</span>
                    <span class="text-[10px] uppercase font-black tracking-[0.2em] text-white/70">pengguna aktif.</span>
                </div>
                <div class="h-10 w-px bg-white/20"></div>
                <div class="flex flex-col">
                    <span class="text-3xl font-extrabold text-white">#1</span>
                    <span class="text-[10px] uppercase font-black tracking-[0.2em] text-white/70">e-commerce pilihan.</span>
                </div>
            </div>
        </div>

        <!-- RIGHT SIDE (FORM REGISTER) -->
        <div class="col-span-1 lg:col-span-5 flex items-center justify-center p-6 lg:p-12 bg-orange-50/20 pt-28 lg:pt-12">
            
            <div class="w-full max-w-[460px] bg-white/90 backdrop-blur-3xl border border-white/40 shadow-2xl rounded-[40px] p-8 lg:p-10 hover:shadow-[0_30px_70px_rgba(238,77,45,0.12)] transition-all duration-500 overflow-y-auto max-h-[90vh] lg:max-h-none custom-scrollbar">
                
                <div class="mb-8">
                    <h3 class="text-3xl font-extrabold text-gray-900 tracking-tighter mb-1">buat akun sekarang.</h3>
                    <p class="text-gray-400 font-semibold text-sm">langkah awal menuju belanja seru.</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf
                    
                    <!-- Full Name -->
                    <div class="space-y-1.5">
                        <label class="text-[11px] font-black text-gray-600 uppercase tracking-widest ml-1">nama lengkap.</label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="masukkan nama anda" required autofocus 
                            class="w-full px-6 py-3.5 bg-gray-100/80 border-2 border-transparent rounded-2xl focus:bg-white focus:border-[#ee4d2d]/30 focus:ring-4 focus:ring-[#ee4d2d]/5 text-sm font-bold transition-all duration-300 outline-none">
                        @error('name') <p class="text-[11px] text-red-500/90 font-bold lowercase mt-1 ml-2 tracking-wide">{{ $message }}</p> @enderror
                    </div>

                    <!-- Email -->
                    <div class="space-y-1.5">
                        <label class="text-[11px] font-black text-gray-600 uppercase tracking-widest ml-1">email address.</label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="masukkan email aktif" required 
                            class="w-full px-6 py-3.5 bg-gray-100/80 border-2 border-transparent rounded-2xl focus:bg-white focus:border-[#ee4d2d]/30 focus:ring-4 focus:ring-[#ee4d2d]/5 text-sm font-bold transition-all duration-300 outline-none">
                        @error('email') <p class="text-[11px] text-red-500/90 font-bold lowercase mt-1 ml-2 tracking-wide">{{ $message }}</p> @enderror
                    </div>

                    <!-- Password with Toggle -->
                    <div class="space-y-1.5">
                        <label class="text-[11px] font-black text-gray-600 uppercase tracking-widest ml-1">password.</label>
                        <div class="relative group">
                            <input type="password" id="password" name="password" placeholder="minimal 8 karakter" required 
                                class="w-full px-6 py-3.5 bg-gray-100/80 border-2 border-transparent rounded-2xl focus:bg-white focus:border-[#ee4d2d]/30 focus:ring-4 focus:ring-[#ee4d2d]/5 text-sm font-bold transition-all duration-300 outline-none pr-14">
                            <button type="button" onclick="togglePassword('password', 'eye-icon-1')" class="absolute right-5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#ee4d2d] transition">
                                <svg id="eye-icon-1" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                        </div>
                        @error('password') <p class="text-[11px] text-red-500/90 font-bold lowercase mt-1 ml-2 tracking-wide">{{ $message }}</p> @enderror
                    </div>

                    <!-- Confirm Password with Toggle -->
                    <div class="space-y-1.5">
                        <label class="text-[11px] font-black text-gray-600 uppercase tracking-widest ml-1">konfirmasi password.</label>
                        <div class="relative group">
                            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="ulangi password" required 
                                class="w-full px-6 py-3.5 bg-gray-100/80 border-2 border-transparent rounded-2xl focus:bg-white focus:border-[#ee4d2d]/30 focus:ring-4 focus:ring-[#ee4d2d]/5 text-sm font-bold transition-all duration-300 outline-none pr-14">
                            <button type="button" onclick="togglePassword('password_confirmation', 'eye-icon-2')" class="absolute right-5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#ee4d2d] transition">
                                <svg id="eye-icon-2" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- CTA Button -->
                    <button type="submit" class="w-full bg-[#ee4d2d] text-white font-extrabold py-4 rounded-full shadow-xl shadow-[#ee4d2d]/25 hover:scale-[1.03] hover:bg-[#d73211] active:scale-95 transition-all duration-300 uppercase tracking-widest text-sm mt-4">
                        buat akun sekarang
                    </button>

                    <!-- SOCIAL REGISTER -->
                    <div class="relative py-2">
                        <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-gray-100"></div></div>
                        <div class="relative flex justify-center text-[10px] uppercase font-black"><span class="bg-white px-4 text-gray-300 tracking-tighter">atau daftar dengan</span></div>
                    </div>

                    <button type="button" class="w-full flex items-center justify-center gap-3 bg-white border border-gray-100 py-4 rounded-full shadow-sm hover:bg-gray-50 active:scale-95 transition-all font-black text-gray-700 text-xs uppercase tracking-widest group">
                        <svg class="w-5 h-5 group-hover:scale-110 transition" viewBox="0 0 48 48"><path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/><path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/><path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"/><path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/></svg>
                        google
                    </button>
                </form>

                <div class="mt-8 text-center text-sm font-bold text-gray-400">
                    sudah punya akun? <a href="{{ route('login') }}" class="text-[#ee4d2d] font-black hover:underline ml-1">masuk.</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Toggle Password Script -->
    <script>
        function togglePassword(inputId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const eyeIcon = document.getElementById(iconId);
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"></path>';
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>';
            }
        }
    </script>
</body>
</html>