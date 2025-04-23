<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="./index.html" class="brand-link">
            <!--begin::Brand Image-->
            <img src="../../dist/assets/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image opacity-75 shadow" />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">AdminLTE 4</span>
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

                <li class="nav-item menu-open">
                    <a href="/lima" class="nav-link active">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>
                            pengambila operator
                        </p>
                    </a>
                </li>
                <li class="nav-item menu-open">
                    <a href="/tiga" class="nav-link active">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>
                            request sampah
                        </p>
                    </a>
                </li>
            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
