<x-layouts.app title="Kelola Data Siswa — SIAKAD Online">
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="inline-block bg-[#EFF6FF] text-[#1B6CF2] border border-[#BFDBFE] text-xs font-bold uppercase px-3 py-1 rounded-full mb-2">
                Master Siswa
            </div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-[#1E293B] tracking-tight">
                Data Pokok Siswa
            </h1>
            <p class="text-xs sm:text-sm text-[#64748B] mt-1">
                Pencarian, penyaringan jurusan, serta pemutakhiran rekam data siswa di sistem administrasi.
            </p>
        </div>

        <div>
            <a href="{{ route('students.create') }}" class="bg-[#1B6CF2] hover:bg-[#1455C0] text-white px-5 py-2.5 rounded-xl text-xs font-bold shadow-xs transition-all inline-block">
                + Tambah Siswa Baru
            </a>
        </div>
    </div>

    <div class="siakad-card p-5 sm:p-6 mb-6">
        <form method="GET" action="{{ route('students.index') }}" class="grid grid-cols-1 sm:grid-cols-12 gap-3">
            <div class="sm:col-span-5">
                <label for="q" class="block text-[11px] font-bold text-[#64748B] uppercase tracking-wider mb-1">
                    Cari Kata Kunci
                </label>
                <input type="text" id="q" name="q" value="{{ request('q') }}" placeholder="Cari nama, NIS, NISN, atau kelas..."
                    class="w-full bg-slate-50 border border-[#E2E8F0] rounded-xl px-3.5 py-2 text-xs font-medium text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-[#1B6CF2] focus:bg-white">
            </div>

            <div class="sm:col-span-3">
                <label for="jurusan" class="block text-[11px] font-bold text-[#64748B] uppercase tracking-wider mb-1">
                    Jurusan
                </label>
                <select id="jurusan" name="jurusan" class="w-full bg-slate-50 border border-[#E2E8F0] rounded-xl px-3.5 py-2 text-xs font-medium text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-[#1B6CF2] focus:bg-white">
                    <option value="">Semua Jurusan</option>
                    <option value="TKJ" {{ request('jurusan') == 'TKJ' ? 'selected' : '' }}>TKJ</option>
                    <option value="RPL" {{ request('jurusan') == 'RPL' ? 'selected' : '' }}>RPL</option>
                    <option value="DKV" {{ request('jurusan') == 'DKV' ? 'selected' : '' }}>DKV</option>
                </select>
            </div>

            <div class="sm:col-span-2">
                <label for="status_aktif" class="block text-[11px] font-bold text-[#64748B] uppercase tracking-wider mb-1">
                    Status
                </label>
                <select id="status_aktif" name="status_aktif" class="w-full bg-slate-50 border border-[#E2E8F0] rounded-xl px-3.5 py-2 text-xs font-medium text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-[#1B6CF2] focus:bg-white">
                    <option value="">Semua Status</option>
                    <option value="aktif" {{ request('status_aktif') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="lulus" {{ request('status_aktif') == 'lulus' ? 'selected' : '' }}>Lulus</option>
                    <option value="mutasi" {{ request('status_aktif') == 'mutasi' ? 'selected' : '' }}>Mutasi</option>
                    <option value="non-aktif" {{ request('status_aktif') == 'non-aktif' ? 'selected' : '' }}>Non-Aktif</option>
                </select>
            </div>

            <div class="sm:col-span-2 flex items-end">
                <button type="submit" class="w-full bg-[#1B6CF2] hover:bg-[#1455C0] text-white py-2 px-4 rounded-xl text-xs font-bold shadow-xs transition-all">
                    Saring Data
                </button>
            </div>
        </form>

        @if(request('q') || request('jurusan') || request('status_aktif'))
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                <span class="text-[#64748B]">
                    Hasil filter: <strong>{{ $students->total() }}</strong> siswa ditemukan
                </span>
                <a href="{{ route('students.index') }}" class="text-[#1B6CF2] font-bold hover:underline">
                    Reset Filter
                </a>
            </div>
        @endif
    </div>

    <div class="siakad-card p-6">
        @if($students->isEmpty())
            <div class="text-center py-12 text-xs text-[#64748B]">
                Tidak ada data siswa yang cocok dengan filter pencarian.
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="border-b border-slate-100 text-[#64748B] font-bold uppercase tracking-wider">
                            <th class="py-3 px-3">NIS / NISN</th>
                            <th class="py-3 px-3">Nama Lengkap</th>
                            <th class="py-3 px-3">Jurusan</th>
                            <th class="py-3 px-3">Kelas</th>
                            <th class="py-3 px-3">Status</th>
                            <th class="py-3 px-3">Akun User</th>
                            <th class="py-3 px-3 text-right">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($students as $st)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="py-3 px-3 font-semibold text-[#64748B]">
                                    <div class="font-bold text-[#1B6CF2]">{{ $st->nis }}</div>
                                    <div class="text-[10px] text-[#94A3B8]">{{ $st->nisn }}</div>
                                </td>
                                <td class="py-3 px-3">
                                    <div class="font-bold text-[#1E293B] text-sm">{{ $st->nama_lengkap }}</div>
                                    <div class="text-[10px] text-[#64748B]">{{ $st->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</div>
                                </td>
                                <td class="py-3 px-3">
                                    <span class="text-[10px] font-bold uppercase px-2.5 py-0.5 rounded-full
                                        @if($st->jurusan === 'TKJ') bg-blue-100 text-blue-800
                                        @elseif($st->jurusan === 'RPL') bg-emerald-100 text-emerald-800
                                        @else bg-amber-100 text-amber-800 @endif">
                                        {{ $st->jurusan }}
                                    </span>
                                </td>
                                <td class="py-3 px-3 font-semibold text-[#334155]">
                                    {{ $st->kelas }}
                                </td>
                                <td class="py-3 px-3">
                                    <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded-md
                                        @if($st->status_aktif === 'aktif') bg-emerald-50 text-emerald-700 border border-emerald-200
                                        @else bg-slate-100 text-slate-600 @endif">
                                        {{ $st->status_aktif }}
                                    </span>
                                </td>
                                <td class="py-3 px-3 text-[#64748B] text-[11px]">
                                    @if($st->user)
                                        <span class="font-semibold text-[#1E293B]">{{ $st->user->email }}</span>
                                    @else
                                        <span class="text-[#94A3B8] italic">Belum terhubung</span>
                                    @endif
                                </td>
                                <td class="py-3 px-3 text-right">
                                    <div class="inline-flex items-center gap-1.5">
                                        <a href="{{ route('students.show', $st) }}" class="bg-slate-100 hover:bg-[#1B6CF2] hover:text-white text-[#1E293B] font-bold px-2.5 py-1 rounded-lg text-[11px] transition-colors">
                                            Detail
                                        </a>
                                        <a href="{{ route('students.edit', $st) }}" class="bg-amber-50 hover:bg-amber-500 hover:text-white text-amber-800 font-bold px-2.5 py-1 rounded-lg text-[11px] transition-colors border border-amber-200">
                                            Ubah
                                        </a>
                                        <form method="POST" action="{{ route('students.destroy', $st) }}" onsubmit="return confirmDelete(event, 'Apakah Anda yakin ingin menghapus data siswa ini?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-rose-50 hover:bg-rose-600 hover:text-white text-rose-700 font-bold px-2.5 py-1 rounded-lg text-[11px] transition-colors border border-rose-200">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $students->links() }}
            </div>
        @endif
    </div>
</x-layouts.app>
