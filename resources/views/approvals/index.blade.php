<x-layouts.app title="Antrean Approval & Verifikasi Surat — SIAKAD Online">
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="inline-block bg-amber-50 text-amber-700 border border-amber-200 text-xs font-bold uppercase px-3 py-1 rounded-full mb-2">
                Otoritas Persetujuan
            </div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-[#1E293B] tracking-tight">
                Verifikasi & Approval Berkas
            </h1>
            <p class="text-xs sm:text-sm text-[#64748B] mt-1">
                Tinjau kelayakan berkas, setujui penerbitan surat, atau tolak permohonan dengan catatan resmi.
            </p>
        </div>
    </div>

    <div class="flex flex-wrap items-center gap-2 mb-6">
        <a href="{{ route('approvals.index', ['status' => 'menunggu']) }}"
            class="px-4 py-2 rounded-xl text-xs font-bold transition-all {{ $statusFilter === 'menunggu' ? 'bg-[#1B6CF2] text-white shadow-xs' : 'bg-white text-[#1E293B] hover:bg-slate-50 border border-[#E2E8F0]' }}">
            Menunggu ({{ $countPending }})
        </a>
        <a href="{{ route('approvals.index', ['status' => 'diproses']) }}"
            class="px-4 py-2 rounded-xl text-xs font-bold transition-all {{ $statusFilter === 'diproses' ? 'bg-[#1B6CF2] text-white shadow-xs' : 'bg-white text-[#1E293B] hover:bg-slate-50 border border-[#E2E8F0]' }}">
            Sedang Diproses ({{ $countProcess }})
        </a>
        <a href="{{ route('approvals.index', ['status' => 'disetujui']) }}"
            class="px-4 py-2 rounded-xl text-xs font-bold transition-all {{ $statusFilter === 'disetujui' ? 'bg-emerald-600 text-white shadow-xs' : 'bg-white text-[#1E293B] hover:bg-slate-50 border border-[#E2E8F0]' }}">
            Disetujui ({{ $countApproved }})
        </a>
        <a href="{{ route('approvals.index', ['status' => 'ditolak']) }}"
            class="px-4 py-2 rounded-xl text-xs font-bold transition-all {{ $statusFilter === 'ditolak' ? 'bg-rose-600 text-white shadow-xs' : 'bg-white text-[#1E293B] hover:bg-slate-50 border border-[#E2E8F0]' }}">
            Ditolak ({{ $countRejected }})
        </a>
        <a href="{{ route('approvals.index', ['status' => 'semua']) }}"
            class="px-4 py-2 rounded-xl text-xs font-bold transition-all {{ $statusFilter === 'semua' ? 'bg-[#0F172A] text-white shadow-xs' : 'bg-white text-[#1E293B] hover:bg-slate-50 border border-[#E2E8F0]' }}">
            Semua
        </a>
    </div>

    <div class="siakad-card p-6">
        @if($submissions->isEmpty())
            <div class="text-center py-12 text-xs text-[#64748B]">
                Tidak ada pengajuan dalam status ini.
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="border-b border-slate-100 text-[#64748B] font-bold uppercase tracking-wider">
                            <th class="py-3 px-3">No. Pengajuan</th>
                            <th class="py-3 px-3">Siswa Pemohon</th>
                            <th class="py-3 px-3">Jenis Permohonan</th>
                            <th class="py-3 px-3">Tanggal</th>
                            <th class="py-3 px-3">Status Saat Ini</th>
                            <th class="py-3 px-3 text-right">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($submissions as $sub)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="py-3 px-3 font-bold text-[#1B6CF2]">
                                    {{ $sub->nomor_pengajuan }}
                                </td>
                                <td class="py-3 px-3">
                                    <div class="font-bold text-[#1E293B]">{{ $sub->student->nama_lengkap }}</div>
                                    <div class="text-[10px] text-[#64748B]">{{ $sub->student->nis }} • {{ $sub->student->kelas }} ({{ $sub->student->jurusan }})</div>
                                </td>
                                <td class="py-3 px-3">
                                    <div class="font-semibold text-[#334155]">{{ $sub->administrationType->nama_layanan }}</div>
                                </td>
                                <td class="py-3 px-3 text-[#64748B]">
                                    {{ $sub->tanggal_pengajuan->format('d M Y') }}
                                </td>
                                <td class="py-3 px-3">
                                    @if($sub->status === 'disetujui')
                                        <span class="bg-emerald-100 text-emerald-800 text-[10px] font-bold uppercase px-2.5 py-0.5 rounded-full">Disetujui</span>
                                    @elseif($sub->status === 'diproses')
                                        <span class="bg-blue-100 text-blue-800 text-[10px] font-bold uppercase px-2.5 py-0.5 rounded-full">Diproses</span>
                                    @elseif($sub->status === 'ditolak')
                                        <span class="bg-rose-100 text-rose-800 text-[10px] font-bold uppercase px-2.5 py-0.5 rounded-full">Ditolak</span>
                                    @else
                                        <span class="bg-amber-100 text-amber-800 text-[10px] font-bold uppercase px-2.5 py-0.5 rounded-full">Menunggu</span>
                                    @endif
                                </td>
                                <td class="py-3 px-3 text-right">
                                    <a href="{{ route('approvals.show', $sub) }}" class="bg-[#1B6CF2] hover:bg-[#1455C0] text-white font-bold px-3.5 py-1.5 rounded-lg text-[11px] transition-colors inline-block">
                                        Periksa Berkas
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $submissions->links() }}
            </div>
        @endif
    </div>
</x-layouts.app>
