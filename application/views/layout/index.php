<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <meta name="google-site-verification" content="Da0TUaYScK7AIiQsOyTgtDTpMIBgIFtz3Gb7zkltBB4" /> -->
    <meta name="google-site-verification" content="7i4MFwx9o5niYM8_5w-uzOuKetBLUFMogGH7c0YpjHY" />
    <meta name="msvalidate.01" content="B36B1215CB3BC26AA0E6851087FF5E2F" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="x-dns-prefetch-control" content="on">
    <meta name="theme-color" content="#05382e"> <!-- Chrome Android -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#05382e"> <!-- Safari iOS -->
    <meta name="msapplication-navbutton-color" content="#05382e"> <!-- Microsoft Edge -->

    <!-- SEO -->
    <?php
    function getCurrentUrl()
    {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        return $url;
    }

    ?>
    <!-- Primary Meta Tags -->
    <?php if (isset($_title)) { ?>
    <title><?= $_title; ?></title>
    <?php } else { ?>
    <title>Pusat Jual Property Semarang | Jual Rumah, Properti, Ruko, dan Kavling | solaceproperti.com</title>
    <?php } ?>

    <?php if (isset($_description)) { ?>
    <meta name="description" content="<?= $_description; ?>" />
    <?php } else { ?>
    <meta name="description"
        content="Cari properti idaman Anda di seluruh Indonesia hanya di solaceproperti.com! Jual dan sewa rumah, perumahan, ruko, dan kavling dengan harga terbaik. Temukan hunian dan properti investasi sekarang!" />
    <?php } ?>
    <?php if (isset($_keyword)) { ?>
    <meta name="keywords" content="<?= $_keyword; ?>" />
    <?php } else { ?>
    <meta name="keywords"
        content="jual rumah, sewa rumah, properti 2025, perumahan, ruko, kavling, properti Indonesia, jual properti, sewa properti, real estate Indonesia, rumah murah, hunian modern, properti investasi, solaceproperti.com" />
    <?php } ?>

    <meta name="robots" content="index, follow" />
    <meta name="author" content="solaceproperti" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="UTF-8" />

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website" />
    <?php if (isset($_title_fb)) { ?>
    <meta property="og:title" content="<?= $_title_fb; ?>" />
    <?php } else { ?>
    <meta property="og:title"
        content="Pusat Jual & Sewa Properti - Rumah, Perumahan, Ruko, Kavling Terbaik 2025 | solaceproperti.com" />
    <?php } ?>
    <?php if (isset($_description_fb)) { ?>
    <meta property="og:description" content="<?= $_description_fb; ?>" />
    <?php } else { ?>
    <meta property="og:description"
        content="Temukan berbagai pilihan properti terbaik di solaceproperti.com untuk dijual atau disewakan. Marketplace terpercaya untuk rumah, perumahan, ruko, dan kavling dengan harga terbaik." />
    <?php } ?>
    <?php if (isset($_meta_foto)) { ?>
    <meta property="og:image" content="<?= $_meta_foto; ?>" />
    <?php } else { ?>
    <meta property="og:image" content="<?php echo base_url('assets'); ?>/img/icon_tittle/title_logo.png" />
    <?php } ?>


    <meta property="og:url" content="<?= getCurrentUrl(); ?>" />
    <meta property="og:site_name" content="Kanpa.co.id - Marketplace Properti Terpercaya" />

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image" />
    <?php if (isset($_title_tw)) { ?>
    <meta name="twitter:title" content="<?= $_title_tw; ?>" />
    <?php } else { ?>
    <meta name="twitter:title"
        content="Marketplace Jual & Sewa Properti - Rumah, Perumahan, Ruko, Kavling Terbaik 2024 | Kanpa.co.id" />
    <?php } ?>
    <?php if (isset($_description_tw)) { ?>
    <meta name="twitter:description" content="<?= $_description_tw; ?>" />
    <?php } else { ?>
    <meta name="twitter:description"
        content="Cari properti ideal Anda dengan mudah di Kanpa.co.id. Jual dan sewa rumah, perumahan, ruko, dan kavling di seluruh Indonesia." />
    <?php } ?>
    <?php if (isset($_meta_foto)) { ?>
    <meta name="twitter:image" content="<?= $_meta_foto; ?>" />
    <?php } else { ?>
    <meta name="twitter:image" content="<?php echo base_url('assets'); ?>/img/icon_tittle/title_logo.png" />
    <?php } ?>


    <meta name="twitter:site" content="@kanpa" />

    <!-- Canonical Link -->
    <link rel="canonical" href="<?= getCurrentUrl(); ?>" />


    <style>
    .opacity-body {
        margin-top: 0;
        width: 100%;
        height: 100%;
        position: fixed;
        z-index: 999;
        background: #0000008c;
    }
    </style>
    <!-- Favicons -->
    <link href="<?php echo base_url('assets'); ?>/img/icon_tittle/title_logo.png" rel="icon">

    <!-- Google Fonts -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Source+Sans+Pro:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Chathura" rel="stylesheet">
    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <!-- Daterangepicker -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
    <!-- Vendor CSS Files -->
    <link href="<?php echo base_url('assets'); ?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="<?php echo base_url('assets'); ?>/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="<?php echo base_url('assets'); ?>/vendor/aos/aos.css" rel="stylesheet">
    <link href="<?php echo base_url('assets'); ?>/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets'); ?>/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets'); ?>/vendor/daterangepicker/daterangepicker.css" rel="stylesheet"
        type="text/css" />
    <!-- Variables CSS Files. Uncomment your preferred color scheme -->
    <link href="<?php echo base_url('assets'); ?>/css/variables.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?php echo base_url('assets'); ?>/css/main.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.6.6/summernote.min.css" rel="stylesheet" />
    <link href="<?php echo base_url('assets'); ?>/css/custom.css" rel="stylesheet">
    <link href="<?php echo base_url('assets'); ?>/css/kanpa.css" rel="stylesheet">

</head>

<body>
    <!-- <div itemprop="image" itemscope="itemscope" itemtype="http://schema.org/ImageObject">
        <meta content="url_gambar" itemprop='url"/>
     </div> -->
    <?php $this->load->view('layout/alert/_alert') ?>
    <?php
    if (isset($_view_login) && !empty($_view_login)) {
        $this->load->view($_view_login);
    } else {

    ?>
    <?php
        include_once 'navbar.php';
        ?>
    <main id="page" class="ml-page">

        <?php
            if (isset($_view) && !empty($_view)) {
                $this->load->view($_view);
                // echo $_view;
                if ($_view == 'produk/produk' or $_view == 'detail/detail' or $_view == 'estimasi_hrg/estimasi_hrg') {

                    // include_once 'best_seller/bs.php';
                    // include_once 'footer.php';
                } else if ($_view == 'dashboard/index' or $_view == 'more_info/more_info') {
                    // include_once 'footer.php';
                } else if ($_view == 'voucher/detail') {
                }
            }
            ?>
        <!-- <button class="js-push-btn" style="display: none;">
                Subscribe Push Messaging
            </button> -->
        <?php
            include_once 'footer.php';
            ?>

    </main>
    <?php
    }
    ?>
    <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
    <?php if ($this->session->userdata("privilage") == 'Admin') { ?>
    <button class="btn-pushnotif btn btn-success text-white" data-toggle="modal" data-target="#push-notifikasi"><i
            class="bi bi-send"></i> Push send notification </button>
    <!-- <div id="preloader"></div> -->
    <!-- Modal -->
    <div class="modal fade" id="push-notifikasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Push Notification Info</h5>
                    <button type="button" class="close btn btn-secondary" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group mt-2">
                                <label for="title-notif">Title</label>
                                <input type="text" id="title-notif" class="form-control" required value="">
                            </div>
                            <div class="form-group mt-2">
                                <label for="info-notif">Info</label>
                                <input type="text" id="info-notif" class="form-control" required value="">
                            </div>
                            <div class="form-group mt-2">
                                <label for="url-notif">URL Link</label>
                                <input type="text" id="url-notif" class="form-control" required value="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="btn-send-notif" class="btn btn-primary">Send <i
                            class="bi bi-send"></i></button>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-W8JB3TCJ" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.6.6/summernote.min.js"></script>

    <script src="https://unpkg.com/popper.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js"
        integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/2.2.2/isotope.pkgd.min.js'></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/html2pdf.js/0.9.1/html2pdf.bundle.js"></script> -->
    <!-- Daterangepicker -->
    <!-- <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script> -->
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <!-- Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="https://cdn.bootcss.com/html2pdf.js/0.9.1/html2pdf.bundle.js"></script>
    <!-- canva -->

    <script src="<?php echo base_url('assets'); ?>/vendor/daterangepicker/moment.min.js"></script>
    <script src="<?php echo base_url('assets'); ?>/vendor/daterangepicker/daterangepicker.min.js"></script>
    <script src="<?php echo base_url('assets'); ?>/vendor/select2-4.0.6-rc.1/dist/js/select2.min.js"></script>
    <script src="<?php echo base_url('assets'); ?>/vendor/select2-4.0.6-rc.1/dist/js/i18n/id.js"></script>

    <script src="<?php echo base_url('assets'); ?>/vendor/aos/aos.js"></script>
    <script src="<?php echo base_url('assets'); ?>/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="<?php echo base_url('assets'); ?>/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="<?php echo base_url('assets'); ?>/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- <script src="<?php echo base_url('assets'); ?>/vendor/php-email-form/validate.js"></script> -->
    <!-- Template Main JS File -->
    <script src="<?php echo base_url('assets'); ?>/js/main.js"></script>
    <!-- <script src="<?php echo base_url('assets'); ?>/vendor/pushnotif/pushnotif.js"></script> -->
    <script src="<?php echo base_url('assets'); ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script>
    var url_ = '<?php base_url(); ?>';
    $('.btn-pushnotif').click(function() {
        $('#url-notif').val('<?= base_url(); ?>');
    });
    $('#btn-send-notif').click(function() {
        let formData = new FormData();
        formData.append('title-notif', $('#title-notif').val());
        formData.append('info-notif', $('#info-notif').val());
        formData.append('url-notif', $('#url-notif').val());
        $.ajax({
            type: 'POST',
            url: "<?php echo site_url('Pushnotif/send_notifications'); ?>",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(response) {
                alert(response.title);
                alert('Notification sent successfully')
            },
            error: function() {
                alert("Data Gagal Diupload");
            }
        });
    })
    </script>
    <!-- <script>
        var userAgent = navigator.userAgent || navigator.vendor || window.opera;

        // Windows Phone must come first because its UA also contains "Android"
        if (/windows phone/i.test(userAgent)) {
            console.log("Windows Phone");
            $('.device').text("Windows Phone");
        }

        if (/android/i.test(userAgent)) {
            console.log("Android");
            $('.device').text("Android");
        }

        // iOS detection from: http://stackoverflow.com/a/9039885/177710
        if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
            console.log("iOS");
            $('.device').text("iOS");
        }

        console.log("unknown");
        $('.device').text("unknown");
    </script> -->
    <script>

    </script>
    <?php
    if (isset($_script) && !empty($_script)) {
        $this->load->view($_script);
    } ?>
    <?php if (!$this->session->userdata('is_login')) : ?>
    <script>
    // alert('ya');
    $('#page').removeClass('ml-page');
    </script>
    <?php endif ?>

    <script>
    $(document).ready(function() {
        var newURL = location.href.split("#")[0];
        window.history.pushState('object', document.title, newURL);
        $('.play-btn').click(function(e) {
            $('.ginner-container').addClass('ginner-container-cus')
        });
    });

    $(document).on("click", ".pilih-logo", function() {
        var file = $(this).parents().find(".file-logo");
        file.trigger("click");
        // alert('ya')
    });
    $(document).on("click", ".pilih-denah-lt2", function() {
        var file = $(this).parents().find(".denah-lt2");
        file.trigger("click");
    });
    $(document).on("click", ".pilih-denah-lt1", function() {
        var file = $(this).parents().find(".denah-lt1");
        file.trigger("click");
    });
    $(document).on("click", ".pilih-foto-tipe", function() {
        var file = $(this).parents().find(".foto-tipe");
        file.trigger("click");
    });
    $(document).on("click", ".pilih-foto-voucher", function() {
        var file = $(this).parents().find(".foto-voucher");
        file.trigger("click");
    });
    $(document).on("click", "#upload-ktp", function() {
        // alert('ya');
        var file = $(this).parents().find(".data-file-ktp");
        file.trigger("click");
    });
    $(document).on("click", ".pilih-berita", function() {
        var file = $(this).parents().find(".file-berita");
        file.trigger("click");
        // alert('ya')
    });
    $(document).on("click", ".pilih-berita-other", function() {
        $('#id-data-berita').val($(this).data('id-data-berita'));
        var file = $(this).parents().find(".file-berita-other");
        file.trigger("click");
        // alert('ya')
    });
    $(document).on("click", ".pilih-foto-meta-berita", function() {
        $('#meta-foto').val($(this).data('meta-foto'));
        var file = $(this).parents().find(".file-berita-meta");
        file.trigger("click");
        // alert('ya')
    });
    $(document).on("click", "#btn-add-foto", function() {
        var file = $(this).parents().find(".file-header-perum");
        file.trigger("click");
        // alert('ya')
    });
    $(document).on("click", ".pilih-foto-btn", function() {
        // $('#nm-foto-btn').val($(this).data('foto-btn'));
        var file = $(this).parents().find(".foto-btn");
        file.trigger("click");
        // alert('ya')
    });

    function footerToggle(footerBtn) {
        $(footerBtn).toggleClass("btnActive");
        $(footerBtn).next().toggleClass("active");
    }

    $(".sidebar").hover(function() {
        // alert('ya');
        openNav();
    }, function() {
        closeNav();
    });

    function openNav() {
        document.getElementById("page").style.marginLeft = "226px";
    }

    function closeNav() {
        document.getElementById("page").style.marginLeft = "74px";
    }
    $(function() {
        var url = window.location.href;

        // passes on every "a" tag
        $("#navbar a").each(function() {
            // checks if its the same on the address bar
            if (url == (this.href)) {
                $(this).closest(".sidebar__nav__link").addClass("sidebar-active");
            }
        });
        // this will get the full URL at the address bar
    });
    $(function() {
        var url = window.location.href;

        // passes on every "a" tag
        $("#tag a").each(function() {
            // checks if its the same on the address bar
            if (url == (this.href)) {
                $(this).closest(".btn-tag").addClass("tag-active");
            }
        });
        // this will get the full URL at the address bar
    });
    // var prevScrollpos = window.pageYOffset;
    // window.onscroll = function() {
    //     var currentScrollPos = window.pageYOffset;
    //     if (prevScrollpos > currentScrollPos) {
    //         document.getElementById("header").style.top = "0";
    //     } else {
    //         document.getElementById("header").style.top = "-50px";
    //     }
    //     prevScrollpos = currentScrollPos;
    // }
    </script>

</body>

</html>