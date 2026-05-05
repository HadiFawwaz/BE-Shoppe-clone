<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shopee Clone - 2026 Edition</title>
    <!-- Import Font Modern Plus Jakarta Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#f8fAfc] text-gray-800 antialiased min-h-screen flex flex-col relative selection:bg-[#ee4d2d] selection:text-white overflow-x-hidden">

    <!-- 1. FLOATING GLASS HEADER -->
    <header class="fixed top-6 left-4 right-4 md:left-1/2 md:-translate-x-1/2 md:w-full max-w-5xl bg-white/70 backdrop-blur-lg border border-white/50 shadow-sm shadow-gray-200/50 rounded-full py-3 px-6 md:px-8 flex justify-between items-center z-50 transition-all duration-300">
        <div class="flex items-center gap-2 text-[#ee4d2d] group cursor-pointer">
            <div class="bg-[#ee4d2d]/10 p-2 rounded-full group-hover:scale-110 transition duration-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
            </div>
            <h1 class="text-xl font-extrabold tracking-tight">shopee.</h1>
        </div>
        <div class="flex items-center gap-2 md:gap-4 font-bold text-sm">
            @auth
                <a href="{{ url('/dashboard') }}" class="text-gray-600 hover:text-[#ee4d2d] transition px-4 py-2">dashboard.</a>
                <a href="{{ url('/dashboard') }}" class="bg-gray-900 text-white px-6 py-2.5 rounded-full hover:scale-105 hover:shadow-lg hover:shadow-gray-900/20 transition-all">Lanjut Belanja</a>
            @else
                <a href="{{ route('login') }}" class="text-gray-600 hover:text-[#ee4d2d] transition px-4 py-2">log in.</a>
                <a href="{{ route('register') }}" class="bg-[#ee4d2d] text-white px-6 py-2.5 rounded-full hover:scale-105 hover:bg-[#d73211] hover:shadow-lg hover:shadow-[#ee4d2d]/30 transition-all duration-300 tracking-wide">daftar.</a>
            @endauth
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-6 md:px-12 pt-36 pb-20 w-full flex-grow flex flex-col gap-24">

        <!-- 2. HERO SECTION DENGAN TYPOGRAPHY MODERN -->
        <section class="flex flex-col-reverse lg:flex-row items-center gap-16">
            <!-- Text Area -->
            <div class="flex-1 space-y-8 text-center lg:text-left relative z-10">
                <div class="inline-flex items-center gap-2 bg-orange-100/60 border border-orange-200 text-[#ee4d2d] text-sm font-bold px-4 py-2 rounded-full mb-2 backdrop-blur-sm">
                    <span class="relative flex h-2.5 w-2.5">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#ee4d2d] opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-[#ee4d2d]"></span>
                    </span>
                    Tren E-Commerce 2026
                </div>
                
                <!-- Headline lowercase + tracking rapat -->
                <h2 class="text-5xl lg:text-[4.5rem] font-extrabold tracking-tighter text-gray-900 leading-[1.1]">
                    belanja cerdas, <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#ee4d2d] to-[#ff8c42]">pasti murah.</span>
                </h2>
                
                <p class="text-gray-500 text-lg md:text-xl max-w-xl mx-auto lg:mx-0 leading-relaxed font-medium">
                    Jelajahi jutaan produk impianmu dengan harga terbaik. Rasakan pengalaman belanja masa depan yang lebih cepat, aman, dan memanjakan mata.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 pt-4 justify-center lg:justify-start">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="bg-gray-900 text-white px-8 py-4 rounded-full font-bold text-lg shadow-xl shadow-gray-900/20 hover:scale-105 hover:bg-black transition-all flex items-center justify-center gap-2 group">
                            Dashboard Saya
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="bg-[#ee4d2d] text-white px-8 py-4 rounded-full font-bold text-lg shadow-xl shadow-[#ee4d2d]/30 hover:scale-105 hover:bg-[#d73211] transition-all flex items-center justify-center gap-2 group">
                            Mulai Sekarang
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                        <a href="{{ route('register') }}" class="bg-white border-[3px] border-gray-300 text-gray-700 px-8 py-4 rounded-full font-bold text-lg hover:border-[#ee4d2d] hover:text-[#ee4d2d] transition-all hover:scale-105 flex items-center justify-center shadow-sm">
                            Pelajari Fitur
                        </a>
                    @endauth
                </div>
            </div>
            
            <!-- 3. ABSTRACT 3D & GLASSMORPHISM -->
            <div class="flex-1 flex justify-center relative w-full lg:min-h-[500px]">
                <!-- Glow Effect Belakang Gambar -->
                <div class="absolute w-72 h-72 bg-gradient-to-tr from-[#ee4d2d] to-[#ff9eb5] rounded-full mix-blend-multiply filter blur-3xl opacity-40 animate-blob top-0 right-10"></div>
                <div class="absolute w-72 h-72 bg-gradient-to-tr from-[#3b82f6] to-[#8b5cf6] rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000 -bottom-10 left-10"></div>
                
                <!-- Elemen Dekoratif Kanan Bawah (Keseimbangan Visual) -->
                <div class="absolute -bottom-8 -right-4 w-28 h-28 border-[6px] border-dashed border-[#ee4d2d]/30 rounded-full z-0 animate-[spin_15s_linear_infinite]"></div>
                <div class="absolute -bottom-2 right-2 w-16 h-16 bg-white/50 backdrop-blur-md rounded-full z-0 border border-white/80 shadow-lg"></div>

                <div class="relative z-10 transform hover:-translate-y-2 transition duration-500 w-full max-w-md">
                    <!-- Gambar 3D Abstract -->
                    <img src="https://images.unsplash.com/photo-1627384113743-6bd5a479fffd?q=80&w=2000" alt="3D Shopping" class="rounded-[2.5rem] w-full h-[450px] object-cover shadow-2xl border-4 border-white">
                    
                    <!-- Glassmorphism Floating Card 1 -->
                    <div class="absolute -bottom-6 -left-6 md:-left-12 bg-white/40 backdrop-blur-xl border border-white/60 p-4 md:p-5 rounded-3xl shadow-2xl flex items-center gap-4 hover:scale-110 transition-transform duration-300">
                        <div class="bg-gradient-to-br from-green-400 to-green-600 p-3.5 rounded-2xl shadow-lg shadow-green-500/30 text-white">
                            <svg class="w-6 h-6 md:w-7 md:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <div>
                            <p class="text-[10px] md:text-xs text-gray-800 font-extrabold uppercase tracking-wider">Gratis Ongkir</p>
                            <p class="text-xs md:text-sm font-semibold text-gray-600">Tanpa Minimum</p>
                        </div>
                    </div>

                    <!-- Glassmorphism Floating Card 2 -->
                    <div class="absolute top-10 -right-4 md:-right-12 bg-white/40 backdrop-blur-xl border border-white/60 px-5 md:px-6 py-4 rounded-3xl shadow-2xl flex items-center gap-3 hover:scale-110 transition-transform duration-300">
                        <span class="text-xl md:text-2xl">🔥</span>
                        <div>
                            <p class="text-[10px] md:text-xs text-gray-800 font-extrabold uppercase tracking-wider">Flash Sale</p>
                            <p class="text-xs md:text-sm font-bold text-[#ee4d2d]">Diskon 99%</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 4. BENTO GRID SECTION -->
        <section class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8 relative z-10">
            
            <!-- Bento Card 1 (Light) -->
            <div class="bg-gradient-to-br from-white to-gray-50 border border-white/80 p-8 rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-[0_20px_40px_rgba(238,77,45,0.08)] hover:-translate-y-1 transition-all duration-300 group">
                <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 group-hover:rotate-3 transition duration-300 border border-blue-100">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <h3 class="text-xl font-extrabold text-gray-900 mb-3 tracking-tight">pencarian cerdas.</h3>
                <p class="text-gray-500 text-sm font-medium leading-relaxed">Algoritma cerdas kami membantu menemukan barang yang spesifik dalam hitungan milidetik.</p>
            </div>

            <!-- Bento Card 2 (Vibrant / Highlighted) -> Warna digelapkan & teks ditebalkan -->
            <div class="bg-gradient-to-br from-[#d94224] to-[#f45c33] p-8 rounded-[2rem] shadow-xl shadow-[#ee4d2d]/20 hover:shadow-2xl hover:shadow-[#ee4d2d]/30 hover:-translate-y-1 transition-all duration-300 group text-white">
                <div class="w-14 h-14 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 group-hover:-rotate-3 transition duration-300 border border-white/30">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                </div>
                <h3 class="text-xl font-extrabold mb-3 tracking-tight">transaksi ultra aman.</h3>
                <!-- Opacity dinaikkan (white/95) & font-semibold -->
                <p class="text-white/95 text-sm font-semibold leading-relaxed">Sistem enkripsi 256-bit kelas militer. Uangmu dijamin aman 100% sampai barang tiba di tangan.</p>
            </div>

            <!-- Bento Card 3 (Light) -->
            <div class="bg-gradient-to-br from-white to-gray-50 border border-white/80 p-8 rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-[0_20px_40px_rgba(238,77,45,0.08)] hover:-translate-y-1 transition-all duration-300 group">
                <div class="w-14 h-14 bg-purple-50 text-purple-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 group-hover:rotate-3 transition duration-300 border border-purple-100">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-xl font-extrabold text-gray-900 mb-3 tracking-tight">layanan support 24/7.</h3>
                <p class="text-gray-500 text-sm font-medium leading-relaxed">Tim support kami bukan robot. Dapatkan bantuan langsung dari manusia kapanpun kamu butuh.</p>
            </div>

        </section>
    </main>
</body>
</html>