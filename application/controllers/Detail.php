<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Detail extends CI_Controller
{
    public $load;
    public $m_detail;
    public $input;
    public $uri;
    public $db;
    function __construct()
    {
        parent::__construct();
        $this->load->helper('API_helper');
    }

    public function perum()
    {
        $perum = preg_replace("![^a-z0-9]+!i", " ", $this->uri->segment(3));
        $lt = $this->uri->segment(5);
        $lb = $this->uri->segment(6);

        $data['properti'] = $this->get_properti($perum, $lt, $lb);
        $nama_kota = '';
        if (!empty($data['properti'])) {
            // Assuming you want to use the city from the first property
            $first_property = reset($data['properti']);
            $nama_kota = $first_property['nama_kota'] ?? '';
            $id_properti = $first_property['id_properti'] ?? '';
            $nama_type = $first_property['nama_type'] ?? '';
            $area_terdekat = $first_property['area_terdekat'] ?? '';
        }
        // echo $nama_kota;
        // meta primary
        $data['_title'] = 'Dijual ' . $nama_type . ' ' . $perum . ' di ' . $nama_kota . ' - Dekat ' . $area_terdekat . ' | Kanpa.co.id</title>';
        $data['_description'] = 'Temukan ' . $nama_type . ' ' . $perum . ' di ' . $nama_kota . ' dengan harga terbaik. Lokasi strategis dekat ' . $area_terdekat . '. Jual beli properti mudah hanya di Kanpa.co.id.';
        $data['_keyword'] = 'Dijual ' . $nama_type . ' ' . $perum . ', ' . $nama_type . ' di ' . $nama_kota . ', rumah di ' . $nama_kota . ', rumah dekat ' . $area_terdekat . ', rumah dijual ' . $nama_kota . ', jual rumah, beli rumah, properti 2024, rumah murah, investasi properti, hunian modern, properti di ' . $nama_kota . ', jual properti, properti dekat ' . $area_terdekat . '';
        // meta facebook
        $data['_title_fb'] = 'Dijual ' . $nama_type . ' ' . $perum . ' di ' . $nama_kota . ' - Area Terdekat ' . $area_terdekat . ' | Kanpa.co.id';
        $data['_description_fb'] = 'Temukan rumah ideal di ' . $nama_type . ' ' . $perum . ', ' . $nama_kota . '. Lokasi strategis dan harga terjangkau. Info lengkap properti tersedia di Kanpa.co.id.';
        // meta tiwitter
        $data['_title_tw'] = 'Dijual ' . $nama_type . ' ' . $perum . ' di ' . $nama_kota . ' - Dekat ' . $area_terdekat . ' | Kanpa.co.id';
        $data['_description_tw'] = 'Cari properti di ' . $perum . ', ' . $nama_kota . '. Harga terbaik dan lokasi dekat ' . $area_terdekat . '. Info properti lengkap hanya di Kanpa.co.id.';
        // $data['_meta_foto'] = '';
        // Fetch related properties based on the city name
        $data['properti_lainnya'] = $this->properti_lainnya($nama_kota, $id_properti);

        $data['_script'] = 'viewdetail/viewdetail_js';
        $data['_view'] = 'viewdetail/viewdetail';

        // Load the layout with the provided data
        $this->load->view('layout/index', $data);
    }

    public function get_properti($perum, $lt = null, $lb = null)
    {
        // Fetch popular properties using the helper function
        $detail_properti = get_properti_populer();

        if (is_array($detail_properti)) {
            // Filter properties based on $perum first
            $filtered_properties = array_filter($detail_properti, function ($property) use ($perum) {
                return strtolower($property['judul_properti']) == strtolower($perum);
            });

            // If $lt and $lb are provided, apply further filtering
            if (!empty($lt) && !empty($lb)) {
                $filtered_properties = array_filter($filtered_properties, function ($property) use ($lt, $lb) {
                    return $property['luas_tanah'] == $lt && $property['luas_bangunan'] == $lb;
                });
            }

            // If $lt and $lb are null or no properties match, filter based on $perum and get the smallest building area
            if (empty($lt) && empty($lb) || empty($filtered_properties)) {
                // Filter properties by $perum and find the smallest building area
                $matching_properties = array_filter($detail_properti, function ($property) use ($perum) {
                    return strtolower($property['judul_properti']) == strtolower($perum);
                });

                // Find the property with the smallest building area
                $smallest_building_property = null;
                foreach ($matching_properties as $property) {
                    if ($smallest_building_property === null || $property['luas_bangunan'] < $smallest_building_property['luas_bangunan']) {
                        $smallest_building_property = $property;
                    }
                }

                // If a property with the smallest building area is found, build the new URL
                if ($smallest_building_property) {
                    $nm_perum = preg_replace("![^a-z0-9]+!i", "-", $perum);
                    $land_area = $smallest_building_property['luas_tanah'];
                    $building_area = $smallest_building_property['luas_bangunan'];
                    $new_url = base_url("Detail/perum/{$nm_perum}/tipe/{$land_area}/{$building_area}");

                    // Redirect to the new URL
                    redirect($new_url);
                    return;  // Ensure no further code is executed after redirect
                }
            }

            // Group by id_properti
            $grouped_properties = [];
            foreach ($filtered_properties as $property) {
                $grouped_properties[$property['id_properti']] = $property;
                $nama_kota = $property['nama_kota'];
                $id_properti = $property['id_properti'];
                // Fetch other properties based on the city name
                $this->properti_lainnya($nama_kota, $id_properti);
            }

            // Return the grouped properties
            return $grouped_properties;
        }

        // Return empty array if no properties were found
        return [];
    }

    public function properti_lainnya($nama_kota, $id_properti)
    {
        // Fetch popular properties using the helper function
        $other_properti = get_properti_populer();

        // Check if the response contains data
        $bulanIndonesia = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];
        if (is_array($other_properti)) {
            // Filter properties based on the city name and exclude the one with the given id_properti
            $filtered_properties = array_filter($other_properti, function ($property) use ($nama_kota, $id_properti) {
                return strtolower($property['nama_kota']) == strtolower($nama_kota) && $property['id_properti'] != $id_properti;
            });

            // $properti_lainnya_html = $id_properti. $nama_kota;
            // Group by id_properti
            $grouped_properties = [];
            $properti_lainnya_html = '';
            foreach ($filtered_properties as $property) {
                // Group properties by id_properti
                $grouped_properties[$property['id_properti']] = $property;

                // Assuming $populer['gambar'] contains something like "ATH.jpg,ATH.jpg"
                $gambar = $property['gambar'];

                // Split the string into an array using the comma as a delimiter
                $gambarArray = explode(',', $gambar);

                // Get the first image filename from the array
                $firstGambar = $gambarArray[0];
                $dateString = $property['dibuat'];
                $date = DateTime::createFromFormat('d-m-Y', $dateString);
                if ($date) {
                    $day = $date->format('d');
                    $month = $bulanIndonesia[(int)$date->format('m')];
                    $year = $date->format('Y');
                    $formattedDate = "$day $month $year";
                } else {
                    $formattedDate = "Unknown Date";
                }

                // Generate HTML for each property
                $properti_lainnya_html .= '<div class=" col-6 p-2 pb-3">' .
                    '<div class="box-shadow border">' .
                    '<a href="' . base_url('Detail/perum/') . preg_replace("![^a-z0-9]+!i", "-", $property['judul_properti']) . '/tipe/' . $property['luas_tanah'] . '/' . $property['luas_bangunan'] . '" class="text-black">' .
                    '<div class="perum-po-content">' .
                    '<img src="https://admin.solaceproperti.com//upload/gambar_properti/' . $firstGambar . '" class="img-produk">' .
                    '</div>' .
                    '<div class=" border p-2">' .
                    '<div class="d-flex justify-content-between text-align-center mb-2">' .
                    '<span class="title-new-proyek-sm">' . $property['nama_type'] . '</span>' .
                    '<span class="title-tayang-sm">Tayang sejak ' . $formattedDate . '</span>' .
                    '</div>' .
                    '<span class="title-price mt-2">Rp ' . $property['harga'] . ' ' . $property['satuan'] . '-an</span>' .
                    '<h6 class=" title-properti font-weight-bold mb-0">' . $property['judul_properti'] . '</h6>' .
                    '<span class="font-weight-bold title-address-sm"><i class="bi bi-geo-alt"></i> ' . $property['alamat'] . '</span>' .
                    '<ul class="d-flex ul-detail-sm mt-2 mb-0">' .
                    '<li><span class="font-weight-bold">LB</span> : ' . $property['luas_bangunan'] . ' m2</li>' .
                    '<li><span class="font-weight-bold">LT</span> : ' . $property['luas_tanah'] . ' m2</li>' .
                    '<li><span class="font-weight-bold">KT</span> : ' . $property['jml_kamar'] . '</li>' .
                    '<li><span class="font-weight-bold">Km</span> : ' . $property['jml_kamar_mandi'] . '</li>' .
                    '</ul>' .
                    '</a>' .
                    '</div>' .
                    '</div>' .
                    '</div>';
            }

            // Return the generated HTML
            return $properti_lainnya_html;
        }
        // return $properti_lainnya_html;

        // Return an empty string if no properties were found
        return '';
    }
}