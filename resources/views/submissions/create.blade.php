<x-layouts.app title="Buat Pengajuan Surat Baru — SIAKAD Online">
    <div class="max-w-2xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('submissions.index') }}" class="text-xs font-bold text-[#1B6CF2] hover:underline uppercase tracking-wider block mb-2">
                Kembali ke Antrean Pengajuan
            </a>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-[#0F172A] tracking-tight">
                Permohonan Administrasi Baru
            </h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">
                Lengkapi formulir permohonan surat administrasi untuk diproses secara digital oleh Bagian Tata Usaha.
            </p>
        </div>

        <div class="siakad-card bg-white rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-sm">
            <form method="POST" action="{{ route('submissions.store') }}" enctype="multipart/form-data" class="space-y-5">
                @csrf

                @if($student)
                    <input type="hidden" name="student_id" value="{{ $student->id }}">
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 flex items-center justify-between">
                        <div>
                            <span class="text-[10px] font-bold text-slate-400 uppercase block tracking-wider">Data Siswa Pemohon</span>
                            <span class="font-bold text-sm text-[#0F172A]">{{ $student->nama_lengkap }} ({{ $student->nis }})</span>
                            <span class="text-xs text-slate-500 block">{{ $student->kelas }} • Jurusan {{ $student->jurusan }}</span>
                        </div>
                        <span class="bg-emerald-50 text-emerald-700 border border-emerald-200 text-[10px] font-bold uppercase px-3 py-1 rounded-full">
                            Terverifikasi
                        </span>
                    </div>
                @else
                    <div>
                        <label for="student_id" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Pilih Siswa Pemohon <span class="text-rose-500">*</span>
                        </label>
                        <select id="student_id" name="student_id" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1B6CF2] focus:border-[#1B6CF2]">
                            <option value="">-- Pilih Siswa --</option>
                            @foreach(\App\Models\Student::orderBy('nama_lengkap')->get() as $st)
                                <option value="{{ $st->id }}" {{ old('student_id') == $st->id ? 'selected' : '' }}>
                                    {{ $st->nama_lengkap }} ({{ $st->nis }} - {{ $st->kelas }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif

                <div>
                    <label for="administration_type_id" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Jenis Layanan Surat <span class="text-rose-500">*</span>
                    </label>
                    <select id="administration_type_id" name="administration_type_id" required onchange="updatePersyaratan(this)"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1B6CF2] focus:border-[#1B6CF2]">
                        <option value="">-- Pilih Jenis Layanan Surat --</option>
                        @foreach($administrationTypes as $type)
                            <option value="{{ $type->id }}"
                                data-hari="{{ $type->estimasi_hari }}"
                                data-syarat="{{ $type->persyaratan }}"
                                data-desc="{{ $type->deskripsi }}"
                                {{ old('administration_type_id') == $type->id ? 'selected' : '' }}>
                                {{ $type->nama_layanan }} (Estimasi: {{ $type->estimasi_hari }} Hari Kerja)
                            </option>
                        @endforeach
                    </select>
                </div>

                <div id="syarat-box" class="p-4 rounded-xl bg-blue-50 border border-blue-200 text-xs text-blue-900 hidden">
                    <span class="font-bold block uppercase text-[10px] tracking-wider mb-1">Persyaratan & Ketentuan Layanan:</span>
                    <p id="syarat-text" class="font-medium leading-relaxed"></p>
                </div>

                <div>
                    <label for="keperluan" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Keperluan / Alasan Pengajuan Surat <span class="text-rose-500">*</span>
                    </label>
                    <textarea id="keperluan" name="keperluan" rows="4" required placeholder="Contoh: Untuk persyaratan pendaftaran beasiswa prestasi / verifikasi administrasi perusahaan magang..."
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl p-4 text-sm font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1B6CF2] focus:border-[#1B6CF2]">{{ old('keperluan') }}</textarea>
                </div>

                <div>
                    <label for="berkas_pendukung" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Unggah Berkas Pendukung (Opsional)
                    </label>
                    <input type="file" id="berkas_pendukung" name="berkas_pendukung" accept=".pdf,.jpg,.jpeg,.png"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl p-2.5 text-sm font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1B6CF2] focus:border-[#1B6CF2]">
                    <span class="text-[10px] text-slate-400 mt-1 block">Format file yang didukung: PDF, JPG, PNG (Maksimal 5 MB).</span>
                </div>

                <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-100">
                    <a href="{{ route('submissions.index') }}" class="px-5 py-2.5 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-100 transition-colors">
                        Batal
                    </a>
                    <button type="submit" class="bg-[#1B6CF2] hover:bg-[#1455C0] text-white px-7 py-2.5 rounded-xl text-sm font-bold shadow-sm transition-all">
                        Kirim Permohonan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function updatePersyaratan(select) {
            const selectedOption = select.options[select.selectedIndex];
            const syarat = selectedOption.getAttribute('data-syarat');
            const desc = selectedOption.getAttribute('data-desc');
            const box = document.getElementById('syarat-box');
            const text = document.getElementById('syarat-text');

            if (syarat) {
                text.textContent = (desc ? desc + ' — ' : '') + syarat;
                box.classList.remove('hidden');
            } else {
                box.classList.add('hidden');
            }
        }
    </script>
</x-layouts.app>
