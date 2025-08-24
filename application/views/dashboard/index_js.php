<script>
$(document).ready(function() {
    let start = 0;
    let limit = window.innerWidth <= 768 ? 4 : 5;
    let device = window.innerWidth <= 768 ? 'mobile' : 'desktop';
    let lastLoadedStart = 0;

    // Initial load of data
    load_data_banner_properti(device);
    load_data_properti(start, limit);
    load_data_properti_new(start, limit);
    load_data_video_properti(start, limit);

    $('.row-btn-vw-next, .next-slide').on('click', function(e) {
        e.preventDefault(); // Prevent default link behavior
        lastLoadedStart = start; // Store the last loaded start index
        start = start + limit; // Update start index
        load_data_properti(start, limit); // Load more data
    });



    // Function to load data, with an option to append new items
    function load_data_properti(start, limit) {
        $.ajax({
            url: "<?php echo base_url('Dashboard/properti_populer'); ?>",
            type: "POST",
            data: {
                start: start,
                limit: limit
            },
            success: function(data) {
                if (data == 'No more data available') {

                } else {
                    if (start === lastLoadedStart) {
                        $('#load-data-properti-populer').html(data); // Load initial data
                    } else {
                        $('#load-data-properti-populer').append(data); // Append new data
                        console.log('load')
                    }
                }
            },
            error: function(xhr, status, error) {
                console.error("Error loading data:", status, error);
                alert("Data Gagal Diupload");
            }
        });
    }

    $('.row-btn-vw-next, .next-slide').on('click', function(e) {
        e.preventDefault();
        lastLoadedStart = start;
        start = start + limit;
        load_data_properti_new(start, limit);
    });

    // Function to load data, with an option to append new items
    function load_data_properti_new(start, limit) {
        $.ajax({
            url: "<?php echo base_url('Dashboard/properti_terbaru'); ?>",
            type: "POST",
            data: {
                start: start,
                limit: limit
            },
            success: function(data) {
                if (data == 'No more data available') {

                } else {
                    if (start === lastLoadedStart) {
                        $('#load-data-properti-terbaru').html(data);
                    } else {
                        $('#load-data-properti-terbaru').append(data);
                        console.log('load')
                    }
                }
            },
            error: function(xhr, status, error) {
                console.error("Error loading data:", status, error);
                alert("Data Gagal Diupload");
            }
        });
    }

    function load_data_video_properti(start, limit) {
        $.ajax({
            url: "<?php echo base_url('Dashboard/get_videos'); ?>",
            type: "POST",
            data: {
                start: start,
                limit: limit
            },
            success: function(data) {
                if (start === lastLoadedStart) {
                    $('#load-data-video-populer').html(data); // Load initial data
                } else {
                    $('#load-data-video-populer').append(data); // Append new data
                }
                play_videos();
            },
            error: function(xhr, status, error) {
                console.error("Error loading data:", status, error);
                alert("Data Gagal Diupload");
            }
        });
    }

    // Optional: Add a window resize event listener if you need to adjust the limit dynamically
    $(window).resize(function() {
        limit = window.innerWidth <= 768 ? 2 : 1;
    });

    // alert(device);
    function load_data_banner_properti(device) {

        $.ajax({
            url: "<?php echo base_url('Dashboard/get_banner'); ?>",
            method: "POST",
            data: {
                device: device
            },
            dataType: "json",
            success: function(response) {
                // alert(response.device);
                // Populate the banner sections with the response data
                $('#banner-full').html(response.banner_full);
                $('#banner-singel').html(response.banner_singel);
                $('#banner-split').html(response.banner_split);
                if (swiper && typeof swiper.update === 'function') {
                    swiper.update();
                } else {
                    console.error('Swiper instance not found or not initialized.');
                }
            },
            error: function(xhr, status, error) {
                console.error("Error loading data:", status, error);
                alert("Data Gagal Diupload");
            }
        });
    }

});


// function initSwiperAndSlider() {
// Initialize Swiper with slides per view
var swiper = new Swiper('.swiper', {
    loop: true, // Enable looping
    watchSlidesProgress: true,
    autoplay: {
        delay: 3000,
        disableOnInteraction: false, // Continue autoplay after interaction
    },
    pagination: {
        el: '.swiper-pagination',
        clickable: true, // Make pagination bullets clickable
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    scrollbar: {
        el: '.swiper-scrollbar',
        draggable: true, // Make scrollbar draggable
    },
    slidesPerView: 1, // Show 1 slide per view
    spaceBetween: 10, // Space between slides
    loopAdditionalSlides: 5, // Increase this to match the number of slides per view
    centeredSlides: true, // Center the active slide
    speed: 500, // Control the transition speed
});

// Ensure Swiper is updated when new slides are loaded dynamically
function updateSwiper() {
    setTimeout(function() {
        swiper.update(); // Recalculate Swiper after new slides are added
    }, 100); // Small delay to ensure DOM is ready
}

// Example function to load new data and update swiper
function loadNewSlides() {
    // Simulate loading new slides dynamically
    $('#swiper-container').append('<div class="swiper-slide">New Slide</div>');
    updateSwiper(); // Call update after appending new slides
}

// Initialize manual scroll per 4 images
const initManualSlider = () => {
    const sliderWrappers = document.querySelectorAll(".slider-wrapper");
    sliderWrappers.forEach(wrapper => {
        const imageList = wrapper.querySelector(".image-list");
        const prevButton = wrapper.querySelector(".prev-slide");
        const nextButton = wrapper.querySelector(".next-slide");
        const imageItems = imageList.querySelectorAll('.img-item');

        if (!imageItems.length) {
            console.error("No image items found in the list.");
            return;
        }

        const getVisibleItems = () => {
            const imageWidth = imageItems[0].clientWidth;
            return imageWidth > 0 ? Math.floor(imageList.clientWidth / imageWidth) : 4;
        };

        const updateSlideWidth = () => {
            const visibleItems = getVisibleItems();
            return imageList.clientWidth / visibleItems;
        };

        let slideWidth = updateSlideWidth();

        window.addEventListener('resize', () => {
            slideWidth = updateSlideWidth();
        });

        prevButton.addEventListener("click", () => {
            imageList.scrollBy({
                left: -slideWidth * 4,
                behavior: "smooth",
            });
        });

        nextButton.addEventListener("click", () => {
            imageList.scrollBy({
                left: slideWidth * 4,
                behavior: "smooth",
            });
        });

        const handleSlideButtons = () => {
            const maxScrollLeft = imageList.scrollWidth - imageList.clientWidth;
            prevButton.style.display = imageList.scrollLeft <= 0 ? "none" : "block";
            nextButton.style.display = imageList.scrollLeft >= maxScrollLeft ? "none" : "block";
        };

        imageList.addEventListener("scroll", handleSlideButtons);
        nextButton.style.display = "block";
    });
};

document.addEventListener("DOMContentLoaded", initManualSlider);
window.addEventListener("resize", initManualSlider);
window.addEventListener("load", initManualSlider);
// }

// Call the function to initialize Swiper and manual slider
// initSwiperAndSlider();



// document.getElementById('play-button').addEventListener('click', function() {
function play_videos() {

    $('.btn-play').click(function() {
        var button = $(this);
        var video = button.siblings('a').find('video')[0]; // Adjusting to find the video inside the anchor tag

        // Pause all other videos
        $('.video').each(function() {
            var currentVideo = this;
            if (currentVideo !== video) {
                currentVideo.pause();
                $(currentVideo).closest('.reel__content').find('.btn-play').html(
                    '<i class="fa-solid fa-play"></i>');
            }
        });

        // Play or pause the selected video
        if (video.paused) {
            video.play();
            button.html('<i class="fa-solid fa-pause"></i>');
        } else {
            video.pause();
            button.html('<i class="fa-solid fa-play"></i>');
        }
    });

}
$("#select-transaksi").select2({
    placeholder: "Pilih transaksi",
    allowClear: true
});
$("#select-tipe").select2({
    placeholder: "Pilih tipe",
    allowClear: true
});
$("#select-sertifikat").select2({
    placeholder: "Pilih sertifikat",
    allowClear: true
});
$("#select-provinsi").select2({
    placeholder: "Pilih provinsi",
    allowClear: true
});
$("#select-kota").select2({
    placeholder: "Pilih kota",
    allowClear: true
});
$("#select-lokasi").select2({
    placeholder: "Pilih lokasi",
    allowClear: true
});
$("#select-km-tidur").select2({
    placeholder: "Jumlah Kamar Tidur",
    allowClear: true
});
$("#select-km-mandi").select2({
    placeholder: "Jumlah Kamar Mandi",
    allowClear: true
});

// code artikel
$(document).ready(function() {

    var limit = 4;
    var start = 0;
    var action = 'inactive';

    function lazzy_loader(limit) {
        var output = '';
        output += '<div class="post_data">';
        output += '<p><span class="content-placeholder" style="width:100%; height: 30px;">&nbsp;</span></p>';
        output += '<p><span class="content-placeholder" style="width:100%; height: 90px;">&nbsp;</span></p>';
        output += '</div>';
        $('#load_data_message').html(output);
    }

    lazzy_loader(limit);

    function load_data(limit, start) {
        $.ajax({
            url: "<?php echo base_url(); ?>Dashboard/get_jurnal",
            method: "POST",
            data: {
                limit: limit,
                start: start
            },
            cache: false,
            success: function(data) {
                if (data == '') {
                    $('#load_data_message').html('');
                    // $('#read-more').hide();
                    action = 'active';
                } else {
                    $('#load_data').append(data);
                    $('#load_data_message').html('');
                    action = 'inactive';
                }
            }
        })
    }

    if (action == 'inactive') {
        action = 'active';
        load_data(limit, start);
    }

    // Tombol Next Page
    $(document).on('click', '#read-more-art', function() {
        if (action == 'inactive') {
            lazzy_loader(limit);
            action = 'active';
            start = start + limit;
            setTimeout(function() {
                load_data(limit, start);
            }, 1000);
        }
    });

});
</script>