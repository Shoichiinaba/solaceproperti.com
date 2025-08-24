<style>
    .img-marketing-md {
        height: auto;
        width: 90px;
        background: #d9d9d9;
        border-radius: 78px;
        box-shadow: inset 0px 0px 20px 0px #00000061;
    }

    .f-xx-small {
        font-size: xx-small;
    }

    .border-listing-md {
        display: grid;
        background: #eef0f0;
        box-shadow: inset -2px 2px 5px -1px #000000b0;
        padding: 5px 10px;
        border-radius: 8px;
    }

    .i-wa-marketing-md {
        font-size: x-large;
        background: #25d366;
        color: white;
        padding: 8px 18px;
        border-radius: 15px;

    }

    .a-btn-view-agen {
        width: -webkit-fill-available;
        border-radius: 7px;
        box-shadow: 0px 3px 8px 1px #000000a8;
    }
</style>
<section>
    <div class="container">
        <div class="row mt-2">
            <div class="text-center">
                <h1 class="tittle">Cari Agent Properti</h1>
            </div>
            <div class="d-flex justify-content-center mt-4">
                <div class="search-bar">
                    <div class="search-input">
                        <input type="text" placeholder="Lokasi, Kata Kunci, Area, Proyek, Developer">
                    </div>
                    <div class="search-filter" data-toggle="modal" data-target="#exampleModalCenter">
                        <i class="fas fa-filter" style="padding-right: 10px;"> </i> <span class="">Filter</span>
                    </div>
                </div>
                <button class="search-button">Cari</button>
            </div>
            <div class="row mt-3">
                <h6 class="tittle mb-4">Temukan Agen Kanpa di KOta Incaran Anda</h6>
                <div class="col-12">
                    <div class="slider-wrapper slider-wrapper-populer">
                        <ul class="image-list p-0">
                            <?php for ($i = 1; $i <= 15; $i++) { ?>
                                <li class="img-item">
                                    <div class="card border li-city">
                                        <img class="img-fluid radius-img-city" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSWJ7iYInB3opGgDQYS1vULccCK13DwJN_G_A&s" alt="">
                                        <div class="P-3 text-center mb-2">
                                            <h6 class="font-weight-bold mb-0">Kab.</h6>
                                            <h6 class="font-weight-bold mb-0">Bajarmasin</h6>
                                        </div>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                        <button class="prev-slide slide-button material-symbols-rounded">
                            <i class="fa-solid fa-chevron-left"></i>
                        </button>
                        <button class="next-slide slide-button material-symbols-rounded">
                            <i class="fa-solid fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <?php for ($i = 1; $i <= 15; $i++) { ?>
                    <div class="col-lg-3 col-md-4 col-6 mt-4">
                        <div class="border box-shadow p-3">
                            <div class="d-flex">
                                <img src="https://kanpa.co.id/upload/0a7970f0cf26d2603a626d489036cc64.png" class="img-marketing-md">
                                <ul class="ul-marketing mb-0">
                                    <li>
                                        <h5 class="font-weight-bold mb-0">Ziha Zizi</h5>
                                    </li>
                                    <li class="f-x-small">
                                        Kanpa Ace
                                    </li>
                                    <li class="f-x-small">
                                        (Poperty Advisor)
                                    </li>
                                    <li>
                                        <p class="font-weight-bold text-blue f-x-small mt-2 mb-0">Ungaran Barat</p>
                                    </li>
                                </ul>
                            </div>
                            <ul class="p-0 mt-3 d-flex justify-content-between list-none text-align-center">
                                <li class="text-center border-listing-md">
                                    <h6 class="font-weight-bold text-blue mb-0">23</h6>
                                    <span class="f-xx-small">Listing Jual</span>
                                </li>
                                <li class="text-center border-listing-md">
                                    <h6 class="font-weight-bold text-blue mb-0">23</h6>
                                    <span class="f-xx-small">Listing Sewa</span>
                                </li>
                                <li>
                                    <i class="bi bi-whatsapp i-wa-marketing-md"></i>
                                </li>
                            </ul>
                            <a class="btn bg-blue text-white a-btn-view-agen">Lihat info Agen</a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>