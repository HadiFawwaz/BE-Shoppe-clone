<x-app-layout>
    <div class="min-h-screen bg-[#f5f5f5] py-6">
        <div class="mx-auto max-w-6xl px-4">
            @if (session('success'))
                <div class="mb-4 rounded-sm border border-green-300 bg-green-50 px-4 py-3 text-sm font-semibold text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 rounded-sm border border-red-300 bg-red-50 px-4 py-3 text-sm text-red-700">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid gap-4 md:grid-cols-[260px_1fr]">
                <aside class="rounded-sm bg-white p-5 shadow-sm">
                    <div class="flex items-center gap-3 border-b border-gray-100 pb-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-[#ffe8df] text-lg font-bold text-[#ee4d2d]">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800">{{ $user->name }}</p>
                            <p class="text-xs text-gray-500">{{ $user->email }}</p>
                        </div>
                    </div>

                    <nav class="mt-4 space-y-2 text-sm">
                        <a href="{{ route('buyer.profile') }}" class="block rounded-sm bg-[#fff1ec] px-3 py-2 font-semibold text-[#ee4d2d]">Profil Saya</a>
                        <a href="{{ route('buyer.riwayat') }}" class="block rounded-sm px-3 py-2 text-gray-700 transition hover:bg-gray-50">Pesanan Saya</a>
                        <a href="{{ route('buyer.katalog') }}" class="block rounded-sm px-3 py-2 text-gray-700 transition hover:bg-gray-50">Kembali Belanja</a>
                    </nav>
                </aside>

                <section class="rounded-sm bg-white p-6 shadow-sm">
                    <div class="mb-6 border-b border-gray-100 pb-4">
                        <h1 class="text-2xl font-semibold text-gray-800">Profil Saya</h1>
                        <p class="mt-1 text-sm text-gray-500">Kelola informasi akun agar proses checkout lebih cepat.</p>
                    </div>

                    <form action="{{ route('buyer.profile.update') }}" method="POST" class="space-y-5">
                        @csrf
                        @method('PUT')

                        <div class="grid gap-5 md:grid-cols-2">
                            <div>
                                <label for="name" class="mb-2 block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required class="w-full rounded-sm border border-gray-300 px-3 py-2 text-sm focus:border-[#ee4d2d] focus:outline-none focus:ring-1 focus:ring-[#ee4d2d]">
                            </div>
                            <div>
                                <label for="no_hp" class="mb-2 block text-sm font-medium text-gray-700">Nomor HP</label>
                                <input id="no_hp" name="no_hp" type="text" value="{{ old('no_hp', $user->no_hp) }}" placeholder="0812xxxxxx" class="w-full rounded-sm border border-gray-300 px-3 py-2 text-sm focus:border-[#ee4d2d] focus:outline-none focus:ring-1 focus:ring-[#ee4d2d]">
                            </div>
                        </div>

                        <div>
                            <label for="alamat" class="mb-2 block text-sm font-medium text-gray-700">Alamat</label>
                            <textarea id="alamat" name="alamat" rows="4" placeholder="Isi alamat lengkap untuk pengiriman." class="w-full rounded-sm border border-gray-300 px-3 py-2 text-sm focus:border-[#ee4d2d] focus:outline-none focus:ring-1 focus:ring-[#ee4d2d]">{{ old('alamat', $user->alamat) }}</textarea>
                        </div>

                        <div>
                            <label for="sosmed" class="mb-2 block text-sm font-medium text-gray-700">Instagram / Sosial Media</label>
                            <input id="sosmed" name="sosmed" type="text" value="{{ old('sosmed', $user->sosmed) }}" placeholder="@username" class="w-full rounded-sm border border-gray-300 px-3 py-2 text-sm focus:border-[#ee4d2d] focus:outline-none focus:ring-1 focus:ring-[#ee4d2d]">
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="rounded-sm bg-[#ee4d2d] px-6 py-2.5 text-sm font-semibold text-white transition hover:bg-[#d74225]">
                                Simpan Profil
                            </button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
