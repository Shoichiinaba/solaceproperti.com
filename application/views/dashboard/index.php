<main id="main">
    <section id="home" class="mt-4">
        <div class="swiper-container-banner">
            <div class="swiper">
                <div id="banner-full" class="swiper-wrapper">
                    <!-- Swiper slides -->
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-prev btn-swiper-banner"></div>
                <div class="swiper-button-next btn-swiper-banner"></div>
            </div>
            <div class="search-overlay p-0">
                <div class="search-box">
                    <div class="search-tabs">
                        <span class="tab active" data-tab="beli">Hunian Impian</span>
                        <span class="tab" data-tab="sewa">Sewa Properti</span>
                    </div>

                    <div class="search-input-group" id="tab-beli">
                        <input type="text" placeholder="Cari Rumah Impian Anda, Contoh: Rumah, Perumahan, Ruko, Tanah">
                    </div>

                    <div class="search-input-group" id="tab-sewa" style="display:none;">
                        <input type="text" placeholder="Cari Properti Sewa, Contoh: Rumah, Perumahan, Ruko, Tanah">
                    </div>

                    <div class="search-footer">
                        <div>
                            <strong>Temukan Hunian Impian Anda, Di Sini!!</strong><br>
                            <small>Dapatkan Estimasi Harga Properti Secara Gratis, Cepat & Akurat Dalam Hitungan
                                Menit</small>
                        </div>
                        <button class="btn-valuation">Cek Nilai Properti</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="container pt-0">
        <div class="mt-4 m-2 row">
            <ul class="ul-lans col-sm-6 col-lg-12">
                <li class="text-webkit-center mx-w-li mb-4">
                    <a href="<?= base_url('Properti/jualsewa/rumah/'); ?>">
                        <div class="border-li bi i-home"></div>
                        <span class="font-weight-bold text-black f-sz-li-porperti">Cari Agent</span>
                    </a>
                </li>
                <li class="text-webkit-center mx-w-li mb-4">
                    <a href="https://wa.me/6283842901775?text=Hallo%20Solace Properti%2C%20Saya%20ingin%20Iklan%20%20properti%20saya%20..."
                        target="_blank">
                        <div class="border-li i-perumahan"></div>
                        <span class="font-weight-bold text-black f-sz-li-porperti">Iklan Properti</span>
                    </a>
                </li>
                <li class="text-webkit-center mx-w-li mb-4">
                    <a href="<?= base_url('Properti/jualsewa/'); ?>">
                        <div class="border-li i-ruko"></div>
                        <span class="font-weight-bold text-black f-sz-li-porperti">Jual Propertimu</span>
                    </a>
                </li>
                <li class="text-webkit-center mx-w-li mb-4">
                    <a href="<?= base_url('Properti/dijual/'); ?>#dijual">
                        <div class="i-kavling border-li"></div>
                        <span class="font-weight-bold text-black f-sz-li-porperti">Carikan Properti</span>
                    </a>
                </li>
                <li class="text-webkit-center mx-w-li mb-4">
                    <a href="<?= base_url('Simulasi_KPR'); ?>">
                        <div class="i-simulasi border-li"></div>
                        <span class="font-weight-bold text-black f-sz-li-porperti">Simulasi KPR</span>
                    </a>
                </li>
                <li class="text-webkit-center mx-w-li mb-4">
                    <a href="<?= base_url('Properti/takeover/'); ?>#dijual">
                        <div class="i-titip-jual border-li"></div>
                        <p class="font-weight-bold text-black f-sz-li-porperti mb-0">Pindah KPR</p>
                        <span class="font-weight-bold text-black f-sz-li-porperti mt-0">(Take Over)</span>
                    </a>
                </li>
                <li class="text-webkit-center mx-w-li mb-4">
                    <a href="<?= base_url('Properti/dijual/perumahan/'); ?>#dijual">
                        <div class="i-lelang border-li"></div>
                        <span class="font-weight-bold text-black f-sz-li-porperti">Aset Lelang Bank</span>
                    </a>
                </li>
            </ul>
        </div>
    </section>

    <section class="pt-0 pb-4">
        <div class="container pt-1">
            <div class="row">
                <div class="d-flex justify-content-between text-align-center">
                    <h1 class="tittle text-dark">Terpopuler</h1>
                    <a href="#" class="spn-vw-all text-blue">Lihat Semua</a>
                </div>
            </div>
            <div class="row mt-3">
                <div class="slider-wrapper slider-wrapper-populer">
                    <ul id="load-data-properti-populer" class="image-list swiper-liproperty row">
                        <li class="img-item">
                            <div class="populer-container">
                            </div>
                        </li>
                    </ul>
                    <button class="prev-slide slide-button material-symbols-rounded box-shadow">
                        <i class="fa-solid fa-chevron-left"></i>
                    </button>
                    <button class="next-slide slide-button material-symbols-rounded box-shadow">
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
                </div>
            </div>
            <div class="row row-btn-vw-next text-center mt-0">
                <div class="col">
                    <a href="#" class="btn-lanjut">Lihat Selanjutnya</a>
                </div>
            </div>
        </div>
    </section>
    <section class="sec-video m-0 bg-green-dark">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-12 text-light text-align-center">
                    <div class="d-flex justify-content-between text-align-center">
                        <h1 class="font-weight-bold"></h1>
                        <a href="<?= base_url('Video/review/'); ?>">
                            <span class="spn-vw-all">Lihat Semua</span>
                        </a>
                    </div>
                    <p class="p-desk-v">
                        Yuk Temukan Property Impian Anda!!!
                    </p>
                </div>
                <div class="col-lg-8 col-md-8 col-12">
                    <div class="slider-wrapper slider-wrapper-reels">
                        <ul id="load-data-video-populer" class="image-list p-0">
                            <li class="img-item">
                                <div class="reel__container">
                                    <div class="reel__content">
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <button class="prev-slide slide-button material-symbols-rounded">
                            <i class="fa-solid fa-chevron-left"></i>
                        </button>
                        <button class="next-slide slide-button material-symbols-rounded">
                            <i class="fa-solid fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pb-4">
        <div class="container">
            <div class="row">
                <div class="text-align-center">
                    <div class="d-flex justify-content-between align-items-center mb-0">
                        <h1 class="tittle text-dark mb-0 title-populer">Daftar Properti Terbaru</h1>
                        <a href="#" class="spn-vw-all text-blue">Lihat Semua</a>
                    </div>
                    <p class="p-desk-v text-dark mt-0">
                        Cari Hunian Impian Anda, Dari rumah hingga Apartemen mewah.
                    </p>
                </div>
            </div>
            <div class="row mt-3">
                <div class="slider-wrapper slider-wrapper-populer">
                    <ul id="load-data-properti-terbaru" class="image-list swiper-liproperty row">
                        <li class="img-item">
                            <div class="populer-container">
                            </div>
                        </li>
                    </ul>
                    <button class="prev-slide slide-button material-symbols-rounded box-shadow">
                        <i class="fa-solid fa-chevron-left"></i>
                    </button>
                    <button class="next-slide slide-button material-symbols-rounded box-shadow">
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
                </div>
            </div>
            <div class="row row-btn-vw-next text-center mt-0">
                <div class="col">
                    <a href="#" class="btn-lanjut">Lihat Selanjutnya</a>
                </div>
            </div>
        </div>
    </section>

    <section class="pb-4 pt-1">
        <div class="container">
            <div class="row">
                <div class="text-align-center">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h1 class="tittle text-dark mb-0">Jurnal Solace Property</h1>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <!--Berita artikel infinity scrool-->
                <div id="load_data" class="row">
                    <!-- data pagination -->
                    <br />
                    <br />
                    <!-- akhir data pagination -->
                </div>
                <div id="load_data_message"></div>
                <div class="text-center mt-3">
                    <button id="read-more-art" class="btn btn-xs btn-outline-info"> <i
                            class="bi bi-box-arrow-in-down"></i>
                        Read More</button>
                </div>
                <!-- end berita -->
            </div>
        </div>
    </section>
</main>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const tabs = document.querySelectorAll(".search-tabs .tab");
    const inputBeli = document.querySelector("#tab-beli input");
    const inputSewa = document.querySelector("#tab-sewa input");
    const searchButton = document.querySelector(".btn-valuation");

    let activeTab = "beli";

    // === Fungsi pindah tab ===
    tabs.forEach(tab => {
        tab.addEventListener("click", function() {
            tabs.forEach(t => t.classList.remove("active"));
            this.classList.add("active");
            activeTab = this.dataset.tab;

            if (activeTab === "beli") {
                document.getElementById("tab-beli").style.display = "block";
                document.getElementById("tab-sewa").style.display = "none";
            } else {
                document.getElementById("tab-beli").style.display = "none";
                document.getElementById("tab-sewa").style.display = "block";
            }
        });
    });

    // === Fungsi tombol search ===
    searchButton.addEventListener("click", function() {
        let keyword = activeTab === "beli" ? inputBeli.value.trim().toLowerCase() : inputSewa.value
            .trim().toLowerCase();

        // Map keyword ke kategori
        let kategori = "properti";
        if (["rumah"].includes(keyword)) kategori = "rumah";
        else if (["perumahan"].includes(keyword)) kategori = "perumahan";
        else if (["ruko"].includes(keyword)) kategori = "ruko";
        else if (["tanah", "kavling"].includes(keyword)) kategori = "kavling";

        // Redirect sesuai tab
        if (activeTab === "beli") {
            window.location.href = "/properti/dijual_search/" + kategori;
        } else {
            window.location.href = "/properti/disewa_search/" + kategori;
        }
    });
});
</script>