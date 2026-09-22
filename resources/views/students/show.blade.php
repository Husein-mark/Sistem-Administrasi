<x-layouts.app title="Detail Siswa — {{ $student->nama_lengkap }}">
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <a href="{{ route('students.index') }}" class="text-xs font-bold text-[#1B6CF2] hover:underline uppercase tracking-wider block mb-2">
                Kembali ke Direktori Siswa
            </a>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-[#0F172A] tracking-tight">
                {{ $student->nama_lengkap }}
            </h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">
                Informasi komprehensif profil siswa dan rekam jejak pengajuan administrasi.
            </p>
        </div>

        <div class="flex items-center gap-2">
            <a href="{{ route('students.edit', $student) }}" class="bg-[#1B6CF2] hover:bg-[#1455C0] text-white px-5 py-2.5 rounded-xl text-xs font-bold shadow-sm transition-all">
                Ubah Profil
            </a>
            <form method="POST" action="{{ route('students.destroy', $student) }}" onsubmit="return confirmDelete(event, 'Apakah Anda yakin ingin menghapus data siswa ini?');" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-rose-50 hover:bg-rose-600 hover:text-white text-rose-700 px-5 py-2.5 rounded-xl text-xs font-bold transition-all">
                    Hapus Siswa
                </button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-12 gap-6 mb-8">
        <div class="md:col-span-4">
            <div class="siakad-card bg-white rounded-2xl p-6 border border-slate-200 shadow-sm">
                <div class="inline-block px-3 py-1 rounded-lg text-xs font-bold uppercase mb-4
                    @if($student->jurusan === 'TKJ') bg-blue-50 text-blue-700 border border-blue-200
                    @elseif($student->jurusan === 'RPL') bg-sky-50 text-sky-700 border border-sky-200
                    @else bg-indigo-50 text-indigo-700 border border-indigo-200 @endif">
                    {{ $student->jurusan }} — {{ $student->kelas }}
                </div>

                <div class="space-y-3.5 text-xs">
                    <div class="border-b border-slate-100 pb-2.5">
                        <span class="text-slate-400 font-bold block uppercase text-[10px] tracking-wider">NIS</span>
                        <span class="font-bold text-sm text-[#0F172A]">{{ $student->nis }}</span>
                    </div>

                    <div class="border-b border-slate-100 pb-2.5">
                        <span class="text-slate-400 font-bold block uppercase text-[10px] tracking-wider">NISN</span>
                        <span class="font-bold text-sm text-[#0F172A]">{{ $student->nisn }}</span>
                    </div>

                    <div class="border-b border-slate-100 pb-2.5">
                        <span class="text-slate-400 font-bold block uppercase text-[10px] tracking-wider">Jenis Kelamin</span>
                        <span class="font-semibold text-slate-700">{{ $student->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
                    </div>

                    <div class="border-b border-slate-100 pb-2.5">
                        <span class="text-slate-400 font-bold block uppercase text-[10px] tracking-wider">Tempat, Tanggal Lahir</span>
                        <span class="font-semibold text-slate-700">{{ $student->tempat_lahir ?? '-' }}, {{ $student->tanggal_lahir ? $student->tanggal_lahir->format('d M Y') : '-' }}</span>
                    </div>

                    <div class="border-b border-slate-100 pb-2.5">
                        <span class="text-slate-400 font-bold block uppercase text-[10px] tracking-wider">Nomor Kontak</span>
                        <span class="font-semibold text-slate-700">{{ $student->no_telepon ?? '-' }}</span>
                    </div>

                    <div class="border-b border-slate-100 pb-2.5">
                        <span class="text-slate-400 font-bold block uppercase text-[10px] tracking-wider">Status Keaktifan</span>
                        <span class="font-bold uppercase text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-md border border-emerald-200 inline-block mt-0.5">{{ $student->status_aktif }}</span>
                    </div>

                    <div>
                        <span class="text-slate-400 font-bold block uppercase text-[10px] tracking-wider">Akun Terhubung</span>
                        <span class="font-semibold text-slate-700">{{ $student->user ? $student->user->email : 'Tidak terhubung ke akun login' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="md:col-span-8">
            <div class="siakad-card bg-white rounded-2xl p-6 border border-slate-200 shadow-sm">
                <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-100">
                    <h2 class="text-sm font-bold text-[#0F172A] uppercase tracking-wider">
                        Riwayat Permohonan Administrasi Siswa
                    </h2>
                    <span class="bg-blue-50 text-[#1B6CF2] border border-blue-100 font-bold text-xs px-3 py-1 rounded-lg">
                        {{ $student->submissions->count() }} Pengajuan
                    </span>
                </div>

                @if($student->submissions->isEmpty())
                    <div class="text-center py-10 text-xs text-slate-500">
                        Siswa ini belum pernah mengajukan surat administrasi.
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs">
                            <thead>
                                <tr class="border-b border-slate-100 text-slate-400 font-bold uppercase tracking-wider">
                                    <th class="py-2.5 px-3">No. Pengajuan</th>
                                    <th class="py-2.5 px-3">Layanan</th>
                                    <th class="py-2.5 px-3">Tanggal</th>
                                    <th class="py-2.5 px-3">Status</th>
                                    <th class="py-2.5 px-3 text-right">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach($student->submissions as $sub)
                                    <tr class="hover:bg-slate-50 transition-colors">
                                        <td class="py-3 px-3 font-bold text-[#0F172A]">{{ $sub->nomor_pengajuan }}</td>
                                        <td class="py-3 px-3 text-slate-700 font-medium">{{ $sub->administrationType->nama_layanan }}</td>
                                        <td class="py-3 px-3 text-slate-500">{{ $sub->tanggal_pengajuan->format('d M Y') }}</td>
                                        <td class="py-3 px-3">
                                            @if($sub->status === 'disetujui')
                                                <span class="bg-emerald-50 text-emerald-700 border border-emerald-200 text-[10px] font-bold uppercase px-2.5 py-0.5 rounded-full">Disetujui</span>
                                            @elseif($sub->status === 'diproses')
                                                <span class="bg-blue-50 text-blue-700 border border-blue-200 text-[10px] font-bold uppercase px-2.5 py-0.5 rounded-full">Diproses</span>
                                            @elseif($sub->status === 'ditolak')
                                                <span class="bg-rose-50 text-rose-700 border border-rose-200 text-[10px] font-bold uppercase px-2.5 py-0.5 rounded-full">Ditolak</span>
                                            @else
                                                <span class="bg-amber-50 text-amber-700 border border-amber-200 text-[10px] font-bold uppercase px-2.5 py-0.5 rounded-full">Menunggu</span>
                                            @endif
                                        </td>
                                        <td class="py-3 px-3 text-right">
                                            <a href="{{ route('submissions.show', $sub) }}" class="bg-slate-100 hover:bg-[#1B6CF2] hover:text-white text-slate-700 font-bold px-3 py-1 rounded-lg text-[11px] transition-colors">
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
    </div>
</x-layouts.app>
