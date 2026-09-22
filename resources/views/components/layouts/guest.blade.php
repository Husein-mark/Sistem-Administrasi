<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        {{ $title ?? 'SIAKAD — Platform Manajemen Administrasi Sekolah' }}
    </title>


    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>


    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >


    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>


<body class="bg-[#F8FAFC] text-[#1E293B] font-sans antialiased min-h-screen flex flex-col selection:bg-[#1B6CF2] selection:text-white">


    {{-- ========================================================= --}}
    {{-- NAVBAR --}}
    {{-- ========================================================= --}}

    <nav class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-[#E2E8F0] shadow-xs">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">


            {{-- LOGO + MENU --}}

            <div class="flex items-center gap-8">

                <a href="{{ route('home') }}" class="flex items-center gap-2.5">

                    <span class="bg-[#1B6CF2] text-white font-extrabold text-sm px-2.5 py-1 rounded-lg tracking-tight">
                        SIAKAD
                    </span>


                    <div class="flex flex-col">

                        <span class="font-bold text-base tracking-tight text-[#1E293B] leading-none">
                            Online
                        </span>

                        <span class="text-[10px] text-[#64748B] font-medium leading-tight">
                            Administrasi Sekolah
                        </span>

                    </div>

                </a>


                {{-- MENU DESKTOP --}}

                <div class="hidden md:flex items-center gap-6 text-sm font-semibold text-[#1E293B]">

                    <a
                        href="{{ route('home') }}"
                        class="hover:text-[#1B6CF2] transition-colors {{ request()->routeIs('home') ? 'text-[#1B6CF2] font-bold' : '' }}"
                    >
                        Beranda
                    </a>


                    <a
                        href="{{ route('public.students') }}"
                        class="hover:text-[#1B6CF2] transition-colors {{ request()->routeIs('public.students*') ? 'text-[#1B6CF2] font-bold' : '' }}"
                    >
                        Direktori Siswa
                    </a>


                    <a
                        href="{{ route('public.tracking') }}"
                        class="hover:text-[#1B6CF2] transition-colors {{ request()->routeIs('public.tracking') ? 'text-[#1B6CF2] font-bold' : '' }}"
                    >
                        Lacak Pengajuan
                    </a>

                </div>

            </div>


            {{-- BUTTON --}}

            <div class="flex items-center gap-3">

                @auth

                    <a
                        href="{{ route('dashboard') }}"
                        class="bg-[#1B6CF2] hover:bg-[#1455C0] text-white px-5 py-2.5 rounded-lg text-xs sm:text-sm font-bold shadow-sm transition-all"
                    >
                        Masuk ke Dasbor
                    </a>


                @else

                    <a
                        href="{{ route('public.tracking') }}"
                        class="hidden sm:inline-block text-[#1B6CF2] border border-[#1B6CF2] hover:bg-[#EFF6FF] px-4 py-2 rounded-lg text-xs sm:text-sm font-bold transition-all"
                    >
                        Cek Resi Surat
                    </a>


                    <a
                        href="{{ route('login') }}"
                        class="bg-[#1B6CF2] hover:bg-[#1455C0] text-white px-5 py-2 rounded-lg text-xs sm:text-sm font-bold shadow-sm transition-all"
                    >
                        Masuk Sistem
                    </a>

                @endauth

            </div>

        </div>

    </nav>


    {{-- ========================================================= --}}
    {{-- CONTENT --}}
    {{-- ========================================================= --}}

    <main class="flex-1 w-full">

        {{ $slot }}

    </main>


    {{-- ========================================================= --}}
    {{-- FOOTER --}}
    {{-- ========================================================= --}}

    <footer class="mt-auto bg-[#0F172A] text-[#94A3B8] border-t border-[#1E293B] py-12 px-4 sm:px-6 lg:px-8">

        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-8 mb-10 text-sm">


            {{-- DESKRIPSI --}}

            <div class="md:col-span-2">

                <div class="flex items-center gap-2.5 mb-4">

                    <span class="bg-[#1B6CF2] text-white font-extrabold text-sm px-2.5 py-1 rounded-lg">
                        SIAKAD
                    </span>

                    <span class="font-bold text-white text-base">
                        Online
                    </span>

                </div>


                <p class="text-sm text-[#94A3B8] max-w-md leading-relaxed">

                    SIAKAD Online adalah platform administrasi terintegrasi untuk pengelolaan data siswa, surat permohonan dinamis, serta alur validasi dan approval berjenjang bagi institusi pendidikan modern.

                </p>

            </div>


            {{-- LAYANAN --}}

            <div>

                <h4 class="font-bold text-white text-sm mb-3 uppercase tracking-wider">
                    Layanan Utama
                </h4>


                <ul class="space-y-2 text-xs">

                    <li>

                        <a
                            href="{{ route('public.students') }}"
                            class="hover:text-white transition-colors"
                        >
                            Direktori Siswa
                        </a>

                    </li>


                    <li>

                        <a
                            href="{{ route('public.tracking') }}"
                            class="hover:text-white transition-colors"
                        >
                            Tracking Dokumen
                        </a>

                    </li>


                    <li>

                        <a
                            href="{{ route('login') }}"
                            class="hover:text-white transition-colors"
                        >
                            Portal Siswa & Tata Usaha
                        </a>

                    </li>


                    <li>

                        <a
                            href="{{ route('login') }}"
                            class="hover:text-white transition-colors"
                        >
                            Approval Pimpinan
                        </a>

                    </li>

                </ul>

            </div>


            {{-- STANDAR MUTU --}}

            <div>

                <h4 class="font-bold text-white text-sm mb-3 uppercase tracking-wider">
                    Standar Mutu
                </h4>


                <p class="text-xs text-[#94A3B8] leading-relaxed">

                    Terverifikasi sesuai LKPD Client Brief 02 dengan arsitektur role-based access control, database relasional, dan audit trail otomatis.

                </p>

            </div>

        </div>


        {{-- COPYRIGHT --}}

        <div class="max-w-7xl mx-auto pt-6 border-t border-slate-800 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-[#64748B]">

            <div>

                &copy; {{ date('Y') }} SIAKAD Online — Sistem Administrasi Sekolah Terpadu.

            </div>


            <div>

                Think Like an Analyst • Design Like an Engineer • Build Like a Developer

            </div>

        </div>

    </footer>

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