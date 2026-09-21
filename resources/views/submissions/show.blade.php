<x-layouts.app title="Detail Pengajuan — {{ $submission->nomor_pengajuan }}">
    <div class="max-w-4xl mx-auto">
        <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <a href="{{ route('submissions.index') }}" class="text-xs font-bold text-[#1B6CF2] hover:underline uppercase tracking-wider block mb-2">
                    Kembali ke Antrean Pengajuan
                </a>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-[#0F172A] tracking-tight">
                    {{ $submission->nomor_pengajuan }}
                </h1>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">
                    Detail berkas permohonan administrasi siswa dan linimasa proses verifikasi.
                </p>
            </div>

            <div class="flex items-center gap-2">
                @if((Auth::user()->isApprover() || Auth::user()->isAdmin()))
                    <a href="{{ route('approvals.show', $submission) }}" class="bg-[#1B6CF2] hover:bg-[#1455C0] text-white px-5 py-2.5 rounded-xl text-xs font-bold shadow-sm transition-all">
                        Tindaklanjuti Approval
                    </a>
                @endif

                @if($submission->status === 'menunggu' && (Auth::user()->isAdmin() || Auth::user()->id === $submission->user_id))
                    <form method="POST" action="{{ route('submissions.destroy', $submission) }}" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pengajuan ini?');" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-rose-50 hover:bg-rose-600 hover:text-white text-rose-700 px-5 py-2.5 rounded-xl text-xs font-bold transition-all">
                            Batalkan Pengajuan
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <div class="siakad-card bg-white rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-sm mb-8">
            <div class="flex flex-wrap items-center justify-between gap-4 pb-6 border-b border-slate-100">
                <div>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Jenis Layanan Surat</span>
                    <span class="text-xl font-extrabold text-[#0F172A]">{{ $submission->administrationType->nama_layanan }}</span>
                    <span class="text-xs text-slate-500 block mt-0.5">Estimasi Pengerjaan: {{ $submission->administrationType->estimasi_hari }} Hari Kerja</span>
                </div>

                <div>
                    @if($submission->status === 'disetujui')
                        <span class="bg-emerald-50 text-emerald-700 border border-emerald-200 text-xs font-bold uppercase px-4 py-1.5 rounded-full">
                            Disetujui
                        </span>
                    @elseif($submission->status === 'diproses')
                        <span class="bg-blue-50 text-blue-700 border border-blue-200 text-xs font-bold uppercase px-4 py-1.5 rounded-full">
                            Sedang Diproses
                        </span>
                    @elseif($submission->status === 'ditolak')
                        <span class="bg-rose-50 text-rose-700 border border-rose-200 text-xs font-bold uppercase px-4 py-1.5 rounded-full">
                            Ditolak
                        </span>
                    @else
                        <span class="bg-amber-50 text-amber-700 border border-amber-200 text-xs font-bold uppercase px-4 py-1.5 rounded-full">
                            Menunggu Verifikasi
                        </span>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 py-6 border-b border-slate-100 text-xs">
                <div>
                    <span class="text-slate-400 font-bold block uppercase text-[10px] tracking-wider mb-1">Identitas Siswa Pemohon</span>
                    <span class="font-bold text-sm text-[#0F172A] block">{{ $submission->student->nama_lengkap }}</span>
                    <span class="text-slate-600 block mt-0.5">NIS: {{ $submission->student->nis }} • NISN: {{ $submission->student->nisn }}</span>
                    <span class="text-slate-600 block">Kelas {{ $submission->student->kelas }} ({{ $submission->student->jurusan }})</span>
                </div>

                <div>
                    <span class="text-slate-400 font-bold block uppercase text-[10px] tracking-wider mb-1">Waktu Pengajuan & Penyelesaian</span>
                    <span class="text-slate-700 block">Diajukan Pada: <strong>{{ $submission->tanggal_pengajuan->format('d F Y') }}</strong></span>
                    <span class="text-slate-700 block mt-1">
                        Selesai Pada: <strong>{{ $submission->tanggal_selesai ? $submission->tanggal_selesai->format('d F Y H:i') : 'Menunggu Penyelesaian' }}</strong>
                    </span>
                    <span class="text-slate-700 block mt-1">Diajukan Oleh Akun: {{ $submission->user->name }} ({{ $submission->user->email }})</span>
                </div>
            </div>

            <div class="py-6 border-b border-slate-100">
                <span class="text-slate-400 font-bold block uppercase text-[10px] tracking-wider mb-1">Keperluan Pengajuan</span>
                <div class="bg-slate-50 border border-slate-200 p-4 rounded-xl text-xs text-[#0F172A] font-medium leading-relaxed">
                    {{ $submission->keperluan }}
                </div>
            </div>

            @if($submission->berkas_pendukung)
                <div class="py-6 border-b border-slate-100 flex items-center justify-between text-xs">
                    <div>
                        <span class="text-slate-400 font-bold block uppercase text-[10px] tracking-wider">Lampiran Berkas Pendukung</span>
                        <span class="font-semibold text-slate-700">Tersedia Berkas Lampiran Terverifikasi</span>
                    </div>
                    <a href="{{ asset('storage/'.$submission->berkas_pendukung) }}" target="_blank" class="bg-[#1B6CF2] hover:bg-[#1455C0] text-white px-4 py-2 rounded-xl text-xs font-bold transition-colors">
                        Buka Dokumen
                    </a>
                </div>
            @endif

            @if($submission->catatan_petugas)
                <div class="py-6 border-b border-slate-100">
                    <span class="text-[#1B6CF2] font-bold block uppercase text-[10px] tracking-wider mb-1">Catatan Resmi Petugas / Approver</span>
                    <div class="bg-blue-50 border border-blue-200 p-4 rounded-xl text-xs text-blue-900 font-semibold leading-relaxed">
                        {{ $submission->catatan_petugas }}
                    </div>
                </div>
            @endif

            <div class="pt-6">
                <h3 class="text-xs font-bold text-[#0F172A] uppercase tracking-wider mb-4">
                    Jejak Audit & Riwayat Perubahan Status (Audit Trail)
                </h3>

                <div class="space-y-4">
                    @foreach($submission->statusLogs as $log)
                        <div class="flex items-start gap-3 text-xs">
                            <div class="w-2.5 h-2.5 rounded-full bg-[#1B6CF2] mt-1.5 flex-shrink-0"></div>
                            <div class="flex-1 bg-slate-50 p-3.5 rounded-xl border border-slate-200">
                                <div class="flex flex-wrap items-center justify-between gap-2 mb-1">
                                    <span class="font-bold text-[#0F172A]">
                                        Status Berubah Menjadi: <span class="uppercase text-[#1B6CF2] font-extrabold">{{ $log->status_baru }}</span>
                                    </span>
                                    <span class="text-[10px] text-slate-400">
                                        {{ $log->created_at->format('d M Y H:i:s') }}
                                    </span>
                                </div>
                                <div class="text-slate-600">
                                    {{ $log->catatan }}
                                </div>
                                @if($log->user)
                                    <div class="text-[10px] text-slate-400 mt-1">
                                        Tindakan Oleh: {{ $log->user->name }} ({{ strtoupper($log->user->role) }})
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
