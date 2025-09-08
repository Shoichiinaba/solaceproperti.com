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
    <div class="section-header pt-4 pb-2">
        <span><span class="font-auto size-50px">A</span><span class="font-auto size-30px">rticle</span></span>
    </div>
    <div class="container">

        <div class=" row">
            <div class="col-lg-9 col-12">
                <hr>

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
                    <button id="read-more" class="btn btn-xs btn-outline-info read-more-tag"> <i
                            class="bi bi-box-arrow-in-down"></i>
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