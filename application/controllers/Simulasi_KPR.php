<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Simulasi_KPR extends CI_Controller
{
    public $load;
    public $m_detail;
    public $input;
    public $uri;
    public $db;
    function __construct()
    {
        parent::__construct();
        $this->load->helper('banner_helper');
    }

    function index()
    {

        // meta primary
		$data['_title'] = 'Simulasi KPR Terbaik 2024 | Hitung Cicilan KPR Rumah di Kanpa.co.id';
		$data['_description'] = "Gunakan simulasi KPR Kanpa.co.id untuk menghitung cicilan rumah impian Anda. Dapatkan perhitungan KPR rumah terbaik dengan suku bunga kompetitif di seluruh Indonesia.";
        $data['_keyword']="simulasi KPR, KPR rumah, kalkulator KPR, hitung cicilan rumah, suku bunga KPR, kredit pemilikan rumah, cicilan KPR, KPR bank, simulasi kredit rumah, KPR 2024, perhitungan KPR, KPR terbaik, cicilan rumah murah, KPR Indonesia, perhitungan kredit rumah, bunga KPR, KPR rumah murah, pengajuan KPR, KPR online, KPR rumah idaman, perhitungan cicilan rumah, KPR cepat, KPR fleksibel, simulasi KPR 2024, kredit rumah murah";
		// meta facebook
		$data['_title_fb'] = "Simulasi KPR Terbaik 2024 - Hitung Cicilan KPR Rumah di Kanpa.co.id";
		$data['_description_fb'] = "Temukan kemudahan menghitung cicilan KPR rumah dengan simulasi KPR Kanpa.co.id. Dapatkan hasil perhitungan KPR sesuai kebutuhan Anda dengan suku bunga kompetitif.";
		// meta tiwitter
		$data['_title_tw'] = "Simulasi KPR Terbaik 2024 - Hitung Cicilan KPR Rumah di Kanpa.co.id";
		$data['_description_tw'] = "Gunakan kalkulator KPR untuk menghitung cicilan rumah sesuai kemampuan Anda. Simulasi KPR cepat dan akurat di Kanpa.co.id.";

        // Call the get_banner_properti function to get the banners
        $banner_properti = get_banner_properti();

        // Check if data was fetched successfully
        if ($banner_properti) {
            // Filter banners with type_banner = 'kpr'
            $filtered_banners = array_filter($banner_properti, function ($banner) {
                return isset($banner['type_banner']) && $banner['type_banner'] === 'KPR';
            });

            // Pass the filtered banners to the view or further processing
            $data['filtered_banners'] = $filtered_banners;
            $data['_title'] = 'Di Jual Rumah Murah';
            $data['_script'] = 'kpr/kpr_js';
            $data['_view'] = 'kpr/kpr';
            $this->load->view('layout/index', $data);
        } else {
            // Handle the case where no banners are fetched
            echo "Error fetching banners.";
        }

    }
}
