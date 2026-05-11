<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin CMS') | Mosarindo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root { --sidebar: #111827; --accent: #dba554; }
        body { background: #f5f7fb; color: #111827; }
        .admin-shell { min-height: 100vh; }
        .admin-sidebar {
            width: 280px;
            background: var(--sidebar);
            color: #d1d5db;
            flex: 0 0 280px;
            transition: width .25s ease, flex-basis .25s ease, transform .25s ease;
        }
        .admin-sidebar .nav-link {
            color: #d1d5db;
            border-radius: 10px;
            padding: .75rem .9rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: .65rem;
            white-space: nowrap;
        }
        .admin-sidebar .nav-link i { width: 1.25rem; text-align: center; }
        .admin-sidebar .nav-link:hover,
        .admin-sidebar .nav-link.active {
            background: rgba(219, 165, 84, .16);
            color: #fff;
        }
        .brand-box {
            width: 42px;
            height: 42px;
            display: grid;
            place-items: center;
            border-radius: 12px;
            background: var(--accent);
            color: #fff;
        }
        .brand-text, .menu-label { transition: opacity .16s ease, width .2s ease; }
        .content-wrap {
            width: calc(100% - 280px);
            transition: width .25s ease;
        }
        .topbar { backdrop-filter: blur(12px); background: rgba(255, 255, 255, .88); }
        .sidebar-toggle {
            width: 44px;
            height: 44px;
            display: inline-grid;
            place-items: center;
        }
        body.sidebar-collapsed .admin-sidebar {
            width: 88px;
            flex-basis: 88px;
        }
        body.sidebar-collapsed .content-wrap { width: calc(100% - 88px); }
        body.sidebar-collapsed .admin-sidebar .brand-text,
        body.sidebar-collapsed .admin-sidebar .menu-label {
            width: 0;
            opacity: 0;
            overflow: hidden;
        }
        body.sidebar-collapsed .admin-sidebar .nav-link {
            justify-content: center;
            padding-left: .75rem;
            padding-right: .75rem;
        }
        body.sidebar-collapsed .admin-sidebar .nav-link i { margin-right: 0 !important; }
        body.sidebar-collapsed .admin-sidebar .brand-box { margin-inline: auto; }
        .stat-card, .admin-card {
            border: 1px solid #e5e7eb;
            box-shadow: 0 14px 40px rgba(15, 23, 42, .06);
            transition: transform .2s ease, box-shadow .2s ease;
        }
        .stat-card:hover, .admin-card:hover { transform: translateY(-2px); box-shadow: 0 18px 45px rgba(15, 23, 42, .09); }
        .table > :not(caption) > * > * { vertical-align: middle; }
        .media-thumb { width: 72px; height: 54px; object-fit: cover; border-radius: 10px; border: 1px solid #e5e7eb; }
        .place-items-center { place-items: center; }
        .fade-in { animation: fadeIn .35s ease both; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: translateY(0); } }
        @media (max-width: 991.98px) {
            .admin-sidebar {
                position: fixed;
                inset: 0 auto 0 0;
                z-index: 1050;
                width: min(84vw, 300px);
                flex-basis: auto;
                transform: translateX(-100%);
            }
            .admin-sidebar.show { transform: translateX(0); }
            .content-wrap { width: 100%; }
            .sidebar-backdrop { position: fixed; inset: 0; z-index: 1040; background: rgba(15,23,42,.5); display: none; }
            .sidebar-backdrop.show { display: block; }
            body.sidebar-collapsed .admin-sidebar {
                width: min(84vw, 300px);
                flex-basis: auto;
            }
            body.sidebar-collapsed .content-wrap { width: 100%; }
            body.sidebar-collapsed .admin-sidebar .brand-text,
            body.sidebar-collapsed .admin-sidebar .menu-label {
                width: auto;
                opacity: 1;
                overflow: visible;
            }
            body.sidebar-collapsed .admin-sidebar .nav-link {
                justify-content: flex-start;
                padding: .75rem .9rem;
            }
            body.sidebar-collapsed .admin-sidebar .brand-box { margin-inline: 0; }
        }
        @media (max-width: 575.98px) {
            .topbar-title { min-width: 0; }
            .topbar-title .small { display: none; }
        }
    </style>
    @stack('styles')
</head>
<body>
    @php
        $menus = [
            ['label' => 'Dashboard', 'route' => 'admin.dashboard', 'icon' => 'bi-speedometer2'],
            ['label' => 'Produk', 'route' => 'admin.products.index', 'icon' => 'bi-box-seam'],
            ['label' => 'Layanan', 'route' => 'admin.services.index', 'icon' => 'bi-briefcase'],
            ['label' => 'Galeri', 'route' => 'admin.gallery-items.index', 'icon' => 'bi-images'],
            ['label' => 'Beranda', 'route' => 'admin.home-pages.index', 'icon' => 'bi-house'],
            ['label' => 'Profil', 'route' => 'admin.about-pages.index', 'icon' => 'bi-building'],
            ['label' => 'Kontak', 'route' => 'admin.contact-pages.index', 'icon' => 'bi-telephone'],
        ];
    @endphp

    <div class="admin-shell d-flex">
        <aside class="admin-sidebar p-3" id="adminSidebar">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="brand-box"><i class="bi bi-grid-1x2-fill"></i></div>
                    <div class="brand-text">
                        <div class="fw-bold text-white">Mosarindo</div>
                        <div class="small text-secondary">Custom CMS</div>
                    </div>
                </div>
                <button class="btn btn-sm btn-outline-light d-lg-none" type="button" data-sidebar-close aria-label="Tutup sidebar">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>

            <nav class="nav flex-column gap-1">
                @foreach ($menus as $menu)
                    <a href="{{ route($menu['route']) }}" class="nav-link {{ request()->routeIs($menu['route']) || request()->routeIs(str_replace('.index', '.*', $menu['route'])) ? 'active' : '' }}" title="{{ $menu['label'] }}">
                        <i class="bi {{ $menu['icon'] }}"></i><span class="menu-label">{{ $menu['label'] }}</span>
                    </a>
                @endforeach
            </nav>
        </aside>
        <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

        <div class="content-wrap">
            <header class="topbar sticky-top border-bottom">
                <div class="d-flex align-items-center justify-content-between px-3 px-lg-4 py-3">
                    <div class="d-flex align-items-center gap-3">
                        <button class="btn btn-outline-secondary sidebar-toggle" type="button" data-sidebar-toggle aria-label="Buka tutup sidebar" aria-controls="adminSidebar" aria-expanded="false">
                            <i class="bi bi-list fs-4"></i>
                        </button>
                        <div class="topbar-title">
                            <h1 class="h5 mb-0 fw-bold">@yield('page_title', 'Dashboard')</h1>
                            <div class="small text-secondary">@yield('page_subtitle', 'Kelola konten website')</div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <a href="{{ route('home') }}" class="btn btn-light border d-none d-sm-inline-flex" target="_blank">
                            <i class="bi bi-box-arrow-up-right me-2"></i>Website
                        </a>
                        <div class="dropdown">
                            <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle me-sm-2"></i><span class="d-none d-sm-inline">{{ auth()->user()->name }}</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>

            <main class="p-3 p-lg-4 fade-in">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <div class="fw-bold mb-1">Periksa kembali input berikut:</div>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const sidebar = document.getElementById('adminSidebar');
        const backdrop = document.getElementById('sidebarBackdrop');
        const sidebarToggle = document.querySelector('[data-sidebar-toggle]');
        const mobileQuery = window.matchMedia('(max-width: 991.98px)');

        const setExpanded = (expanded) => {
            sidebarToggle?.setAttribute('aria-expanded', expanded ? 'true' : 'false');
        };

        const toggleMobileSidebar = (show) => {
            sidebar?.classList.toggle('show', show);
            backdrop?.classList.toggle('show', show);
            document.body.style.overflow = show ? 'hidden' : '';
            setExpanded(show);
        };

        const setDesktopCollapsed = (collapsed) => {
            document.body.classList.toggle('sidebar-collapsed', collapsed);
            localStorage.setItem('adminSidebarCollapsed', collapsed ? '1' : '0');
            setExpanded(! collapsed);
        };

        if (! mobileQuery.matches && localStorage.getItem('adminSidebarCollapsed') === '1') {
            document.body.classList.add('sidebar-collapsed');
        }

        sidebarToggle?.addEventListener('click', () => {
            if (mobileQuery.matches) {
                toggleMobileSidebar(! sidebar?.classList.contains('show'));
                return;
            }

            setDesktopCollapsed(! document.body.classList.contains('sidebar-collapsed'));
        });

        document.querySelector('[data-sidebar-close]')?.addEventListener('click', () => toggleMobileSidebar(false));
        backdrop?.addEventListener('click', () => toggleMobileSidebar(false));
        sidebar?.querySelectorAll('.nav-link').forEach((link) => {
            link.addEventListener('click', () => {
                if (mobileQuery.matches) {
                    toggleMobileSidebar(false);
                }
            });
        });

        mobileQuery.addEventListener('change', (event) => {
            toggleMobileSidebar(false);
            if (event.matches) {
                document.body.classList.remove('sidebar-collapsed');
                return;
            }

            document.body.classList.toggle('sidebar-collapsed', localStorage.getItem('adminSidebarCollapsed') === '1');
        });

        document.querySelectorAll('[data-confirm-delete]').forEach((form) => {
            form.addEventListener('submit', (event) => {
                if (! confirm('Hapus data ini? Data utama akan terhapus dari tabel.')) {
                    event.preventDefault();
                }
            });
        });

        document.querySelectorAll('[data-loading-form]').forEach((form) => {
            form.addEventListener('submit', () => {
                const button = form.querySelector('[type="submit"]');
                if (! button) return;
                button.disabled = true;
                button.dataset.originalText = button.innerHTML;
                button.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Menyimpan...';
            });
        });

        document.querySelectorAll('[data-add-row]').forEach((button) => {
            button.addEventListener('click', () => {
                const target = document.querySelector(button.dataset.addRow);
                const template = document.querySelector(button.dataset.template);
                if (! target || ! template) return;
                target.insertAdjacentHTML('beforeend', template.innerHTML);
            });
        });

        document.addEventListener('click', (event) => {
            const remove = event.target.closest('[data-remove-row]');
            if (remove) {
                remove.closest('[data-row]')?.remove();
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
