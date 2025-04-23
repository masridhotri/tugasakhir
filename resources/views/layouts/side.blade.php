<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="./index.html" class="brand-link">
            <!--begin::Brand Image-->
            <img src="../../dist/assets/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image opacity-75 shadow" />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">ecoBank</span>
            <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item menu-open">
                    <a href="{{ route('dashboard') }}" class="nav-link active">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @if (Auth::user()->role === 'admin')
                    <li class="nav-item menu-open">
                        <a href="{{ route('user.index') }}" class="nav-link active">
                            <i class="nav-icon bi bi-speedometer"></i>
                            <p>
                                user
                            </p>
                        </a>
                    </li>
                    <li class="nav-item menu-open">
                        <a href="{{ route('jenis.index') }}" class="nav-link active">
                            <i class="nav-icon bi bi-speedometer"></i>
                            <p>
                                jenis sampah
                            </p>
                        </a>
                    </li>
                    <li class="nav-item menu-open">
                        <a href="{{ route('tabungan.index') }}" class="nav-link active">
                            <i class="nav-icon bi bi-speedometer"></i>
                            <p>
                                tabungan
                            </p>
                        </a>
                    </li>
                    <li class="nav-item menu-open">
                        <a href="/first" class="nav-link active">
                            <i class="nav-icon bi bi-speedometer"></i>
                            <p>
                                riwayat
                            </p>
                        </a>
                    </li>
                @endif


                {{-- for operator --}}
                @if (Auth::user()->role === 'operator')
                    <li class="nav-item menu-open">
                        <a href="/enam" class="nav-link active">
                            <i class="nav-icon bi bi-speedometer"></i>
                            <p>
                                Riwayat pengambilan
                            </p>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->role === 'user')
                    <li class="nav-item menu-open">
                        <a href="/indexuser" class="nav-link active">
                            <i class="nav-icon bi bi-speedometer"></i>
                            <p>
                                Riwayat pengambilan
                            </p>
                        </a>
                    </li>
                    <li class="nav-item menu-open">
                        <a href="/saldouser" class="nav-link active">
                            <i class="nav-icon bi bi-speedometer"></i>
                            <p>
                                Riwayat mutasi
                            </p>
                        </a>
                    </li>
                @endif
            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
