<x-layouts.app title="Dasbor Pimpinan & Approval — SIAKAD Online">
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="inline-block bg-amber-50 text-amber-700 border border-amber-200 text-xs font-bold uppercase px-3 py-1 rounded-full mb-2">
                Portal Verifikator & Pimpinan
            </div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-[#1E293B] tracking-tight">
                {{ Auth::user()->name }}
            </h1>
            <p class="text-xs sm:text-sm text-[#64748B] mt-1">
                Otoritas persetujuan surat keterangan, permohonan PKL, dan pengesahan dokumen kesiswaan.
            </p>
        </div>

        <div>
            <a href="{{ route('approvals.index') }}" class="bg-[#1B6CF2] hover:bg-[#1455C0] text-white px-5 py-2.5 rounded-xl text-xs font-bold shadow-xs transition-all inline-block">
                Buka Antrean Approval ({{ $pendingApprovals }})
            </a>
        </div>
    </div>

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="siakad-card p-5">
            <div class="text-xs font-bold text-[#64748B] uppercase tracking-wider">Perlu Persetujuan</div>
            <div class="text-3xl font-extrabold text-amber-500 mt-1">{{ $pendingApprovals }}</div>
            <div class="text-[11px] text-[#64748B] font-medium mt-1">Status Menunggu atau Diproses</div>
        </div>

        <div class="siakad-card p-5">
            <div class="text-xs font-bold text-[#64748B] uppercase tracking-wider">Telah Disetujui</div>
            <div class="text-3xl font-extrabold text-emerald-600 mt-1">{{ $approvedCount }}</div>
            <div class="text-[11px] text-[#64748B] font-medium mt-1">Surat resmi disahkan</div>
        </div>

        <div class="siakad-card p-5">
            <div class="text-xs font-bold text-[#64748B] uppercase tracking-wider">Permohonan Ditolak</div>
            <div class="text-3xl font-extrabold text-rose-600 mt-1">{{ $rejectedCount }}</div>
            <div class="text-[11px] text-[#64748B] font-medium mt-1">Berkas tidak memenuhi syarat</div>
        </div>

        <div class="siakad-card p-5">
            <div class="text-xs font-bold text-[#64748B] uppercase tracking-wider">Total Masuk</div>
            <div class="text-3xl font-extrabold text-[#1B6CF2] mt-1">{{ $totalSubmissions }}</div>
            <div class="text-[11px] text-[#64748B] font-medium mt-1">Akumulasi seluruh permohonan</div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <div class="lg:col-span-8">
            <div class="siakad-card p-6">
                <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-100">
                    <h2 class="text-sm font-extrabold text-[#1E293B] uppercase tracking-wider">
                        Permohonan Menunggu Verifikasi Anda
                    </h2>
                    <a href="{{ route('approvals.index') }}" class="text-xs font-bold text-[#1B6CF2] hover:underline">
                        Lihat Selengkapnya
                    </a>
                </div>

                @if($submissionsToReview->isEmpty())
                    <div class="text-center py-10 text-xs text-[#64748B]">
                        Tidak ada berkas yang tertunda. Semua permohonan telah selesai ditindaklanjuti.
                    </div>
                @else
                    <div class="space-y-3">
                        @foreach($submissionsToReview as $sub)
                            <div class="p-4 rounded-xl bg-slate-50 border border-slate-100 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                                <div>
                                    <div class="flex items-center gap-2">
                                        <span class="font-bold text-sm text-[#1E293B]">{{ $sub->student->nama_lengkap }}</span>
                                        <span class="text-[10px] font-bold text-[#64748B]">{{ $sub->student->kelas }} ({{ $sub->student->jurusan }})</span>
                                    </div>
                                    <div class="text-xs font-semibold text-[#1B6CF2] mt-0.5">
                                        {{ $sub->administrationType->nama_layanan }}
                                    </div>
                                    <div class="text-[11px] text-[#64748B] mt-1 line-clamp-1">
                                        Keperluan: {{ $sub->keperluan }}
                                    </div>
                                </div>

                                <div class="flex items-center gap-2 w-full sm:w-auto justify-end">
                                    <a href="{{ route('approvals.show', $sub) }}" class="bg-[#1B6CF2] hover:bg-[#1455C0] text-white text-xs font-bold px-4 py-2 rounded-lg transition-colors">
                                        Periksa Berkas
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <div class="lg:col-span-4">
            <div class="siakad-card p-6">
                <h2 class="text-sm font-extrabold text-[#1E293B] uppercase tracking-wider mb-4 pb-3 border-b border-slate-100">
                    Statistik Per Jenis Layanan
                </h2>

                <div class="space-y-2.5">
                    @foreach($statsPerType as $type)
                        <div class="p-3 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-between">
                            <div class="text-xs font-bold text-[#1E293B] max-w-[200px]">
                                {{ $type->nama_layanan }}
                            </div>
                            <span class="bg-[#EFF6FF] text-[#1B6CF2] border border-[#BFDBFE] text-xs font-bold px-2.5 py-0.5 rounded-full">
                                {{ $type->submissions_count }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
