<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        {{ $title ?? 'SIAKAD — Dasbor Administrasi Sekolah' }}
    </title>

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>


<body class="bg-[#F8FAFC] text-[#1E293B] font-sans antialiased min-h-screen selection:bg-[#1B6CF2] selection:text-white">


    {{-- ========================================================= --}}
    {{-- MOBILE TOP BAR --}}
    {{-- ========================================================= --}}

    <div class="md:hidden sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-[#E2E8F0] shadow-xs h-16 flex items-center justify-between px-4">

        <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5">

            <span class="bg-[#1B6CF2] text-white font-extrabold text-xs px-2.5 py-1 rounded-lg tracking-tight">
                SIAKAD
            </span>

            <span class="font-bold text-base tracking-tight text-[#1E293B]">
                Online
            </span>

        </a>

        <button
            type="button"
            onclick="toggleSidebar()"
            class="p-2 rounded-lg text-[#64748B] hover:bg-slate-100 transition-colors"
            aria-label="Buka menu"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

    </div>


    {{-- ========================================================= --}}
    {{-- OVERLAY (MOBILE) --}}
    {{-- ========================================================= --}}

    <div
        id="sidebar-overlay"
        onclick="toggleSidebar()"
        class="fixed inset-0 bg-slate-900/40 z-40 hidden md:hidden"
    ></div>


    <div class="md:flex">

        {{-- ========================================================= --}}
        {{-- SIDEBAR --}}
        {{-- ========================================================= --}}

        <aside
            id="sidebar"
            class="fixed md:sticky top-0 left-0 h-screen w-72 bg-white border-r border-[#E2E8F0] z-50 flex flex-col -translate-x-full md:translate-x-0 transition-transform duration-200 ease-in-out"
        >

            {{-- LOGO --}}

            <div class="h-16 flex items-center gap-2.5 px-5 border-b border-[#E2E8F0] shrink-0">

                <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5">

                    <span class="bg-[#1B6CF2] text-white font-extrabold text-xs sm:text-sm px-2.5 py-1 rounded-lg tracking-tight">
                        SIAKAD
                    </span>

                    <span class="font-bold text-base tracking-tight text-[#1E293B]">
                        Online
                    </span>

                </a>

                <button
                    type="button"
                    onclick="toggleSidebar()"
                    class="md:hidden ml-auto p-1.5 rounded-lg text-[#64748B] hover:bg-slate-100 transition-colors"
                    aria-label="Tutup menu"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

            </div>


            {{-- ROLE BADGE --}}

            <div class="px-5 pt-5">

                @if(Auth::user()->isAdmin())

                    <span class="inline-block bg-[#EFF6FF] text-[#1B6CF2] border border-[#BFDBFE] text-[11px] font-bold uppercase px-2.5 py-1 rounded-full">
                        Administrator TU
                    </span>

                @elseif(Auth::user()->isApprover())

                    <span class="inline-block bg-amber-50 text-amber-700 border border-amber-200 text-[11px] font-bold uppercase px-2.5 py-1 rounded-full">
                        Approver / Kepsek
                    </span>

                @else

                    <span class="inline-block bg-emerald-50 text-emerald-700 border border-emerald-200 text-[11px] font-bold uppercase px-2.5 py-1 rounded-full">
                        Siswa Pemohon
                    </span>

                @endif

            </div>


            {{-- NAVIGATION --}}

            <nav class="flex-1 overflow-y-auto px-3 py-5 space-y-1 text-sm font-semibold">

                <a
                    href="{{ route('dashboard') }}"
                    class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg transition-colors {{ request()->routeIs('dashboard') ? 'bg-[#1B6CF2] text-white' : 'text-[#64748B] hover:text-[#1E293B] hover:bg-slate-100' }}"
                >
                    Dasbor
                </a>


                @if(Auth::user()->isAdmin())

                    <a
                        href="{{ route('students.index') }}"
                        class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg transition-colors {{ request()->routeIs('students*') ? 'bg-[#1B6CF2] text-white' : 'text-[#64748B] hover:text-[#1E293B] hover:bg-slate-100' }}"
                    >
                        Data Siswa
                    </a>


                    <a
                        href="{{ route('submissions.index') }}"
                        class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg transition-colors {{ request()->routeIs('submissions*') ? 'bg-[#1B6CF2] text-white' : 'text-[#64748B] hover:text-[#1E293B] hover:bg-slate-100' }}"
                    >
                        Semua Pengajuan
                    </a>


                    <a
                        href="{{ route('approvals.index') }}"
                        class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg transition-colors {{ request()->routeIs('approvals*') ? 'bg-[#1B6CF2] text-white' : 'text-[#64748B] hover:text-[#1E293B] hover:bg-slate-100' }}"
                    >
                        Approval
                    </a>


                    <a
                        href="{{ route('administration-types.index') }}"
                        class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg transition-colors {{ request()->routeIs('administration-types*') ? 'bg-[#1B6CF2] text-white' : 'text-[#64748B] hover:text-[#1E293B] hover:bg-slate-100' }}"
                    >
                        Jenis Layanan
                    </a>


                @elseif(Auth::user()->isApprover())

                    <a
                        href="{{ route('approvals.index') }}"
                        class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg transition-colors {{ request()->routeIs('approvals*') ? 'bg-[#1B6CF2] text-white' : 'text-[#64748B] hover:text-[#1E293B] hover:bg-slate-100' }}"
                    >
                        Verifikasi & Approval
                    </a>


                    <a
                        href="{{ route('submissions.index') }}"
                        class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg transition-colors {{ request()->routeIs('submissions*') ? 'bg-[#1B6CF2] text-white' : 'text-[#64748B] hover:text-[#1E293B] hover:bg-slate-100' }}"
                    >
                        Rekapitulasi Berkas
                    </a>


                    <a
                        href="{{ route('public.students') }}"
                        class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg transition-colors text-[#64748B] hover:text-[#1E293B] hover:bg-slate-100"
                    >
                        Direktori Siswa
                    </a>


                @else

                    <a
                        href="{{ route('submissions.index') }}"
                        class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg transition-colors {{ request()->routeIs('submissions.index') ? 'bg-[#1B6CF2] text-white' : 'text-[#64748B] hover:text-[#1E293B] hover:bg-slate-100' }}"
                    >
                        Riwayat Permohonan
                    </a>


                    <a
                        href="{{ route('submissions.create') }}"
                        class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg transition-colors {{ request()->routeIs('submissions.create') ? 'bg-[#1B6CF2] text-white' : 'bg-[#EFF6FF] text-[#1B6CF2] hover:bg-[#DBEAFE]' }}"
                    >
                        Buat Pengajuan Baru
                    </a>

                @endif

            </nav>


            {{-- USER + LOGOUT --}}

            <div class="border-t border-[#E2E8F0] p-4 shrink-0">

                <div class="flex items-center gap-3 mb-3">

                    <div class="w-9 h-9 rounded-full bg-[#EFF6FF] text-[#1B6CF2] flex items-center justify-center font-bold text-sm shrink-0">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>

                    <div class="min-w-0">

                        <div class="text-xs font-bold text-[#1E293B] leading-none truncate">
                            {{ Auth::user()->name }}
                        </div>

                        <div class="text-[11px] text-[#64748B] font-medium mt-1 truncate">
                            {{ Auth::user()->email }}
                        </div>

                    </div>

                </div>


                <form method="POST" action="{{ route('logout') }}">

                    @csrf

                    <button
                        type="submit"
                        class="w-full bg-white hover:bg-rose-50 text-rose-600 hover:text-rose-700 px-3.5 py-2 rounded-lg text-xs font-bold border border-rose-200 transition-colors"
                    >
                        Keluar
                    </button>

                </form>

            </div>

        </aside>


        {{-- ========================================================= --}}
        {{-- CONTENT + FOOTER --}}
        {{-- ========================================================= --}}

        <div class="flex-1 min-w-0 flex flex-col min-h-screen">

            <main class="flex-1 w-full px-4 sm:px-6 lg:px-8 py-8">

                {{ $slot }}

            </main>


            <footer class="mt-auto border-t border-[#E2E8F0] bg-white py-6 px-4 sm:px-6 lg:px-8">

                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 text-xs font-medium text-[#64748B]">

                    <div>

                        <span class="font-bold text-[#1E293B]">
                            SIAKAD Online
                        </span>

                        — Sistem Administrasi & Manajemen Dokumen Terpadu

                    </div>


                    <div>

                        Think Like an Analyst • Design Like an Engineer • Build Like a Developer

                    </div>

                </div>

            </footer>

        </div>

    </div>


    <div
    id="sweetalert-data"
    class="hidden"
    data-status="{{ session('status') }}"
    data-error="{{ session('error') }}"
>
    @foreach ($errors->all() as $error)
        <span data-validation-error="{{ $error }}"></span>
    @endforeach
    </div>


<script>

    function toggleSidebar() {

        document.getElementById('sidebar').classList.toggle('-translate-x-full');

        document.getElementById('sidebar-overlay').classList.toggle('hidden');

    }


    document.addEventListener('DOMContentLoaded', function () {

        const sweetAlertData =
            document.getElementById('sweetalert-data');


        const flashStatus =
            sweetAlertData.dataset.status;


        const flashError =
            sweetAlertData.dataset.error;


        const validationErrors =
            Array.from(
                sweetAlertData.querySelectorAll(
                    '[data-validation-error]'
                )
            ).map(function (element) {

                return element.dataset.validationError;

            });


        if (flashStatus) {

            Swal.fire({

                icon: 'success',

                title: 'Berhasil!',

                text: flashStatus,

                confirmButtonText: 'OK',

                confirmButtonColor: '#1B6CF2',

                timer: 3500,

                timerProgressBar: true

            });

        }


        if (flashError) {

            Swal.fire({

                icon: 'error',

                title: 'Terjadi Kesalahan',

                text: flashError,

                confirmButtonText: 'Mengerti',

                confirmButtonColor: '#1B6CF2'

            });

        }


        if (validationErrors.length > 0) {

            Swal.fire({

                icon: 'warning',

                title: 'Periksa Input Anda',

                html: `
                    <div style="text-align: left;">
                        <ul style="padding-left: 20px; margin: 0;">
                            ${validationErrors
                                .map(function (error) {
                                    return `<li>${error}</li>`;
                                })
                                .join('')}
                        </ul>
                    </div>
                `,

                confirmButtonText: 'Perbaiki',

                confirmButtonColor: '#1B6CF2'

            });

        }

    });

</script>

</body>

</html>
