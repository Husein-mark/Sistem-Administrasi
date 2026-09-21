<x-layouts.guest title="Lacak Pengajuan Surat — SIAKAD Online">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 py-10 sm:py-16">
        <div class="text-center mb-8">
            <div class="inline-block bg-[#EFF6FF] text-[#1B6CF2] border border-[#BFDBFE] text-xs font-bold uppercase px-3 py-1 rounded-full mb-3">
                Penelusuran Status Berkas
            </div>
            <h1 class="text-2xl sm:text-4xl font-extrabold text-[#1E293B] tracking-tight">
                Lacak Pengajuan Administrasi
            </h1>
            <p class="text-xs sm:text-sm text-[#64748B] mt-2 max-w-xl mx-auto">
                Masukkan nomor registrasi pengajuan surat Anda untuk memantau proses verifikasi secara langsung.
            </p>
        </div>

        <div class="siakad-card p-6 sm:p-8 mb-8">
            <form method="GET" action="{{ route('public.tracking') }}" class="flex flex-col sm:flex-row gap-3">
                <input type="text" name="kode" value="{{ request('kode') }}" required placeholder="Contoh: ADM-20260918-A1091"
                    class="flex-1 bg-slate-50 border border-[#E2E8F0] rounded-xl px-4 py-3 text-sm font-bold uppercase text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-[#1B6CF2] focus:bg-white">
                <button type="submit" class="bg-[#1B6CF2] hover:bg-[#1455C0] text-white px-8 py-3 rounded-xl text-sm font-bold shadow-xs transition-all">
                    Lacak Berkas
                </button>
            </form>
        </div>

        @if($searched)
            @if($submission)
                <div class="siakad-card p-6 sm:p-8 mb-8">
                    <div class="flex flex-wrap items-center justify-between gap-4 pb-6 border-b border-slate-100">
                        <div>
                            <span class="text-xs font-bold text-[#64748B] uppercase tracking-wider block">Nomor Pengajuan</span>
                            <span class="text-xl font-extrabold text-[#1B6CF2]">{{ $submission->nomor_pengajuan }}</span>
                        </div>
                        <div>
                            @if($submission->status === 'disetujui')
                                <span class="bg-emerald-500 text-white text-xs font-bold uppercase px-4 py-1.5 rounded-full shadow-xs">
                                    Disetujui
                                </span>
                            @elseif($submission->status === 'diproses')
                                <span class="bg-[#0EA5E9] text-white text-xs font-bold uppercase px-4 py-1.5 rounded-full shadow-xs">
                                    Sedang Diproses
                                </span>
                            @elseif($submission->status === 'ditolak')
                                <span class="bg-rose-500 text-white text-xs font-bold uppercase px-4 py-1.5 rounded-full shadow-xs">
                                    Ditolak
                                </span>
                            @else
                                <span class="bg-amber-500 text-white text-xs font-bold uppercase px-4 py-1.5 rounded-full shadow-xs">
                                    Menunggu Verifikasi
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 py-6 border-b border-slate-100 text-xs">
                        <div>
                            <span class="text-[#64748B] block mb-1">Nama Pemohon / Siswa</span>
                            <span class="font-bold text-sm text-[#1E293B]">{{ $submission->student->nama_lengkap }} ({{ $submission->student->nis }})</span>
                            <span class="text-[#64748B] block mt-0.5">{{ $submission->student->kelas }} — {{ $submission->student->jurusan }}</span>
                        </div>
                        <div>
                            <span class="text-[#64748B] block mb-1">Layanan yang Diajukan</span>
                            <span class="font-bold text-sm text-[#1E293B]">{{ $submission->administrationType->nama_layanan }}</span>
                            <span class="text-[#64748B] block mt-0.5">Estimasi Layanan: {{ $submission->administrationType->estimasi_hari }} Hari Kerja</span>
                        </div>
                        <div>
                            <span class="text-[#64748B] block mb-1">Tanggal Diajukan</span>
                            <span class="font-semibold text-[#1E293B]">{{ $submission->tanggal_pengajuan->format('d F Y') }}</span>
                        </div>
                        <div>
                            <span class="text-[#64748B] block mb-1">Tanggal Selesai / Ditindaklanjuti</span>
                            <span class="font-semibold text-[#1E293B]">{{ $submission->tanggal_selesai ? $submission->tanggal_selesai->format('d F Y H:i') : 'Dalam Proses' }}</span>
                        </div>
                    </div>

                    <div class="py-4 border-b border-slate-100">
                        <span class="text-xs text-[#64748B] block mb-1">Keperluan Pengajuan</span>
                        <p class="text-xs text-[#1E293B] bg-slate-50 p-3.5 rounded-xl font-medium border border-slate-100">
                            {{ $submission->keperluan }}
                        </p>
                    </div>

                    @if($submission->catatan_petugas)
                        <div class="py-4 border-b border-slate-100">
                            <span class="text-xs font-bold text-[#1B6CF2] block mb-1">Catatan Resmi Petugas / Approver</span>
                            <div class="text-xs text-amber-900 bg-amber-50 border border-amber-200 p-3.5 rounded-xl font-semibold">
                                {{ $submission->catatan_petugas }}
                            </div>
                        </div>
                    @endif

                    <div class="pt-6">
                        <h3 class="text-sm font-extrabold text-[#1E293B] uppercase tracking-wider mb-4">
                            Riwayat Penelusuran Berkas (Audit Trail)
                        </h3>

                        <div class="space-y-3">
                            @foreach($submission->statusLogs as $log)
                                <div class="flex items-start gap-3.5 text-xs">
                                    <div class="w-2.5 h-2.5 rounded-full bg-[#1B6CF2] mt-1.5 flex-shrink-0"></div>
                                    <div class="flex-1 bg-slate-50 p-3.5 rounded-xl border border-slate-100">
                                        <div class="flex flex-wrap items-center justify-between gap-2 mb-1">
                                            <span class="font-bold text-[#1E293B]">
                                                Status: <span class="uppercase text-[#1B6CF2]">{{ $log->status_baru }}</span>
                                            </span>
                                            <span class="text-[10px] text-[#94A3B8]">
                                                {{ $log->created_at->format('d M Y H:i') }}
                                            </span>
                                        </div>
                                        <div class="text-[#64748B]">
                                            {{ $log->catatan }}
                                        </div>
                                        @if($log->user)
                                            <div class="text-[10px] text-[#94A3B8] mt-1">
                                                Oleh: {{ $log->user->name }} ({{ strtoupper($log->user->role) }})
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @else
                <div class="siakad-card p-10 text-center">
                    <span class="bg-rose-100 text-rose-800 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider inline-block mb-3">
                        Tidak Ditemukan
                    </span>
                    <h3 class="text-lg font-bold text-[#1E293B]">Pengajuan dengan nomor registrasi tersebut tidak ditemukan</h3>
                    <p class="text-xs text-[#64748B] mt-1">
                        Pastikan Anda memasukkan kode pengajuan yang tepat sesuai tanda bukti permohonan.
                    </p>
                </div>
            @endif
        @endif
    </div>
</x-layouts.guest>
