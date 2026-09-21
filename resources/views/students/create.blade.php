<x-layouts.app title="Tambah Siswa Baru — SIAKAD Online">
    <div class="max-w-3xl mx-auto">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <a href="{{ route('students.index') }}" class="text-xs font-bold text-[#1B6CF2] hover:underline uppercase tracking-wider block mb-2">
                    Kembali ke Direktori Siswa
                </a>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-[#0F172A] tracking-tight">
                    Tambah Siswa Baru
                </h1>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">
                    Daftarkan peserta didik baru ke dalam pangkalan data terpusat SIAKAD.
                </p>
            </div>
        </div>

        <div class="siakad-card bg-white rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-sm">
            <form method="POST" action="{{ route('students.store') }}" class="space-y-5">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="nis" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Nomor Induk Siswa (NIS) <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" id="nis" name="nis" value="{{ old('nis') }}" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1B6CF2] focus:border-[#1B6CF2]">
                    </div>

                    <div>
                        <label for="nisn" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            NISN <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" id="nisn" name="nisn" value="{{ old('nisn') }}" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1B6CF2] focus:border-[#1B6CF2]">
                    </div>
                </div>

                <div>
                    <label for="nama_lengkap" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Nama Lengkap Siswa <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1B6CF2] focus:border-[#1B6CF2]">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label for="jurusan" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Jurusan <span class="text-rose-500">*</span>
                        </label>
                        <select id="jurusan" name="jurusan" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1B6CF2] focus:border-[#1B6CF2]">
                            <option value="">Pilih Jurusan</option>
                            <option value="TKJ" {{ old('jurusan') == 'TKJ' ? 'selected' : '' }}>Teknik Komputer & Jaringan</option>
                            <option value="RPL" {{ old('jurusan') == 'RPL' ? 'selected' : '' }}>Rekayasa Perangkat Lunak</option>
                            <option value="DKV" {{ old('jurusan') == 'DKV' ? 'selected' : '' }}>Desain Komunikasi Visual</option>
                        </select>
                    </div>

                    <div>
                        <label for="kelas" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Kelas <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" id="kelas" name="kelas" value="{{ old('kelas') }}" placeholder="Contoh: XI RPL 1" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1B6CF2] focus:border-[#1B6CF2]">
                    </div>

                    <div>
                        <label for="jenis_kelamin" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Jenis Kelamin <span class="text-rose-500">*</span>
                        </label>
                        <select id="jenis_kelamin" name="jenis_kelamin" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1B6CF2] focus:border-[#1B6CF2]">
                            <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="tempat_lahir" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Tempat Lahir
                        </label>
                        <input type="text" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}"
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1B6CF2] focus:border-[#1B6CF2]">
                    </div>

                    <div>
                        <label for="tanggal_lahir" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Tanggal Lahir
                        </label>
                        <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1B6CF2] focus:border-[#1B6CF2]">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="no_telepon" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            No. Telepon / WhatsApp
                        </label>
                        <input type="text" id="no_telepon" name="no_telepon" value="{{ old('no_telepon') }}"
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1B6CF2] focus:border-[#1B6CF2]">
                    </div>

                    <div>
                        <label for="status_aktif" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Status Keaktifan Siswa <span class="text-rose-500">*</span>
                        </label>
                        <select id="status_aktif" name="status_aktif" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1B6CF2] focus:border-[#1B6CF2]">
                            <option value="aktif" {{ old('status_aktif', 'aktif') == 'aktif' ? 'selected' : '' }}>Aktif Belajar</option>
                            <option value="lulus" {{ old('status_aktif') == 'lulus' ? 'selected' : '' }}>Lulus</option>
                            <option value="mutasi" {{ old('status_aktif') == 'mutasi' ? 'selected' : '' }}>Mutasi / Pindah</option>
                            <option value="non-aktif" {{ old('status_aktif') == 'non-aktif' ? 'selected' : '' }}>Non-Aktif</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label for="user_id" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Hubungkan ke Akun Pengguna (Opsional)
                    </label>
                    <select id="user_id" name="user_id"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1B6CF2] focus:border-[#1B6CF2]">
                        <option value="">Tidak Dihubungkan</option>
                        @foreach($usersWithoutStudent as $u)
                            <option value="{{ $u->id }}" {{ old('user_id') == $u->id ? 'selected' : '' }}>
                                {{ $u->name }} ({{ $u->email }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="alamat" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Alamat Domisili
                    </label>
                    <textarea id="alamat" name="alamat" rows="3"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl p-4 text-sm font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1B6CF2] focus:border-[#1B6CF2]">{{ old('alamat') }}</textarea>
                </div>

                <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-100">
                    <a href="{{ route('students.index') }}" class="px-5 py-2.5 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-100 transition-colors">
                        Batal
                    </a>
                    <button type="submit" class="bg-[#1B6CF2] hover:bg-[#1455C0] text-white px-7 py-2.5 rounded-xl text-sm font-bold shadow-sm transition-all">
                        Simpan Siswa
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
