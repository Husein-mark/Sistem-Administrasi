<x-layouts.guest title="Masuk ke Sistem Administrasi — SIAKAD Online">
    <div class="max-w-md mx-auto my-8 sm:my-16 px-4">
        <div class="siakad-card p-8 sm:p-10 shadow-lg">
            <div class="mb-8 text-center">
                <span class="inline-block bg-[#EFF6FF] text-[#1B6CF2] border border-[#BFDBFE] font-bold text-xs px-3 py-1 rounded-full mb-3 tracking-wide">
                    AUTENTIKASI PENGGUNA
                </span>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-[#1E293B] tracking-tight">
                    Masuk ke Sistem
                </h1>
                <p class="text-xs text-[#64748B] mt-1.5 font-medium">
                    Gunakan email dan kata sandi yang telah terdaftar di SIAKAD
                </p>
            </div>

            <form method="POST" action="{{ route('login.attempt') }}" class="space-y-4">
                @csrf

                <div>
                    <label for="email" class="block text-xs font-bold text-[#64748B] uppercase tracking-wider mb-1">
                        Alamat Email
                    </label>
                    <input type="email" id="email" name="email" value="{{ old('email', 'admin@pesat.sch.id') }}" required autofocus
                        class="w-full bg-slate-50 border border-[#E2E8F0] rounded-xl px-4 py-2.5 text-sm font-medium text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-[#1B6CF2] focus:bg-white">
                </div>

                <div>
                    <label for="password" class="block text-xs font-bold text-[#64748B] uppercase tracking-wider mb-1">
                        Kata Sandi
                    </label>
                    <input type="password" id="password" name="password" value="password" required
                        class="w-full bg-slate-50 border border-[#E2E8F0] rounded-xl px-4 py-2.5 text-sm font-medium text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-[#1B6CF2] focus:bg-white">
                </div>

                <div class="flex items-center justify-between pt-1">
                    <label class="flex items-center gap-2 cursor-pointer text-xs font-semibold text-[#64748B]">
                        <input type="checkbox" name="remember" class="rounded border-[#E2E8F0] text-[#1B6CF2] focus:ring-[#1B6CF2]">
                        Ingat sesi saya
                    </label>
                </div>

                <button type="submit" class="w-full bg-[#1B6CF2] hover:bg-[#1455C0] text-white py-3 px-6 rounded-xl font-bold text-sm shadow-xs transition-all mt-3">
                    Masuk Sekarang
                </button>
            </form>

            <div class="mt-8 pt-6 border-t border-slate-100">
                <div class="text-[11px] font-bold text-[#64748B] uppercase tracking-wider mb-3 text-center">
                    Akses Cepat Akun Demo (Klik untuk Mengisi)
                </div>
                <div class="grid grid-cols-3 gap-2">
                    <button type="button" onclick="document.getElementById('email').value='admin@pesat.sch.id';document.getElementById('password').value='password';"
                        class="bg-slate-50 hover:bg-[#EFF6FF] border border-slate-200 p-2 rounded-xl text-[11px] font-bold text-[#1E293B] hover:text-[#1B6CF2] text-center transition-colors">
                        Admin TU
                    </button>
                    <button type="button" onclick="document.getElementById('email').value='siswa@pesat.sch.id';document.getElementById('password').value='password';"
                        class="bg-slate-50 hover:bg-[#EFF6FF] border border-slate-200 p-2 rounded-xl text-[11px] font-bold text-[#1E293B] hover:text-[#1B6CF2] text-center transition-colors">
                        Siswa (RPL)
                    </button>
                    <button type="button" onclick="document.getElementById('email').value='kepsek@pesat.sch.id';document.getElementById('password').value='password';"
                        class="bg-slate-50 hover:bg-[#EFF6FF] border border-slate-200 p-2 rounded-xl text-[11px] font-bold text-[#1E293B] hover:text-[#1B6CF2] text-center transition-colors">
                        Approver
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-layouts.guest>
