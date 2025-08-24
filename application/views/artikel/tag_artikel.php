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
        -webkit-animation-duration: 1s;
        animation-duration: 1s;
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
<section class="pt-5 mt-3" id="">
    <div class="section-header">
        <span><span class="font-auto size-50px">A</span><span class="font-auto size-30px">rticle</span></span>
    </div>
    <div class="container">

        <div class=" row">
            <div class="col-lg-9 col-12">
                <hr>
                <!-- <div class="row">
                    <?php
                    $no = 3;
                    foreach ($data_berita_tag as $data) {
                        $judul_berita = $data->judul_berita;
                        $tittle_news = preg_replace("![^a-z0-9]+!i", "-", $judul_berita);
                    ?>
                    <div class="col-lg-6 col-12 " data-aos="zoom-in" data-aos-delay="<?php echo $no++; ?>00">
                        <div class="border-radius">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-4">
                                    <div class="form-group">
                                        <a class="text-dark add-view-news"
                                            href="<?php echo base_url('Artikel'); ?>/page/<?php echo $tittle_news; ?>"
                                            data-id-berita="<?php echo $data->id_berita; ?>">
                                            <img src="<?php echo base_url('upload'); ?>/<?php echo $data->foto_berita; ?>"
                                                class="img-fluid p-1 border-radius img-berita"
                                                data-id-berita="<?php echo $data->id_berita; ?>" alt="red sample">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-8 col-8">
                                    <a class="text-dark add-view-news"
                                        href="<?php echo base_url('Artikel'); ?>/page/<?php echo $tittle_news; ?>"
                                        data-id-berita="<?php echo $data->id_berita; ?>">
                                        <h6 class="text-publishing"><?php echo $data->tgl_berita; ?></h6>
                                        <h6 class="tittle-news"><?php echo $data->judul_berita; ?></h6>
                                        <h6 class="font-text-port"><?php echo $data->view_berita; ?> views</h6>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div> -->
                <!--Berita artikel infinity scrool-->
                <?php
                $tag = $this->uri->segment(3);
                $tag_berita = preg_replace("![^a-z0-9]+!i", " ", $tag);
                ?>
                <input type="text" id="tag-berita" value="<?= $tag_berita; ?>" hidden>
                <div id="load_data_tag" class="row">
                    <!-- data pagination -->
                    <br />
                    <br />
                </div>
                <!-- akhir data pagination -->
                <div id="load_data_message"></div>
                <div class="text-center mt-3">
                    <button id="read-more" class="btn btn-xs btn-outline-info"> <i class="bi bi-box-arrow-in-down"></i>
                        Read More</button>
                </div>
                <!-- end berita -->
                <hr>
                <!-- tampilan Tag -->
                <span id="tag">
                    <span style="font-weight: bold;font-family: 'Poppins';"> TAG :</span>
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
                </span>
                <!-- Takhir tampilan tag -->
            </div>
            <div class="col-lg-3 col-12">
                <div class="row gy-1">
                    <?= $properti; ?>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <center>
                            <a href="<?php echo base_url('Produk'); ?>#produk">
                                <button type="button" id="" class="btn btn-sm btn-outline-info"
                                    style="font-size: 18px;">
                                    <i class="fa-brands fa-product-hunt"></i> Lihat Produk Lainnya >>
                                </button>
                            </a>
                        </center>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>