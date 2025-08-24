<style>
.footer {
    background-color: #002f2b;
    padding: 22px 0;
    color: white;
    font-family: 'Segoe UI', sans-serif;
}

.footer .logo {
    font-size: 28px;
    font-weight: bold;
    color: #f6d76f;
    display: block;
    margin-bottom: 20px;
}

.footer .footer-column h5 {
    font-size: 16px;
    font-weight: bold;
    color: white;
    margin-bottom: 15px;
}

.footer .footer-column ul {
    list-style: none;
    padding-left: 0;
    margin: 0;
}

.footer .footer-column ul li {
    margin-bottom: 10px;
}

.footer .footer-column ul li a {
    color: white;
    text-decoration: none;
    transition: color 0.3s;
}

.footer .footer-column ul li a:hover {
    color: #f6d76f;
}

#copyright {
    text-align: center;
    color: white;
    margin-top: 20px;
    padding-top: 20px;
    border-top: 1px solid rgba(255, 255, 255, 0.2);
    font-size: 14px;
}
</style>
<section id="footer" class="footer">
    <div class="container">
        <div class="row">
            <!-- Logo dan nama -->
            <div class="col-md-3 col-12 mb-4">
                <img src="<?= base_url('assets/img/logo/solace_logo.png'); ?>" alt="solaceproperti.com"
                    style="height: 60px;">
            </div>

            <!-- Kolom 1 -->
            <div class="col-md-3 col-6 footer-column">
                <h5>Perusahaan</h5>
                <ul>
                    <li><a href="#">Tentang Kami</a></li>
                    <li><a href="#">Produk & Layanan</a></li>
                    <li><a href="#">Partner</a></li>
                    <li><a href="#">Karir</a></li>
                    <li><a href="#">Pressroom</a></li>
                </ul>
            </div>

            <!-- Kolom 2 -->
            <div class="col-md-3 col-6 footer-column">
                <h5>Layanan</h5>
                <ul>
                    <li><a href="#">Iklankan Properti</a></li>
                    <li><a href="#">KPR</a></li>
                </ul>
            </div>

            <!-- Kolom 3 -->
            <div class="col-md-3 col-12 footer-column">
                <h5>Dukungan</h5>
                <ul>
                    <li><a href="#">Kebijakan</a></li>
                    <li><a href="#">Syarat Penggunaan</a></li>
                    <li><a href="#">Syarat Penggunaan Agen</a></li>
                </ul>
            </div>
        </div>

        <div id="copyright">
            &copy; 2025 Solace Properti. All Rights Reserved.
        </div>
    </div>
</section>