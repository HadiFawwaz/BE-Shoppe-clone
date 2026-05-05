<x-app-layout>
    <div class="bg-[#f5f5f5] min-h-screen py-8 font-sans">
        <div class="max-w-[1200px] mx-auto px-4 flex flex-col md:flex-row gap-6">
            
            <!-- SIDEBAR KIRI -->
            <div class="w-full md:w-64 flex-shrink-0">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-200">
                    <div class="w-12 h-12 rounded-full bg-gray-200 border border-gray-300 flex items-center justify-center text-gray-500 overflow-hidden">
                        <svg class="w-8 h-8 mt-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                    </div>
                    <div>
                        <div class="font-bold text-sm text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="text-[#ee4d2d] text-xs flex items-center gap-1 mt-0.5 cursor-pointer">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            Ubah Profil
                        </div>
                    </div>
                </div>
                <ul class="text-sm space-y-4">
                    <li class="font-bold text-[#ee4d2d] flex items-center gap-2 cursor-pointer">
                        <svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                        Akun Saya
                    </li>
                    <li class="text-[#ee4d2d] pl-7 cursor-pointer font-medium">Profil</li>
                    <li class="text-gray-600 pl-7 hover:text-[#ee4d2d] cursor-pointer">Bank & Kartu</li>
                    <li class="text-gray-600 pl-7 hover:text-[#ee4d2d] cursor-pointer">Alamat</li>
                    <li class="font-bold text-gray-700 mt-4 hover:text-[#ee4d2d] flex items-center gap-2 cursor-pointer">
                        <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : route('buyer.riwayat') }}" class="flex items-center gap-2 w-full">
                            <svg class="w-5 h-5 text-[#ee4d2d]" fill="currentColor" viewBox="0 0 20 20"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path></svg>
                            {{ Auth::user()->role === 'admin' ? 'Pesanan Masuk' : 'Pesanan Saya' }}
                        </a>
                    </li>
                </ul>
            </div>

            <!-- KONTEN KANAN -->
            <div class="flex-1 space-y-4">
                
                <!-- Notifikasi Berhasil -->
                @if (session('status') === 'profile-updated' || session('status') === 'password-updated')
                    <div class="bg-green-50 border border-green-200 text-green-600 px-4 py-3 rounded-sm text-sm">
                        Data berhasil diperbarui!
                    </div>
                @endif

                <!-- KOTAK 1: PROFIL DASAR -->
                <div class="bg-white p-6 shadow-sm rounded-sm">
                    <div class="border-b border-gray-100 pb-4 mb-6">
                        <h2 class="text-lg font-medium text-gray-800">Profil Saya</h2>
                        <p class="text-sm text-gray-500">Kelola informasi profil Anda untuk mengontrol, melindungi dan mengamankan akun</p>
                    </div>

                    <form method="post" action="{{ route('profile.update') }}" class="max-w-2xl">
                        @csrf
                        @method('patch')

                        <div class="flex items-center mb-6">
                            <label class="w-1/4 text-right pr-6 text-sm text-gray-500 font-medium">Nama</label>
                            <div class="w-3/4">
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border-gray-300 focus:border-[#ee4d2d] focus:ring-[#ee4d2d] rounded-sm shadow-sm text-sm" required>
                            </div>
                        </div>

                        <div class="flex items-center mb-6">
                            <label class="w-1/4 text-right pr-6 text-sm text-gray-500 font-medium">Email</label>
                            <div class="w-3/4">
                                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border-gray-300 focus:border-[#ee4d2d] focus:ring-[#ee4d2d] rounded-sm shadow-sm text-sm" required>
                            </div>
                        </div>

                        <div class="flex items-center">
                            <div class="w-1/4"></div>
                            <div class="w-3/4">
                                <button type="submit" class="bg-[#ee4d2d] hover:bg-[#d73211] text-white px-8 py-2 text-sm rounded-sm shadow-sm transition">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- KOTAK 2: GANTI PASSWORD -->
                <div class="bg-white p-6 shadow-sm rounded-sm">
                    <div class="border-b border-gray-100 pb-4 mb-6">
                        <h2 class="text-lg font-medium text-gray-800">Keamanan Akun</h2>
                        <p class="text-sm text-gray-500">Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap aman.</p>
                    </div>

                    <form method="post" action="{{ route('password.update') }}" class="max-w-2xl">
                        @csrf
                        @method('put')

                        <div class="flex items-center mb-6">
                            <label class="w-1/4 text-right pr-6 text-sm text-gray-500 font-medium">Password Saat Ini</label>
                            <div class="w-3/4">
                                <input type="password" name="current_password" class="w-full border-gray-300 focus:border-[#ee4d2d] focus:ring-[#ee4d2d] rounded-sm shadow-sm text-sm">
                            </div>
                        </div>

                        <div class="flex items-center mb-6">
                            <label class="w-1/4 text-right pr-6 text-sm text-gray-500 font-medium">Password Baru</label>
                            <div class="w-3/4">
                                <input type="password" name="password" class="w-full border-gray-300 focus:border-[#ee4d2d] focus:ring-[#ee4d2d] rounded-sm shadow-sm text-sm">
                            </div>
                        </div>

                        <div class="flex items-center mb-6">
                            <label class="w-1/4 text-right pr-6 text-sm text-gray-500 font-medium">Konfirmasi Password</label>
                            <div class="w-3/4">
                                <input type="password" name="password_confirmation" class="w-full border-gray-300 focus:border-[#ee4d2d] focus:ring-[#ee4d2d] rounded-sm shadow-sm text-sm">
                            </div>
                        </div>

                        <div class="flex items-center">
                            <div class="w-1/4"></div>
                            <div class="w-3/4">
                                <button type="submit" class="bg-[#ee4d2d] hover:bg-[#d73211] text-white px-8 py-2 text-sm rounded-sm shadow-sm transition">
                                    Update Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>