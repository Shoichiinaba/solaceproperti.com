<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Video extends CI_Controller
{
    public $load;
    public $m_produk;
    public $uri;
    public $db;
    public $input;
    function __construct()
    {
        parent::__construct();
        $this->load->helper('videos_helper');
    }
    function review()
    {
        $data['_title'] = 'Di Jual Rumah Murah';
        $data['_script'] = 'video/video_js';
        $data['_view'] = 'video/video';
        $this->load->view('layout/index', $data);
    }

    public function get_videos()
    {
        $start = (int) ($this->input->post('start') ?? 0);
        $limit = (int) ($this->input->post('limit') ?? 2);
        $video_start = preg_replace("![^a-z0-9]+!i", " ", $this->input->post('video_start'));

        $video_properti = get_video_properti();
        $videos_html = '';

        // Filter jika ada parameter video_start
        if ($video_start && $start === 0) {
            $video_start_lower = strtolower($video_start);
            $key = array_search($video_start_lower, array_map('strtolower', array_column($video_properti, 'judul_properti')));

            if ($key !== false) {
                $video_selected = $video_properti[$key];
                unset($video_properti[$key]);
                array_unshift($video_properti, $video_selected);
            }
        }

        $video_subset = array_slice($video_properti, $start, $limit);

        foreach ($video_subset as $video) {
            $videos_html .= '<div class="swiper-slide swiper-slide-re-vi" style="height: 590px;width: 45rem;">
                <div class="reel_container-review">
                    <div class="reel__content reel-content-mobile">
                        <div class="videoContainer videoContainer-rv">
                            <video class="video video-reel-mobile" width="600" autoplay muted loop>
                                <source src="https://admin.solaceproperti.com/upload/videos/' . htmlspecialchars($video['video']) . '" type="video/mp4">
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
                        <h2 class="font-weight-bold text-blue resp-mobile nm-properti">' . htmlspecialchars($video['judul_properti']) . '</h2>
                        <p style="line-height: normal;font-size: smaller;">' . htmlspecialchars(substr($video['deskripsi'], 0, 100)) . '...</p>
                        <button class="btn-share-video mb-3"><i class="bi bi-share-fill p-2"></i> Bagikan</button>

                        <ul class="ul-share-media justify-content-around list-none box-shadow2">
                            <li class="copy-link d-grid place-items-center text-algin-center" data-tooltip="Salin Link">
                                <div class="bg-i box-shadow2"><i class="fa-solid fa-link"></i></div>
                                <span class="span-text-share">Salin Link</span>
                            </li>
                            <li class="d-grid place-items-center text-algin-center">
                                <div class="bg-i box-shadow2"><i class="fa-brands fa-whatsapp"></i></div>
                                <span class="span-text-share">whatsapp</span>
                            </li>
                            <li class="d-grid place-items-center text-algin-center">
                                <div class="bg-i box-shadow2"><i class="fa-brands fa-facebook-messenger"></i></div>
                                <span class="span-text-share">messenger</span>
                            </li>
                            <li class="d-grid place-items-center text-algin-center">
                                <div class="bg-i box-shadow2"><i class="fa-brands fa-facebook"></i></div>
                                <span class="span-text-share">facebook</span>
                            </li>
                            <li class="d-grid place-items-center text-algin-center">
                                <div class="bg-i box-shadow2"><i class="fa-brands fa-telegram"></i></div>
                                <span class="span-text-share">telegram</span>
                            </li>
                        </ul>

                        <a href="' . base_url('Detail/perum/') . preg_replace("![^a-z0-9]+!i", "-", $video['judul_properti']) . '" class="text-blue font-weight-bold resp-mobile">Lihat Detail</a>

                        <div class="card border box-shadow resp-mobile p-3">
                            <h3 class="title-price">Rp ' . htmlspecialchars($video['harga']) . '</h3>
                            <h5 class="font-weight-bold">' . htmlspecialchars($video['judul_properti']) . '</h5>
                            <h6 class="font-weight-bold title-address"><i class="bi bi-geo-alt"></i> <span class="alamat">' . htmlspecialchars($video['alamat']) . '</span></h6>
                            <ul class="d-flex ul-detail mt-3">
                                <li><span class="font-weight-bold">LT</span>: <span class="lt">' . htmlspecialchars($video['luas_tanah']) . '</span> m2</li>
                                <li><span class="font-weight-bold">LB</span>: <span class="lb">' . htmlspecialchars($video['luas_bangunan']) . '</span> m2</li>
                                <li><span class="font-weight-bold">KT</span>: ' . htmlspecialchars($video['jml_kamar']) . '</li>
                                <li><span class="font-weight-bold">KM</span>: ' . htmlspecialchars($video['jml_kamar_mandi']) . '</li>
                            </ul>
                            <hr>
                            <div class="d-flex kontakas">
                                <img src="https://admin.solaceproperti.com/upload/agent/' . htmlspecialchars($video['foto_profil']) . '" class="img-agent" alt="Foto Agent">
                                <div class="d-block">
                                    <h5 class="font-weight-bold m-0">' . htmlspecialchars($video['nama_agent']) . '</h5>
                                    <p class="small m-0">' . htmlspecialchars($video['agency_alamat']) . '</p>
                                </div>
                                <i class="bi bi-whatsapp i-wa-marketing"></i>
                            </div>
                        </div>

                        <div class="d-flex topleft align-items-baseline">
                            <a href="' . base_url() . '">
                                <i class="bg-btn-back fa-solid fa-circle-arrow-left"></i>
                            </a>
                        </div>

                        <div class="d-flex toprig align-items-baseline">
                            <span class="bor-orange-vi-re box-shadow">
                                <i class="fa-solid fa-thumbs-up"></i> <span class="nm-type">' . htmlspecialchars($video['nama_type']) . '</span>
                            </span>
                        </div>

                        <div class="d-flex botleft align-items-baseline">
                            <span class="bor-orange-vi-re box-shadow jenis-penawaran"> ' . htmlspecialchars($video['jenis_penawaran']) . '</span>
                            <span class="title-tayang main">Tayang sejak ' . date('d F Y', strtotime($video['uploaded'])) . '</span>
                        </div>

                        <div class="i-btn-right-video align-items-baseline">
                            <ul class="d-grid gap-3 list-none">
                                <li>
                                    <a href="' . base_url('Detail/perum/') . preg_replace("![^a-z0-9]+!i", "-", $video['judul_properti']) . '">
                                        <span class="i-bg-orange box-shadow"><i class="bi bi-house-door"></i></span>
                                    </a>
                                </li>
                                <li>
                                    <span class="i-bg-white box-shadow"><i class="fa-solid fa-paper-plane"></i></span>
                                </li>
                            </ul>
                        </div>

                        <span class="nm-kota" hidden>' . htmlspecialchars($video['nama_kota']) . '</span>
                        <span class="area-terdekat" hidden>' . htmlspecialchars($video['area_terdekat']) . '</span>
                    </div>
                </div>
            </div>';
        }

        echo $videos_html;
    }
}