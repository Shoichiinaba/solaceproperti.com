<style>
    
</style>
<section id="home" class=" text-center bg-pg-marketing">
    <div class="container posit-pg-marketing">
        <div class="row frame-marketing place-items-center">
            <div class="col-lg-4 col-12 d-flex text-align-center">
                <img src="https://kanpa.co.id/upload/0a7970f0cf26d2603a626d489036cc64.png" class="img-marketing-lar">
                <ul class="ul-marketing mb-0">
                    <li>
                        <h2 class="font-weight-bold">Ziha Zizi</h2>
                    </li>
                    <li class="f-x-small">
                        Kanpa Ace
                    </li>
                    <li class="f-x-small">
                        (Poperty Advisor)
                    </li>
                    <li>
                        <h6 class="font-weight-bold text-blue mt-2">Ungaran Barat</h6>
                    </li>
                </ul>
            </div>
            <div class="col-lg-4 col-12">
                <ul class="p-0">
                    <li class="d-inline-block" style="margin-bottom: 1rem;">
                        <ul class="p-0 d-flex list-none ">
                            <li class="text-center border-listing">
                                <h4 class="font-weight-bold text-blue mb-0">23</h4>
                                <span class="f-x-small">Listing Jual</span>
                            </li>
                            <li class="text-center border-listing">
                                <h4 class="font-weight-bold text-blue mb-0">23</h4>
                                <span class="f-x-small">Listing Sewa</span>
                            </li>
                        </ul>
                    </li>
                    <li class="d-inline-block" style="margin-bottom: 1rem;">
                        <ul class="p-0 d-flex list-none">
                            <li class="text-center li-bor-icon li-bg-icon-mess">
                                <i class="bi bi-messenger"></i>
                            </li>
                            <li class="text-center li-bor-icon li-bg-icon-gmail">
                                <i class="bi bi-envelope"></i>
                            </li>
                            <li class="text-center li-bor-icon li-bg-icon-wa">
                                <i class="bi bi-whatsapp"></i>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="col-4">
                <img src="<?= base_url('upload/test/'); ?>bit.ly_48dELSR.png" class="img-fluid" style="width: 9rem;">
            </div>
        </div>
        <div class="row mt-5">
            <h1 class="tittle">Properti yang Ditawarkan</h1>
        </div>
        <div class="row mt-3">
            <div class="slider-wrapper slider-wrapper-populer">
                <ul class="image-list p-3">
                    <?php for ($i = 1; $i <= 15; $i++) { ?>
                        <li class="img-item">
                            <div class="populer-container">
                                <div class="populer-content">
                                    <img src="<?= base_url('upload'); ?>/test/ATH.jpg" class="img-produk-sw">
                                </div>
                                <div class="box-detail bg-light p-2">
                                    <span class="title-new-proyek">PROYEK BARU</span>
                                    <span class="title-tayang">Tayang sejak 24 November 2024</span>
                                    <h3 class="title-price">Rp 700 Jt</h3>
                                    <h5 class="font-weight-bold">Alton Town House</h5>
                                    <h6 class="font-weight-bold title-address"><i class="bi bi-geo-alt"></i> Sisemut, Ungaran Barat</h6>
                                    <ul class="d-flex ul-detail mt-3">
                                        <li><span class="font-weight-bold">LT</span> : 120 m2</li>
                                        <li><span class="font-weight-bold">LT</span> : 140 m2</li>
                                        <li><span class="font-weight-bold">KT</span> : 4</li>
                                        <li><span class="font-weight-bold">Km</span> : 2</li>
                                    </ul>
                                    <hr>
                                    <div class="d-flex kontakas">
                                        <img src="https://kanpa.co.id/upload/0a7970f0cf26d2603a626d489036cc64.png" class="img-marketing">
                                        <div class="d-block">
                                            <h5 class="font-weight-bold m-0">Ziha Zizi</h5>
                                            <p class="small m-0">Ungaran Barat</p>
                                        </div>
                                        <i class="bi bi-whatsapp i-wa-marketing"></i>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php } ?>
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
</section>