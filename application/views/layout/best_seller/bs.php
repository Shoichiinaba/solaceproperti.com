<div class="main-bs " data-aos="fade-up">
    <div class="container-bs">
        <div class="swiper-container-bs">
            <div class="swiper-wrapper">
                <!-- <div class="" src="https://source.unsplash.com/1280x720/?nature" alt="Image Slider"> -->
                <?php
                $sql = "SELECT* FROM perum WHERE status_perum='Direkomendasikan' ORDER BY order_perum ASC";
                $query = $this->db->query($sql);
                if ($query->num_rows() > 0) {
                    foreach ($query->result() as $data) :

                        $id_perum = $data->id_perum;
                        $nm_perum = $data->nm_perum;
                        $tittle = preg_replace("![^a-z0-9]+!i", "-", $nm_perum);
                        // echo $tittle;
                        $nm = preg_replace("![^a-z0-9]+!i", " ", $tittle);
                ?>
                        <div class="swiper-slide">
                            <div class="card-image">
                                <div class="img-swiper-bs" data-aos="zoom-in" data-aos-delay="200">
                                    <div class="service-item" style="background: #d3d3d317;border-radius: 6px;">
                                        <?php
                                        $total_view = 0;
                                        $sql = "SELECT foto_tipe, id_tipe, promo, luas_bangunan, luas_tanah, view_tipe FROM foto, tipe WHERE foto.id_foto_tipe=tipe.id_tipe AND tipe.id_tipe_perum = $id_perum AND foto.label_foto='display' ORDER BY  RAND() limit 1";
                                        $query = $this->db->query($sql);
                                        if ($query->num_rows() > 0) {
                                            foreach ($query->result() as $foto) :
                                                $hasil = $foto->view_tipe;
                                                $total_view += $hasil;
                                        ?>
                                                <a href="<?php echo base_url('detail'); ?>/perum/<?php echo $tittle; ?>/tipe/<?php echo $foto->luas_bangunan; ?>/<?php echo $foto->luas_tanah; ?>">
                                                    <div class="img border-r-0px" style="position: relative;">
                                                        <img src="<?php echo base_url('upload'); ?>/<?php echo $foto->foto_tipe; ?>" class=" size-img-bs img-fluid" alt="">

                                                        <div class="bottom-right promo"><?php echo $foto->promo; ?></div>
                                                    </div>
                                                </a>
                                        <?php
                                            endforeach;
                                        }
                                        ?>
                                        <div class="m-2">
                                            <span class="mb-0 font-text-port" style="font-size: x-small;" hidden>Mulai</span>
                                            <span class="mb-0 font-text-port float-right" style="font-size: x-small;"><?php echo $total_view; ?> views</span>
                                            <br>
                                            <hr class="m-0">
                                            <?php
                                            $sql = "SELECT hrg, satuan_hrg, id_tipe, luas_bangunan, luas_tanah  FROM tipe WHERE id_tipe_perum = $id_perum ORDER BY hrg ASC limit 1";
                                            $query = $this->db->query($sql);
                                            if ($query->num_rows() > 0) {
                                                foreach ($query->result() as $data_hrg) {
                                            ?>
                                                    <a hidden class="btn-hrg-dash-bs" href="<?php echo base_url('detail'); ?>/perum/<?php echo $tittle; ?>/tipe/<?php echo $data_hrg->luas_bangunan; ?>/<?php echo $data_hrg->luas_tanah; ?>">Rp <?php echo $data_hrg->hrg; ?> <sub><?php echo $data_hrg->satuan_hrg; ?></sub></a>
                                            <?php
                                                }
                                            }
                                            ?>
                                            <a href="<?php echo base_url('detail'); ?>/perum/<?php echo $tittle; ?>/tipe/<?php echo $foto->luas_bangunan; ?>/<?php echo $foto->luas_tanah; ?>" style="color:black;">
                                                <h4 class="text-nm-perum-bs mb-0"><?php echo $data->nm_perum; ?> - Tipe mulai</h4>
                                            </a>
                                            <?php
                                            $sql = "SELECT* FROM tipe ORDER BY luas_bangunan DESC";
                                            $query = $this->db->query($sql);
                                            if ($query->num_rows() > 0) {
                                                foreach ($query->result() as $tipe) {
                                            ?>
                                                    <?php
                                                    if ($data->id_perum == $tipe->id_tipe_perum) {
                                                    ?>
                                                        <a href="<?php echo base_url('detail'); ?>/perum/<?php echo $tittle; ?>/tipe/<?php echo $tipe->luas_bangunan; ?>/<?php echo $tipe->luas_tanah; ?>">
                                                            <button type="button" id="" class="btn btn-sm mb-2 btn-outline-info btn-tipe-bs"><?php echo $tipe->luas_bangunan; ?>/<?php echo $tipe->luas_tanah; ?></button>
                                                        </a>
                                            <?php
                                                    }
                                                }
                                            }
                                            ?>
                                            <br>
                                            <span class="mb-0 font-text-port"> <?php echo $data->alamat; ?></span>
                                            <!-- <br> -->
                                            <div class="icon-fasilitas" style="text-align-last: justify;">
                                                <?php
                                                $sql = "SELECT* FROM tipe ORDER BY luas_bangunan DESC";
                                                $query = $this->db->query($sql);
                                                if ($query->num_rows() > 0) {
                                                    foreach ($query->result() as $tipe) {
                                                ?>
                                                        <?php
                                                        if ($tipe->id_tipe == $foto->id_tipe) {
                                                        ?>
                                                            <div class="figure">
                                                                <img src="<?php echo base_url('assets'); ?>/img/ikon-display/ru-tamu.png" class="size-ikon-dash img-fluid" alt="">
                                                                <h6><?php echo $tipe->r_tamu; ?></h6>
                                                            </div>
                                                            <div class="figure">
                                                                <img src="<?php echo base_url('assets'); ?>/img/ikon-display/ka-tidur.png" class="size-ikon-dash img-fluid" alt="">
                                                                <h6><?php echo $tipe->k_tidur; ?></h6>
                                                            </div>
                                                            <div class="figure">
                                                                <img src="<?php echo base_url('assets'); ?>/img/ikon-display/ka-mandi.png" class="size-ikon-dash img-fluid" alt="">
                                                                <h6><?php echo $tipe->k_mandi; ?></h6>
                                                            </div>
                                                            <div class="figure">
                                                                <img src="<?php echo base_url('assets'); ?>/img/ikon-display/dapur.png" class="size-ikon-dash img-fluid" alt="">
                                                                <h6><?php echo $tipe->dapur; ?></h6>
                                                            </div>
                                                <?php
                                                        }
                                                    }
                                                }
                                                ?>
                                            </div>
                                            <center class="mt-2">
                                                <button type="button" id="" class="btn btn-sm mb-2 btn-outline-dark btn-tipe-bs"> More info >></button>
                                            </center>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    endforeach;
                }
                ?>
            </div>
            <!-- </div> -->
            <!-- Add Pagination -->
            <div class="swiper-pagination-bullet-bs"></div>
            <!-- Add Scrollbar -->
            <!-- <div class="swiper-button-next-bs">
                    <h1>aa</h1>
                    <i class="fas fa-chevron-circle-right arrow-icon"></i>
                </div>
                <div class="swiper-button-prev-bs">
                    <h1>aa</h1>
                    <i class="fas fa-chevron-circle-left arrow-icon"></i>
                </div> -->
        </div>
    </div>
</div>