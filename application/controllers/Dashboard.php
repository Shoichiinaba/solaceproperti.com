<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public $load;
	public $m_dashboard;
	public $input;
	// public $domain;
	public $db;
	function __construct()
	{
		parent::__construct();
		$this->load->helper('artikel_helper');
		$this->load->helper('api_helper');
		$this->load->helper('videos_helper');
		$this->load->helper('banner_helper');
		$this->load->helper('map_helper');
	}

	function index()
	{
		$map_data = map_data();

		if (isset($map_data['error_message'])) {
			$data['error_message'] = $map_data['error_message'];
			$data['map_prov'] = [];
		} else {
			$data['map_prov'] = $map_data;
		}

		// Other data to be passed to the view
		$data['_script'] = 'dashboard/index_js';
		$data['_view'] = 'dashboard/index';

		// Load the view
		$this->load->view('layout/index', $data);
	}

	function get_banner()
	{
		$device = $this->input->post('device');

		if (!$device) {
			echo json_encode([
				'banner_full' => '',
				'banner_singel' => '',
				'banner_split' => '',
				'error' => 'Device tidak terdefinisi.'
			]);
			return;
   		 }

		$banner_properti = get_banner_properti();

		if (!is_array($banner_properti)) {
			echo json_encode([
				'banner_full' => '',
				'banner_singel' => '',
				'banner_split' => '',
				'error' => 'Data banner tidak tersedia.'
			]);
			return;
		}

		// Step 1: Filter 'Full' banners
		$full_banners = array_filter($banner_properti, function ($banner) {
			return $banner['type_banner'] === 'Full';
		});

		// Step 2: Randomly select one 'Full' banner
		$random_full_banner = null;
		if (!empty($full_banners)) {
			$random_full_banner = $full_banners[array_rand($full_banners)];
		}

		// Step 3: Initialize arrays for other banner types
		$filter_full = [];
		$filter_singel = [];
		$filter_split = [];
		if ($device == 'dekstop') {

			if ($random_full_banner) {
				// Add the selected full banner to the filter_full array
				if ($random_full_banner['judul_properti'] == null) {
					$redirect = '#';
				} else {
					$redirect = base_url('Detail/perum/') . preg_replace("![^a-z0-9]+!i", "-", $random_full_banner['judul_properti']);
				}
				$filter_singel[] = '<div class="col-12 p-2 col-header-12">' .
					'<a href="' . $redirect . '">' .
					'<img src="https://admin.solaceproperti.com/upload/banner/' . $random_full_banner['foto_banner'] . '" class=" border img-fluid" alt="">' .
					'</a>' .
					'<div class="box3"></div>' .
					'</div>';
				$selected_full_id = $random_full_banner['id_banner'];
			}
		}
		// Step 4: Filter and exclude the selected full banner from the other selections
		foreach ($banner_properti as $banner) {
			// Skip the randomly selected full banner
			if (isset($selected_full_id) && $banner['id_banner'] === $selected_full_id) {
				continue;
			}

			switch ($banner['type_banner']) {
				case 'Full':
					if ($banner['judul_properti'] == null) {
						$redirect = '#';
					} else {
						$redirect = base_url('Detail/perum/') . preg_replace("![^a-z0-9]+!i", "-", $random_full_banner['judul_properti']);
					}
					$filter_full[] = '<div class="swiper-slide">' .
						'	<a href="' . $redirect . '">' .
						'		<img src="https://admin.solaceproperti.com/upload/banner/' . $banner['foto_banner'] . '" alt="' . $banner['judul_properti'] . '" class="img-fluid">' .
						'	</a>' .
						'</div>';
					break;

				case 'Split':
					$filter_split[] = '<div class="col-6 p-2">' .
						'	<a href="' . base_url('Properti/') . strtolower($banner['jenis_penawaran']) . '/">' .
						'		<img src="https://admin.solaceproperti.com/upload/banner/' . $banner['foto_banner'] . '" class="border img-fluid" alt="">' .
						'	</a>' .
						'</div>';
					break;
			}
		}

		// Prepare the data array
		$data = [
			'banner_full' => implode('', $filter_full),
			'banner_singel' => implode('', $filter_singel),
			'banner_split' => implode('', $filter_split),
		];

		// Return the data as JSON
		echo json_encode($data);
	}

	public function properti_populer()
	{
		// Ambil data dari API
		$properti_data = get_properti_populer();

		// Cek apakah data valid
		if (!is_array($properti_data)) {
			echo "Failed to fetch property data.";
			return;
		}

		// Urutkan berdasarkan viewer terbanyak
		usort($properti_data, function ($a, $b) {
			return (int)($b['viewer'] ?? 0) - (int)($a['viewer'] ?? 0);
		});

		// Ambil hanya 6 properti teratas
		$populer_subset = array_slice($properti_data, 0, 6);

		// Jika kosong
		if (empty($populer_subset)) {
			echo "No data available";
			return;
		}

		// Array bulan Indonesia
		$bulanIndonesia = [
			'January'   => 'Januari',
			'February'  => 'Februari',
			'March'     => 'Maret',
			'April'     => 'April',
			'May'       => 'Mei',
			'June'      => 'Juni',
			'July'      => 'Juli',
			'August'    => 'Agustus',
			'September' => 'September',
			'October'   => 'Oktober',
			'November'  => 'November',
			'December'  => 'Desember'
		];

		// Inisialisasi HTML
		$populer_html = '';

		foreach ($populer_subset as $populer) {
			// Ambil gambar pertama
			$gambarArray = explode(',', $populer['gambar']);
			$firstGambar = $gambarArray[0] ?? 'default.jpg';

			// Tampilkan ribbon berdasarkan status
			$html_ribbon = '';
			$status = strtolower($populer['status']);
			if ($status == 'subsidi' || $status == 'takeover' || $status == 'lelang') {
				$html_ribbon = '<div class="ribbon ribbon-top-left ' . $status . '"><span>' . ucfirst($status) . '</span></div>';
			}

			// Format tanggal dari API (Y-m-d → 02 Agustus 2025)
			$tanggalAsli = $populer['created_at'] ?? date('Y-m-d');
			$formattedDate = date('d F Y', strtotime($tanggalAsli));
			$formattedDate = str_replace(array_keys($bulanIndonesia), array_values($bulanIndonesia), $formattedDate);

			// Jumlah viewer
			$viewerCount = (int)($populer['viewer'] ?? 0);

			// Generate HTML item
			$populer_html .= '<li class="img-item col-6 p-2 pb-3">
				<div class="populer-container">
					<a href="' . base_url('Detail/perum/') . preg_replace("![^a-z0-9]+!i", "-", $populer['judul_properti']) . '/tipe/' . $populer['luas_tanah'] . '/' . $populer['luas_bangunan'] . '">
						<div class="populer-content">
							<img src="https://admin.solaceproperti.com/upload/gambar_properti/' . htmlspecialchars($firstGambar, ENT_QUOTES, 'UTF-8') . '" class="img-produk-sw">
							' . $html_ribbon . '
							<div class="viewer-count" style="position:absolute; top:5px; right:5px; background:rgba(0,0,0,0.6); color:#fff; padding:3px 8px; border-radius:12px; font-size:12px;">
								<i class="bi bi-eye"></i> ' . number_format($viewerCount, 0, ',', '.') . '
							</div>
						</div>
						<div class="bg-light border p-2">
							<span class="title-new-proyek">' . htmlspecialchars($populer['nama_type'], ENT_QUOTES, 'UTF-8') . '</span>
							<span class="title-tayang">Tayang sejak ' . htmlspecialchars($formattedDate, ENT_QUOTES, 'UTF-8') . '</span>
							<h3 class="title-price">Rp ' . $populer['harga']. ' ' . htmlspecialchars($populer['satuan'], ENT_QUOTES, 'UTF-8') . '-an</h3>
							<h5 class="title-properti text-black font-weight-bold">' . htmlspecialchars($populer['judul_properti'], ENT_QUOTES, 'UTF-8') . '</h5>
							<h6 class="font-weight-bold title-address"><i class="bi bi-geo-alt"></i> ' . htmlspecialchars($populer['alamat'], ENT_QUOTES, 'UTF-8') . '</h6>
							<ul class="d-flex ul-detail mt-3">
								<li class="text-black"><span class="font-weight-bold">LB</span>: ' . htmlspecialchars($populer['luas_bangunan'], ENT_QUOTES, 'UTF-8') . ' m2</li>
								<li class="text-black"><span class="font-weight-bold">LT</span>: ' . htmlspecialchars($populer['luas_tanah'], ENT_QUOTES, 'UTF-8') . ' m2</li>
								<li class="text-black"><span class="font-weight-bold">KT</span>: ' . htmlspecialchars($populer['jml_kamar'], ENT_QUOTES, 'UTF-8') . '</li>
								<li class="text-black"><span class="font-weight-bold">Km</span>: ' . htmlspecialchars($populer['jml_kamar_mandi'], ENT_QUOTES, 'UTF-8') . '</li>
							</ul>
					</a>
					<hr>
					<div class="d-flex kontakas">
						<img src="https://admin.solaceproperti.com/upload/agent/' . htmlspecialchars($populer['foto_profil'], ENT_QUOTES, 'UTF-8') . '" class="img-marketing">
						<div class="d-block">
							<h5 class="font-weight-bold title-name m-0">' . htmlspecialchars($populer['nama_agent'], ENT_QUOTES, 'UTF-8') . '</h5>
							<p class="small title-address m-0">' . htmlspecialchars($populer['position'], ENT_QUOTES, 'UTF-8') . '</p>
						</div>
						<a href="https://wa.me/' . $populer['no_tlp'] . '?text=hallo kak ' . $populer['nama_agent'] . ', Saya ingin tahu lebih lanjut tentang ' . $populer['nama_type'] . ' ' . $populer['judul_properti'] . ' ..." target="_blank">
							<i class="bi bi-whatsapp i-wa-marketing"></i>
						</a>
					</div>
				</div>
			</div>
			</li>';
		}

		echo $populer_html;
	}

	public function properti_terbaru()
	{
		// Fetch the start and limit from the POST request
		$start = (int) ($this->input->post('start') ?? 0);
		$limit = (int) ($this->input->post('limit') ?? 1);

		// Fetch properties using the helper function
		$properti_populer = get_properti_populer();

		// Initialize the HTML string
		$populer_html = '';

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

		if (is_array($properti_populer)) {

			// Urutkan berdasarkan id_property terbaru di atas (DESC)
			usort($properti_populer, function ($a, $b) {
				return (int)$b['id_properti'] <=> (int)$a['id_properti'];
			});

			// Ambil data sesuai pagination
			$populer_subset = array_slice($properti_populer, $start, $limit);

			if (empty($populer_subset)) {
				echo "No more data available";
			} else {
				foreach ($populer_subset as $populer) {
					// Format tanggal dari Y-m-d ke 02 Agustus 2025
					$dateString = $populer['dibuat'];
					$date = DateTime::createFromFormat('Y-m-d', $dateString);
					if ($date) {
						$day = $date->format('d');
						$month = $bulanIndonesia[(int)$date->format('m')];
						$year = $date->format('Y');
						$formattedDate = "$day $month $year";
					} else {
						$formattedDate = $dateString; // fallback jika parsing gagal
					}

					// Ambil gambar pertama
					$gambarArray = explode(',', $populer['gambar']);
					$firstGambar = $gambarArray[0] ?? 'default.jpg';

					// Tampilkan ribbon jika status tertentu
					$html_ribbon = '';
					$status = strtolower($populer['status']);
					if (in_array($status, ['subsidi', 'takeover', 'lelang'])) {
						$html_ribbon = '<div class="ribbon ribbon-top-left ' . $status . '"><span>' . ucfirst($status) . '</span></div>';
					}

					// Generate HTML
					$populer_html .= '<li class="img-item col-6 p-2 pb-3">' .
						'<div class="populer-container">' .
						'<a href="' . base_url('Detail/perum/') . preg_replace("![^a-z0-9]+!i", "-", $populer['judul_properti']) . '/tipe/' . $populer['luas_tanah'] . '/' . $populer['luas_bangunan'] . '">' .
						'<div class="populer-content">' .
						'<img src="https://admin.solaceproperti.com/upload/gambar_properti/' . htmlspecialchars($firstGambar, ENT_QUOTES, 'UTF-8') . '" class="img-produk-sw">' .
						$html_ribbon .
						'</div>' .
						'<div class="bg-light border p-2">' .
						'<span class="title-new-proyek">' . htmlspecialchars($populer['nama_type'], ENT_QUOTES, 'UTF-8') . '</span>' .
						'<span class="title-tayang">Tayang sejak ' . htmlspecialchars($formattedDate, ENT_QUOTES, 'UTF-8') . '</span>' .
						'<h3 class="title-price">Rp ' . number_format($populer['harga'], 2, ',', '.') . ' ' . htmlspecialchars($populer['satuan'], ENT_QUOTES, 'UTF-8') . '</h3>' .
						'<h5 class="title-properti text-black font-weight-bold">' . htmlspecialchars($populer['judul_properti'], ENT_QUOTES, 'UTF-8') . '</h5>' .
						'<h6 class="font-weight-bold title-address"><i class="bi bi-geo-alt"></i> ' . htmlspecialchars($populer['alamat'], ENT_QUOTES, 'UTF-8') . '</h6>' .
						'<ul class="d-flex ul-detail mt-3">' .
						'<li class="text-black"><span class="font-weight-bold">LB</span>: ' . htmlspecialchars($populer['luas_bangunan'], ENT_QUOTES, 'UTF-8') . ' m2</li>' .
						'<li class="text-black"><span class="font-weight-bold">LT</span>: ' . htmlspecialchars($populer['luas_tanah'], ENT_QUOTES, 'UTF-8') . ' m2</li>' .
						'<li class="text-black"><span class="font-weight-bold">KT</span>: ' . htmlspecialchars($populer['jml_kamar'], ENT_QUOTES, 'UTF-8') . '</li>' .
						'<li class="text-black"><span class="font-weight-bold">Km</span>: ' . htmlspecialchars($populer['jml_kamar_mandi'], ENT_QUOTES, 'UTF-8') . '</li>' .
						'</ul>' .
						'</a>' .
						'<hr>' .
						'<div class="d-flex kontakas">' .
						'<img src="https://admin.solaceproperti.com/upload/agent/' . htmlspecialchars($populer['foto_profil'], ENT_QUOTES, 'UTF-8') . '" class="img-marketing">' .
						'<div class="d-block">' .
						'<h5 class="font-weight-bold title-name m-0">' . htmlspecialchars($populer['nama_agent'], ENT_QUOTES, 'UTF-8') . '</h5>' .
						'<p class="small title-address m-0">' . htmlspecialchars($populer['position'], ENT_QUOTES, 'UTF-8') . '</p>' .
						'</div>' .
						'<a href="https://wa.me/' . $populer['no_tlp'] . '?text=hallo kak ' . $populer['nama_agent'] . ', Saya ingin tahu lebih lanjut tentang ' . $populer['nama_type'] . ' ' . $populer['judul_properti'] . ' ..." target="_blank">' .
						'<i class="bi bi-whatsapp i-wa-marketing"></i>' .
						'</a>' .
						'</div>' .
						'</div>' .
						'</div>' .
						'</li>';
				}
				echo $populer_html;
			}
		} else {
			echo "Failed to fetch property data.";
		}
	}

	function get_videos()
	{
		// Fetch the start and limit from the POST request
		$start = (int) ($this->input->post('start') ?? 0);
		$limit = (int) ($this->input->post('limit') ?? 1);

		// Fetch popular properties using the helper function
		$video_properti = get_video_properti();

		// Initialize the HTML string
		$videos_html = '';

		// Ensure properties are fetched and start is within valid range
		if (is_array($video_properti)) {
			// Slice the array based on start and limit
			$video_subset = array_slice($video_properti, $start, $limit);

			foreach ($video_subset as $video) {
				// Generate HTML for the property
				$deskripsi = substr($video['deskripsi'], 0, 50) . '...';
				$videos_html .= '<li class="img-item">' .
					'<div class="reel__container">' .
					'<div class="reel__content">' .
					'<button class="btn-play" id="play-button">' .
					'<i class="fa-solid fa-play"></i>' .
					'</button>' .
					'<a class="fullscreen" href="' . base_url('Video/review/') . preg_replace("![^a-z0-9]+!i", "-", $video['judul_properti']) . '">' .
					'<video class="video" width="315" height="560">' .
					'<source src="https://admin.solaceproperti.com/upload/videos/' . $video['video'] . '" type="video/mp4">' .
					'</video>' .
					'</a>' .
					'<span class="text-desk">' . substr($video['deskripsi'], 0, 40) . '...' . '</span>' .
					'</div>' .
					'</div>' .
					'</li>';
			}
		} else {
			$videos_html = "Failed to fetch property data.";
		}
		$videos_html .= '<li class="img-item">' .
			'    <div class="reel__container" style="min-width: 11rem;">' .
			'        <div class="reel__content">' .
			'        </div>' .
			'    </div>' .
			'</li>';
		echo $videos_html;
	}

	public function get_jurnal()
	{
		$start = $this->input->post('start');
		$limit = $this->input->post('limit');

		$artikel = get_artikel();

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

}