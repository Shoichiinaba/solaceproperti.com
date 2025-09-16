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
<section id="home" class=" container text-center pl-0 pr-0 mt-5">
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