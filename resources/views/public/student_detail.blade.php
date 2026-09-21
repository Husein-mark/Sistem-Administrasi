<x-layouts.guest title="{{ $student->nama_lengkap }} — Profil Siswa SIAKAD Online">
    <div class="mb-6">
        <a href="{{ route('public.students') }}" class="text-xs font-bold text-[#1B6CF2] hover:underline uppercase tracking-wider inline-block mb-3">
            Kembali ke Direktori Siswa
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-12 gap-8">
        <div class="md:col-span-5">
            <div class="siakad-card bg-white rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-sm">
                <div class="inline-block px-3 py-1 rounded-lg text-xs font-bold uppercase mb-4
                    @if($student->jurusan === 'TKJ') bg-blue-50 text-blue-700 border border-blue-200
                    @elseif($student->jurusan === 'RPL') bg-sky-50 text-sky-700 border border-sky-200
                    @else bg-indigo-50 text-indigo-700 border border-indigo-200 @endif">
                    {{ $student->jurusan }} — {{ $student->kelas }}
                </div>

                <h1 class="text-2xl sm:text-3xl font-extrabold text-[#0F172A] leading-tight mb-2">
                    {{ $student->nama_lengkap }}
                </h1>

                <div class="text-xs font-semibold text-slate-500 mb-6">
                    Peserta Didik Aktif — SMK Informatika Pesat IT XPRO
                </div>

                <div class="space-y-3.5 text-xs font-medium text-[#0F172A] border-t border-slate-100 pt-6">
                    <div class="flex justify-between py-1 border-b border-slate-50">
                        <span class="text-slate-500">Nomor Induk Siswa (NIS)</span>
                        <span class="font-bold">{{ $student->nis }}</span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-slate-50">
                        <span class="text-slate-500">NISN</span>
                        <span class="font-bold">{{ $student->nisn }}</span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-slate-50">
                        <span class="text-slate-500">Jenis Kelamin</span>
                        <span class="font-bold">{{ $student->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-slate-50">
                        <span class="text-slate-500">Tempat, Tanggal Lahir</span>
                        <span class="font-bold">{{ $student->tempat_lahir ?? '-' }}, {{ $student->tanggal_lahir ? $student->tanggal_lahir->format('d F Y') : '-' }}</span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-slate-50">
                        <span class="text-slate-500">Status Keaktifan</span>
                        <span class="font-bold text-emerald-600 uppercase bg-emerald-50 px-2 py-0.5 rounded-md border border-emerald-200">{{ $student->status_aktif }}</span>
                    </div>
                    <div class="py-1">
                        <span class="text-slate-500 block mb-1">Alamat Tempat Tinggal</span>
                        <span class="font-semibold block bg-slate-50 p-2.5 rounded-xl border border-slate-100">{{ $student->alamat ?? 'Alamat belum dilengkapi' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="md:col-span-7">
            <div class="siakad-card bg-white rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-sm mb-6">
                <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-100">
                    <h2 class="text-base font-bold text-[#0F172A]">
                        Rekam Jejak Permohonan Administrasi
                    </h2>
                    <span class="bg-blue-50 text-[#1B6CF2] border border-blue-100 text-[10px] font-bold uppercase px-3 py-1 rounded-lg">
                        {{ $student->submissions->count() }} Pengajuan
                    </span>
                </div>

                @if($student->submissions->isEmpty())
                    <div class="text-center py-8 text-xs text-slate-500">
                        Belum ada permohonan administrasi yang tercatat untuk siswa ini.
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach($student->submissions as $sub)
                            <div class="p-4 rounded-xl border border-slate-200 bg-slate-50 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
                                <div>
                                    <div class="text-xs font-bold text-[#0F172A]">
                                        {{ $sub->administrationType->nama_layanan }}
                                    </div>
                                    <div class="text-[11px] text-slate-500 mt-0.5">
                                        Nomor: {{ $sub->nomor_pengajuan }} • Diajukan: {{ $sub->tanggal_pengajuan->format('d M Y') }}
                                    </div>
                                </div>

                                <div>
                                    @if($sub->status === 'disetujui')
                                        <span class="bg-emerald-50 text-emerald-700 border border-emerald-200 text-[10px] font-bold uppercase px-3 py-1 rounded-full">
                                            Disetujui
                                        </span>
                                    @elseif($sub->status === 'diproses')
                                        <span class="bg-blue-50 text-blue-700 border border-blue-200 text-[10px] font-bold uppercase px-3 py-1 rounded-full">
                                            Diproses
                                        </span>
                                    @elseif($sub->status === 'ditolak')
                                        <span class="bg-rose-50 text-rose-700 border border-rose-200 text-[10px] font-bold uppercase px-3 py-1 rounded-full">
                                            Ditolak
                                        </span>
                                    @else
                                        <span class="bg-slate-200 text-slate-700 text-[10px] font-bold uppercase px-3 py-1 rounded-full">
                                            Menunggu
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="siakad-gradient text-white rounded-2xl p-6 shadow-sm text-center">
                <h3 class="text-base font-bold mb-2">Ingin mengajukan surat atau legalisir?</h3>
                <p class="text-xs text-white/80 mb-4 max-w-md mx-auto">
                    Siswa terdaftar dapat masuk ke portal SIAKAD untuk membuat permohonan baru langsung dari akun masing-masing.
                </p>
                <a href="{{ route('login') }}" class="bg-white text-[#1B6CF2] hover:bg-blue-50 text-xs font-bold px-6 py-2.5 rounded-xl inline-block transition-colors">
                    Masuk ke Akun Siswa
                </a>
            </div>
        </div>
    </div>
</x-layouts.guest>
