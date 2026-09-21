<x-layouts.guest title="SIAKAD Online — Platform Manajemen Administrasi Sekolah Modern">
    <section class="siakad-gradient text-white py-16 sm:py-24 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <div class="lg:col-span-7 text-left">
                    <div class="inline-block bg-white/20 backdrop-blur-md text-white text-xs font-bold px-4 py-1.5 rounded-full mb-6 border border-white/30">
                        Platform Manajemen Administrasi Sekolah Terintegrasi
                    </div>

                    <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-[1.15] text-white">
                        Sistem Administrasi Sekolah Modern, Cepat, dan Terpercaya
                    </h1>

                    <p class="mt-6 text-base sm:text-lg text-white/90 leading-relaxed max-w-2xl font-normal">
                        Kelola direktori siswa, pengajuan surat resmi, disposisi dan validasi pimpinan hingga audit trail transparan dalam satu ekosistem berbasis cloud.
                    </p>

                    <div class="mt-8 flex flex-wrap items-center gap-4">
                        <a href="{{ route('login') }}" class="bg-white hover:bg-slate-50 text-[#1B6CF2] font-bold px-7 py-3.5 rounded-xl text-sm shadow-md transition-all hover:shadow-lg">
                            Mulai Pengajuan Surat
                        </a>
                        <a href="{{ route('public.tracking') }}" class="border-2 border-white/80 hover:bg-white/10 text-white font-semibold px-6 py-3 rounded-xl text-sm transition-all">
                            Cek Status Resi
                        </a>
                        <a href="{{ route('public.students') }}" class="bg-[#1455C0] hover:bg-[#0F172A] text-white font-semibold px-6 py-3 rounded-xl text-sm transition-all">
                            Direktori Siswa
                        </a>
                    </div>

                    <div class="mt-10 pt-6 border-t border-white/20 flex flex-wrap items-center gap-6 text-xs text-white/80 font-medium">
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-400"></span>
                            <span>Multi-Peran: TU, Kepsek, Siswa</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-400"></span>
                            <span>Audit Trail Real-Time</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-400"></span>
                            <span>Standar LKPD Client Brief 02</span>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-5">
                    <div class="bg-white rounded-2xl shadow-2xl p-6 text-[#1E293B] border border-slate-100">
                        <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                            <div>
                                <div class="text-xs font-bold text-[#64748B] uppercase tracking-wider">Live Monitoring</div>
                                <div class="text-base font-extrabold text-[#1E293B]">Ringkasan Administrasi</div>
                            </div>
                            <span class="bg-emerald-50 text-emerald-700 text-xs font-bold px-2.5 py-1 rounded-full border border-emerald-200">
                                Sistem Aktif
                            </span>
                        </div>

                        <div class="grid grid-cols-3 gap-3 my-4">
                            <div class="bg-[#EFF6FF] rounded-xl p-3 text-center border border-[#BFDBFE]/40">
                                <div class="text-xl font-black text-[#1B6CF2]">{{ $totalStudents }}</div>
                                <div class="text-[11px] font-semibold text-[#64748B] mt-0.5">Siswa</div>
                            </div>
                            <div class="bg-[#EFF6FF] rounded-xl p-3 text-center border border-[#BFDBFE]/40">
                                <div class="text-xl font-black text-[#0EA5E9]">{{ $totalServices }}</div>
                                <div class="text-[11px] font-semibold text-[#64748B] mt-0.5">Layanan</div>
                            </div>
                            <div class="bg-emerald-50 rounded-xl p-3 text-center border border-emerald-200/60">
                                <div class="text-xl font-black text-emerald-600">{{ $totalCompleted }}</div>
                                <div class="text-[11px] font-semibold text-emerald-700 mt-0.5">Selesai</div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="text-xs font-bold text-[#64748B] uppercase mb-2">Simulasi Distribusi Berkas</div>
                            <div class="h-3 w-full bg-slate-100 rounded-full overflow-hidden flex">
                                <div class="bg-[#1B6CF2] h-full" style="width: 45%;"></div>
                                <div class="bg-[#0EA5E9] h-full" style="width: 30%;"></div>
                                <div class="bg-[#10B981] h-full" style="width: 25%;"></div>
                            </div>
                            <div class="flex justify-between text-[10px] text-[#64748B] mt-1.5 font-medium">
                                <span>Verifikasi TU (45%)</span>
                                <span>Approval Kepsek (30%)</span>
                                <span>Terbit (25%)</span>
                            </div>
                        </div>

                        <div class="space-y-2.5 pt-2 border-t border-slate-100 text-xs">
                            <div class="flex items-center justify-between p-2.5 bg-slate-50 rounded-lg">
                                <div>
                                    <div class="font-bold text-[#1E293B]">Ahmad Maulana (TKJ)</div>
                                    <div class="text-[10px] text-[#64748B]">Surat Keterangan Aktif</div>
                                </div>
                                <span class="bg-emerald-100 text-emerald-800 text-[10px] font-bold px-2 py-0.5 rounded">Disetujui</span>
                            </div>
                            <div class="flex items-center justify-between p-2.5 bg-slate-50 rounded-lg">
                                <div>
                                    <div class="font-bold text-[#1E293B]">Siti Sarah (RPL)</div>
                                    <div class="text-[10px] text-[#64748B]">Surat Rekomendasi Magang</div>
                                </div>
                                <span class="bg-blue-100 text-blue-800 text-[10px] font-bold px-2 py-0.5 rounded">Diproses</span>
                            </div>
                            <div class="flex items-center justify-between p-2.5 bg-slate-50 rounded-lg">
                                <div>
                                    <div class="font-bold text-[#1E293B]">Budi Santoso (DKV)</div>
                                    <div class="text-[10px] text-[#64748B]">Legalisir Rapor</div>
                                </div>
                                <span class="bg-amber-100 text-amber-800 text-[10px] font-bold px-2 py-0.5 rounded">Menunggu</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white border-b border-[#E2E8F0] py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div class="border-r last:border-r-0 border-slate-100">
                    <div class="text-3xl sm:text-4xl font-extrabold text-[#1B6CF2]">{{ $totalStudents }}</div>
                    <div class="text-xs sm:text-sm font-semibold text-[#64748B] mt-1">Siswa Terdaftar</div>
                </div>
                <div class="border-r last:border-r-0 border-slate-100">
                    <div class="text-3xl sm:text-4xl font-extrabold text-[#1B6CF2]">3</div>
                    <div class="text-xs sm:text-sm font-semibold text-[#64748B] mt-1">Program Keahlian</div>
                </div>
                <div class="border-r last:border-r-0 border-slate-100">
                    <div class="text-3xl sm:text-4xl font-extrabold text-[#1B6CF2]">{{ $totalCompleted }}</div>
                    <div class="text-xs sm:text-sm font-semibold text-[#64748B] mt-1">Pengajuan Disetujui</div>
                </div>
                <div>
                    <div class="text-3xl sm:text-4xl font-extrabold text-[#1B6CF2]">{{ $totalServices }}</div>
                    <div class="text-xs sm:text-sm font-semibold text-[#64748B] mt-1">Jenis Dokumen Layanan</div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 sm:py-24 bg-[#F8FAFF]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-14">
                <span class="bg-[#EFF6FF] text-[#1B6CF2] text-xs font-bold uppercase px-3.5 py-1.5 rounded-full">
                    Transformasi Digital
                </span>
                <h2 class="text-2xl sm:text-4xl font-extrabold text-[#1E293B] mt-3">
                    Mengapa Harus Beralih ke SIAKAD Online?
                </h2>
                <p class="text-sm sm:text-base text-[#64748B] mt-3">
                    Bandingkan efisiensi pengelolaan berkas sebelum dan sesudah menggunakan sistem administrasi terintegrasi.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                <div class="bg-white rounded-2xl p-8 border border-rose-100 shadow-sm">
                    <div class="flex items-center gap-3 mb-6 pb-4 border-b border-rose-50">
                        <span class="bg-rose-100 text-rose-700 text-xs font-black px-3 py-1 rounded-md">SEBELUM</span>
                        <h3 class="text-base font-bold text-[#1E293B]">Sistem Manual & Spreadsheet</h3>
                    </div>
                    <ul class="space-y-4 text-xs sm:text-sm text-[#64748B]">
                        <li class="flex items-start gap-3">
                            <span class="text-rose-500 font-bold">[X]</span>
                            <span>Data siswa tersebar di file terpisah, rawan ganda atau terhapus.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="text-rose-500 font-bold">[X]</span>
                            <span>Pengajuan surat harus datang langsung dan mengisi lembaran kertas fisik.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="text-rose-500 font-bold">[X]</span>
                            <span>Proses validasi menunggu kepala sekolah di ruang kerja, sering tertunda.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="text-rose-500 font-bold">[X]</span>
                            <span>Tidak ada riwayat atau audit trail saat terjadi keluhan siswa.</span>
                        </li>
                    </ul>
                </div>

                <div class="bg-white rounded-2xl p-8 border border-emerald-200 shadow-md">
                    <div class="flex items-center gap-3 mb-6 pb-4 border-b border-emerald-50">
                        <span class="bg-emerald-100 text-emerald-700 text-xs font-black px-3 py-1 rounded-md">SESUDAH</span>
                        <h3 class="text-base font-bold text-[#1E293B]">SIAKAD Administrasi Online</h3>
                    </div>
                    <ul class="space-y-4 text-xs sm:text-sm text-[#1E293B]">
                        <li class="flex items-start gap-3">
                            <span class="text-emerald-600 font-bold">[V]</span>
                            <span>Database relasional terpusat dengan pencarian cepat nama, NIS, dan kelas.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="text-emerald-600 font-bold">[V]</span>
                            <span>Pengajuan mandiri online 24 jam dengan nomor tiket pelacakan otomatis.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="text-emerald-600 font-bold">[V]</span>
                            <span>Alur disposisi dan verifikasi digital berjenjang untuk TU dan Kepala Sekolah.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="text-emerald-600 font-bold">[V]</span>
                            <span>Catatan riwayat status audit trail lengkap dengan tanggal dan identitas petugas.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 sm:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-14">
                <span class="bg-[#EFF6FF] text-[#1B6CF2] text-xs font-bold uppercase px-3.5 py-1.5 rounded-full">
                    Fitur Komprehensif
                </span>
                <h2 class="text-2xl sm:text-4xl font-extrabold text-[#1E293B] mt-3">
                    Modul Pengelolaan Administrasi Sekolah
                </h2>
                <p class="text-sm sm:text-base text-[#64748B] mt-3">
                    Didesain khusus untuk memenuhi seluruh rubrik studi kasus LKPD Client Brief 02.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="siakad-card p-6">
                    <span class="inline-block bg-[#EFF6FF] text-[#1B6CF2] text-xs font-bold px-3 py-1 rounded-md mb-4">
                        Modul 01
                    </span>
                    <h3 class="text-lg font-bold text-[#1E293B] mb-2">Manajemen Siswa Lengkap</h3>
                    <p class="text-xs sm:text-sm text-[#64748B] leading-relaxed">
                        Pengelolaan master data siswa dengan validasi form ketat, pencarian fleksibel, filter program keahlian, dan penomoran otomatis.
                    </p>
                </div>

                <div class="siakad-card p-6">
                    <span class="inline-block bg-[#EFF6FF] text-[#1B6CF2] text-xs font-bold px-3 py-1 rounded-md mb-4">
                        Modul 02
                    </span>
                    <h3 class="text-lg font-bold text-[#1E293B] mb-2">Layanan Surat Dinamis</h3>
                    <p class="text-xs sm:text-sm text-[#64748B] leading-relaxed">
                        Konfigurasi berbagai kategori surat seperti Surat Keterangan Aktif, Izin PKL, Rekomendasi Beasiswa, dan Legalisir Ijazah.
                    </p>
                </div>

                <div class="siakad-card p-6">
                    <span class="inline-block bg-[#EFF6FF] text-[#1B6CF2] text-xs font-bold px-3 py-1 rounded-md mb-4">
                        Modul 03
                    </span>
                    <h3 class="text-lg font-bold text-[#1E293B] mb-2">Approval & Disposisi</h3>
                    <p class="text-xs sm:text-sm text-[#64748B] leading-relaxed">
                        Verifikasi keabsahan dokumen oleh staf TU dan tanda tangan atau keputusan persetujuan pimpinan sekolah secara digital.
                    </p>
                </div>

                <div class="siakad-card p-6">
                    <span class="inline-block bg-[#EFF6FF] text-[#1B6CF2] text-xs font-bold px-3 py-1 rounded-md mb-4">
                        Modul 04
                    </span>
                    <h3 class="text-lg font-bold text-[#1E293B] mb-2">Jejak Audit Status</h3>
                    <p class="text-xs sm:text-sm text-[#64748B] leading-relaxed">
                        Pencatatan transparan seluruh mutasi status pengajuan (Pending, Diproses, Disetujui, Ditolak) beserta catatan penjelas.
                    </p>
                </div>

                <div class="siakad-card p-6">
                    <span class="inline-block bg-[#EFF6FF] text-[#1B6CF2] text-xs font-bold px-3 py-1 rounded-md mb-4">
                        Modul 05
                    </span>
                    <h3 class="text-lg font-bold text-[#1E293B] mb-2">Pelacakan Publik Mandiri</h3>
                    <p class="text-xs sm:text-sm text-[#64748B] leading-relaxed">
                        Siswa atau orang tua dapat mengecek progres penerbitan surat secara langsung melalui nomor tiket tanpa harus login akun.
                    </p>
                </div>

                <div class="siakad-card p-6">
                    <span class="inline-block bg-[#EFF6FF] text-[#1B6CF2] text-xs font-bold px-3 py-1 rounded-md mb-4">
                        Modul 06
                    </span>
                    <h3 class="text-lg font-bold text-[#1E293B] mb-2">Keamanan & Otorisasi Peran</h3>
                    <p class="text-xs sm:text-sm text-[#64748B] leading-relaxed">
                        Dilengkapi Custom Middleware peran pengguna untuk memisahkan hak akses antara Admin TU, Approver Pimpinan, dan Siswa.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 sm:py-24 bg-[#F8FAFF]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-14">
                <span class="bg-[#EFF6FF] text-[#1B6CF2] text-xs font-bold uppercase px-3.5 py-1.5 rounded-full">
                    Program Keahlian
                </span>
                <h2 class="text-2xl sm:text-4xl font-extrabold text-[#1E293B] mt-3">
                    Direktori Berbasis Jurusan
                </h2>
                <p class="text-sm sm:text-base text-[#64748B] mt-3">
                    Pemisahan data siswa dan permohonan sesuai konsentrasi keahlian di sekolah.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-2xl p-6 border-t-4 border-[#1B6CF2] shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs font-bold text-[#1B6CF2] uppercase">Jurusan</span>
                            <span class="bg-blue-50 text-blue-700 text-[11px] font-bold px-2 py-0.5 rounded">Kelas X - XII</span>
                        </div>
                        <h3 class="text-2xl font-black text-[#1E293B] mb-2">TKJ</h3>
                        <div class="text-xs font-bold text-[#64748B] mb-2">Teknik Komputer & Jaringan</div>
                        <p class="text-xs text-[#64748B] leading-relaxed">
                            Fokus pada konfigurasi server, routing mikrotik & cisco, infrastruktur fiber optik, dan keamanan jaringan komputasi.
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between">
                        <a href="{{ route('public.students', ['jurusan' => 'TKJ']) }}" class="text-xs font-bold text-[#1B6CF2] hover:underline">
                            Lihat Direktori TKJ
                        </a>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-6 border-t-4 border-emerald-500 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs font-bold text-emerald-600 uppercase">Jurusan</span>
                            <span class="bg-emerald-50 text-emerald-700 text-[11px] font-bold px-2 py-0.5 rounded">Kelas X - XII</span>
                        </div>
                        <h3 class="text-2xl font-black text-[#1E293B] mb-2">RPL</h3>
                        <div class="text-xs font-bold text-[#64748B] mb-2">Rekayasa Perangkat Lunak</div>
                        <p class="text-xs text-[#64748B] leading-relaxed">
                            Kompetensi pengembangan aplikasi web fullstack Laravel, mobile application, relational database MySQL, dan arsitektur REST API.
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between">
                        <a href="{{ route('public.students', ['jurusan' => 'RPL']) }}" class="text-xs font-bold text-[#1B6CF2] hover:underline">
                            Lihat Direktori RPL
                        </a>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-6 border-t-4 border-amber-500 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs font-bold text-amber-600 uppercase">Jurusan</span>
                            <span class="bg-amber-50 text-amber-700 text-[11px] font-bold px-2 py-0.5 rounded">Kelas X - XII</span>
                        </div>
                        <h3 class="text-2xl font-black text-[#1E293B] mb-2">DKV</h3>
                        <div class="text-xs font-bold text-[#64748B] mb-2">Desain Komunikasi Visual</div>
                        <p class="text-xs text-[#64748B] leading-relaxed">
                            Keahlian perancangan grafis komunikasi, fotografi & videografi komersial, motion graphic, dan pengembangan brand identity.
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between">
                        <a href="{{ route('public.students', ['jurusan' => 'DKV']) }}" class="text-xs font-bold text-[#1B6CF2] hover:underline">
                            Lihat Direktori DKV
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="siakad-gradient text-white py-16 text-center">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl sm:text-4xl font-extrabold mb-4">
                Siap Meningkatkan Kualitas Layanan Administrasi Sekolah?
            </h2>
            <p class="text-sm sm:text-base text-white/90 mb-8 max-w-2xl mx-auto leading-relaxed">
                Akses sistem sekarang untuk membuat permohonan surat, melacak dokumen, atau mengelola direktori siswa secara cepat dan transparan.
            </p>
            <div class="flex flex-wrap items-center justify-center gap-4">
                <a href="{{ route('login') }}" class="bg-white text-[#1B6CF2] hover:bg-slate-50 font-bold px-8 py-3.5 rounded-xl text-sm shadow-lg transition-all">
                    Masuk ke Dasbor
                </a>
                <a href="{{ route('public.tracking') }}" class="border-2 border-white text-white hover:bg-white/10 font-semibold px-8 py-3 rounded-xl text-sm transition-all">
                    Lacak Status Resi
                </a>
            </div>
        </div>
    </section>
</x-layouts.guest>
