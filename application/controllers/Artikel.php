<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Artikel extends CI_Controller
{
	public $load;
	public $m_artikel;
	public $input;
	public $uri;
	public $db;
	function __construct()
	{
		parent::__construct();
		$this->load->helper('artikel_helper');
		$this->load->helper('API_helper');
	}

	function index()
	{

		// meta primary
		$data['_title'] = 'Kumpulan Artikel Properti | Tips Rumah, Investasi, dan Perumahan Terbaik 2024 | Kanpa.co.id';
		$data['_description'] = "Baca kumpulan artikel terbaru seputar properti di Kanpa.co.id. Temukan tips membeli rumah, investasi real estate, hingga tren perumahan modern di Indonesia. Panduan properti terbaik untuk Anda.";
		$data['_keyword'] = "artikel properti, tips rumah, investasi properti, perumahan, tren properti 2024, rumah murah, desain rumah, investasi rumah, real estate Indonesia, kanpa.co.id";
		// meta facebook
		$data['_title_fb'] = "Kumpulan Artikel Properti | Tips Rumah, Investasi, dan Perumahan Terbaik 2024 | Kanpa.co.id";
		$data['_description_fb'] = "Jelajahi artikel lengkap tentang properti di Kanpa.co.id: mulai dari tips membeli rumah, investasi real estate, hingga desain dan tren perumahan modern. Panduan properti terbaik untuk Anda.";
		// meta tiwitter
		$data['_title_tw'] = "Kumpulan Artikel Properti | Tips Rumah, Investasi, dan Perumahan Terbaik 2024 | Kanpa.co.id";
		$data['_description_tw'] = "Baca kumpulan artikel properti di Kanpa.co.id: Temukan tips membeli rumah, investasi properti, dan tren perumahan terbaru di sini. Wawasan terbaik untuk keputusan properti Anda.";

		$data['_script'] = 'artikel/artikel_js';
		$data['_view'] = 'artikel/artikel';
		$data['data_tag'] = $this->data_tag();
		$data['data_berita_left'] = $this->data_berita_left();
		$data['data_berita_center'] = $this->data_berita_center();
		$data['properti'] = $this->data_properti();
		$this->load->view('layout/index', $data);
	}

	function data_berita_center()
	{
		// Call the helper function to get the article data
		$artikel = get_artikel();

		// Check if the article data was fetched successfully
		if ($artikel !== false && !empty($artikel)) {
			// Limit the article data to the first item only
			return array_slice($artikel, 0, 1);
		} else {
			// If fetching articles failed, return an empty array or handle as needed
			return [];
		}
	}
	function data_berita_left()
	{
		// Call the helper function to get the article data
		$artikel = get_artikel();

		// Check if the article data was fetched successfully
		if ($artikel !== false && !empty($artikel)) {
			// Limit the article data to the first item only
			shuffle($artikel);
			return array_slice($artikel, 0, 2);
		} else {
			// If fetching articles failed, return an empty array or handle as needed
			return [];
		}
	}

	public function get_berita()
	{
		// Initialize variables for limit and start
		$start = $this->input->post('start');
		$limit = $this->input->post('limit');

		// Call the helper function to get the article data with limit and start
		$artikel = get_artikel();
		// Check if the article data was fetched successfully
		$output = '';

		if (is_array($artikel)) {
			$artikel_subset = array_slice($artikel, $start, $limit);

			if (empty($artikel_subset)) {
				echo "No more data available";
			} else {
				foreach ($artikel_subset as $row) {
					$judul_berita = $row['judul_berita'];
					$tittle_news = preg_replace("![^a-z0-9]+!i", "-", $judul_berita);
					$link = base_url('Artikel/page/') . $tittle_news;

					$output .= '
								<div class="col-lg-6 col-12 mb-3">
									<div class="article-card position-relative">
										<a class="add-view-news" href="' . $link . '" data-id-berita="' . $row['id_berita'] . '">
											<img src="https://admin.solaceproperti.com/upload/article/' . $row['foto_berita'] . '"
												alt="' . htmlspecialchars($judul_berita) . '"
												class="article-image img-left-rounded">
										</a>
										<div class="article-content">
											<span class="article-date">' . date("M d, Y", strtotime($row['tgl_berita'])) . '</span>
											<h3 class="article-title">
												<a href="' . $link . '" class="text-dark add-view-news" data-id-berita="' . $row['id_berita'] . '">' . htmlspecialchars($judul_berita) . '</a>
											</h3>
										</div>

										<!-- viewer count -->
										<div class="viewer-artikel">
											<i class="bi bi-eye"></i> ' . $row['view_berita'] . '
										</div>
									</div>
								</div>
								';
				}
				echo $output;
			}
		}
	}

	function data_properti()
	{
		// Call the helper function to get the article data
		$properti = get_properti_populer();
		// Month names in Indonesian
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
		// Check if the article data was fetched successfully
		if ($properti !== false && !empty($properti)) {
			// Shuffle and limit the article data to the first two items only
			shuffle($properti);
			$properti_subset = array_slice($properti, 0, 2);

			// Initialize output variable
			$output = '';

			// Iterate through the properties using foreach
			foreach ($properti_subset as $row) {
				// Format the date
				$dateString = $row['dibuat'];
				$date = DateTime::createFromFormat('d-m-Y', $dateString);

				if ($date) {
					$day = $date->format('d');
					$month = $bulanIndonesia[(int)$date->format('m')];
					$year = $date->format('Y');
					$formattedDate = "$day $month $year";
				} else {
					$formattedDate = $dateString; // Fallback if date is invalid
				}

				// Handle the image string (assumes multiple images are separated by commas)
				$gambar = $row['gambar'];
				$gambarArray = explode(',', $gambar);
				$firstGambar = $gambarArray[0];
				$html_ribbon = '';
				if ($row['status'] == 'Subsidi') {
					$html_ribbon = '<div class="ribbon ribbon-top-left"><span>' . $row['status'] . '</span></div>';
				}
				// Assuming $row contains the property details you want to display
				$output .= '<div class="img-item col p-2 pb-3">' .
					'<div class="populer-container">' .
					'<a href="' . base_url('Detail/perum/') . preg_replace("![^a-z0-9]+!i", "-", $row['judul_properti']) . '/tipe/' . $row['luas_tanah'] . '/' . $row['luas_bangunan'] . '">' .
					'<div class="populer-content">' .
					'<img src="https://admin.solaceproperti.com/upload/gambar_properti/' . htmlspecialchars($firstGambar, ENT_QUOTES, 'UTF-8') . '" class="img-produk-sw">' .
					$html_ribbon .

					'</div>' .
					'<div class="bg-light border p-2">' .
					'<span class="title-new-proyek">' . htmlspecialchars($row['nama_type'], ENT_QUOTES, 'UTF-8') . '</span>' .
					'<span class="title-tayang">Tayang sejak ' . htmlspecialchars($formattedDate, ENT_QUOTES, 'UTF-8') . '</span>' .
					'<h3 class="title-price">Rp ' . number_format($row['harga'], 0, ',', '.') . ' ' . htmlspecialchars($row['satuan'], ENT_QUOTES, 'UTF-8') . '-an</h3>' .
					'<h5 class="title-properti text-black font-weight-bold">' . htmlspecialchars($row['judul_properti'], ENT_QUOTES, 'UTF-8') . '</h5>' .
					'<h6 class="font-weight-bold title-address"><i class="bi bi-geo-alt"></i> ' . htmlspecialchars($row['alamat'], ENT_QUOTES, 'UTF-8') . '</h6>' .
					'<ul class="d-flex ul-detail mt-3">' .
					'<li class="text-black"><span class="font-weight-bold">LB</span>: ' . htmlspecialchars($row['luas_bangunan'], ENT_QUOTES, 'UTF-8') . ' m2</li>' .
					'<li class="text-black"><span class="font-weight-bold">LT</span>: ' . htmlspecialchars($row['luas_tanah'], ENT_QUOTES, 'UTF-8') . ' m2</li>' .
					'<li class="text-black"><span class="font-weight-bold">KT</span>: ' . htmlspecialchars($row['jml_kamar'], ENT_QUOTES, 'UTF-8') . '</li>' .
					'<li class="text-black"><span class="font-weight-bold">Km</span>: ' . htmlspecialchars($row['jml_kamar_mandi'], ENT_QUOTES, 'UTF-8') . '</li>' .
					'</ul>' .
					'</a>' .
					'<hr>' .
					'<div class="d-flex kontakas">' .
					'<img src="https://admin.solaceproperti.com/upload/agent/' . htmlspecialchars($row['foto_profil'], ENT_QUOTES, 'UTF-8') . '" class="img-marketing">' .
					'<div class="d-block">' .
					'<h5 class="font-weight-bold title-name m-0">' . htmlspecialchars($row['nama_agent'], ENT_QUOTES, 'UTF-8') . '</h5>' .
					'<p class="small title-address m-0">' . htmlspecialchars($row['position'], ENT_QUOTES, 'UTF-8') . '</p>' .
					'</div>' .
					'<a href="https://wa.me/' . $row['no_tlp'] . '?text=hallo kak ' . $row['nama_agent'] . ', Saya ingin tahu lebih lanjut tentang ' . $row['nama_type'] . ' ' . $row['judul_properti'] . ' ..." target="_blank">' .
					'<i class="bi bi-whatsapp i-wa-marketing"></i>' .
					'</a>' .
					'</div>' .
					'</div>' .
					'</div>' .
					'</div>';
			}
			// echo $output;
			// Return the constructed output
			return $output;
		} else {
			// If fetching articles failed, return an empty string or handle as needed
			return '<p>No properties available.</p>';
		}
	}

	function data_tag()
	{
		// Call the helper function to get the article data
		$artikel = get_artikel();

		// Initialize an empty array for grouping
		$grouped_by_tag = [];

		// Check if the article data was fetched successfully
		if (is_array($artikel) && !empty($artikel)) {
			// Loop through each article
			foreach ($artikel as $row) {
				// Assuming each article has a 'tag_berita' field
				$tags = explode(',', $row['tag_berita']); // Split tags by comma

				// Loop through each tag and group articles by tag
				foreach ($tags as $tag) {
					$tag = trim($tag); // Remove any whitespace
					// Initialize the tag array if not already set
					if (!isset($grouped_by_tag[$tag])) {
						$grouped_by_tag[$tag] = [];
					}
					// Add the article to the tag group
					$grouped_by_tag[$tag][] = $row;
				}
			}
		}

		// Return the grouped data
		return $grouped_by_tag;
	}


	function page()
	{
		$judul_artikel = preg_replace("![^a-z0-9]+!i", " ", $this->uri->segment(3));
		$get_artikel = get_artikel();

		if (is_array($get_artikel)) {
			// Filter articles based on $judul_artikel
			$filtered_properties = array_filter($get_artikel, function ($fillter_artikel) use ($judul_artikel) {
				return strtolower($fillter_artikel['judul_berita']) == strtolower($judul_artikel);
			});
			foreach ($filtered_properties as $meta) {
				$meta_desk = $meta['meta_desk'];
				$meta_foto = $meta['meta_foto'];
				$tag_berita = $meta['tag_berita'];
			}
		}
		// meta primary
		$data['_title'] = '$judul_artikel';
		$data['_description'] = 'Kanpa.co.id ' . $judul_artikel . ' - ' . $meta_desk;
		$data['_keyword'] = 'artikel ' . $tag_berita . ', ' . $judul_artikel;
		// meta facebook
		$data['_title_fb'] = $judul_artikel;
		$data['_description_fb'] = 'Kanpa.co.id ' . $judul_artikel . ' - ' . $meta_desk;
		// meta tiwitter
		$data['_title_tw'] = $judul_artikel;
		$data['_description_tw'] = 'Kanpa.co.id ' . $judul_artikel . ' - ' . $meta_desk;

		$data['_meta_foto'] =  'https://admin.solaceproperti.com/upload/article/' . $meta_foto;
		$data['_url'] = base_url('Artikel/page/') . preg_replace("![^a-z0-9]+!i", "-", $judul_artikel);


		$data['_script'] = 'artikel/artikel_js';
		$data['_view'] = 'artikel/page_artikel';
		$data['detail_artikel'] = $this->get_detail_artikel($judul_artikel);
		$data['properti'] = $this->data_properti();
		$data['data_tag'] = $this->data_tag();
		$this->load->view('layout/index', $data);
	}

	function get_detail_artikel($judul_artikel)
	{
		$get_artikel = get_artikel();
		$output = '';
		$id_berita = null; // default untuk mencegah undefined

		if (is_array($get_artikel)) {
			// Filter artikel berdasarkan judul
			$filtered_properties = array_filter($get_artikel, function ($artikel) use ($judul_artikel) {
				return strtolower($artikel['judul_berita']) == strtolower($judul_artikel);
			});

			foreach ($filtered_properties as $artikel) {
				$id_berita = $artikel['id_berita'] ?? null;
				$output .= '<img src="https://admin.solaceproperti.com/upload/article/' . ($artikel['foto_berita'] ?? '') . '" class="img-fluid border-radius img-berita" data-id-berita="' . ($artikel['id_berita'] ?? '') . '" alt="red sample">'
						. '<span class="float-right">' . ($artikel['tgl_berita'] ?? '') . '</span>'
						. '<hr>'
						. '<h3 style="font-family: auto;">' . ($artikel['judul_berita'] ?? '') . '</h3>';
			}
		}

		// Kalau tidak ada ID berita, langsung return
		if (!$id_berita) {
			return $output;
		}

		$get_data_artikel = get_data_artikel();

		if (is_array($get_data_artikel)) {
			// Sort descending berdasarkan id_data_berita
			usort($get_data_artikel, function ($a, $b) {
				return $b['id_data_berita'] <=> $a['id_data_berita'];
			});

			// Filter artikel detail berdasarkan berita_id
			$filtered_properties = array_filter($get_data_artikel, function ($artikel) use ($id_berita) {
				return $artikel['berita_id'] == $id_berita;
			});

			// Gabungkan konten artikel detail
			foreach ($filtered_properties as $artikel) {
				if (!empty($artikel['file_foto_berita'])) {
					$output .= '<div class="gallery__content--flow"><figure>'
							. '    <img src="https://admin.solaceproperti.com/upload/article/' . $artikel['file_foto_berita'] . '" class="img-grid-news">'
							. '    <figcaption class="header__caption" role="presentation">'
							. '        <h2 class="title title--secondary"></h2>'
							. '    </figcaption>'
							. '</figure></div>';
				}

				$output .= $artikel['text_berita'] ?? '';

				if (!empty($artikel['file_foto_btn'])) {
					$link_btn = $artikel['link_btn'] ?? '#';
					$output .= '<center>'
							. '    <a href="' . $link_btn . '" target="_blank">'
							. '        <img src="https://admin.solaceproperti.com/upload/article/' . $artikel['file_foto_btn'] . '" class="img-fluid" alt="" style="width: 25rem;">'
							. '    </a>'
							. '</center>';
				}
			}
		}

		return $output;
	}

	function tag()
	{
		$tag = $this->uri->segment(3);
		$tag_berita = preg_replace("![^a-z0-9]+!i", " ", $tag);

		// meta primary
		$data['_title'] = 'kumpulan artikel menarik tentang ' . $tag_berita . ' | solaceproperti.com';
		$data['_description'] = 'kumpulan artikel menarik tentang ' . $tag_berita . ' | solaceproperti.com';
		$data['_keyword'] = 'kumpulan menarik artikel ' . $tag_berita;
		// meta facebook
		$data['_title_fb'] = 'kumpulan artikel menarik tentang ' . $tag_berita . ' | solaceproperti.com';
		$data['_description_fb'] = 'kumpulan artikel menarik tentang ' . $tag_berita . ' | solaceproperti.com';
		// meta tiwitter
		$data['_title_tw'] = 'kumpulan artikel menarik tentang ' . $tag_berita . ' | solaceproperti.com';
		$data['_description_tw'] = 'kumpulan artikel menarik tentang ' . $tag_berita . ' | solaceproperti.com';

		$data['_script'] = 'artikel/artikel_js';
		$data['_view'] = 'artikel/tag_artikel';
		$data['data_tag'] = $this->data_tag();
		$data['properti'] = $this->data_properti();
		$this->load->view('layout/index', $data);
	}

	public function get_berita_tag()
	{
		$tag_berita = $this->input->post('tag_berita');
		$start = $this->input->post('start');
		$limit = $this->input->post('limit');

		// Call the helper function to get the article data
		$artikel = get_artikel();

		$output = '';

		// Ensure articles are fetched and start is within valid range
		if (is_array($artikel)) {
			// Filter the articles based on the given tag
			$filtered_artikel = array_filter($artikel, function ($item) use ($tag_berita) {
				return isset($item['tag_berita']) && strpos($item['tag_berita'], $tag_berita) !== false;
			});

			// Slice the filtered array based on start and limit
			$artikel_subset = array_slice($filtered_artikel, $start, $limit);

			if (empty($artikel_subset)) {
				// No more data available
				echo "No more data available";
			} else {
				foreach ($artikel_subset as $row) {
					$judul_berita = $row['judul_berita'];
					$tittle_news = preg_replace("![^a-z0-9]+!i", "-", $judul_berita);
					$output .= '
                <div class="col-lg-6 col-12 ">
                    <div id="list" class="border-radius">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-4">
                                <div class="form-group">
                                    <a class="text-dark add-view-news" href="' . base_url('Artikel/page/') . $tittle_news . '" data-id-berita="' . $row['id_berita'] . '">
                                        <img src="https://admin.solaceproperti/upload/article/' . $row['foto_berita'] . '"
                                            class="img-fluid p-1 border-radius img-berita" data-id-berita="' . $row['id_berita'] . '"
                                            alt="red sample">
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-8 col-8">
                                <a class="text-dark add-view-news" href="' . base_url('Artikel/page/') . $tittle_news . '" data-id-berita="' . $row['id_berita'] . '">
                                    <h6 class="text-publishing">' . $row['tgl_berita'] . '</h6>
                                    <h6 class="tittle-news">' . $row['judul_berita'] . '</h6>
                                    <h6 class="font-text-port">' . $row['view_berita'] . ' Views</h6>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                ';
				}
			}
			echo $output;
		}
	}
}