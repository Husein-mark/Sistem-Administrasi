<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'SIAKAD — Dasbor Administrasi Sekolah' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F8FAFC] text-[#1E293B] font-sans antialiased min-h-screen flex flex-col selection:bg-[#1B6CF2] selection:text-white">
    <header class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-[#E2E8F0] shadow-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center gap-6">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5">
                        <span class="bg-[#1B6CF2] text-white font-extrabold text-xs sm:text-sm px-2.5 py-1 rounded-lg tracking-tight">SIAKAD</span>
                        <span class="font-bold text-base tracking-tight text-[#1E293B]">Online</span>
                    </a>

                    <div class="hidden sm:flex items-center gap-1.5">
                        @if(Auth::user()->isAdmin())
                            <span class="bg-[#EFF6FF] text-[#1B6CF2] border border-[#BFDBFE] text-[11px] font-bold uppercase px-2.5 py-0.5 rounded-full">Administrator TU</span>
                        @elseif(Auth::user()->isApprover())
                            <span class="bg-amber-50 text-amber-700 border border-amber-200 text-[11px] font-bold uppercase px-2.5 py-0.5 rounded-full">Approver / Kepsek</span>
                        @else
                            <span class="bg-emerald-50 text-emerald-700 border border-emerald-200 text-[11px] font-bold uppercase px-2.5 py-0.5 rounded-full">Siswa Pemohon</span>
                        @endif
                    </div>
                </div>

                <nav class="hidden md:flex items-center gap-2 text-xs sm:text-sm font-semibold">
                    <a href="{{ route('dashboard') }}" class="px-3.5 py-2 rounded-lg transition-colors {{ request()->routeIs('dashboard') ? 'bg-[#1B6CF2] text-white' : 'text-[#64748B] hover:text-[#1E293B] hover:bg-slate-100' }}">
                        Dasbor
                    </a>

                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('students.index') }}" class="px-3.5 py-2 rounded-lg transition-colors {{ request()->routeIs('students*') ? 'bg-[#1B6CF2] text-white' : 'text-[#64748B] hover:text-[#1E293B] hover:bg-slate-100' }}">
                            Data Siswa
                        </a>
                        <a href="{{ route('submissions.index') }}" class="px-3.5 py-2 rounded-lg transition-colors {{ request()->routeIs('submissions*') ? 'bg-[#1B6CF2] text-white' : 'text-[#64748B] hover:text-[#1E293B] hover:bg-slate-100' }}">
                            Semua Pengajuan
                        </a>
                        <a href="{{ route('approvals.index') }}" class="px-3.5 py-2 rounded-lg transition-colors {{ request()->routeIs('approvals*') ? 'bg-[#1B6CF2] text-white' : 'text-[#64748B] hover:text-[#1E293B] hover:bg-slate-100' }}">
                            Approval
                        </a>
                        <a href="{{ route('administration-types.index') }}" class="px-3.5 py-2 rounded-lg transition-colors {{ request()->routeIs('administration-types*') ? 'bg-[#1B6CF2] text-white' : 'text-[#64748B] hover:text-[#1E293B] hover:bg-slate-100' }}">
                            Jenis Layanan
                        </a>
                    @elseif(Auth::user()->isApprover())
                        <a href="{{ route('approvals.index') }}" class="px-3.5 py-2 rounded-lg transition-colors {{ request()->routeIs('approvals*') ? 'bg-[#1B6CF2] text-white' : 'text-[#64748B] hover:text-[#1E293B] hover:bg-slate-100' }}">
                            Verifikasi & Approval
                        </a>
                        <a href="{{ route('submissions.index') }}" class="px-3.5 py-2 rounded-lg transition-colors {{ request()->routeIs('submissions*') ? 'bg-[#1B6CF2] text-white' : 'text-[#64748B] hover:text-[#1E293B] hover:bg-slate-100' }}">
                            Rekapitulasi Berkas
                        </a>
                        <a href="{{ route('public.students') }}" class="px-3.5 py-2 rounded-lg transition-colors text-[#64748B] hover:text-[#1E293B] hover:bg-slate-100">
                            Direktori Siswa
                        </a>
                    @else
                        <a href="{{ route('submissions.index') }}" class="px-3.5 py-2 rounded-lg transition-colors {{ request()->routeIs('submissions.index') ? 'bg-[#1B6CF2] text-white' : 'text-[#64748B] hover:text-[#1E293B] hover:bg-slate-100' }}">
                            Riwayat Permohonan
                        </a>
                        <a href="{{ route('submissions.create') }}" class="px-3.5 py-2 rounded-lg transition-colors {{ request()->routeIs('submissions.create') ? 'bg-[#1B6CF2] text-white' : 'bg-[#EFF6FF] text-[#1B6CF2] hover:bg-[#DBEAFE]' }}">
                            Buat Pengajuan Baru
                        </a>
                    @endif
                </nav>

                <div class="flex items-center gap-3">
                    <div class="text-right hidden sm:block">
                        <div class="text-xs font-bold text-[#1E293B] leading-none">{{ Auth::user()->name }}</div>
                        <div class="text-[11px] text-[#64748B] font-medium mt-0.5">{{ Auth::user()->email }}</div>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-white hover:bg-rose-50 text-rose-600 hover:text-rose-700 px-3.5 py-1.5 rounded-lg text-xs font-bold border border-rose-200 transition-colors">
                            Keluar
                        </button>
                    </form>
                </div>
            </div>

            <div class="flex md:hidden items-center gap-2 overflow-x-auto py-2.5 border-t border-slate-100 text-xs font-semibold">
                <a href="{{ route('dashboard') }}" class="px-3 py-1.5 rounded-lg whitespace-nowrap {{ request()->routeIs('dashboard') ? 'bg-[#1B6CF2] text-white' : 'text-[#64748B] bg-slate-50' }}">Dasbor</a>
                @if(Auth::user()->isAdmin())
                    <a href="{{ route('students.index') }}" class="px-3 py-1.5 rounded-lg whitespace-nowrap {{ request()->routeIs('students*') ? 'bg-[#1B6CF2] text-white' : 'text-[#64748B] bg-slate-50' }}">Data Siswa</a>
                    <a href="{{ route('submissions.index') }}" class="px-3 py-1.5 rounded-lg whitespace-nowrap {{ request()->routeIs('submissions*') ? 'bg-[#1B6CF2] text-white' : 'text-[#64748B] bg-slate-50' }}">Pengajuan</a>
                    <a href="{{ route('approvals.index') }}" class="px-3 py-1.5 rounded-lg whitespace-nowrap {{ request()->routeIs('approvals*') ? 'bg-[#1B6CF2] text-white' : 'text-[#64748B] bg-slate-50' }}">Approval</a>
                    <a href="{{ route('administration-types.index') }}" class="px-3 py-1.5 rounded-lg whitespace-nowrap {{ request()->routeIs('administration-types*') ? 'bg-[#1B6CF2] text-white' : 'text-[#64748B] bg-slate-50' }}">Layanan</a>
                @elseif(Auth::user()->isApprover())
                    <a href="{{ route('approvals.index') }}" class="px-3 py-1.5 rounded-lg whitespace-nowrap {{ request()->routeIs('approvals*') ? 'bg-[#1B6CF2] text-white' : 'text-[#64748B] bg-slate-50' }}">Approval</a>
                    <a href="{{ route('submissions.index') }}" class="px-3 py-1.5 rounded-lg whitespace-nowrap {{ request()->routeIs('submissions*') ? 'bg-[#1B6CF2] text-white' : 'text-[#64748B] bg-slate-50' }}">Semua Berkas</a>
                @else
                    <a href="{{ route('submissions.index') }}" class="px-3 py-1.5 rounded-lg whitespace-nowrap {{ request()->routeIs('submissions.index') ? 'bg-[#1B6CF2] text-white' : 'text-[#64748B] bg-slate-50' }}">Riwayat</a>
                    <a href="{{ route('submissions.create') }}" class="px-3 py-1.5 rounded-lg whitespace-nowrap {{ request()->routeIs('submissions.create') ? 'bg-[#1B6CF2] text-white' : 'text-[#1B6CF2] bg-[#EFF6FF]' }}">+ Buat Pengajuan</a>
                @endif
            </div>
        </div>
    </header>

    <main class="flex-1 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if (session('status'))
            <div class="mb-6 bg-emerald-50 border border-emerald-200 rounded-xl p-4 text-emerald-800 font-semibold text-sm shadow-xs flex items-center justify-between">
                <div>
                    <span class="font-bold uppercase tracking-wider text-xs mr-2">[BERHASIL]</span> {{ session('status') }}
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 bg-rose-50 border border-rose-200 rounded-xl p-4 text-rose-800 font-semibold text-sm shadow-xs flex items-center justify-between">
                <div>
                    <span class="font-bold uppercase tracking-wider text-xs mr-2">[PERINGATAN]</span> {{ session('error') }}
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 bg-rose-50 border border-rose-200 rounded-xl p-4 text-rose-800 text-sm shadow-xs">
                <div class="font-bold uppercase tracking-wider text-xs mb-2">[PERIKSA KEMBALI INPUTAN ANDA]</div>
                <ul class="list-disc list-inside space-y-1 text-xs">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{ $slot }}
    </main>

    <footer class="mt-auto border-t border-[#E2E8F0] bg-white py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-4 text-xs font-medium text-[#64748B]">
            <div>
                <span class="font-bold text-[#1E293B]">SIAKAD Online</span> — Sistem Administrasi & Manajemen Dokumen Terpadu
            </div>
            <div>
                Think Like an Analyst • Design Like an Engineer • Build Like a Developer
            </div>
        </div>
    </footer>
</body>
</html>
