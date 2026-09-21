<x-layouts.app title="Dasbor Administrator Tata Usaha — SIAKAD Online">
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="inline-block bg-[#EFF6FF] text-[#1B6CF2] border border-[#BFDBFE] text-xs font-bold uppercase px-3 py-1 rounded-full mb-2">
                Dasbor Tata Usaha
            </div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-[#1E293B] tracking-tight">
                Selamat Datang, {{ Auth::user()->name }}
            </h1>
            <p class="text-xs sm:text-sm text-[#64748B] mt-1">
                Pantau seluruh rekapitulasi data siswa dan disposisi permohonan surat administrasi sekolah.
            </p>
        </div>

        <div class="flex flex-wrap gap-2.5">
            <a href="{{ route('students.create') }}" class="bg-[#1B6CF2] hover:bg-[#1455C0] text-white px-4 py-2.5 rounded-xl text-xs font-bold shadow-xs transition-all">
                + Tambah Siswa
            </a>
            <a href="{{ route('administration-types.create') }}" class="bg-white border border-[#E2E8F0] hover:bg-slate-50 text-[#1E293B] px-4 py-2.5 rounded-xl text-xs font-bold shadow-xs transition-all">
                + Tambah Layanan
            </a>
        </div>
    </div>

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="siakad-card p-5">
            <div class="text-xs font-bold text-[#64748B] uppercase tracking-wider">Total Siswa</div>
            <div class="text-3xl font-extrabold text-[#1B6CF2] mt-1">{{ $totalStudents }}</div>
            <div class="text-[11px] text-emerald-600 font-semibold mt-1">{{ $activeStudents }} Siswa Berstatus Aktif</div>
        </div>

        <div class="siakad-card p-5">
            <div class="text-xs font-bold text-[#64748B] uppercase tracking-wider">Menunggu Respon</div>
            <div class="text-3xl font-extrabold text-amber-500 mt-1">{{ $pendingSubmissions }}</div>
            <div class="text-[11px] text-[#64748B] font-medium mt-1">Permohonan belum diverifikasi</div>
        </div>

        <div class="siakad-card p-5">
            <div class="text-xs font-bold text-[#64748B] uppercase tracking-wider">Sedang Diproses</div>
            <div class="text-3xl font-extrabold text-[#0EA5E9] mt-1">{{ $inProcessSubmissions }}</div>
            <div class="text-[11px] text-[#64748B] font-medium mt-1">Dalam tahap verifikasi berkas</div>
        </div>

        <div class="siakad-card p-5">
            <div class="text-xs font-bold text-[#64748B] uppercase tracking-wider">Selesai / Disetujui</div>
            <div class="text-3xl font-extrabold text-emerald-600 mt-1">{{ $approvedSubmissions }}</div>
            <div class="text-[11px] text-[#64748B] font-medium mt-1">Surat telah berhasil diterbitkan</div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <div class="lg:col-span-8">
            <div class="siakad-card p-6">
                <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-100">
                    <h2 class="text-sm font-extrabold text-[#1E293B] uppercase tracking-wider">
                        Pengajuan Surat Terbaru
                    </h2>
                    <a href="{{ route('submissions.index') }}" class="text-xs font-bold text-[#1B6CF2] hover:underline">
                        Lihat Semua ({{ $totalSubmissions }})
                    </a>
                </div>

                @if($latestSubmissions->isEmpty())
                    <div class="text-center py-8 text-xs text-[#64748B]">
                        Belum ada permohonan surat masuk.
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs">
                            <thead>
                                <tr class="border-b border-slate-100 text-[#64748B] font-bold uppercase tracking-wider">
                                    <th class="py-2.5 px-3">No. Pengajuan</th>
                                    <th class="py-2.5 px-3">Siswa</th>
                                    <th class="py-2.5 px-3">Layanan</th>
                                    <th class="py-2.5 px-3">Status</th>
                                    <th class="py-2.5 px-3 text-right">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach($latestSubmissions as $sub)
                                    <tr class="hover:bg-slate-50 transition-colors">
                                        <td class="py-3 px-3 font-bold text-[#1B6CF2]">
                                            {{ $sub->nomor_pengajuan }}
                                        </td>
                                        <td class="py-3 px-3">
                                            <div class="font-bold text-[#1E293B]">{{ $sub->student->nama_lengkap }}</div>
                                            <div class="text-[10px] text-[#64748B]">{{ $sub->student->nis }} • {{ $sub->student->kelas }}</div>
                                        </td>
                                        <td class="py-3 px-3 text-[#334155]">
                                            {{ $sub->administrationType->nama_layanan }}
                                        </td>
                                        <td class="py-3 px-3">
                                            @if($sub->status === 'disetujui')
                                                <span class="bg-emerald-100 text-emerald-800 text-[10px] font-bold uppercase px-2.5 py-0.5 rounded-full">
                                                    Disetujui
                                                </span>
                                            @elseif($sub->status === 'diproses')
                                                <span class="bg-blue-100 text-blue-800 text-[10px] font-bold uppercase px-2.5 py-0.5 rounded-full">
                                                    Diproses
                                                </span>
                                            @elseif($sub->status === 'ditolak')
                                                <span class="bg-rose-100 text-rose-800 text-[10px] font-bold uppercase px-2.5 py-0.5 rounded-full">
                                                    Ditolak
                                                </span>
                                            @else
                                                <span class="bg-amber-100 text-amber-800 text-[10px] font-bold uppercase px-2.5 py-0.5 rounded-full">
                                                    Menunggu
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-3 px-3 text-right">
                                            <a href="{{ route('submissions.show', $sub) }}" class="bg-[#EFF6FF] hover:bg-[#1B6CF2] hover:text-white text-[#1B6CF2] font-bold px-3 py-1 rounded-lg transition-colors text-[11px]">
                                                Detail
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        <div class="lg:col-span-4">
            <div class="siakad-card p-6">
                <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-100">
                    <h2 class="text-sm font-extrabold text-[#1E293B] uppercase tracking-wider">
                        Siswa Terbaru
                    </h2>
                    <a href="{{ route('students.index') }}" class="text-xs font-bold text-[#1B6CF2] hover:underline">
                        Semua Siswa
                    </a>
                </div>

                <div class="space-y-2.5">
                    @foreach($latestStudents as $st)
                        <div class="p-3 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-between">
                            <div>
                                <div class="text-xs font-bold text-[#1E293B]">{{ $st->nama_lengkap }}</div>
                                <div class="text-[10px] text-[#64748B]">{{ $st->nis }} • {{ $st->kelas }} ({{ $st->jurusan }})</div>
                            </div>
                            <a href="{{ route('students.show', $st) }}" class="text-xs font-bold text-[#1B6CF2] hover:underline">
                                Buka
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
