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
                    <div class="col-lg-3 col-4">
                        <?php
                        $no = 3;
                        foreach ($data_berita_left as $data) {
                            $judul_berita = $data['judul_berita'];
                            $tittle_news = preg_replace("![^a-z0-9]+!i", "-", $judul_berita);
                        ?>
                        <a class="text-dark add-view-news"
                            href="<?php echo base_url('Artikel'); ?>/page/<?php echo $tittle_news; ?>"
                            data-id-berita="<?php echo $data['id_berita']; ?>">
                            <img src="https://admin.kanpa.co.id/upload/article/<?php echo $data['foto_berita']; ?>"
                                class="img-fluid border-radius img-berita" alt="red sample">
                            <h6 class="text-publishing"><?php echo $data['tgl_berita']; ?></h6>
                            <h6 class="tittle-news resp-tittle"><?php echo $data['judul_berita']; ?></h6>
                            <h6 class="font-text-port"><?php echo $data['view_berita']; ?> views</h6>
                        </a>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="col-lg-9 col-8">
                        <?php
                        $no = 3;
                        foreach ($data_berita_center as $data) {
                            $judul_berita = $data['judul_berita'];
                            $tittle_news = preg_replace("![^a-z0-9]+!i", "-", $judul_berita);
                        ?>
                        <a class="text-dark add-view-news"
                            href="<?php echo base_url('Artikel'); ?>/page/<?php echo $tittle_news; ?>"
                            data-id-berita="<?php echo $data['id_berita']; ?>">
                            <img src="https://admin.kanpa.co.id/upload/article/<?php echo $data['foto_berita']; ?>"
                                class="img-fluid border-radius img-berita"
                                data-id-berita="<?php echo $data['id_berita']; ?>" alt="red sample">
                            <h3 style="font-family: auto;"><?php echo $data['judul_berita']; ?></h3>
                        </a>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <hr>
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