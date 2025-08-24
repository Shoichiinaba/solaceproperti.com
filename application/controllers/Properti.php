<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Properti extends CI_Controller
{
    public $load;
    public $input;
    public $uri;
    public $db;
    function __construct()
    {
        parent::__construct();
        $this->load->helper('API_helper');
    }

    // Call the function for each property type

    function dijual()
    {
        if ($this->uri->segment(3) == 'rumah') {
            $this->load_property_view('rumah');
        } else if ($this->uri->segment(3) == 'perumahan') {
            $this->load_property_view('perumahan');
        } else if ($this->uri->segment(3) == 'ruko') {
            $this->load_property_view('ruko');
        } else if ($this->uri->segment(3) == 'kavling') {
            $this->load_property_view('kavling');
        } else {
            $this->load_property_view('');
        }
    }

    function disewa()
    {
        if ($this->uri->segment(3) == 'rumah') {
            $this->load_property_view('rumah');
        } else if ($this->uri->segment(3) == 'perumahan') {
            // $this->load_property_view('perumahan');
            redirect(base_url('Properti/dijual/perumahan'));
        } else if ($this->uri->segment(3) == 'ruko') {
            $this->load_property_view('ruko');
        } else if ($this->uri->segment(3) == 'kavling') {
            // $this->load_property_view('kavling');
            redirect(base_url('Properti/dijual/kavling'));
        } else {
            $this->load_property_view('');
        }
    }

    function jualsewa()
    {

        if ($this->uri->segment(3) == 'rumah') {
            $this->load_property_view('rumah');
        } else if ($this->uri->segment(3) == 'perumahan') {
            $this->load_property_view('perumahan');
        } else if ($this->uri->segment(3) == 'ruko') {
            $this->load_property_view('ruko');
        } else if ($this->uri->segment(3) == 'kavling') {
            $this->load_property_view('kavling');
        } else {
            $this->load_property_view('');
        }
    }

    function proyek_baru()
    {
        if ($this->uri->segment(3) == 'rumah') {
            $this->load_property_view('rumah');
        } else if ($this->uri->segment(3) == 'perumahan') {
            $this->load_property_view('perumahan');
        } else if ($this->uri->segment(3) == 'ruko') {
            $this->load_property_view('ruko');
        } else if ($this->uri->segment(3) == 'kavling') {
            $this->load_property_view('kavling');
        } else {
            $this->load_property_view('');
        }
    }

    function lelang()
    {

        if ($this->uri->segment(3) == 'rumah') {
            $this->load_property_view('rumah');
        } else if ($this->uri->segment(3) == 'perumahan') {
            $this->load_property_view('perumahan');
        } else if ($this->uri->segment(3) == 'ruko') {
            $this->load_property_view('ruko');
        } else if ($this->uri->segment(3) == 'kavling') {
            $this->load_property_view('kavling');
        } else {
            $this->load_property_view('');
        }
    }

    function takeover()
    {

        if ($this->uri->segment(3) == 'Takeover') {
            $this->load_filter_status('Takeover');
        } else if ($this->uri->segment(3) == 'Lelang') {
            $this->load_filter_status('Lelang');
        } else {
            $this->load_filter_status('');
        }
    }

    function load_property_view($type)
    {
        $titles = [
            'properti' => 'Dijual Properti',
            'rumah' => 'Dijual Rumah',
            'perumahan' => 'Dijual Perumahan',
            'ruko' => 'Dijual Ruko',
            'kavling' => 'Dijual Kavling'
        ];

        // Set dynamic title based on the property type
        $data['_title'] = isset($titles[$type]) ? $titles[$type] : 'Dijual Properti';
        $data['_url'] = base_url('Perumahan');
        $data['_view'] = 'properti/properti';
        $data['_script'] = 'properti/properti_js';

        // Load the view with the layout
        $this->load->view('layout/index', $data);
    }

    function load_filter_status($type)
    {
        $titles = [
            'lelang' => 'Lelang Properti',
            'takeover' => 'Take Over',
        ];

        // Set dynamic title based on the property type
        $data['_title'] = isset($titles[$type]) ? $titles[$type] : 'Lelang Properti';
        $data['_url'] = base_url('Perumahan');
        $data['_view'] = 'properti/properti';
        $data['_script'] = 'properti/properti_js';

        // Load the view with the layout
        $this->load->view('layout/index', $data);
    }

    function get_kota()
    {

        $post_city =  preg_replace("![^a-z0-9]+!i", " ", $this->input->post('filter-kota'));
        // Fetch popular properties using the helper function
        $properti_populer = get_properti_populer();

        $kota_html = '';

        // Check if decoding was successful and the result is an array
        if (is_array($properti_populer)) {
            // Initialize an empty array to hold grouped data
            $grouped_kota = [];

            // Loop through each property and filter by 'area_terdekat'
            foreach ($properti_populer as $populer) {
                $nama_kota = $populer['nama_kota'];
                $area_terdekat = preg_replace("![^a-z0-9]+!i", " ", $populer['area_terdekat']);
                if ($post_city == '') {
                    // Loop through each property and group by 'nama_kota'
                    foreach ($properti_populer as $populer) {
                        $nama_kota = $populer['nama_kota'];

                        // Group properties by 'nama_kota'
                        if (!isset($grouped_kota[$nama_kota])) {
                            $grouped_kota[$nama_kota] = [];
                        }

                        $grouped_kota[$nama_kota][] = $populer;
                    }
                } else {
                    // If the area_terdekat contains the post_city, proceed
                    if (strpos(strtolower($area_terdekat), strtolower($post_city)) !== false) {
                        // Group properties by 'nama_kota'
                        if (!isset($grouped_kota[$nama_kota])) {
                            $grouped_kota[$nama_kota] = [];
                        }

                        $grouped_kota[$nama_kota][] = $populer;
                    }
                }
            }

            // Build the HTML for each grouped city
            foreach ($grouped_kota as $kota => $properties) {
                // Retrieve the city icon from the first property in the group
                $gambar_city = $properties[0]['icon_filter'];

                $kota_html .= '<li class="img-item">' .
                    // '<a href="' . base_url('Dijual/properti/') . preg_replace("![^a-z0-9]+!i", "-", $kota) . '">' .
                    '<div class="card border li-city-sm" data-city="' . preg_replace("![^a-z0-9]+!i", "-", $kota)  . '">' .
                    '<img class="radius-img-city-sm" src="https://admin.kanpa.co.id/upload/icon/' . $gambar_city . '" alt="">' .
                    '<div class="p-3 text-center m-li-box-city">' .
                    ' <h6 class="text-black font-weight-bold d-table-caption f-s-li-city mb-0">' . $kota . '</h6>' .
                    ' </div>' .
                    '</div>' .
                    // '</a>' .
                    '</li>';
            }
            echo $kota_html;
        }

        // Return the generated HTML
        return $kota_html;
    }

    public function get_properti()
    {
        $post_city = strtolower(preg_replace("![^a-z0-9]+!i", " ", $this->input->post('segment_city')));
        $post_penawaran = strtolower(preg_replace("![^a-z0-9]+!i", " ", $this->input->post('segment_penawaran')));
        $start = intval($this->input->post('start'));
        $limit = intval($this->input->post('limit'));
        $data_properti = $this->input->post('data_properti');
        $other_properti = get_properti_populer();

        if (is_array($other_properti)) {
            $filtered_properties = $other_properti;

            // Filter properties based on city name
            if (!empty($post_city)) {
                $filtered_properties = array_filter($filtered_properties, function ($property) use ($post_city) {
                    return strtolower(preg_replace("![^a-z0-9]+!i", " ", $property['nama_kota'])) == $post_city;
                });
            }

            // Filter properties based on `data_properti`
            if ($data_properti != 'all') {
                $filtered_properties = array_filter($filtered_properties, function ($property) use ($data_properti) {
                    return strtolower($property['nama_type']) == $data_properti;
                });
            }

            // Filter properties based on `post_penawaran`
            if ($post_penawaran == 'dijual' || $post_penawaran == 'disewa') {
                $filtered_properties = array_filter($filtered_properties, function ($property) use ($post_penawaran) {
                    return strtolower($property['jenis_penawaran']) == strtolower($post_penawaran);
                });
            } elseif ($post_penawaran == 'jualsewa') {
                $filtered_properties = array_filter($filtered_properties, function ($property) use ($post_penawaran) {
                    $jenis_penawaran = strtolower(trim($property['jenis_penawaran']));
                    return $jenis_penawaran == 'dijual' || $jenis_penawaran == 'disewa';
                });
            }

            // Check if there are enough properties available
            $total_available = count($filtered_properties);
            if ($start >= $total_available) {
                echo json_encode('No more data available');
                return;
            }

            // Define limits for each property type
            $limits = [
                'rumah' => 5,
                'perumahan' => 5,
                'ruko' => 5,
                'kavling' => 5
            ];

            // Initialize output structure
            $data_properti_output = [
                'rumah' => '',
                'perumahan' => '',
                'ruko' => '',
                'kavling' => ''
            ];

            // Indonesian month names
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

            // Group properties by type
            $grouped_properties = [];
            foreach ($filtered_properties as $property) {
                $type = strtolower(trim($property['nama_type']));
                if (!isset($grouped_properties[$type])) {
                    $grouped_properties[$type] = [];
                }
                $grouped_properties[$type][] = $property;
            }

            // Prepare HTML for each type, applying pagination
            foreach ($grouped_properties as $type => $properties) {
                // Get limit for the current type
                $limit_type = $limits[$type] ?? 0;

                // Apply start and limit for pagination
                $paged_properties = array_slice($properties, $start, $limit > 0 ? $limit : $limit_type);

                foreach ($paged_properties as $property) {
                    $gambarArray = explode(',', $property['gambar']);
                    $firstGambar = $gambarArray[0];

                    // Format the date
                    $dateString = $property['dibuat'];
                    $date = DateTime::createFromFormat('d-m-Y', $dateString);
                    $formattedDate = $date ? $date->format('d') . ' ' . $bulanIndonesia[(int)$date->format('m')] . ' ' . $date->format('Y') : '';
					$html_ribbon = '';

                    if ($property['status'] == 'Subsidi') {
                        $html_ribbon = '<div class="ribbon ribbon-top-left"><span>' . $property['status'] . '</span></div>';
                    }

                    $property_data = [
                        'id_properti' => $property['id_properti'],
                        'status' => $html_ribbon,
                        'gambar_properti' => $firstGambar,
                        'tanggal' => $formattedDate,
                        'judul_properti' => $property['judul_properti'],
                        'nama_type' => $property['nama_type'],
                        'jenis_penawaran' => $property['jenis_penawaran'],
                        'harga' => $property['harga'],
                        'satuan' => $property['satuan'],
                        'alamat' => $property['alamat'],
                        'luas_bangunan' => $property['luas_bangunan'],
                        'luas_tanah' => $property['luas_tanah'],
                        'jml_kamar' => $property['jml_kamar'],
                        'jml_kamar_mandi' => $property['jml_kamar_mandi'],
                        'foto_profil' => $property['foto_profil'],
                        'no_tlp' => $property['no_tlp'],
                        'nama_agent' => $property['nama_agent']
                    ];

                    // Append the HTML for each property type
                    $html = $this->html_properti($property_data);
                    if (array_key_exists($type, $data_properti_output)) {
                        $data_properti_output[$type] .= $html;
                    }
                }
            }

            // Add "coming soon" message for empty categories
            foreach ($data_properti_output as $type => $html) {
                if (empty($html)) {
                    $data_properti_output[$type] = $this->html_comingsoon($type);
                }
            }

            echo json_encode($data_properti_output);
            return;
        }

        // If no properties, return default "coming soon" message
        echo json_encode([
            'rumah' => $this->html_comingsoon('rumah'),
            'perumahan' => $this->html_comingsoon('perumahan'),
            'ruko' => $this->html_comingsoon('ruko'),
            'kavling' => $this->html_comingsoon('kavling')
        ]);
    }

    private function html_comingsoon($category)
    {
        return '<li>' .
            '    <img src="' . base_url('assets/img/') . 'comingsoon-' . $category . '.jpg" class="img-comingsoon">' .
            '</li>';
    }

    private function html_properti($data_properti)
    {
        // Build and return the HTML string using the provided data
        return '<li class="img-item col-6 p-2 pb-3" data-id="' . $data_properti['id_properti'] . '">' .
            '<div class="populer-container">' .
            '<a href="' . base_url('Detail/perum/') . preg_replace("![^a-z0-9]+!i", "-", $data_properti['judul_properti']) . '/tipe/' . $data_properti['luas_tanah'] . '/' . $data_properti['luas_bangunan'] . '">' .
            '<div class="populer-content">' .
            '<img src="https://admin.kanpa.co.id/upload/gambar_properti/' . $data_properti['gambar_properti'] . '" class="img-produk-sw">' .
            $data_properti['status'] .
            '</div>' .
            '<div class="bg-light border p-2">' .
            '<span class="title-new-proyek bg-' . $data_properti['jenis_penawaran'] . '">' . $data_properti['jenis_penawaran'] . '</span>' .
            '<span class="title-tayang">Tayang sejak ' . $data_properti['tanggal'] . '</span>' .
            '<h3 class="title-price">Rp ' . $data_properti['harga'] . ' ' . $data_properti['satuan'] . '-an</h3>' .
            '<h5 class=" title-properti font-weight-bold text-black">' . $data_properti['judul_properti'] . '</h5>' .
            '<h6 class="font-weight-bold title-address"><i class="bi bi-geo-alt"></i> ' . $data_properti['alamat'] . '</h6>' .
            '<ul class="d-flex ul-detail mt-3">' .
            '<li class="text-black"><span class="font-weight-bold">LB</span> : ' . $data_properti['luas_bangunan'] . ' m2</li>' .
            '<li class="text-black"><span class="font-weight-bold">LT</span> : ' . $data_properti['luas_tanah'] . ' m2</li>' .
            '<li class="text-black"><span class="font-weight-bold">KT</span> : ' . $data_properti['jml_kamar'] . '</li>' .
            '<li class="text-black"><span class="font-weight-bold">Km</span> : ' . $data_properti['jml_kamar_mandi'] . '</li>' .
            '</ul>' .
            '</a>' .
            '<hr>' .
            '<div class="d-flex kontakas">' .
            '<img src="https://admin.solaceproperti.com/upload/agent/' . $data_properti['foto_profil'] . '" class="img-marketing">' .
            '<div class="d-block">' .
            '<h5 class="font-weight-bold title-name m-0">' . $data_properti['nama_agent'] . '</h5>' .
            '<p class="small title-address m-0">Ungaran Barat</p>' .
            '</div>' .
            '<a href="https://wa.me/' . $data_properti['no_tlp'] . '?text=hallo kak ' . $data_properti['nama_agent'] . ', Saya ingin tahu lebih lanjut tentang ' . $data_properti['nama_type'] . ' ' . $data_properti['judul_properti'] . ' ..." target="_blank">' .
            '<i class="bi bi-whatsapp i-wa-marketing"></i>' .
            '</a>' .
            '</div>' .
            '</div>' .
            '</div>' .
            '</li>';
    }
}