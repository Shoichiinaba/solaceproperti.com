<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sitemap extends CI_Controller
{
    public $load;

    function __construct()
    {
        parent::__construct();
        // Load model yang mengambil data halaman
        // $this->load->model('Sitemap_model');
        // Load URL Helper
        // $this->load->helper('url');
        $this->load->helper('API_helper');
        $this->load->helper('artikel_helper');
        $this->load->helper('videos_helper');
    }

    function index()
    {

        // Ambil data halaman dari model
        $data['url_artikel'] = $this->get_url_artikel();
        $data['url_properti_rumah'] = $this->get_url_properti_rumah();
        $data['url_properti_perumahan'] = $this->get_url_properti_perumahan();
        $data['url_properti_proyek_baru'] = $this->get_url_properti_proyek_baru();
        $data['url_detail_properti'] = $this->get_url_detail_properti();
        $data['url_properti_ruko'] = $this->get_url_properti_ruko();
        $data['url_tag_artikel'] = $this->get_url_tag_artikel();
        $data['url_detail_artikel'] = $this->get_url_detail_artikel();
        $data['url_short_video'] = $this->get_url_short_video();

        // Set header ke XML
        header("Content-Type: text/xml;charset=iso-8859-1");

        // Load view sitemap
        $this->load->view('sitemap/sitemap_view', $data);
    }

    function get_url_properti_rumah()
    {
        $property = get_properti_populer();
        $nama_type = 'rumah';
        $output = '';

        if (is_array($property)) {
            // Filter properties where 'nama_type' is 'rumah'
            $filter_properties_rumah = array_filter($property, function ($property) {
                return strtolower($property['nama_type']) == 'rumah';
            });

            // Group filtered properties by 'jenis_penawaran'
            $grouped_properties = [];

            foreach ($filter_properties_rumah as $row) {
                $jenis_penawaran = strtolower($row['jenis_penawaran']);
                if (!isset($grouped_properties[$jenis_penawaran])) {
                    $grouped_properties[$jenis_penawaran] = $row; // Save the first entry of this jenis_penawaran
                }
            }

            // Loop through the grouped properties and generate the output
            foreach ($grouped_properties as $jenis_penawaran => $row) {
                $formatted_date = date('Y-m-d', strtotime($row['dibuat'])); // Ubah format

                $output .= '
                            <url>
                                <loc>' . base_url('Properti/' . $row['jenis_penawaran'] . '/' . $nama_type) . '</loc>
                                <lastmod>' . $formatted_date . 'T10:23:54+00:00</lastmod>
                                <changefreq>weekly</changefreq>
                                <priority>0.7</priority>
                            </url>';
            }
            // Return or output the generated XML
            $output .= '
                        <url>
                            <loc>' . base_url('Properti/jualsewa/rumah') . '</loc>
                            <lastmod>' . $formatted_date . 'T10:23:54+00:00</lastmod>
                            <changefreq>weekly</changefreq>
                            <priority>0.7</priority>
                        </url>';
            // Initialize arrays to hold grouped properties by 'nama_kota'
            $grouped_properties_jual = [];
            $grouped_properties_sewa = [];

            // Group properties by 'nama_kota'
            foreach ($filter_properties_rumah as $row) {
                $output .= '
                            <url>
                                <loc>' . base_url('Properti/jualsewa/rumah/') . preg_replace("![^a-z0-9]+!i", "-", $row['nama_kota']) . '</loc>
                                <lastmod>' . $formatted_date . 'T10:23:54+00:00</lastmod>
                                <changefreq>weekly</changefreq>
                                <priority>0.7</priority>
                            </url>';
                $nama_kota = strtolower($row['nama_kota']);
                $jenis_penawaran = strtolower($row['jenis_penawaran']);

                // Group by kota for sale
                if ($jenis_penawaran == 'dijual') {
                    if (!isset($grouped_properties_jual[$nama_kota])) {
                        $grouped_properties_jual[$nama_kota] = []; // Initialize array for this kota
                    }
                    $grouped_properties_jual[$nama_kota][] = $row;
                }

                // Group by kota for rent
                if ($jenis_penawaran == 'disewa') {
                    if (!isset($grouped_properties_sewa[$nama_kota])) {
                        $grouped_properties_sewa[$nama_kota] = []; // Initialize array for this kota
                    }
                    $grouped_properties_sewa[$nama_kota][] = $row;
                }
            }

            // Check for properties for sale
            if (!empty($grouped_properties_jual)) {
                foreach ($grouped_properties_jual as $nama_kota => $properties) {
                    foreach ($properties as $row) {
                        $formatted_date = date('Y-m-d', strtotime($row['dibuat']));

                        // Generate XML output for each property for sale
                        $output .= '
                                    <url>
                                        <loc>' . base_url('Properti/dijual/rumah/' . preg_replace("![^a-z0-9]+!i", "-", $nama_kota)) . '</loc>
                                        <lastmod>' . $formatted_date . 'T10:23:54+00:00</lastmod>
                                        <changefreq>weekly</changefreq>
                                        <priority>0.7</priority>
                                    </url>';
                    }
                }
            }

            // Check for properties for rent
            if (!empty($grouped_properties_sewa)) {
                foreach ($grouped_properties_sewa as $nama_kota => $properties) {
                    foreach ($properties as $row) {
                        $formatted_date = date('Y-m-d', strtotime($row['dibuat']));

                        // Generate XML output for each property for rent
                        $output .= '
                                    <url>
                                        <loc>' . base_url('Properti/disewa/rumah/' . preg_replace("![^a-z0-9]+!i", "-", $nama_kota)) . '</loc>
                                        <lastmod>' . $formatted_date . 'T10:23:54+00:00</lastmod>
                                        <changefreq>weekly</changefreq>
                                        <priority>0.7</priority>
                                    </url>';
                    }
                }
            }


            return $output;
        }
    }
    function get_url_properti_perumahan()
    {
        $property = get_properti_populer();
        // $nama_type = 'perumahan';
        $output = '';

        if (is_array($property)) {
            // Filter properties where 'nama_type' is 'perumahan'
            $filter_properties_perumahan = array_filter($property, function ($property) {
                return strtolower($property['nama_type']) == 'perumahan';
            });

            // Group filtered properties by 'jenis_penawaran'
            $grouped_properties = [];

            foreach ($filter_properties_perumahan as $row) {
                $jenis_penawaran = strtolower($row['jenis_penawaran']);
                if (!isset($grouped_properties[$jenis_penawaran])) {
                    $grouped_properties[$jenis_penawaran] = $row; // Save the first entry of this jenis_penawaran
                }
            }

            // Loop through the grouped properties and generate the output
            foreach ($grouped_properties as $jenis_penawaran => $row) {
                // Format the date from the 'dibuat' field
                $formatted_date = date('Y-m-d', strtotime($row['dibuat']));

                // Generate XML output for each unique 'jenis_penawaran'
                $output .= '
                        <url>
                            <loc>' . base_url('Properti/' . $jenis_penawaran . '/' . $row['nama_type']) . '</loc>
                            <lastmod>' . $formatted_date . 'T10:23:54+00:00</lastmod>
                            <changefreq>weekly</changefreq>
                            <priority>0.85</priority>
                        </url>';
            }
            // Group filtered properties by 'nama_kota'
            $grouped_properties = [];

            foreach ($filter_properties_perumahan as $row) {
                $nama_kota = strtolower($row['nama_kota']);
                if (!isset($grouped_properties[$nama_kota])) {
                    $grouped_properties[$nama_kota] = $row; // Save the first entry of this nama_kota
                }
            }
            foreach ($grouped_properties as $nama_kota => $row) {

                $formatted_date = date('Y-m-d', strtotime($row['dibuat'])); // Ubah format

                $output .= '
                                <url>
                                    <loc>' . base_url('Properti/' . $row['jenis_penawaran'] . '/perumahan/' . preg_replace("![^a-z0-9]+!i", "-", $nama_kota)) . '</loc>
                                    <lastmod>' . $formatted_date . 'T10:23:54+00:00</lastmod>
                                    <changefreq>weekly</changefreq>
                                    <priority>0.85</priority>
                                    </url>';
            }

            return $output;
        }
    }
    function get_url_properti_proyek_baru()
    {
        $property = get_properti_populer();
        // $nama_type = 'perumahan';
        $output = '';

        if (is_array($property)) {
            // Filter properties where 'nama_type' is 'perumahan'
            $filter_properties_perumahan = array_filter($property, function ($property) {
                return strtolower($property['nama_type']) == 'perumahan';
            });

            // Group filtered properties by 'jenis_penawaran'
            $grouped_properties = [];

            foreach ($filter_properties_perumahan as $row) {
                $jenis_penawaran = strtolower($row['jenis_penawaran']);
                if (!isset($grouped_properties[$jenis_penawaran])) {
                    $grouped_properties[$jenis_penawaran] = $row; // Save the first entry of this jenis_penawaran
                }
            }

            // Loop through the grouped properties and generate the output
            foreach ($grouped_properties as $jenis_penawaran => $row) {
                // Format the date from the 'dibuat' field
                $formatted_date = date('Y-m-d', strtotime($row['dibuat']));

                // Generate XML output for each unique 'jenis_penawaran'
                $output .= '
                        <url>
                            <loc>' . base_url('Properti/proyek_baru/' . $row['nama_type']) . '</loc>
                            <lastmod>' . $formatted_date . 'T10:23:54+00:00</lastmod>
                            <changefreq>weekly</changefreq>
                            <priority>0.85</priority>
                        </url>';
            }
            // Group filtered properties by 'nama_kota'
            $grouped_properties = [];

            foreach ($filter_properties_perumahan as $row) {
                $nama_kota = strtolower($row['nama_kota']);
                if (!isset($grouped_properties[$nama_kota])) {
                    $grouped_properties[$nama_kota] = $row; // Save the first entry of this nama_kota
                }
            }
            foreach ($grouped_properties as $nama_kota => $row) {

                $formatted_date = date('Y-m-d', strtotime($row['dibuat'])); // Ubah format

                $output .= '
                                <url>
                                    <loc>' . base_url('Properti/proyek_baruy/perumahan/' . preg_replace("![^a-z0-9]+!i", "-", $nama_kota)) . '</loc>
                                    <lastmod>' . $formatted_date . 'T10:23:54+00:00</lastmod>
                                    <changefreq>weekly</changefreq>
                                    <priority>0.85</priority>
                                    </url>';
            }

            return $output;
        }
    }

    function get_url_detail_properti()
    {
        $property = get_properti_populer();
        $output = '';
        foreach ($property as $row) {
            $formatted_date = date('Y-m-d', strtotime($row['dibuat'])); // Ubah format
            $output .= '
                        <url>
                            <loc>' . base_url('Detail/perum/') . preg_replace("![^a-z0-9]+!i", "-", $row['judul_properti']) . '/tipe/' . $row['luas_tanah'] . '/' . $row['luas_bangunan'] . '</loc>
                            <lastmod>' . $formatted_date . 'T10:23:54+00:00</lastmod>
                            <changefreq>weekly</changefreq>
                            <priority>0.8</priority>
                        </url>';
        }
        return $output;
    }
    function get_url_short_video()
    {
        $videos = get_video_properti();
        $output = '';
        foreach ($videos as $row) {
            $formatted_date = date('Y-m-d', strtotime($row['uploaded'])); // Ubah format
            $output .= '
                        <url>
                            <loc>' . base_url('Video/review/') . preg_replace("![^a-z0-9]+!i", "-", $row['judul_properti']) . '/tipe/' . $row['luas_tanah'] . '/' . $row['luas_bangunan'] . '</loc>
                            <lastmod>' . $formatted_date . 'T10:23:54+00:00</lastmod>
                            <changefreq>weekly</changefreq>
                            <priority>0.8</priority>
                        </url>';
        }
        return $output;
    }

    function get_url_artikel()
    {
        $artikel = get_artikel();
        $output = '';
        foreach ($artikel as $row) {
            $formatted_date = date('Y-m-d', strtotime($row['tgl_berita'])); // Ubah format
            $output .= '

            <url>
            <loc>' . base_url('Artikel/page/') . preg_replace("![^a-z0-9]+!i", "-", $row['judul_berita']) . '</loc>
            <lastmod>' . $formatted_date . 'T10:23:54+00:00</lastmod>
                <changefreq>weekly</changefreq>
                <priority>0.80</priority>
                </url>';
        }
        $output .= '
    
            <url>
                <loc>' . base_url('Artikel/') . '</loc>
                <lastmod>' . $formatted_date . 'T10:23:54+00:00</lastmod>
                <changefreq>weekly</changefreq>
                <priority>0.80</priority>
            </url>';
        return $output;
    }

    function get_url_properti_ruko()
    {
        $property = get_properti_populer();
        $nama_type = 'ruko';
        $output = '';
        $output .= '
        <url>
            <loc>' . base_url('Properti/jualsewa/ruko') . '</loc>
            <lastmod></lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.7</priority>
        </url>';
        if (is_array($property)) {
            // Filter properties where 'nama_type' is 'ruko'
            $filter_properties_ruko = array_filter($property, function ($property) {
                return strtolower($property['nama_type']) == 'ruko';
            });

            // Group filtered properties by 'jenis_penawaran'
            $grouped_properties = [];

            foreach ($filter_properties_ruko as $row) {
                $jenis_penawaran = strtolower($row['jenis_penawaran']);
                if (!isset($grouped_properties[$jenis_penawaran])) {
                    $grouped_properties[$jenis_penawaran] = $row; // Save the first entry of this jenis_penawaran
                }
            }

            // Loop through the grouped properties and generate the output
            foreach ($grouped_properties as $jenis_penawaran => $row) {
                $formatted_date = date('Y-m-d', strtotime($row['dibuat'])); // Ubah format

                $output .= '
                            <url>
                                <loc>' . base_url('Properti/' . $row['jenis_penawaran'] . '/' . $nama_type) . '</loc>
                                <lastmod>' . $formatted_date . 'T10:23:54+00:00</lastmod>
                                <changefreq>monthly</changefreq>
                                <priority>0.7</priority>
                            </url>';
            }
            // Initialize arrays to hold grouped properties by 'nama_kota'
            $grouped_properties_jual = [];
            $grouped_properties_sewa = [];

            // Group properties by 'nama_kota'
            foreach ($filter_properties_ruko as $row) {
                $output .= '
                            <url>
                                <loc>' . base_url('Properti/jualsewa/ruko/') . preg_replace("![^a-z0-9]+!i", "-", $row['nama_kota']) . '</loc>
                                <lastmod>' . $formatted_date . 'T10:23:54+00:00</lastmod>
                                <changefreq>monthly</changefreq>
                                <priority>0.7</priority>
                            </url>';
                $nama_kota = strtolower($row['nama_kota']);
                $jenis_penawaran = strtolower($row['jenis_penawaran']);

                // Group by kota for sale
                if ($jenis_penawaran == 'dijual') {
                    if (!isset($grouped_properties_jual[$nama_kota])) {
                        $grouped_properties_jual[$nama_kota] = []; // Initialize array for this kota
                    }
                    $grouped_properties_jual[$nama_kota][] = $row;
                }

                // Group by kota for rent
                if ($jenis_penawaran == 'disewa') {
                    if (!isset($grouped_properties_sewa[$nama_kota])) {
                        $grouped_properties_sewa[$nama_kota] = []; // Initialize array for this kota
                    }
                    $grouped_properties_sewa[$nama_kota][] = $row;
                }
            }

            // Check for properties for sale
            if (!empty($grouped_properties_jual)) {
                foreach ($grouped_properties_jual as $nama_kota => $properties) {
                    foreach ($properties as $row) {
                        $formatted_date = date('Y-m-d', strtotime($row['dibuat']));

                        // Generate XML output for each property for sale
                        $output .= '
                                    <url>
                                        <loc>' . base_url('Properti/dijual/ruko/' . preg_replace("![^a-z0-9]+!i", "-", $nama_kota)) . '</loc>
                                        <lastmod>' . $formatted_date . 'T10:23:54+00:00</lastmod>
                                        <changefreq>monthly</changefreq>
                                        <priority>0.7</priority>
                                    </url>';
                    }
                }
            }

            // Check for properties for rent
            if (!empty($grouped_properties_sewa)) {
                foreach ($grouped_properties_sewa as $nama_kota => $properties) {
                    foreach ($properties as $row) {
                        $formatted_date = date('Y-m-d', strtotime($row['dibuat']));

                        // Generate XML output for each property for rent
                        $output .= '
                                    <url>
                                        <loc>' . base_url('Properti/disewa/rumah/' . preg_replace("![^a-z0-9]+!i", "-", $nama_kota)) . '</loc>
                                        <lastmod>' . $formatted_date . 'T10:23:54+00:00</lastmod>
                                        <changefreq>monthly</changefreq>
                                        <priority>0.7</priority>
                                    </url>';
                    }
                }
            }


            return $output;
        }
        return '';
    }

    function get_url_tag_artikel()
    {
        $tag_artikel = get_artikel();
        $output = '';
        if (is_array($tag_artikel)) {

            // Group filtered properties by 'tag_berita'

            foreach ($tag_artikel as $row) {
                $tag_berita = strtolower($row['tag_berita']);
                if (!isset($grouped_tag_artiekl[$tag_berita])) {
                    $grouped_tag_artiekl[$tag_berita] = $row; // Save the first entry of this jenis_penawaran
                }
            }

            // Loop through the grouped properties and generate the output
            foreach ($grouped_tag_artiekl as $tag_berita => $row) {
                $formatted_date = date('Y-m-d', strtotime($row['tgl_berita'])); // Ubah format

                $output .= '
                            <url>
                                <loc>' . base_url('Artikel/tag/') . preg_replace("![^a-z0-9]+!i", "-", $tag_berita) . '</loc>
                                <lastmod>' . $formatted_date . 'T10:23:54+00:00</lastmod>
                                <changefreq>weekly</changefreq>
                                <priority>0.5</priority>
                                </url>';
            }
        }
        return $output;
    }

    function get_url_detail_artikel()
    {
        $property = get_artikel();
        $output = '';
        foreach ($property as $row) {
            $formatted_date = date('Y-m-d', strtotime($row['tgl_berita'])); // Ubah format
            $output .= '
                        <url>
                            <loc>' . base_url('Artikel/page/').preg_replace("![^a-z0-9]+!i", "-",$row['judul_berita']).'</loc>
                            <lastmod>' . $formatted_date . 'T10:23:54+00:00</lastmod>
                            <changefreq>weekly</changefreq>
                            <priority>0.5</priority>
                        </url>';
        }
        return $output;
    }
}
