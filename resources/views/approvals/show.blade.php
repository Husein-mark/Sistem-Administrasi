<x-layouts.app title="Tindak Lanjut Approval — {{ $submission->nomor_pengajuan }}">
    <div class="max-w-4xl mx-auto">
        <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <a href="{{ route('approvals.index') }}" class="text-xs font-bold text-[#1B6CF2] hover:underline uppercase tracking-wider block mb-2">
                    Kembali ke Antrean Approval
                </a>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-[#0F172A] tracking-tight">
                    Pemeriksaan & Tindak Lanjut Berkas
                </h1>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">
                    Verifikasi kelayakan berkas persyaratan dan putuskan persetujuan administrasi.
                </p>
            </div>

            <div class="text-xs font-bold text-slate-500">
                Nomor: <span class="text-[#0F172A] font-extrabold text-sm">{{ $submission->nomor_pengajuan }}</span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 mb-8">
            <div class="md:col-span-7 space-y-6">
                <div class="siakad-card bg-white rounded-2xl p-6 border border-slate-200 shadow-sm">
                    <h2 class="text-sm font-bold text-[#0F172A] uppercase tracking-wider mb-4 pb-2 border-b border-slate-100">
                        Informasi Pemohon & Layanan
                    </h2>

                    <div class="space-y-3.5 text-xs">
                        <div class="flex justify-between py-1 border-b border-slate-50">
                            <span class="text-slate-400 font-bold uppercase text-[10px] tracking-wider">Nama Siswa</span>
                            <span class="font-bold text-[#0F172A] text-sm">{{ $submission->student->nama_lengkap }}</span>
                        </div>

                        <div class="flex justify-between py-1 border-b border-slate-50">
                            <span class="text-slate-400 font-bold uppercase text-[10px] tracking-wider">NIS / NISN</span>
                            <span class="font-semibold text-slate-700">{{ $submission->student->nis }} / {{ $submission->student->nisn }}</span>
                        </div>

                        <div class="flex justify-between py-1 border-b border-slate-50">
                            <span class="text-slate-400 font-bold uppercase text-[10px] tracking-wider">Kelas & Jurusan</span>
                            <span class="font-bold text-[#1B6CF2]">{{ $submission->student->kelas }} ({{ $submission->student->jurusan }})</span>
                        </div>

                        <div class="flex justify-between py-1 border-b border-slate-50">
                            <span class="text-slate-400 font-bold uppercase text-[10px] tracking-wider">Layanan Diminta</span>
                            <span class="font-bold text-slate-800">{{ $submission->administrationType->nama_layanan }}</span>
                        </div>

                        <div class="flex justify-between py-1 border-b border-slate-50">
                            <span class="text-slate-400 font-bold uppercase text-[10px] tracking-wider">Tanggal Pengajuan</span>
                            <span class="font-semibold text-slate-700">{{ $submission->tanggal_pengajuan->format('d F Y') }}</span>
                        </div>

                        <div class="flex justify-between py-1 border-b border-slate-50">
                            <span class="text-slate-400 font-bold uppercase text-[10px] tracking-wider">Status Saat Ini</span>
                            <span class="font-bold uppercase
                                @if($submission->status === 'disetujui') text-emerald-600
                                @elseif($submission->status === 'diproses') text-blue-600
                                @elseif($submission->status === 'ditolak') text-rose-600
                                @else text-amber-600 @endif">
                                {{ $submission->status }}
                            </span>
                        </div>
                    </div>

                    <div class="mt-4 pt-4 border-t border-slate-100">
                        <span class="text-slate-400 font-bold block uppercase text-[10px] tracking-wider mb-1">Keperluan Pemohon</span>
                        <div class="bg-slate-50 border border-slate-200 p-3.5 rounded-xl text-xs text-[#0F172A] font-medium leading-relaxed">
                            {{ $submission->keperluan }}
                        </div>
                    </div>

                    @if($submission->berkas_pendukung)
                        <div class="mt-4 pt-4 border-t border-slate-100 flex items-center justify-between">
                            <span class="text-xs font-bold text-slate-500">Berkas Lampiran Pemohon</span>
                            <a href="{{ asset('storage/'.$submission->berkas_pendukung) }}" target="_blank" class="bg-[#1B6CF2] hover:bg-[#1455C0] text-white px-4 py-2 rounded-xl text-xs font-bold transition-colors">
                                Lihat Lampiran
                            </a>
                        </div>
                    @endif
                </div>

                <div class="siakad-card bg-white rounded-2xl p-6 border border-slate-200 shadow-sm">
                    <h3 class="text-xs font-bold text-[#0F172A] uppercase tracking-wider mb-4 pb-2 border-b border-slate-100">
                        Riwayat Verifikasi Dokumen
                    </h3>

                    <div class="space-y-3">
                        @foreach($submission->statusLogs as $log)
                            <div class="p-3.5 bg-slate-50 rounded-xl border border-slate-200 text-xs">
                                <div class="flex justify-between items-center mb-1">
                                    <span class="font-bold uppercase text-[#1B6CF2]">{{ $log->status_baru }}</span>
                                    <span class="text-[10px] text-slate-400">{{ $log->created_at->format('d M Y H:i') }}</span>
                                </div>
                                <div class="text-slate-600">{{ $log->catatan }}</div>
                                @if($log->user)
                                    <div class="text-[10px] text-slate-400 mt-1">Oleh: {{ $log->user->name }}</div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="md:col-span-5">
                <div class="siakad-card bg-white rounded-2xl p-6 sm:p-7 border border-slate-200 shadow-sm sticky top-24">
                    <div class="inline-block bg-blue-50 text-[#1B6CF2] border border-blue-200 text-[10px] font-bold uppercase px-3 py-1 rounded-md mb-3">
                        Formulir Keputusan
                    </div>
                    <h2 class="text-lg font-bold text-[#0F172A] mb-1">
                        Tentukan Status Pengajuan
                    </h2>
                    <p class="text-xs text-slate-500 mb-6">
                        Pilih keputusan verifikasi dan sertakan catatan resmi untuk pemohon.
                    </p>

                    <form method="POST" action="{{ route('approvals.update', $submission) }}" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="status" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Keputusan Status <span class="text-rose-500">*</span>
                            </label>
                            <select id="status" name="status" required
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs font-bold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1B6CF2] focus:border-[#1B6CF2]">
                                <option value="diproses" {{ old('status', $submission->status) == 'diproses' ? 'selected' : '' }}>
                                    Sedang Diproses (Diverifikasi Bagian Terkait)
                                </option>
                                <option value="disetujui" {{ old('status', $submission->status) == 'disetujui' ? 'selected' : '' }}>
                                    Disetujui (Terbitkan Surat & Tanda Tangan)
                                </option>
                                <option value="ditolak" {{ old('status', $submission->status) == 'ditolak' ? 'selected' : '' }}>
                                    Ditolak (Tidak Memenuhi Syarat)
                                </option>
                                <option value="menunggu" {{ old('status', $submission->status) == 'menunggu' ? 'selected' : '' }}>
                                    Kembalikan ke Menunggu
                                </option>
                            </select>
                        </div>

                        <div>
                            <label for="catatan_petugas" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Catatan / Instruksi Tindak Lanjut
                            </label>
                            <textarea id="catatan_petugas" name="catatan_petugas" rows="4" placeholder="Contoh: Berkas telah diverifikasi lengkap. Surat dapat diambil di Ruang TU mulai besok jam 09.00 WIB."
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3 text-xs font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1B6CF2] focus:border-[#1B6CF2]">{{ old('catatan_petugas', $submission->catatan_petugas) }}</textarea>
                        </div>

                        <button type="submit" class="w-full bg-[#1B6CF2] hover:bg-[#1455C0] text-white py-3 px-6 rounded-xl font-bold text-sm shadow-sm transition-all">
                            Simpan Keputusan Approval
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
