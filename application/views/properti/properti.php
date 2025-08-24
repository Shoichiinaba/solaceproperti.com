<style>
.text-penawarann-properti.active {
    position: fixed;
    /* left: 4rem; */
    margin: 0px !important;
    background: #eef0f0;
    width: 100%;
    z-index: 5;
    top: 59px;
    display: block;
    padding: 14px 50px;
    transition: 300ms;
}
</style>

<main class="main-segment" id="">
    <section id="header" class="mt-5 p-3">
        <div class="text-penawarann-properti flex mt-3 mb-3">
            <i class="fa-solid fa-arrow-left btn-back"></i>
            <i id="text-url-aktif" class="text-ubuntu text-gray fz-text-penwaran text-align-center">
                Properti Dijual ~ Di Kota Semarang
            </i>
        </div>
        <div class="text-center">
            <img id="banner-penawaran" src="https://admin.solaceproperti.com/upload/banner/All_Properti.jpg"
                class="img-fluid banner-properti">

            <?php
        $segment2 = $this->uri->segment(2);
        if ($segment2 === 'takeover' || $segment2 === 'lelang'): ?>
            <div class="posi-btn-jualsewa">
                <button class="btn btn-penawaran dijual border-0 box-shadow font-weight-bold text-gray"
                    data-status_properti="Takeover" data-btn="">Take Over</button>
                <button class="btn btn-penawaran disewa border-0 box-shadow font-weight-bold text-gray"
                    data-status_properti="Lelang" data-btn="">Lelang</button>
            </div>
            <?php else: ?>
            <div class="posi-btn-jualsewa">
                <button class="btn btn-penawaran dijual border-0 box-shadow font-weight-bold text-gray"
                    data-penawaran="dijual" data-btn="">DiJual</button>
                <button class="btn btn-penawaran disewa border-0 box-shadow font-weight-bold text-gray"
                    data-penawaran="disewa" data-btn="">DiSewa</button>
            </div>
            <?php endif; ?>
        </div>
    </section>
    <section class=" content-fixed">
        <!-- <h1 class="text-center title-city font-weight-bold text-blue m-0"><?= preg_replace("![^a-z0-9]+!i", " ", $this->uri->segment(4)); ?> </h1> -->
        <ul id="ul-menu-left"
            class="ul-type-properti list-none justify-content-center mb-0 ul-trans-left ul-gap-type-properti"
            style="z-index:5;">

            <li id="li-rumah" class="text-webkit-center mx-w-li li-menu-properti" data-target="rumah">
                <div class="border-li-sm menu-li-properi i-home-sm"></div>
                <span class="font-weight-bold f-sz-li-porperti">Rumah</span>
            </li>

            <li id="li-perumahan" class="text-webkit-center mx-w-li li-menu-properti" data-target="perumahan">
                <div class="border-li-sm menu-li-properi i-perumahan-sm"></div>
                <span class="font-weight-bold f-sz-li-porperti">Perumahan</span>
            </li>

            <li id="li-ruko" class="text-webkit-center mx-w-li li-menu-properti" data-target="ruko">
                <div class="border-li-sm menu-li-properi i-ruko-sm"></div>
                <span class="font-weight-bold f-sz-li-porperti">Ruko</span>
            </li>

            <li id="li-kavling" class="text-webkit-center mx-w-li li-menu-properti" data-target="kavling">
                <div class="border-li-sm menu-li-properi i-kavling-sm"></div>
                <span class="font-weight-bold f-sz-li-porperti">Kavling</span>
            </li>

        </ul>
        <div class="wrapper">
            <div id="rollbox" class="rollNot">
                <div class="row mt-2">
                    <!-- <h5 class="tittle">Pilih Kota</h5> -->
                    <div class="col-12">
                        <div class="slider-wrapper slider-wrapper-city">
                            <ul id="load-data-kota-bottom" class="image-list swiper-gap-city p-0"
                                style="min-height: unset;">
                                <li class="img-item">
                                    <div class="card border li-city-none">
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
                </div>
            </div>
        </div>
    </section>
    <section class="main p-0" style="min-height: 44rem;" id="main-page" hidden>
        <section id="rumah" class="pt-0 pb-5">
            <div class="container">
                <div class="row">
                    <div class="d-flex justify-content-between text-align-center">
                        <h1 class="tittle">Rumah</h1>
                        <a href="#" class="spn-vw-all text-blue">Lihat Semua</a>
                    </div>
                </div>
                <div class="row">
                    <div class="slider-wrapper slider-wrapper-populer">
                        <ul id="load-data-rumah" class="image-list swiper-liproperty row">
                            <li class="img-item">
                                <div class="populer-container">
                                </div>
                            </li>
                        </ul>
                        <button class="prev-slide slide-button material-symbols-rounded box-shadow">
                            <i class="fa-solid fa-chevron-left"></i>
                        </button>
                        <button class="next-slide slide-button material-symbols-rounded box-shadow"
                            data-properti="rumah">
                            <i class="fa-solid fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
                <div class="row row-btn-vw-next text-center mt-4" data-properti="rumah">
                    <div class="col">
                        <a href="#" class="btn-blue">Lihat Selanjutnya</a>
                    </div>
                </div>
            </div>
        </section>

        <section id="perumahan" class="pt-0 pb-5">
            <div class="container">
                <div class="row">
                    <div class="d-flex justify-content-between text-align-center">
                        <h1 class="tittle">Perumahan</h1>
                        <a href="#" class="spn-vw-all text-blue">Lihat Semua</a>
                    </div>
                </div>
                <div class="row">
                    <div class="slider-wrapper slider-wrapper-populer">
                        <ul id="load-data-perumahan" class="image-list swiper-liproperty row">
                        </ul>
                        <button class="prev-slide slide-button material-symbols-rounded box-shadow">
                            <i class="fa-solid fa-chevron-left"></i>
                        </button>
                        <button class="next-slide slide-button material-symbols-rounded box-shadow"
                            data-properti="perumahan">
                            <i class="fa-solid fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
                <div class="row row-btn-vw-next text-center mt-4" data-properti="perumahan">
                    <div class="col">
                        <a href="#" class="btn-blue">Lihat Selanjutnya</a>
                    </div>
                </div>
            </div>
        </section>

        <section id="ruko" class="pt-0 pb-5">
            <div class="container">
                <div class="row">
                    <div class="d-flex justify-content-between text-align-center">
                        <h1 class="tittle">Ruko</h1>
                        <a href="#" class="spn-vw-all text-blue">Lihat Semua</a>
                    </div>

                </div>
                <div class="row">
                    <div class="slider-wrapper slider-wrapper-populer">
                        <ul id="load-data-ruko" class="image-list swiper-liproperty row">
                            <li class="img-item">
                                <div class="populer-container">
                                </div>
                            </li>
                        </ul>
                        <button class="prev-slide slide-button material-symbols-rounded box-shadow">
                            <i class="fa-solid fa-chevron-left"></i>
                        </button>
                        <button class="next-slide slide-button material-symbols-rounded box-shadow"
                            data-properti="ruko">
                            <i class="fa-solid fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
                <div class="row row-btn-vw-next text-center mt-4" data-properti="ruko">
                    <div class="col">
                        <a href="#" class="btn-blue">Lihat Selanjutnya</a>
                    </div>
                </div>
            </div>
        </section>

        <section id="kavling" class="pt-0 pb-5">
            <div class="container">
                <div class="row">
                    <div class="d-flex justify-content-between text-align-center">
                        <h1 class="tittle">Kavling</h1>
                        <a href="#" class="spn-vw-all text-blue">Lihat Semua</a>
                    </div>

                </div>
                <div class="row">
                    <div class="slider-wrapper slider-wrapper-populer">
                        <ul id="load-data-kavling" class="image-list swiper-liproperty row">
                            <li class="img-item">
                                <div class="populer-container">
                                </div>
                            </li>
                        </ul>
                        <button class="prev-slide slide-button material-symbols-rounded box-shadow">
                            <i class="fa-solid fa-chevron-left"></i>
                        </button>
                        <button class="next-slide slide-button material-symbols-rounded box-shadow"
                            data-properti="kavling">
                            <i class="fa-solid fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
                <div class="row row-btn-vw-next text-center mt-4" data-properti="kavling">
                    <div class="col">
                        <a href="#" class="btn-blue">Lihat Selanjutnya</a>
                    </div>
                </div>
            </div>
        </section>
    </section>
</main>