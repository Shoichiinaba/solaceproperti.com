<header id="header" class="header fixed-top"
    style="background: url('<?= base_url('assets/img/background_head.jpg'); ?>') no-repeat center center; background-size: cover; color: #f6d76f; z-index: 999; padding: 0;">

    <div class="container py-4">
        <!-- Baris atas: logo kiri, akun kanan -->
        <div class="d-flex justify-content-between align-items-center">
            <!-- Logo -->
            <a href="<?= base_url(); ?>#home" class="logo d-flex align-items-center">
                <img src="<?= base_url('assets/img/logo/solace_logo.png'); ?>" alt="Logo" class="size-logo-nav">
            </a>
            <!-- style="height: 60px;" -->
            <!-- Akun -->
            <div class="akun-menu d-none d-lg-flex align-items-center">
                <a href="https://admin.solaceproperti.com/">
                    <img src="<?= base_url('assets/img/icons/user.png'); ?>" alt="Akun" class="akun-icon">
                    <span class="akun-text">Akun</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Navbar dengan full-width background -->
    <div class="navbar-wrapper">
        <div class="container">
            <nav class="navbar">
                <ul class="d-flex gap-4 mb-0">
                    <li><a class="nav-link scrollto" href="<?= base_url('Properti/dijual/'); ?>#dijual">Dijual</a></li>
                    <li><a class="nav-link scrollto" href="<?= base_url('Properti/disewa/'); ?>#disewa">Disewa</a></li>
                    <li><a class="nav-link scrollto"
                            href="<?= base_url('Properti/proyek_baru/perumahan/'); ?>#proyek_baru">Proyek Baru</a></li>
                    <li><a class="nav-link scrollto" href="<?= base_url('Simulasi_KPR'); ?>#kpr">KPR</a></li>
                    <li><a class="nav-link scrollto" href="<?= base_url('Artikel'); ?>#artikel">Artikel</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle d-none"></i>
            </nav>
        </div>
    </div>
</header>