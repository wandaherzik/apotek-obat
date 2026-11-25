<nav class="app-header navbar navbar-expand">
    <div class="container-fluid">
        <!--begin::Start Navbar Links-->
        <ul class="navbar-nav align-items-center">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button" title="Buka/Tutup Sidebar">
                    <i class="bi bi-list"></i>
                </a>
            </li>
            <li class="nav-item d-none d-lg-block ms-2">
                <div class="navbar-live-clock">
                    <i class="bi bi-clock-history"></i>
                    <span id="navbarLiveClockText">Memuat waktu...</span>
                </div>
            </li>
        </ul>
        <!--end::Start Navbar Links-->

        <!--begin::End Navbar Links-->
        <ul class="navbar-nav ms-auto align-items-center gap-1 gap-md-2">
            <!-- Quick POS Kasir Action -->
            <li class="nav-item">
                <a href="{{ route('transaksi.index') }}" class="btn-quick-pos" title="Buka Transaksi Kasir">
                    <span class="pulse-indicator"></span>
                    <i class="bi bi-cart3"></i>
                    <span>Kasir POS</span>
                </a>
            </li>

            <!-- Dark / Light Mode Toggle -->
            <li class="nav-item">
                <button type="button" class="navbar-action-btn" id="themeToggleBtn" title="Ganti Tema Terang/Gelap">
                    <i class="bi bi-moon-stars-fill" id="themeToggleIcon" style="color: #087F5B;"></i>
                </button>
            </li>

            <!-- Fullscreen Toggle -->
            <li class="nav-item d-none d-sm-block">
                <button type="button" class="navbar-action-btn" data-lte-toggle="fullscreen" title="Layar Penuh">
                    <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                    <i data-lte-icon="minimize" class="bi bi-fullscreen-exit d-none"></i>
                </button>
            </li>

            <!--begin::User Menu Dropdown-->
            <li class="nav-item dropdown user-menu">
                <a href="#" class="navbar-user-btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="user-avatar-badge">
                        {{ strtoupper(substr(auth()->user()->nama ?? 'A', 0, 1)) }}
                    </div>
                    <span class="d-none d-md-inline fw-semibold" style="font-size: 0.88rem; color: #25352F;">
                        {{ auth()->user()->nama ?? 'Administrator' }}
                    </span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0">
                    <li class="dropdown-header text-center py-3">
                        <div class="user-avatar-badge mx-auto mb-2" style="width: 46px; height: 46px; font-size: 1.15rem;">
                            {{ strtoupper(substr(auth()->user()->nama ?? 'A', 0, 1)) }}
                        </div>
                        <h6 class="mb-1 fw-bold" style="color: #25352F;">
                            {{ auth()->user()->nama ?? 'Administrator' }}
                        </h6>
                        <span class="badge border px-2 py-1 rounded-pill" style="font-size: 0.75rem; background-color: #ebf9f3; color: #087F5B; border-color: rgba(32, 166, 122, 0.3) !important;">
                            <i class="bi bi-shield-check me-1"></i>{{ strtoupper(auth()->user()->role ?? 'ADMIN') }}
                        </span>
                    </li>

                    <li>
                        <a href="{{ route('dashboard') }}" class="dropdown-item">
                            <i class="bi bi-speedometer2" style="color: #087F5B;"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('transaksi.index') }}" class="dropdown-item">
                            <i class="bi bi-cart3" style="color: #20A67A;"></i>
                            Transaksi Kasir
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('obat.index') }}" class="dropdown-item">
                            <i class="bi bi-capsule-pill" style="color: #087F5B;"></i>
                            Katalog Obat
                        </a>
                    </li>

                    <li><hr class="dropdown-divider my-2"></li>

                    <li>
                        <form action="{{ route('logout') }}" method="POST" id="navbarLogoutForm">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger w-100 text-start border-0 bg-transparent">
                                <i class="bi bi-box-arrow-right text-danger"></i>
                                Keluar Sistem
                            </button>
                        </form>
                    </li>
                </ul>
            </li>
            <!--end::User Menu Dropdown-->
        </ul>
        <!--end::End Navbar Links-->
    </div>
</nav>
