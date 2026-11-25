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
        width: 82%;
        height: 100vh;
        object-fit: cover;
        position: relative;
        left: -155px;
    }

    .text-desk-review {
        position: absolute;
        bottom: 34px;
        left: -48px;
        font-weight: 600 !important;
        font-size: 15px;
        padding: 12px 20px;
        border-radius: 3px;
        color: white !important;
        z-index: 10;
        width: 100%;
        display: block;
    }

    .resp-mobile {
        display: none !important;
    }

    .reel_container-review {
        position: relative;
        height: 100vh;
        width: auto;
        display: contents;
    }

    .videoContainer-rv {
        position: relative;
        width: fit-content;
        margin: auto;
    }

    .swiper-container-re-vi {
        height: 100vh;
    }

    .title-tayang,
    .title-new-proyek {
        font-size: 10px;
        color: white !important;
        margin-left: 6px;
    }

    .botleft {
        position: fixed;
        top: 2%;
        left: 9%;
        z-index: 9999;
    }

    .toprig {
        position: fixed;
        bottom: 97vh;
        top: 2%;
        left: 44%;
        z-index: 999999 !important;
    }

    .topleft {
        position: fixed;
        left: 1%;
        top: -14px;
        font-size: -webkit-xxx-large;
    }

    .bg-btn-back {
        color: #ffffff75;
        font-size: smaller;
    }

    .i-bg-orange {
        background: #064f43;
        padding: 5px 10px 4px 12px;
        border: 2px solid #ffe587fa;
        border-radius: 7px;
        color: #f97316;
        font-size: 30px;
    }

    .i-bg-white {
        background: #ffffff96;
        padding: 8px 14px 8px 14px;
        border-radius: 7px;
        color: #f97316;
        font-size: 27px;
    }

    .i-bg-white:hover+.ul-share-media,
    .ul-share-media:hover {
        display: flex;
        transition: 500ms;
    }

    .btn-share {
        position: fixed;
        top: 88%;
        left: 43%;
    }

    .btn-share-video {
        font-size: medium;
        font-weight: bold;
        color: #1a44b2;
        background: #d9d9d9;
        border: none;
        padding: 5px 12px 5px 5px;
        border-radius: 8px;
        font-family: 'Ubuntu';
    }

    .customControls {
        position: absolute;
        bottom: 14%;
        left: -60%;
        right: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
    }

    .customControls .seekBar {
        width: 100%;
        max-width: 250px;
    }

    .ul-share-media {
        background: #ffffff;
        border-radius: 10px;
        position: fixed;
        top: 69%;
        left: 3% !important;
        z-index: 7;
        padding: 13px 10px;
        left: 19rem;
        gap: 19px;
        display: none;
    }

    .span-text-share {
        font-size: 12px;
        font-family: 'ubuntu';
        margin-top: 6px;
    }

    .bg-i {
        background: #eef0f0;
        padding: 1px 14px;
        border-radius: 21px;
    }

    .btn-share-video:hover+.ul-share-media,
    .ul-share-media:hover {
        display: flex;
        transition: 500ms;
    }

    .i-btn-right-video {
        display: flex;
        position: absolute;
        bottom: 267%;
        left: 75%;
    }

}
</style>

<section id="home" class="container text-center pl-0 pr-0 mt-5">
    <div class="swiper-container-re-vi">
        <div id="load-data-video" class="swiper-wrapper">
            <!-- Video items akan di-load dari controller -->
        </div>

        <!-- Tombol navigasi -->
        <div class="custom-nav resp-mobile">
            <button class="btn-swiper-re-vi" id="prevBtn-re-vi">
                <i class="fa-solid fa-angle-up"></i>
            </button>
            <button class="btn-swiper-re-vi" id="nextBtn-re-vi">
                <i class="fa-solid fa-angle-down"></i>
            </button>
        </div>
    </div>

    <button id="fullscreen-btn" hidden>fullscreen</button>
</section>