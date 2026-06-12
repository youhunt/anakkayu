<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <div class="navbar-brand-box">
                <a href="<?= base_url('admin') ?>" class="logo logo-dark">
                    <span class="logo-sm"><strong>AK</strong></span>
                    <span class="logo-lg"><strong>AnakKayu</strong></span>
                </a>
                <a href="<?= base_url('admin') ?>" class="logo logo-light">
                    <span class="logo-sm text-white"><strong>AK</strong></span>
                    <span class="logo-lg text-white"><strong>AnakKayu</strong></span>
                </a>
            </div>
            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>
            <div class="d-none d-md-flex align-items-center ms-3">
                <span class="fw-semibold"><?= esc($title ?? 'Dashboard') ?></span>
            </div>
        </div>
        <div class="d-flex align-items-center gap-2">
            <a class="btn btn-sm btn-outline-secondary" href="<?= base_url() ?>" target="_blank" rel="noopener">Lihat Website</a>
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="d-none d-xl-inline-block ms-1"><?= esc(auth()->user()->username ?? 'Admin') ?></span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="<?= base_url('admin/settings') ?>"><i class="bx bx-wrench font-size-16 align-middle me-1"></i> Settings</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="<?= base_url('logout') ?>"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> Logout</a>
                </div>
            </div>
        </div>
    </div>
</header>
