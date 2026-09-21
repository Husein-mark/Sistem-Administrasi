<x-layouts.guest title="Direktori Data Siswa — SIAKAD Online">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="mb-8">
            <div class="inline-block bg-[#EFF6FF] text-[#1B6CF2] border border-[#BFDBFE] text-xs font-bold uppercase px-3 py-1 rounded-full mb-3">
                Pencarian & Profiling Siswa
            </div>
            <h1 class="text-2xl sm:text-4xl font-extrabold text-[#1E293B] tracking-tight">
                Direktori Siswa Sekolah
            </h1>
            <p class="text-xs sm:text-sm text-[#64748B] mt-1.5">
                Telusuri data siswa aktif berdasarkan nama, NIS, kelas, maupun kompetensi keahlian.
            </p>
        </div>

        <div class="siakad-card p-6 mb-8">
            <form method="GET" action="{{ route('public.students') }}" class="grid grid-cols-1 sm:grid-cols-12 gap-4">
                <div class="sm:col-span-7">
                    <label for="q" class="block text-xs font-bold text-[#64748B] uppercase tracking-wider mb-1">
                        Cari Nama atau NIS
                    </label>
                    <input type="text" id="q" name="q" value="{{ request('q') }}" placeholder="Ketik nama siswa atau NIS..."
                        class="w-full bg-slate-50 border border-[#E2E8F0] rounded-xl px-4 py-2.5 text-sm font-medium text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-[#1B6CF2] focus:bg-white">
                </div>

                <div class="sm:col-span-3">
                    <label for="jurusan" class="block text-xs font-bold text-[#64748B] uppercase tracking-wider mb-1">
                        Jurusan
                    </label>
                    <select id="jurusan" name="jurusan" class="w-full bg-slate-50 border border-[#E2E8F0] rounded-xl px-4 py-2.5 text-sm font-medium text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-[#1B6CF2] focus:bg-white">
                        <option value="">Semua Jurusan</option>
                        <option value="TKJ" {{ request('jurusan') == 'TKJ' ? 'selected' : '' }}>TKJ (Jaringan)</option>
                        <option value="RPL" {{ request('jurusan') == 'RPL' ? 'selected' : '' }}>RPL (Software)</option>
                        <option value="DKV" {{ request('jurusan') == 'DKV' ? 'selected' : '' }}>DKV (Desain)</option>
                    </select>
                </div>

                <div class="sm:col-span-2 flex items-end">
                    <button type="submit" class="w-full bg-[#1B6CF2] hover:bg-[#1455C0] text-white py-2.5 px-4 rounded-xl text-sm font-bold shadow-xs transition-all">
                        Cari Data
                    </button>
                </div>
            </form>

            @if(request('q') || request('jurusan'))
                <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                    <span class="text-[#64748B]">
                        Menampilkan hasil filter: <strong>{{ $students->total() }}</strong> siswa ditemukan
                    </span>
                    <a href="{{ route('public.students') }}" class="text-[#1B6CF2] font-bold hover:underline">
                        Reset Filter
                    </a>
                </div>
            @endif
        </div>

        @if($students->isEmpty())
            <div class="siakad-card p-12 text-center my-8">
                <span class="bg-slate-100 text-[#64748B] text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider inline-block mb-3">
                    Tidak Ditemukan
                </span>
                <h3 class="text-xl font-bold text-[#1E293B]">Data siswa tidak cocok dengan kriteria pencarian</h3>
                <p class="text-xs text-[#64748B] mt-1 max-w-md mx-auto">
                    Silakan coba kata kunci lain atau pilih opsi 'Semua Jurusan' untuk melihat kembali daftar seluruh siswa.
                </p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-8">
                @foreach($students as $student)
                    <div class="siakad-card p-6 flex flex-col justify-between group transition-all">
                        <div>
                            <div class="flex items-center justify-between gap-2 mb-3">
                                <span class="text-[10px] font-bold uppercase px-2.5 py-0.5 rounded-full
                                    @if($student->jurusan === 'TKJ') bg-blue-100 text-blue-700
                                    @elseif($student->jurusan === 'RPL') bg-emerald-100 text-emerald-700
                                    @else bg-amber-100 text-amber-700 @endif">
                                    {{ $student->jurusan }}
                                </span>
                                <span class="text-[10px] font-semibold text-[#64748B]">
                                    NIS: {{ $student->nis }}
                                </span>
                            </div>

                            <h3 class="text-base font-extrabold text-[#1E293B] group-hover:text-[#1B6CF2] transition-colors leading-tight mb-1">
                                {{ $student->nama_lengkap }}
                            </h3>

                            <div class="text-xs font-semibold text-[#64748B] mb-4">
                                Kelas {{ $student->kelas }}
                            </div>
                        </div>

                        <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                            <span class="text-[11px] font-bold text-emerald-600">
                                Status: {{ ucfirst($student->status_aktif) }}
                            </span>
                            <a href="{{ route('public.students.show', $student) }}" class="bg-[#EFF6FF] hover:bg-[#1B6CF2] hover:text-white text-[#1B6CF2] text-xs font-bold px-3.5 py-1.5 rounded-lg transition-colors border border-[#BFDBFE]/60">
                                Lihat Profil
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $students->links() }}
            </div>
        @endif
    </div>
</x-layouts.guest>
