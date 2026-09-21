<x-layouts.app title="Daftar Pengajuan Administrasi — SIAKAD Online">
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="inline-block bg-[#EFF6FF] text-[#1B6CF2] border border-[#BFDBFE] text-xs font-bold uppercase px-3 py-1 rounded-full mb-2">
                Tata Kelola Dokumen
            </div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-[#1E293B] tracking-tight">
                {{ Auth::user()->isStudent() ? 'Pengajuan Saya' : 'Semua Permohonan Administrasi' }}
            </h1>
            <p class="text-xs sm:text-sm text-[#64748B] mt-1">
                Monitoring status dan penelusuran seluruh permohonan surat sekolah secara realtime.
            </p>
        </div>

        @if(Auth::user()->isStudent() || Auth::user()->isAdmin())
            <div>
                <a href="{{ route('submissions.create') }}" class="bg-[#1B6CF2] hover:bg-[#1455C0] text-white px-5 py-2.5 rounded-xl text-xs font-bold shadow-xs transition-all inline-block">
                    + Buat Pengajuan Baru
                </a>
            </div>
        @endif
    </div>

    <div class="siakad-card p-5 sm:p-6 mb-6">
        <form method="GET" action="{{ route('submissions.index') }}" class="grid grid-cols-1 sm:grid-cols-12 gap-3">
            <div class="sm:col-span-5">
                <label for="q" class="block text-[11px] font-bold text-[#64748B] uppercase tracking-wider mb-1">
                    Cari Kata Kunci
                </label>
                <input type="text" id="q" name="q" value="{{ request('q') }}" placeholder="Cari nomor pengajuan, nama siswa, atau keperluan..."
                    class="w-full bg-slate-50 border border-[#E2E8F0] rounded-xl px-3.5 py-2 text-xs font-medium text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-[#1B6CF2] focus:bg-white">
            </div>

            <div class="sm:col-span-3">
                <label for="administration_type_id" class="block text-[11px] font-bold text-[#64748B] uppercase tracking-wider mb-1">
                    Jenis Layanan
                </label>
                <select id="administration_type_id" name="administration_type_id" class="w-full bg-slate-50 border border-[#E2E8F0] rounded-xl px-3.5 py-2 text-xs font-medium text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-[#1B6CF2] focus:bg-white">
                    <option value="">Semua Layanan</option>
                    @foreach($administrationTypes as $type)
                        <option value="{{ $type->id }}" {{ request('administration_type_id') == $type->id ? 'selected' : '' }}>
                            {{ $type->nama_layanan }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="sm:col-span-2">
                <label for="status" class="block text-[11px] font-bold text-[#64748B] uppercase tracking-wider mb-1">
                    Status
                </label>
                <select id="status" name="status" class="w-full bg-slate-50 border border-[#E2E8F0] rounded-xl px-3.5 py-2 text-xs font-medium text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-[#1B6CF2] focus:bg-white">
                    <option value="">Semua Status</option>
                    <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                    <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                    <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                    <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>

            <div class="sm:col-span-2 flex items-end">
                <button type="submit" class="w-full bg-[#1B6CF2] hover:bg-[#1455C0] text-white py-2 px-4 rounded-xl text-xs font-bold shadow-xs transition-all">
                    Saring Data
                </button>
            </div>
        </form>

        @if(request('q') || request('administration_type_id') || request('status'))
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                <span class="text-[#64748B]">
                    Hasil saringan: <strong>{{ $submissions->total() }}</strong> pengajuan ditemukan
                </span>
                <a href="{{ route('submissions.index') }}" class="text-[#1B6CF2] font-bold hover:underline">
                    Reset Filter
                </a>
            </div>
        @endif
    </div>

    <div class="siakad-card p-6">
        @if($submissions->isEmpty())
            <div class="text-center py-12 text-xs text-[#64748B]">
                Tidak ada data pengajuan yang sesuai dengan kriteria.
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="border-b border-slate-100 text-[#64748B] font-bold uppercase tracking-wider">
                            <th class="py-3 px-3">No. Pengajuan</th>
                            <th class="py-3 px-3">Siswa Pemohon</th>
                            <th class="py-3 px-3">Layanan Surat</th>
                            <th class="py-3 px-3">Tgl Diajukan</th>
                            <th class="py-3 px-3">Status</th>
                            <th class="py-3 px-3 text-right">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($submissions as $sub)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="py-3 px-3">
                                    <div class="font-bold text-[#1B6CF2]">{{ $sub->nomor_pengajuan }}</div>
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
                                    <div class="inline-flex items-center gap-1.5">
                                        <a href="{{ route('submissions.show', $sub) }}" class="bg-slate-100 hover:bg-[#1B6CF2] hover:text-white text-[#1E293B] font-bold px-3 py-1 rounded-lg text-[11px] transition-colors">
                                            Detail
                                        </a>

                                        @if(Auth::user()->isApprover() || Auth::user()->isAdmin())
                                            <a href="{{ route('approvals.show', $sub) }}" class="bg-[#EFF6FF] hover:bg-[#1B6CF2] hover:text-white text-[#1B6CF2] font-bold px-3 py-1 rounded-lg text-[11px] transition-colors border border-[#BFDBFE]">
                                                Approval
                                            </a>
                                        @endif

                                        @if($sub->status === 'menunggu' && (Auth::user()->isAdmin() || Auth::user()->id === $sub->user_id))
                                            <form method="POST" action="{{ route('submissions.destroy', $sub) }}" onsubmit="return confirm('Batalkan pengajuan ini?');" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-rose-50 hover:bg-rose-600 hover:text-white text-rose-700 font-bold px-3 py-1 rounded-lg text-[11px] transition-colors border border-rose-200">
                                                    Batal
                                                </button>
                                            </form>
                                        @endif
                                    </div>
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
