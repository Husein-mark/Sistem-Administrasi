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

    <style>
        /* =========================================================
           SIDEBAR
        ========================================================= */

        .siakad-sidebar {
            width: 240px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 60;
            background: #ffffff;
            border-right: 1px solid #E2E8F0;
            display: flex;
            flex-direction: column;
            transition: transform .25s ease;
        }

        .siakad-sidebar-header {
            height: 64px;
            padding: 0 18px;
            display: flex;
            align-items: center;
            border-bottom: 1px solid #E2E8F0;
            flex-shrink: 0;
        }

        .siakad-brand {
            display: flex;
            align-items: center;
            gap: 9px;
            text-decoration: none;
        }

        .siakad-brand-badge {
            background: #1B6CF2;
            color: white;
            font-size: 13px;
            font-weight: 800;
            padding: 6px 10px;
            border-radius: 8px;
            letter-spacing: -.3px;
            line-height: 1;
        }

        .siakad-brand-text {
            color: #1E293B;
            font-size: 15px;
            font-weight: 700;
            letter-spacing: -.3px;
        }

        .sidebar-close {
            display: none;
            margin-left: auto;
            width: 30px;
            height: 30px;
            border: 0;
            background: transparent;
            color: #64748B;
            cursor: pointer;
            font-size: 22px;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
        }

        .sidebar-close:hover {
            background: #F1F5F9;
            color: #1E293B;
        }

        .siakad-sidebar-content {
            flex: 1;
            overflow-y: auto;
            padding: 18px 12px;
        }

        .siakad-role {
            display: inline-flex;
            align-items: center;
            margin: 0 5px 22px;
            padding: 5px 10px;
            border-radius: 999px;
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .2px;
        }

        .sidebar-section-title {
            padding: 0 11px;
            margin: 0 0 8px;
            color: #94A3B8;
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .6px;
        }

        .sidebar-menu {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .sidebar-link {
            min-height: 42px;
            width: 100%;
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 9px 11px;
            border-radius: 9px;
            color: #64748B;
            text-decoration: none;
            font-size: 12px;
            font-weight: 600;
            transition: all .18s ease;
        }

        .sidebar-link:hover {
            background: #F8FAFC;
            color: #1E293B;
        }

        .sidebar-link.active {
            background: #1B6CF2;
            color: #ffffff;
            box-shadow: 0 3px 8px rgba(27, 108, 242, .16);
        }

        .sidebar-link.special {
            background: #EFF6FF;
            color: #1B6CF2;
        }

        .sidebar-link.special:hover {
            background: #DBEAFE;
        }

        .sidebar-icon {
            width: 19px;
            height: 19px;
            flex: 0 0 19px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar-icon svg {
            width: 19px;
            height: 19px;
            stroke: currentColor;
            stroke-width: 1.8;
            fill: none;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .sidebar-link-text {
            flex: 1;
            line-height: 1.25;
        }

        .siakad-sidebar-footer {
            padding: 12px;
            border-top: 1px solid #E2E8F0;
            flex-shrink: 0;
        }

        .sidebar-user {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px;
            margin-bottom: 7px;
            border-radius: 9px;
            background: #F8FAFC;
        }

        .sidebar-user-avatar {
            width: 34px;
            height: 34px;
            flex: 0 0 34px;
            border-radius: 9px;
            background: #EFF6FF;
            color: #1B6CF2;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 800;
        }

        .sidebar-user-info {
            min-width: 0;
        }

        .sidebar-user-name {
            color: #1E293B;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sidebar-user-email {
            color: #64748B;
            font-size: 9px;
            margin-top: 2px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sidebar-logout {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border: 1px solid #FECACA;
            background: #ffffff;
            color: #E11D48;
            padding: 8px 10px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
            transition: .18s ease;
        }

        .sidebar-logout:hover {
            background: #FFF1F2;
            color: #BE123C;
        }

        .sidebar-logout svg {
            width: 16px;
            height: 16px;
            stroke: currentColor;
            fill: none;
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
        }


        /* =========================================================
           AREA KONTEN
        ========================================================= */

        .siakad-page {
            margin-left: 240px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .siakad-topbar {
            height: 64px;
            background: rgba(255, 255, 255, .95);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid #E2E8F0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
            position: sticky;
            top: 0;
            z-index: 40;
        }

        .mobile-sidebar-button {
            display: none;
            width: 34px;
            height: 34px;
            border: 1px solid #E2E8F0;
            background: white;
            color: #475569;
            border-radius: 8px;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .mobile-sidebar-button svg {
            width: 19px;
            height: 19px;
            stroke: currentColor;
            fill: none;
            stroke-width: 1.8;
            stroke-linecap: round;
        }

        .topbar-title {
            color: #1E293B;
            font-size: 14px;
            font-weight: 700;
        }

        .topbar-user {
            text-align: right;
        }

        .topbar-user-name {
            color: #1E293B;
            font-size: 11px;
            font-weight: 700;
            line-height: 1.2;
        }

        .topbar-user-email {
            color: #64748B;
            font-size: 10px;
            font-weight: 500;
            margin-top: 3px;
        }

        .siakad-main {
            flex: 1;
            width: 100%;
            max-width: 1280px;
            margin: 0 auto;
            padding: 32px 36px;
        }

        .siakad-footer {
            border-top: 1px solid #E2E8F0;
            background: white;
            padding: 22px 36px;
        }

        .siakad-footer-inner {
            max-width: 1280px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            color: #64748B;
            font-size: 11px;
            font-weight: 500;
        }

        /* Overlay untuk mobile */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, .35);
            z-index: 55;
        }


        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 1023px) {

            .siakad-sidebar {
                transform: translateX(-100%);
            }

            .siakad-sidebar.open {
                transform: translateX(0);
            }

            .sidebar-close {
                display: flex;
            }

            .sidebar-overlay.open {
                display: block;
            }

            .siakad-page {
                margin-left: 0;
            }

            .mobile-sidebar-button {
                display: flex;
            }

            .siakad-topbar {
                padding: 0 20px;
                gap: 12px;
            }

            .topbar-left {
                display: flex;
                align-items: center;
                gap: 12px;
            }

            .siakad-main {
                padding: 28px 24px;
            }

            .siakad-footer {
                padding: 20px 24px;
            }
        }

        @media (max-width: 640px) {

            .siakad-topbar {
                height: 58px;
                padding: 0 14px;
            }

            .topbar-title {
                font-size: 13px;
            }

            .topbar-user {
                display: none;
            }

            .siakad-main {
                padding: 22px 14px;
            }

            .siakad-footer {
                padding: 18px 14px;
            }

            .siakad-footer-inner {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</head>

<body class="bg-[#F8FAFC] text-[#1E293B] font-sans antialiased min-h-screen selection:bg-[#1B6CF2] selection:text-white">

    <!-- =========================================================
         SIDEBAR OVERLAY MOBILE
    ========================================================== -->
    <div id="sidebarOverlay" class="sidebar-overlay" onclick="closeSidebar()"></div>


    <!-- =========================================================
         SIDEBAR
    ========================================================== -->
    <aside id="siakadSidebar" class="siakad-sidebar">

        <!-- Logo -->
        <div class="siakad-sidebar-header">

            <a href="{{ route('dashboard') }}" class="siakad-brand">
                <span class="siakad-brand-badge">SIAKAD</span>
                <span class="siakad-brand-text">Online</span>
            </a>

            <button
                type="button"
                class="sidebar-close"
                onclick="closeSidebar()"
                aria-label="Tutup menu">
                ×
            </button>

        </div>


        <!-- Sidebar Content -->
        <div class="siakad-sidebar-content">

            <!-- ROLE -->
            @if(Auth::user()->isAdmin())

                <div class="siakad-role bg-[#EFF6FF] text-[#1B6CF2] border border-[#BFDBFE]">
                    Administrator TU
                </div>

            @elseif(Auth::user()->isApprover())

                <div class="siakad-role bg-amber-50 text-amber-700 border border-amber-200">
                    Approver / Kepsek
                </div>

            @else

                <div class="siakad-role bg-emerald-50 text-emerald-700 border border-emerald-200">
                    Siswa Pemohon
                </div>

            @endif


            <!-- MENU UTAMA -->
            <div class="sidebar-section-title">
                Menu Utama
            </div>

            <nav class="sidebar-menu">

                <!-- DASBOR -->
                <a
                    href="{{ route('dashboard') }}"
                    class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">

                    <span class="sidebar-icon">
                        <svg viewBox="0 0 24 24">
                            <path d="M3 10.5 12 3l9 7.5"></path>
                            <path d="M5 9.5V21h14V9.5"></path>
                            <path d="M9 21v-6h6v6"></path>
                        </svg>
                    </span>

                    <span class="sidebar-link-text">
                        Dasbor
                    </span>

                </a>


                <!-- ADMIN -->
                @if(Auth::user()->isAdmin())

                    <!-- DATA SISWA -->
                    <a
                        href="{{ route('students.index') }}"
                        class="sidebar-link {{ request()->routeIs('students*') ? 'active' : '' }}">

                        <span class="sidebar-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                        </span>

                        <span class="sidebar-link-text">
                            Data Siswa
                        </span>

                    </a>


                    <!-- PENGAJUAN -->
                    <a
                        href="{{ route('submissions.index') }}"
                        class="sidebar-link {{ request()->routeIs('submissions*') ? 'active' : '' }}">

                        <span class="sidebar-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <path d="M14 2v6h6"></path>
                                <path d="M8 13h8"></path>
                                <path d="M8 17h6"></path>
                            </svg>
                        </span>

                        <span class="sidebar-link-text">
                            Semua Pengajuan
                        </span>

                    </a>


                    <!-- APPROVAL -->
                    <a
                        href="{{ route('approvals.index') }}"
                        class="sidebar-link {{ request()->routeIs('approvals*') ? 'active' : '' }}">

                        <span class="sidebar-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M9 11l3 3L22 4"></path>
                                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                            </svg>
                        </span>

                        <span class="sidebar-link-text">
                            Approval
                        </span>

                    </a>


                    <!-- JENIS LAYANAN -->
                    <a
                        href="{{ route('administration-types.index') }}"
                        class="sidebar-link {{ request()->routeIs('administration-types*') ? 'active' : '' }}">

                        <span class="sidebar-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M4 4h16v16H4z"></path>
                                <path d="M8 8h8"></path>
                                <path d="M8 12h8"></path>
                                <path d="M8 16h5"></path>
                            </svg>
                        </span>

                        <span class="sidebar-link-text">
                            Jenis Layanan
                        </span>

                    </a>


                <!-- APPROVER -->
                @elseif(Auth::user()->isApprover())

                    <!-- APPROVAL -->
                    <a
                        href="{{ route('approvals.index') }}"
                        class="sidebar-link {{ request()->routeIs('approvals*') ? 'active' : '' }}">

                        <span class="sidebar-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M9 11l3 3L22 4"></path>
                                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                            </svg>
                        </span>

                        <span class="sidebar-link-text">
                            Verifikasi & Approval
                        </span>

                    </a>


                    <!-- REKAP -->
                    <a
                        href="{{ route('submissions.index') }}"
                        class="sidebar-link {{ request()->routeIs('submissions*') ? 'active' : '' }}">

                        <span class="sidebar-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M4 4h16v16H4z"></path>
                                <path d="M8 9h8"></path>
                                <path d="M8 13h8"></path>
                                <path d="M8 17h5"></path>
                            </svg>
                        </span>

                        <span class="sidebar-link-text">
                            Rekapitulasi Berkas
                        </span>

                    </a>


                    <!-- DIREKTORI -->
                    <a
                        href="{{ route('public.students') }}"
                        class="sidebar-link">

                        <span class="sidebar-icon">
                            <svg viewBox="0 0 24 24">
                                <circle cx="12" cy="8" r="4"></circle>
                                <path d="M4 21a8 8 0 0 1 16 0"></path>
                            </svg>
                        </span>

                        <span class="sidebar-link-text">
                            Direktori Siswa
                        </span>

                    </a>


                <!-- SISWA -->
                @else

                    <!-- RIWAYAT -->
                    <a
                        href="{{ route('submissions.index') }}"
                        class="sidebar-link {{ request()->routeIs('submissions.index') ? 'active' : '' }}">

                        <span class="sidebar-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M3 12a9 9 0 1 0 3-6.7"></path>
                                <path d="M3 4v6h6"></path>
                                <path d="M12 7v5l3 2"></path>
                            </svg>
                        </span>

                        <span class="sidebar-link-text">
                            Riwayat Permohonan
                        </span>

                    </a>


                    <!-- BUAT PENGAJUAN -->
                    <a
                        href="{{ route('submissions.create') }}"
                        class="sidebar-link {{ request()->routeIs('submissions.create') ? 'active' : 'special' }}">

                        <span class="sidebar-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M12 5v14"></path>
                                <path d="M5 12h14"></path>
                            </svg>
                        </span>

                        <span class="sidebar-link-text">
                            Buat Pengajuan Baru
                        </span>

                    </a>

                @endif

            </nav>

        </div>


        <!-- Sidebar Footer -->
        <div class="siakad-sidebar-footer">

            <div class="sidebar-user">

                <div class="sidebar-user-avatar">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>

                <div class="sidebar-user-info">

                    <div class="sidebar-user-name">
                        {{ Auth::user()->name }}
                    </div>

                    <div class="sidebar-user-email">
                        {{ Auth::user()->email }}
                    </div>

                </div>

            </div>


            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="sidebar-logout">

                    <svg viewBox="0 0 24 24">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <path d="M16 17l5-5-5-5"></path>
                        <path d="M21 12H9"></path>
                    </svg>

                    Keluar

                </button>

            </form>

        </div>

    </aside>


    <!-- =========================================================
         AREA UTAMA
    ========================================================== -->
    <div class="siakad-page">

        <!-- TOPBAR -->
        <header class="siakad-topbar">

            <div class="topbar-left flex items-center gap-3">

                <!-- Mobile Button -->
                <button
                    type="button"
                    class="mobile-sidebar-button"
                    onclick="openSidebar()"
                    aria-label="Buka menu">

                    <svg viewBox="0 0 24 24">
                        <path d="M4 6h16"></path>
                        <path d="M4 12h16"></path>
                        <path d="M4 18h16"></path>
                    </svg>

                </button>

                <div class="topbar-title">
                    SIAKAD Online
                </div>

            </div>


            <div class="topbar-user">

                <div class="topbar-user-name">
                    {{ Auth::user()->name }}
                </div>

                <div class="topbar-user-email">
                    {{ Auth::user()->email }}
                </div>

            </div>

        </header>


        <!-- MAIN CONTENT -->
        <main class="siakad-main">

            <!-- SUCCESS -->
            @if (session('status'))

                <div class="mb-6 bg-emerald-50 border border-emerald-200 rounded-xl p-4 text-emerald-800 font-semibold text-sm shadow-xs flex items-center justify-between">

                    <div>
                        <span class="font-bold uppercase tracking-wider text-xs mr-2">
                            [BERHASIL]
                        </span>

                        {{ session('status') }}
                    </div>

                </div>

            @endif


            <!-- ERROR -->
            @if (session('error'))

                <div class="mb-6 bg-rose-50 border border-rose-200 rounded-xl p-4 text-rose-800 font-semibold text-sm shadow-xs flex items-center justify-between">

                    <div>
                        <span class="font-bold uppercase tracking-wider text-xs mr-2">
                            [PERINGATAN]
                        </span>

                        {{ session('error') }}
                    </div>

                </div>

            @endif


            <!-- VALIDATION ERROR -->
            @if ($errors->any())

                <div class="mb-6 bg-rose-50 border border-rose-200 rounded-xl p-4 text-rose-800 text-sm shadow-xs">

                    <div class="font-bold uppercase tracking-wider text-xs mb-2">
                        [PERIKSA KEMBALI INPUTAN ANDA]
                    </div>

                    <ul class="list-disc list-inside space-y-1 text-xs">

                        @foreach ($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            {{ $slot }}

        </main>


        <!-- FOOTER -->
        <footer class="siakad-footer">

            <div class="siakad-footer-inner">

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


    <!-- =========================================================
         SIDEBAR SCRIPT
    ========================================================== -->
    <script>
        function openSidebar() {
            const sidebar = document.getElementById('siakadSidebar');
            const overlay = document.getElementById('sidebarOverlay');

            sidebar.classList.add('open');
            overlay.classList.add('open');

            document.body.style.overflow = 'hidden';
        }

        function closeSidebar() {
            const sidebar = document.getElementById('siakadSidebar');
            const overlay = document.getElementById('sidebarOverlay');

            sidebar.classList.remove('open');
            overlay.classList.remove('open');

            document.body.style.overflow = '';
        }

        window.addEventListener('resize', function () {
            if (window.innerWidth > 1023) {
                closeSidebar();
            }
        });
    </script>

</body>
</html>