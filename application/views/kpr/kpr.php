<main id="kpr">
    <section class="bg-gray-1 pb-5">
        <div class="container mt-4">
            <?php foreach ($filtered_banners as $data) { ?>
                <img src="https://admin.kanpa.co.id/upload/banner/<?= $data['foto_banner']; ?>" class="img-fluid border box-shadow" alt="">
            <?php } ?>
            <div class="row mt-5">
                <div class="col-lg-6 col-md-6 col-12">
                    <label class="ps-2 pb-2">Harga Poperti</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text i-g-text-l">Rp.</span>
                        </div>
                        <input type="text" id="hargaProperti" class="form-control" value="">
                    </div>
                    <label class="ps-2 pb-2 ">Uang Muka (DP)</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text i-g-text-l">Rp.</span>
                        </div>
                        <input type="text" id="uangMuka" class="form-control" value="">
                    </div>
                    <label class="ps-2 pb-2">Jumlah Pinjaman</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text i-g-text-l">Rp.</span>
                        </div>
                        <input type="text" id="jumlahPinjaman" class="form-control" value="">
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label class="ps-2 pb-2">Jangka Waktu</label>
                            <div class="input-group mb-3">
                                <input type="text" id="jangkaWaktu" class="form-control" value="">
                                <div class="input-group-prepend">
                                    <span class="input-group-text i-g-text-r">Tahun</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <label class="ps-2 pb-2">Suku Bunga</label>
                            <div class="input-group mb-3">
                                <input type="text" id="sukuBunga" class="form-control" value="">
                                <div class="input-group-prepend">
                                    <span class="input-group-text i-g-text-r">%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <h4 class="text-blue">Hasil Sumulasi KPR</h4>
                    <div class="b-amount-white text-center">
                        <h4>Harga Properti</h4>
                        <h1 class="mb-0" id="hasil-hargaProperti">Rp,-</h1>
                    </div>
                    <div class="b-amount text-center">
                        <h4>Jumlah Angsuran per Bulan</h4>
                        <h1 class="mb-0" id="hasil">Rp,-</h1>
                    </div>
                    <p class="mt-3">
                        <i>
                            *Hasil dari perhitungan simulasi KPR ini hanya marupakan pekiraan saja.
                            Untuk perhitungan tepatnya, pihak bank akan memberikan ilustrasi angsuran Anda.
                        </i>
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-white">
        <div class="container">
            <h4 class="text-center font-weight-bold">
                Kanpa bekerjasama dengan seluruh berberapa Bank terkemuka di Indonesia untuk membantu pendanaan properti anda dalam bentuk KPR, KAP, Take Over, ataupun KMK.
                Prosesnya Mudah, Cepat, dan Gratis! tanpa tambahan Biaya.
            </h4>
            <div class="row">
                <h1 class="text-center font-weight-bold text-blue">Data Pengajuan KPR</h1>
                <div class="col-lg-4 col-md-4 col-12">
                    <ul class="list-none ul-list-kpr">
                        <li class="align-items-baseline d-flex gap-2 mb-2">
                            <input type="checkbox" id="">
                            <label for="">KTP klien dan pasangan Suami / Istri</label>
                        </li>
                        <li class="align-items-baseline d-flex gap-2 mb-2">
                            <input type="checkbox" id="">
                            <label for="">No Telpon klien dan pasangan</label>
                        </li>
                        <li class="align-items-baseline d-flex gap-2 mb-2">
                            <input type="checkbox" id="">
                            <label for="">NPWP klien</label>
                        </li>
                        <li class="align-items-baseline d-flex gap-2 mb-2">
                            <input type="checkbox" id="">
                            <label for="">AKTA Nikah</label>
                        </li>
                        <li class="align-items-baseline d-flex gap-2 mb-2">
                            <input type="checkbox" id="">
                            <label for="">Kartu Keluarga</label>
                        </li>
                        <li class="align-items-baseline d-flex gap-2 mb-2">
                            <input type="checkbox" id="">
                            <label for="">Perjanjian Pisah harta (Jika Ada)</label>
                        </li>
                        <li class="align-items-baseline d-flex gap-2 mb-2">
                            <input type="checkbox" id="">
                            <label for="">Surat Keterangan belum menikah (Jika Single)</label>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-4 col-12">
                    <ul class="list-none ul-list-kpr">
                        <h4 class="font-weight-bold text-blue">Jika Karyawan</h4>
                        <li class="align-items-baseline d-flex gap-2 mb-2">
                            <input type="checkbox" id="">
                            <label for="">Surat Keterangan Kerja</label>
                        </li>
                        <li class="align-items-baseline d-flex gap-2 mb-2">
                            <input type="checkbox" id="">
                            <label for="">Mutasi Rekening Gaji Min 3 Bulan Terakhir</label>
                        </li>
                        <li class="align-items-baseline d-flex gap-2 mb-2">
                            <input type="checkbox" id="">
                            <label for="">Slip Gaji Terakhir</label>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-4 col-12">
                    <ul class="list-none ul-list-kpr">
                        <h4 class="font-weight-bold text-blue">Jika Pengusaha</h4>
                        <li class="align-items-baseline d-flex gap-2 mb-2">
                            <input type="checkbox" id="">
                            <label for="">NPWP Usaha</label>
                        </li>
                        <li class="align-items-baseline d-flex gap-2 mb-2">
                            <input type="checkbox" id="">
                            <label for="">AKTA Pendirian</label>
                        </li>
                        <li class="align-items-baseline d-flex gap-2 mb-2">
                            <input type="checkbox" id="">
                            <label for="">SIUP</label>
                        </li>
                        <li class="align-items-baseline d-flex gap-2 mb-2">
                            <input type="checkbox" id="">
                            <label for="">AKTA Perubahan Terbaru</label>
                        </li>
                        <li class="align-items-baseline d-flex gap-2 mb-2">
                            <input type="checkbox" id="">
                            <label for="">TDP</label>
                        </li>
                        <li class="align-items-baseline d-flex gap-2 mb-2">
                            <input type="checkbox" id="">
                            <label for="">SK Menkeh (Jika Berbentuk PT)</label>
                        </li>
                        <li class="align-items-baseline d-flex gap-2 mb-2">
                            <input type="checkbox" id="">
                            <label for="">SK Domisili Usaha (Jika Ada)</label>
                        </li>
                        <li class="align-items-baseline d-flex gap-2 mb-2">
                            <input type="checkbox" id="">
                            <label for="">Bidang Usaha</label>
                        </li>
                        <li class="align-items-baseline d-flex gap-2 mb-2">
                            <input type="checkbox" id="">
                            <label for="">Usaha Beriri Sejak Kapan</label>
                        </li>
                        <li class="align-items-baseline d-flex gap-2 mb-2">
                            <input type="checkbox" id="">
                            <label for="">Mutasi Rekening Gaji Min 6 Bulan Terakhir</label>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <h1 class="text-center font-weight-bold text-blue">Data Tambahan</h1>
                <div class="col-lg-4 col-md-4 col-12">

                    <ul class="list-none ul-list-kpr">
                        <h4 class="font-weight-bold text-blue">Data Relasi (Bukan Serumah)</h4>
                        <li class="align-items-baseline d-flex gap-2 mb-2">
                            <input type="checkbox" id="">
                            <label for="">Nama Lengkap Relasi</label>
                        </li>
                        <li class="align-items-baseline d-flex gap-2 mb-2">
                            <input type="checkbox" id="">
                            <label for="">Alamat Lengkap Relasi</label>
                        </li>
                        <li class="align-items-baseline d-flex gap-2 mb-2">
                            <input type="checkbox" id="">
                            <label for="">Nomor Handphone Relasi</label>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-4 col-12">
                    <ul class="list-none ul-list-kpr">
                        <h4 class="font-weight-bold text-blue">Data Jaminan</h4>
                        <li class="align-items-baseline d-flex gap-2 mb-2">
                            <input type="checkbox" id="">
                            <label for="">PBB (Distempel Agen Properti)</label>
                        </li>
                        <li class="align-items-baseline d-flex gap-2 mb-2">
                            <input type="checkbox" id="">
                            <label for="">IMB (Distempel Agen Properti)</label>
                        </li>
                        <li class="align-items-baseline d-flex gap-2 mb-2">
                            <input type="checkbox" id="">
                            <label for="">Sertifikat Rumah (Distempel Agen Properti)</label>
                        </li>
                        <li class="align-items-baseline d-flex gap-2 mb-2">
                            <input type="checkbox" id="">
                            <label for="">Bukti Bayar Appraisal (Rp. 1,1 juta untuk plafon < 1M, Rp. 1,5 juta untuk plafon> 1M )</label>
                        </li>
                        <li class="align-items-baseline d-flex gap-2 mb-2">
                            <input type="checkbox" id="">
                            <label for="">No Telpon Penjual dan Hubungannya Dengan Nama Di Sertifikat</label>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-4 col-12">
                    <ul class="list-none ul-list-kpr">
                        <h4 class="font-weight-bold text-blue">Data Agen Properti</h4>
                        <li class="align-items-baseline d-flex gap-2 mb-2">
                            <input type="checkbox" id="">
                            <label for="">Surat Pengantar Agen Properti</label>
                        </li>
                        <li class="align-items-baseline d-flex gap-2 mb-2">
                            <input type="checkbox" id="">
                            <label for="">Kartu Nama Agen Properti</label>
                        </li>
                        <h4 class="font-weight-bold text-blue">Data Pengajuan</h4>
                        <li class="align-items-baseline d-flex gap-2 mb-2">
                            <input type="checkbox" id="">
                            <label for="">Plafon Yang Diajukan</label>
                        </li>
                        <li class="align-items-baseline d-flex gap-2 mb-2">
                            <input type="checkbox" id="">
                            <label for="">Jangka Waktu Yang Diajukan</label>
                        </li>
                        <li class="align-items-baseline d-flex gap-2 mb-2">
                            <input type="checkbox" id="">
                            <label for="">Program Bunga Yang Diajukan</label>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</main>