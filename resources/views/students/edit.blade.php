<x-layouts.app title="Ubah Data Siswa — {{ $student->nama_lengkap }}">
    <div class="max-w-3xl mx-auto">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <a href="{{ route('students.show', $student) }}" class="text-xs font-bold text-[#1B6CF2] hover:underline uppercase tracking-wider block mb-2">
                    Kembali ke Detail Siswa
                </a>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-[#0F172A] tracking-tight">
                    Perbarui Data Siswa
                </h1>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">
                    Sinkronisasi pembaruan informasi profil siswa dalam pangkalan data SIAKAD.
                </p>
            </div>
        </div>

        <div class="siakad-card bg-white rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-sm">
            <form method="POST" action="{{ route('students.update', $student) }}" class="space-y-5">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="nis" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Nomor Induk Siswa (NIS) <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" id="nis" name="nis" value="{{ old('nis', $student->nis) }}" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1B6CF2] focus:border-[#1B6CF2]">
                    </div>

                    <div>
                        <label for="nisn" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            NISN <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" id="nisn" name="nisn" value="{{ old('nisn', $student->nisn) }}" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1B6CF2] focus:border-[#1B6CF2]">
                    </div>
                </div>

                <div>
                    <label for="nama_lengkap" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Nama Lengkap Siswa <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap', $student->nama_lengkap) }}" required
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1B6CF2] focus:border-[#1B6CF2]">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label for="jurusan" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Jurusan <span class="text-rose-500">*</span>
                        </label>
                        <select id="jurusan" name="jurusan" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1B6CF2] focus:border-[#1B6CF2]">
                            <option value="TKJ" {{ old('jurusan', $student->jurusan) == 'TKJ' ? 'selected' : '' }}>TKJ</option>
                            <option value="RPL" {{ old('jurusan', $student->jurusan) == 'RPL' ? 'selected' : '' }}>RPL</option>
                            <option value="DKV" {{ old('jurusan', $student->jurusan) == 'DKV' ? 'selected' : '' }}>DKV</option>
                        </select>
                    </div>

                    <div>
                        <label for="kelas" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Kelas <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" id="kelas" name="kelas" value="{{ old('kelas', $student->kelas) }}" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1B6CF2] focus:border-[#1B6CF2]">
                    </div>

                    <div>
                        <label for="jenis_kelamin" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Jenis Kelamin <span class="text-rose-500">*</span>
                        </label>
                        <select id="jenis_kelamin" name="jenis_kelamin" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1B6CF2] focus:border-[#1B6CF2]">
                            <option value="L" {{ old('jenis_kelamin', $student->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin', $student->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="tempat_lahir" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Tempat Lahir
                        </label>
                        <input type="text" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir', $student->tempat_lahir) }}"
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1B6CF2] focus:border-[#1B6CF2]">
                    </div>

                    <div>
                        <label for="tanggal_lahir" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Tanggal Lahir
                        </label>
                        <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $student->tanggal_lahir?->format('Y-m-d')) }}"
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1B6CF2] focus:border-[#1B6CF2]">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="no_telepon" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            No. Telepon / WhatsApp
                        </label>
                        <input type="text" id="no_telepon" name="no_telepon" value="{{ old('no_telepon', $student->no_telepon) }}"
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1B6CF2] focus:border-[#1B6CF2]">
                    </div>

                    <div>
                        <label for="status_aktif" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Status Keaktifan Siswa <span class="text-rose-500">*</span>
                        </label>
                        <select id="status_aktif" name="status_aktif" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1B6CF2] focus:border-[#1B6CF2]">
                            <option value="aktif" {{ old('status_aktif', $student->status_aktif) == 'aktif' ? 'selected' : '' }}>Aktif Belajar</option>
                            <option value="lulus" {{ old('status_aktif', $student->status_aktif) == 'lulus' ? 'selected' : '' }}>Lulus</option>
                            <option value="mutasi" {{ old('status_aktif', $student->status_aktif) == 'mutasi' ? 'selected' : '' }}>Mutasi / Pindah</option>
                            <option value="non-aktif" {{ old('status_aktif', $student->status_aktif) == 'non-aktif' ? 'selected' : '' }}>Non-Aktif</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label for="user_id" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Hubungkan ke Akun Pengguna
                    </label>
                    <select id="user_id" name="user_id"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1B6CF2] focus:border-[#1B6CF2]">
                        <option value="">Tidak Dihubungkan</option>
                        @foreach($usersWithoutStudent as $u)
                            <option value="{{ $u->id }}" {{ old('user_id', $student->user_id) == $u->id ? 'selected' : '' }}>
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
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl p-4 text-sm font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1B6CF2] focus:border-[#1B6CF2]">{{ old('alamat', $student->alamat) }}</textarea>
                </div>

                <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-100">
                    <a href="{{ route('students.show', $student) }}" class="px-5 py-2.5 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-100 transition-colors">
                        Batal
                    </a>
                    <button type="submit" class="bg-[#1B6CF2] hover:bg-[#1455C0] text-white px-7 py-2.5 rounded-xl text-sm font-bold shadow-sm transition-all">
                        Perbarui Data Siswa
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
