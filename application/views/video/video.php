<style>
    @media only screen and (min-width: 200px) and (max-width: 1024px) and (orientation: portrait) {

        header,
        footer {
            display: none;
        }

        section {
            padding: 0;
        }

        .reel-content-mobile {
            border-radius: 0;
        }

        .video-reel-mobile {
            width: 100%;
            height: 100vh;
            object-fit: cover;
        }


    }
</style>
<section id="home" class=" container text-center pl-0 pr-0">
    <div class="swiper-container-re-vi">
        <div id="load-data-video" class="swiper-wrapper">
            <!-- <div id="" class="swiper-wrapper"> -->

        </div>
        <div class="custom-nav resp-mobile">
            <button class="btn-swiper-re-vi" id="prevBtn-re-vi"><i class="fa-solid fa-angle-up"></i></button>
            <button class="btn-swiper-re-vi" id="nextBtn-re-vi"><i class="fa-solid fa-angle-down"></i></button>
        </div>
    </div>
    <button id="fullscreen-btn" hidden>fullscreen</button>
</section>

<!-- <?php for ($i = 1; $i <= 5; $i++) { ?> -->
<!-- <div class="swiper-slide swiper-slide-re-vi">
        <div class="reel_container-review">
            <div class="reel__content reel-content-mobile">
                <div class="videoContainer videoContainer-rv">
                    <video class="video video-reel-mobile" width="600" autoplay muted loop=1>
                        <source src="<?= base_url('upload/video/'); ?>baron-hardseling 2.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <div class="customControls">
                        <button class="playPauseBtn"><i class="fas fa-pause"></i></button>
                        <button class="muteBtn"><i class="fas fa-volume-mute"></i></button>
                        <input type="range" class="seekBar" value="0" min="0" max="100">
                    </div>
                </div>
            </div>
            <div class="text-desk-review">
                <H1 class="font-weight-bold text-blue resp-mobile">Griya Kanzu Caruban</H1>
                <p>Rumah Subsidi di Caruban, Madiun cuma Rp. 160 Jt. Buruan booking keburu habis</p>
                <a href="" class="text-blue font-weight-bold resp-mobile">Lihat Detail</a>
                <div class="card border box-shadow resp-mobile p-3">
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
                <div class="d-flex topleft align-items-baseline">
                    <a href="<?= base_url(); ?>">
                        <i class="bg-btn-back fa-solid fa-circle-arrow-left"></i>
                    </a>
                </div>
                <div class="d-flex toprig align-items-baseline">
                    <span class="bor-orange-vi-re box-shadow"><i class="fa-solid fa-thumbs-up"></i> Official Developer</span>
                </div>
                <div class="d-flex botleft align-items-baseline">
                    <span class=" bor-orange-vi-re box-shadow"> Proyek baru </span>
                    <span class="title-tayang main">Tayang sejak 24 November 2024</span>
                </div>
                <div class="i-btn-right-video align-items-baseline">
                    <ul class="d-grid gap-3 list-none">
                        <li>
                            <a href="'.base_url('Detail/perum/').'">
                                <span class="i-bg-orange box-shadow"><i class="bi bi-house-door"></i></span>
                            </a>
                        </li>
                        <li>
                            <span class="i-bg-white box-shadow"><i class="fa-solid fa-paper-plane"></i></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div> -->
<!-- <?php } ?> -->