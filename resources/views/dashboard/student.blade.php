<x-layouts.app title="Dasbor Siswa — SIAKAD Online">
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="inline-block bg-emerald-50 text-emerald-700 border border-emerald-200 text-xs font-bold uppercase px-3 py-1 rounded-full mb-2">
                Portal Pemohon Siswa
            </div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-[#1E293B] tracking-tight">
                Halo, {{ Auth::user()->name }}
            </h1>
            <p class="text-xs sm:text-sm text-[#64748B] mt-1">
                @if($student)
                    NIS: {{ $student->nis }} • {{ $student->kelas }} (Jurusan {{ $student->jurusan }})
                @else
                    Akun Siswa Aktif
                @endif
            </p>
        </div>

        <div>
            <a href="{{ route('submissions.create') }}" class="bg-[#1B6CF2] hover:bg-[#1455C0] text-white px-5 py-2.5 rounded-xl text-xs font-bold shadow-xs transition-all inline-block">
                + Buat Pengajuan Surat
            </a>
        </div>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-8">
        <div class="siakad-card p-5">
            <div class="text-xs font-bold text-[#64748B] uppercase tracking-wider">Total Diajukan</div>
            <div class="text-3xl font-extrabold text-[#1B6CF2] mt-1">{{ $totalSubmissions }}</div>
            <div class="text-[11px] text-[#64748B] font-medium mt-1">Seluruh riwayat permohonan</div>
        </div>

        <div class="siakad-card p-5">
            <div class="text-xs font-bold text-[#64748B] uppercase tracking-wider">Menunggu</div>
            <div class="text-3xl font-extrabold text-amber-500 mt-1">{{ $pendingSubmissions }}</div>
            <div class="text-[11px] text-[#64748B] font-medium mt-1">Menunggu pemeriksaan TU</div>
        </div>

        <div class="siakad-card p-5">
            <div class="text-xs font-bold text-[#64748B] uppercase tracking-wider">Diproses</div>
            <div class="text-3xl font-extrabold text-[#0EA5E9] mt-1">{{ $inProcessSubmissions }}</div>
            <div class="text-[11px] text-[#64748B] font-medium mt-1">Dalam proses verifikasi</div>
        </div>

        <div class="siakad-card p-5">
            <div class="text-xs font-bold text-[#64748B] uppercase tracking-wider">Disetujui</div>
            <div class="text-3xl font-extrabold text-emerald-600 mt-1">{{ $approvedSubmissions }}</div>
            <div class="text-[11px] text-[#64748B] font-medium mt-1">Siap diambil di Tata Usaha</div>
        </div>
    </div>

    <div class="siakad-card p-6 sm:p-8">
        <div class="flex items-center justify-between mb-6 pb-4 border-b border-slate-100">
            <div>
                <h2 class="text-base font-extrabold text-[#1E293B]">
                    Riwayat Pengajuan Terkini
                </h2>
                <p class="text-xs text-[#64748B]">Pantau proses persetujuan berkas Anda</p>
            </div>
            <a href="{{ route('submissions.index') }}" class="text-xs font-bold text-[#1B6CF2] hover:underline">
                Lihat Semua Pengajuan
            </a>
        </div>

        @if($mySubmissions->isEmpty())
            <div class="text-center py-12">
                <span class="bg-slate-100 text-[#64748B] text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider inline-block mb-3">
                    Belum Ada Pengajuan
                </span>
                <h3 class="text-base font-bold text-[#1E293B]">Anda belum pernah mengajukan surat administrasi</h3>
                <p class="text-xs text-[#64748B] mt-1 mb-6">
                    Mulai ajukan Surat Keterangan Aktif, Pengantar PKL, atau Legalisir secara online.
                </p>
                <a href="{{ route('submissions.create') }}" class="bg-[#1B6CF2] hover:bg-[#1455C0] text-white px-6 py-2.5 rounded-xl text-xs font-bold transition-colors">
                    Ajukan Sekarang
                </a>
            </div>
        @else
            <div class="space-y-3">
                @foreach($mySubmissions as $sub)
                    <div class="p-4 rounded-xl border border-slate-100 bg-slate-50 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-sm text-[#1E293B]">{{ $sub->administrationType->nama_layanan }}</span>
                                <span class="text-[10px] font-semibold text-[#64748B]">({{ $sub->nomor_pengajuan }})</span>
                            </div>
                            <div class="text-xs text-[#64748B] mt-1 line-clamp-1">
                                Keperluan: {{ $sub->keperluan }}
                            </div>
                            <div class="text-[10px] text-[#94A3B8] mt-1">
                                Tanggal: {{ $sub->tanggal_pengajuan->format('d F Y') }}
                            </div>
                        </div>

                        <div class="flex items-center gap-3 w-full sm:w-auto justify-between sm:justify-end">
                            <div>
                                @if($sub->status === 'disetujui')
                                    <span class="bg-emerald-100 text-emerald-800 text-xs font-bold uppercase px-3 py-1 rounded-full">
                                        Disetujui
                                    </span>
                                @elseif($sub->status === 'diproses')
                                    <span class="bg-blue-100 text-blue-800 text-xs font-bold uppercase px-3 py-1 rounded-full">
                                        Diproses
                                    </span>
                                @elseif($sub->status === 'ditolak')
                                    <span class="bg-rose-100 text-rose-800 text-xs font-bold uppercase px-3 py-1 rounded-full">
                                        Ditolak
                                    </span>
                                @else
                                    <span class="bg-amber-100 text-amber-800 text-xs font-bold uppercase px-3 py-1 rounded-full">
                                        Menunggu
                                    </span>
                                @endif
                            </div>

                            <a href="{{ route('submissions.show', $sub) }}" class="bg-white border border-[#E2E8F0] hover:bg-slate-100 text-[#1E293B] font-bold text-xs px-4 py-2 rounded-lg transition-colors">
                                Detail
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-layouts.app>
