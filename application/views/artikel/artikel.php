<style>
.btn-hrg-dash {
    font-size: smaller;
}

.text-nm-perum {
    font-size: medium;
}

.text-publishing,
.font-text-port {
    font-size: x-small;
    color: #a7a5a5;
}

.conten-berita-left {
    display: block;
}

.btn-tipe {
    font-size: 11px;
}

@media (max-width: 992px) {

    .conten-berita-left {
        display: none;
    }

    .text-nm-perum {
        font-size: 11px;
    }

    .btn-hrg-dash {
        font-size: x-small;
    }
}

/* pagination stile */
@-webkit-keyframes placeHolderShimmer {
    0% {
        background-position: -468px 0;
    }

    100% {
        background-position: 468px 0;
    }
}

@keyframes placeHolderShimmer {
    0% {
        background-position: -468px 0;
    }

    100% {
        background-position: 468px 0;
    }
}

.content-placeholder {
    display: inline-block;
    -webkit-animation-duration: 400ms;
    animation-duration: 900ms;
    -webkit-animation-fill-mode: forwards;
    animation-fill-mode: forwards;
    -webkit-animation-iteration-count: infinite;
    animation-iteration-count: infinite;
    -webkit-animation-name: placeHolderShimmer;
    animation-name: placeHolderShimmer;
    -webkit-animation-timing-function: linear;
    animation-timing-function: linear;
    background: #f6f7f8;
    background: -webkit-gradient(linear, left top, right top, color-stop(8%, #eeeeee), color-stop(18%, #dddddd), color-stop(33%, #eeeeee));
    background: -webkit-linear-gradient(left, #eeeeee 8%, #dddddd 18%, #eeeeee 33%);
    background: linear-gradient(to right, #eeeeee 8%, #dddddd 18%, #eeeeee 33%);
    -webkit-background-size: 800px 104px;
    background-size: 800px 104px;
    height: inherit;
    position: relative;
}
</style>

<section class="pt-5 mt-3" id="berita">
    <div class="section-header artikel">

        <span><span class="font-auto size-50px">A</span><span class="font-auto size-30px">rtikel</span></span>
    </div>
    <div class="container">
        <div class=" row">
            <div class="col-lg-9 col-12">
                <div class="row">
                    <!-- artikel samping kiri -->
                    <div class="col-lg-3 col-4 p-1">
                        <?php foreach ($data_berita_left as $data):
                            $judul_berita = $data['judul_berita'];
                            $tittle_news = preg_replace("![^a-z0-9]+!i", "-", $judul_berita);
                        ?>
                        <div class="card mb-4 shadow-sm border-0 overflow-hidden rounded-3 position-relative">
                            <a class="text-dark add-view-news text-decoration-none d-block"
                                href="<?= base_url('Artikel/page/' . $tittle_news); ?>"
                                data-id-berita="<?= $data['id_berita']; ?>">

                                <img src="https://admin.solaceproperti.com/upload/article/<?= $data['foto_berita']; ?>"
                                    class="card-img-top img-fluid"
                                    style="border-top-left-radius: 0.75rem; border-top-right-radius: 0.75rem;"
                                    alt="<?= $data['judul_berita']; ?>">

                                <!-- min-height dihapus supaya fleksibel -->
                                <div class="card-body p-3 d-flex flex-column">
                                    <h6 class="mb-1 fw-bold"
                                        style="color:#fa7516; font-size:9px; margin-left:-13px; margin-top:-12px;">
                                        <?= date("d F Y", strtotime($data['tgl_berita'])); ?>
                                    </h6>
                                    <h6 class="tittle-news resp-tittle"><?= $data['judul_berita']; ?></h6>
                                    <div class="mt-auto text-end" style="margin-right: -9px; margin-bottom: -9px;">
                                        <span class="badge px-2 py-1"
                                            style="background:#fa7516; border-radius:0.5rem; color:#fff;">
                                            <?= $data['view_berita']; ?> views
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <!-- akhir artikel kiri -->

                    <!-- artikel utama -->
                    <div class="col-lg-9 col-8 p-1">
                        <?php
                        foreach ($data_berita_center as $data) {
                            $judul_berita = $data['judul_berita'];
                            $tittle_news = preg_replace("![^a-z0-9]+!i", "-", $judul_berita);
                        ?>
                        <a class="text-dark add-view-news" href="<?= base_url('Artikel/page/' . $tittle_news); ?>"
                            data-id-berita="<?= $data['id_berita']; ?>">
                            <img src="https://admin.solaceproperti.com/upload/article/<?= $data['foto_berita']; ?>"
                                class="img-fluid border-radius img-berita" alt="<?= $data['judul_berita']; ?>">
                            <h3 style="font-family: auto;"><?= $data['judul_berita']; ?></h3>
                        </a>
                        <?php } ?>
                    </div>
                    <!-- akhir artikel utama -->

                </div>
                <hr>
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
                <hr>
                <!-- tampil tag -->
                <span id="tag">
                    <span style="font-weight: bold;font-family: 'Poppins';"> TAG :</span>
                    <ul>
                        <?php
                        foreach ($data_tag as $tag_berita => $articles) :
                            $tag = preg_replace("![^a-z0-9]+!i", "-", $tag_berita);
                        ?>
                        <li class="btn-tag tag" style="display: inline-block;">
                            <a href="<?php echo base_url('Artikel/tag/') . $tag; ?>">
                                <?php echo htmlspecialchars($tag_berita); ?>
                            </a>
                        </li>
                        <?php
                        endforeach;
                        ?>

                    </ul>
                </span>
                <!-- akhir tag -->
            </div>
            <div class="col-lg-3 col-12">
                <!-- properti -->
                <?= $properti; ?>
                <!-- end properti -->
                <div class="row mt-3">
                    <div class="col">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>