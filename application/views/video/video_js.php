<script>
    $(document).ready(function() {
        function enterFullscreen() {
            if (document.documentElement.requestFullscreen) {
                document.documentElement.requestFullscreen();
            } else if (document.documentElement.mozRequestFullScreen) {
                document.documentElement.mozRequestFullScreen();
            } else if (document.documentElement.webkitRequestFullscreen) {
                document.documentElement.webkitRequestFullscreen();
            } else if (document.documentElement.msRequestFullscreen) {
                document.documentElement.msRequestFullscreen();
            }
        }
        // User interaction: touch or click to trigger fullscreen
        document.addEventListener('click', enterFullscreen);
        document.addEventListener('touchstart', enterFullscreen);
    });

    let swiper;
    let start = 0; // Initialize start index
    const limit = 2; // Number of items to load per request
    let isFirstLoad = true; // Flag for initial load
    let hasMoreData = true; // Flag to check if there's more data to load
    let loadingMoreData = false; // Prevent multiple concurrent requests
    function get_url() {
        var activeIndex = swiper.activeIndex;
        var active_nmproperti = $('.swiper-slide').eq(activeIndex).find('.nm-properti').text().trim().replace(/[^a-z0-9]+/gi, "-");
        var active_nmkota = $('.swiper-slide').eq(activeIndex).find('.nm-kota').text().trim().replace(/[^a-z0-9]+/gi, "-");
        var active_alamat = $('.swiper-slide').eq(activeIndex).find('.alamat').text().trim().replace(/[^a-z0-9]+/gi, "-");
        var active_areaterdekat = $('.swiper-slide').eq(activeIndex).find('.area-terdekat').text().trim().replace(/[^a-z0-9]+/gi, "-");
        var active_jenispenawaran = $('.swiper-slide').eq(activeIndex).find('.jenis-penawaran').text().trim().replace(/[^a-z0-9]+/gi, "-");
        var active_nmtype = $('.swiper-slide').eq(activeIndex).find('.nm-type').text().trim().replace(/[^a-z0-9]+/gi, "-");
        var active_lt = $('.swiper-slide').eq(activeIndex).find('.lt').text().trim().replace(/[^a-z0-9]+/gi, "-");
        var active_lb = $('.swiper-slide').eq(activeIndex).find('.lb').text().trim().replace(/[^a-z0-9]+/gi, "-");

        if (active_nmproperti && active_lt && active_lb) {
            console.log("Active Slide Text: " + active_nmtype + " " + active_nmproperti + " " + active_jenispenawaran + " lt" + active_lt + " lb" + active_lb);
            meta_seo(active_nmtype, active_nmproperti, active_jenispenawaran, active_lt, active_lb)
            var currentUrl = window.location.href;

            // Remove trailing slashes
            currentUrl = currentUrl.replace(/\/+$/, '');

            // Split URL into segments
            var urlSegments = currentUrl.split('/');

            // Find the index of 'review'
            var reviewIndex = urlSegments.indexOf('review');

            if (reviewIndex !== -1) {
                // Update property name
                urlSegments[reviewIndex + 1] = active_nmproperti;

                // Ensure 'tipe', 'lt', and 'lb' are updated in the URL
                if (urlSegments[reviewIndex + 2] === 'tipe') {
                    urlSegments[reviewIndex + 3] = active_lb; // Update lt
                    urlSegments[reviewIndex + 4] = active_lt; // Update lb
                }

                // Rebuild the new URL
                var newUrl = urlSegments.join('/');

                console.log("New URL: " + newUrl);

                // Update the URL without reloading the page
                history.pushState(null, null, newUrl);
            } else {
                console.log("Review segment not found in the URL.");
            }
        } else {
            console.log("Required text not found for the active slide.");
        }
    }

    function meta_seo(active_nmtype, active_nmproperti, active_jenispenawaran, active_lt, active_lb) {
        if (active_nmtype == 'rumah' || active_nmtype == 'perumahan') {
            document.title = 'Video ' + active_jenispenawaran + ' - ' + active_nmtype + ' ' + active_nmproperti + ' tipe/ ' + active_lb + '/' + active_lt + '- Rumah Idaman di Lingkungan Nyaman | Kanpa.co.id';
            $('meta[name="description"]').attr('content', 'Temukan ' + active_nmtype + ' ' + active_nmproperti + 'di ' + active_nmkota + ',' + active_alamat + ' dengan harga terbaik. Dekat dengan ' + active_areaterdekat + '. Lihat video singkat rumah dijual di lingkungan yang nyaman dan strategis. Dapatkan informasi lengkap di Kanpa.co.id.');
            $('meta[name="keywords"]').attr('content', active_nmtype + ' ' + active_nmproperti + ', ' + active_jenispenawaran + ' rumah ' + active_nmproperti + ', rumah ' + active_jenispenawaran + ' ' + active_nmkota + ',' + active_areaterdekat + 'Kanpa.co.id');
            // facebook
            $('meta[property="og:title"]').attr('content', 'Video ' + active_jenispenawaran + ' ' + active_nmtype + ' ' + active_nmproperti + ' - ' + active_nmtype + ' Idaman di Lingkungan Nyaman | Kanpa.co.id');
            $('meta[property="og:description"]').attr('content', 'Lihat video singkat ' + active_jenispenawaran + ' ' + active_nmtype + ' ' + active_nmproperti + ', ' + active_nmkota + ',' + active_alamat + '. Dekat dengan ' + active_areaterdekat + '. Lokasi strategis dengan lingkungan yang nyaman. Info lengkap di Kanpa.co.id.');
            // twitter
            $('meta[name="twitter:]').attr('content', 'Video ' + active_jenispenawaran + ' ' + active_nmtype + ' ' + active_nmproperti + ' - Rumah Idaman di Lingkungan Nyaman | Kanpa.co.id');
            $('meta[name="twitter:]').attr('content', 'Lihat video singkat ' + active_jenispenawaran + ' ' + active_nmtype + ' ' + active_nmproperti + ', ' + active_nmkota + ',' + active_alamat + '. Dekat dengan ' + active_areaterdekat + '. Lokasi strategis dengan lingkungan yang nyaman. Info lengkap di Kanpa.co.id.');
        } else if (active_nmtype == 'ruko') {
            document.title = 'Ruko Dijual & Disewa - Area Komersial Strategis di Kabupaten Semarang | Kanpa.co.id';
            $('meta[name="description"]').attr('content', 'Temukan kavling strategis untuk dijual dan disewa di Kabupaten Semarang, Sisemut, Ungaran Barat. Pilihan terbaik untuk investasi properti. Dekat dengan Kab. Kendal dan Kab. Semarang. Info lengkap di Kanpa.co.id.');
            $('meta[name="keywords"]').attr('content', 'ruko dijual, ruko disewa, jual ruko Kabupaten Semarang, sewa ruko Ungaran Barat, ruko strategis, properti komersial Kab. Kendal, bisnis properti, Kanpa.co.id"');
            // facebook
            $('meta[property="og:title"]').attr('content', 'Ruko Dijual & Disewa - Area Komersial Strategis di Kabupaten Semarang | Kanpa.co.id');
            $('meta[property="og:description"]').attr('content', 'Cari ruko di area komersial strategis untuk dijual atau disewa di Kabupaten Semarang, Sisemut, Ungaran Barat. Dekat dengan Kab. Kendal dan Kab. Semarang. Info lengkap di Kanpa.co.id.');
            // twitter
            $('meta[name="twitter:]').attr('content', 'Cari ruko di area komersial strategis untuk dijual atau disewa di Kabupaten Semarang, Sisemut, Ungaran Barat. Dekat dengan Kab. Kendal dan Kab. Semarang. Info lengkap di Kanpa.co.id.');
            $('meta[name="twitter:]').attr('content', 'Temukan kavling strategis untuk dijual dan disewa di Kabupaten Semarang, Sisemut, Ungaran Barat. Info lengkap di Kanpa.co.id.');

        } else {
            document.title = 'Kavling Dijual - Lokasi Strategis di Kabupaten Semarang | Kanpa.co.id';
            $('meta[name="description"]').attr('content', 'Temukan ruko dijual  di area komersial strategis Kabupaten Semarang, Sisemut, Ungaran Barat. Cocok untuk bisnis Anda. Dekat dengan Kab. Kendal dan Kab. Semarang. Info lengkap di Kanpa.co.id.');
            $('meta[name="keywords"]').attr('content', 'kavling dijual, kavling , jual kavling Kabupaten Semarang, sewa kavling Ungaran Barat, kavling strategis, properti Kab. Kendal, investasi properti, Kanpa.co.id');
            // facebook
            $('meta[property="og:title"]').attr('content', 'Kavling Dijual - Lokasi Strategis di Kabupaten Semarang | Kanpa.co.id');
            $('meta[property="og:description"]').attr('content', 'Cari kavling strategis di Kabupaten Semarang, Sisemut, Ungaran Barat. Pilihan untuk dijual  dekat dengan Kab. Kendal dan Kab. Semarang. Info lengkap di Kanpa.co.id.');
            // twitter
            $('meta[name="twitter:]').attr('content', 'Kavling Dijual - Lokasi Strategis di Kabupaten Semarang | Kanpa.co.id');
            $('meta[name="twitter:]').attr('content', 'Temukan kavling strategis untuk dijual  di Kabupaten Semarang, Sisemut, Ungaran Barat. Info lengkap di Kanpa.co.id.');

        }
    }



    function initializeSwiper() {
        swiper = new Swiper('.swiper-container-re-vi', {
            direction: 'vertical',
            slidesPerView: 1,
            spaceBetween: 0,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            scrollbar: {
                el: '.swiper-scrollbar',
                draggable: true,
            },
            freeMode: false,
            mousewheel: true,
            allowTouchMove: true,
            touchRatio: 0.9,
            threshold: 10,
            longSwipesRatio: 0.3,
            longSwipesMs: 300,
            speed: 600, // Adjust speed for smoother transitions
            on: {
                slideChange: function() {
                    checkIfLastSlide(); // Check if the last slide is reached on slide change
                    playActiveSlideVideo(); // Play the video in the active slide
                    // get_url();
                }
            }
        });
    }

    function loadVideos(start, limit, isFirstLoad) {
        if (loadingMoreData) return; // Prevent multiple requests

        loadingMoreData = true; // Set the flag to indicate data is loading
        $.ajax({
            url: "<?php echo base_url('Video/get_videos'); ?>",
            type: "POST",
            data: {
                start: start,
                limit: limit,
                video_start: isFirstLoad ? '<?= $this->uri->segment(3); ?>' : undefined
            },
            success: function(data) {
                if (data.trim() === '') {
                    hasMoreData = false;
                    document.getElementById('nextBtn-re-vi').disabled = true; // Disable "Next" button if no more data
                } else {
                    $('#load-data-video').append(data); // Append new data to the swiper-wrapper
                    swiper.update(); // Update Swiper to reflect new slides
                    handleVideoControls(); // Reapply video controls
                    playActiveSlideVideo(); // Ensure the active slide's video is played
                }

                // Update the flag after the first load
                if (isFirstLoad) {
                    isFirstLoad = false;
                }
                share();
                loadingMoreData = false; // Reset the loading flag
            },
            error: function(xhr, status, error) {
                console.error("Error loading data:", status, error);
                alert("Data Gagal Diupload");
                loadingMoreData = false; // Reset the loading flag
            }
        });
    }

    function checkIfLastSlide() {

        if (swiper.isEnd && hasMoreData) {
            start += limit; // Update start index for the next set of data
            loadVideos(start, limit, false); // Load the next set of videos
        }
    }

    function playActiveSlideVideo() {

        const videos = document.querySelectorAll('.video');
        videos.forEach(video => video.pause()); // Pause all videos

        // Find the active slide's video and play it
        const activeSlide = swiper.slides[swiper.activeIndex];
        const activeVideo = activeSlide.querySelector('.video');
        if (activeVideo) {
            activeVideo.play(); // Play video in the active slide
            get_url();
        }
    }

    function handleVideoControls() {
        $('.playPauseBtn').each(function() {
            const playPauseBtn = $(this);
            const video = playPauseBtn.closest('.swiper-slide').find('.video'); // Ensure it targets the correct slide

            playPauseBtn.off('click').on('click', function() {
                if (video.length > 0) {
                    if (video[0].paused) {
                        video[0].play();
                        playPauseBtn.html('<i class="fas fa-pause"></i>');
                    } else {
                        video[0].pause();
                        playPauseBtn.html('<i class="fas fa-play"></i>');
                    }
                } else {
                    console.warn("No video found in the slide.");
                }
            });

            video.off('click').on('click', function() {
                playPauseBtn.click();
            });
        });

        $('.muteBtn').each(function() {
            const muteBtn = $(this);
            const video = muteBtn.closest('.swiper-slide').find('.video'); // Ensure it targets the correct slide

            muteBtn.off('click').on('click', function() {
                if (video.length > 0) {
                    if (video[0].muted) {
                        video[0].muted = false;
                        muteBtn.html('<i class="fas fa-volume-up"></i>');
                    } else {
                        video[0].muted = true;
                        muteBtn.html('<i class="fas fa-volume-mute"></i>');
                    }
                } else {
                    console.warn("No video found in the slide.");
                }
            });
        });

        $('.seekBar').each(function() {
            const seekBar = $(this);
            const video = seekBar.closest('.swiper-slide').find('.video'); // Ensure it targets the correct slide

            if (video.length > 0) {
                video.off('timeupdate').on('timeupdate', function() {
                    const value = (100 / video[0].duration) * video[0].currentTime;
                    seekBar.val(value);
                });

                seekBar.off('input').on('input', function() {
                    const value = seekBar.val();
                    video[0].currentTime = (value / 100) * video[0].duration;
                });
            } else {
                console.warn("No video found in the slide.");
            }
        });
    }

    function setupNavigation() {
        const prevBtn = document.getElementById('prevBtn-re-vi');
        const nextBtn = document.getElementById('nextBtn-re-vi');

        prevBtn.addEventListener('click', () => {
            swiper.slidePrev();
        });

        nextBtn.addEventListener('click', () => {
            if (hasMoreData) {
                start += limit; // Update start index for the next set of data
                loadVideos(start, limit, false); // Load the next set of videos
            }
            swiper.slideNext(); // Navigate to the next slide
        });

        swiper.on('slideChange', () => {
            prevBtn.disabled = swiper.isBeginning;
            nextBtn.disabled = !hasMoreData && swiper.isEnd; // Disable "Next" button only on the last slide if no more data
        });

        prevBtn.disabled = swiper.isBeginning;
        nextBtn.disabled = !hasMoreData;
    }

    function initialize() {
        initializeSwiper(); // Initialize Swiper
        loadVideos(start, limit, isFirstLoad); // Initial data load
        setupNavigation(); // Setup navigation buttons

    }

    initialize();

    function share() {
        const url = window.location.href;
        const title = document.title;
        $('.copy-link').on('click', function(e) {
            console.log('copy link');
            e.preventDefault();

            const url = "your-url-here"; // Replace with the actual URL you want to copy

            navigator.clipboard.writeText(url).then(() => {
                const $copyLinkLi = $(this);
                $copyLinkLi.addClass('tooltip-active').attr('data-tooltip', "Link Disalin!");

                // Restore the tooltip after 2 seconds
                setTimeout(() => {
                    $copyLinkLi.removeClass('tooltip-active').attr('data-tooltip', "Salin Link");
                }, 2000);
            }).catch(err => {
                console.error("Failed to copy the link: ", err);
            });
        });
    }
</script>