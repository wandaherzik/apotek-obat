<!--begin::Sidebar-->
<aside class="app-sidebar shadow" data-bs-theme="dark">

    <!-- Brand -->
    <div class="sidebar-brand">
        <a href="{{ route('dashboard') }}" class="brand-link">
            <div class="brand-icon-wrapper">
                <i class="bi bi-capsule-pill"></i>
            </div>
            <div class="brand-title-group">
                <span class="brand-title">Apotek<span>Khadijah</span></span>
            </div>
        </a>
    </div>

    <!-- User Profile Snippet in Sidebar -->
    <div class="sidebar-user-card">
        <div class="sidebar-user-avatar">
            {{ strtoupper(substr(auth()->user()->nama ?? 'A', 0, 1)) }}
            <span class="status-indicator" title="Status: Online"></span>
        </div>
        <div class="sidebar-user-info">
            <span class="sidebar-user-name">{{ auth()->user()->nama ?? 'Administrator' }}</span>
            <span class="sidebar-user-role">
                <i class="bi bi-shield-check me-1"></i>{{ auth()->user()->role ?? 'Admin' }}
            </span>
        </div>
    </div>

    <!-- Real-Time Interactive Menu Search Filter -->
    <div class="sidebar-search-box">
        <div class="sidebar-search-inner">
            <i class="bi bi-search search-icon"></i>
            <input type="text" id="sidebarMenuSearch" placeholder="Cari menu sistem..." autocomplete="off">
            <button type="button" class="sidebar-search-clear" id="sidebarSearchClear" title="Hapus pencarian">
                <i class="bi bi-x-circle-fill"></i>
            </button>
        </div>
    </div>

    <!-- Sidebar Wrapper -->
    <div class="sidebar-wrapper">
        <nav class="mt-1">
            <ul
                class="nav sidebar-menu flex-column"
                data-lte-toggle="treeview"
                data-accordion="false">

                {{-- ================= Dashboard ================= --}}
                <li class="nav-item">
                    <a
                        href="{{ route('dashboard') }}"
                        class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-grid-1x2-fill"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                {{-- ================= Master Data ================= --}}
                <li class="nav-header">MANAJEMEN DATA</li>

                <li class="nav-item {{ request()->routeIs('kategori-obat.*','obat.*','batch-obat.*','satuan.*','konversi-satuan.*','user.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('kategori-obat.*','obat.*','batch-obat.*','satuan.*','konversi-satuan.*','user.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-box-seam-fill"></i>
                        <p>
                            Master Data
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a
                                href="{{ route('kategori-obat.index') }}"
                                class="nav-link {{ request()->routeIs('kategori-obat.*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-tags"></i>
                                <p>Kategori Obat</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a
                                href="{{ route('satuan.index') }}"
                                class="nav-link {{ request()->routeIs('satuan.*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-rulers"></i>
                                <p>Satuan</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a
                                href="{{ route('konversi-satuan.index') }}"
                                class="nav-link {{ request()->routeIs('konversi-satuan.*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-arrow-left-right"></i>
                                <p>Konversi Satuan</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a
                                href="{{ route('obat.index') }}"
                                class="nav-link {{ request()->routeIs('obat.*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-capsule-pill"></i>
                                <p>Data Obat</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a
                                href="{{ route('batch-obat.index') }}"
                                class="nav-link {{ request()->routeIs('batch-obat.*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-boxes"></i>
                                <p>Batch Obat</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a
                                href="{{ route('user.index') }}"
                                class="nav-link {{ request()->routeIs('user.*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-people-fill"></i>
                                <p>Manajemen User</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- ================= Persediaan ================= --}}
                <li class="nav-header">INVENTORY</li>

                <li class="nav-item {{ request()->routeIs('restok.*') ? 'menu-open' : '' }}">
                    <a
                        href="#"
                        class="nav-link {{ request()->routeIs('restok.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-archive-fill"></i>
                        <p>
                            Persediaan
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a
                                href="{{ route('restok.index') }}"
                                class="nav-link {{ request()->routeIs('restok.*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-plus-circle-dotted"></i>
                                <p>Restok Obat</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- ================= Transaksi ================= --}}
                <li class="nav-header">KASIR & PENJUALAN</li>

                <li class="nav-item {{ request()->routeIs('transaksi.*') ? 'menu-open' : '' }}">
                    <a
                        href="#"
                        class="nav-link {{ request()->routeIs('transaksi.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-cart-check-fill"></i>
                        <p>
                            Transaksi Kasir
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a
                                href="{{ route('transaksi.index') }}"
                                class="nav-link {{ request()->routeIs('transaksi.index') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-cart-plus"></i>
                                <p>
                                    Penjualan (POS)
                                    <span class="badge ms-auto" style="font-size: 0.65rem; padding: 0.2rem 0.5rem; background-color: #20A67A; color: #ffffff;">KASIR</span>
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a
                                href="{{ route('transaksi.riwayat') }}"
                                class="nav-link {{ request()->routeIs('transaksi.riwayat') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-clock-history"></i>
                                <p>Riwayat Transaksi</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- ================= Laporan ================= --}}
                <li class="nav-header">LAPORAN</li>

                <li class="nav-item">
                    <a
                        href="{{ route('laporan.index') }}"
                        class="nav-link {{ request()->routeIs('laporan.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-file-earmark-bar-graph-fill"></i>
                        <p>Laporan Penjualan</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

</aside>
<!--end::Sidebar-->
