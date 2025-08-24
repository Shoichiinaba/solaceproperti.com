<script>
var segment_city = '<?= $this->uri->segment(4); ?>';
var segment_penawaran = '<?= $this->uri->segment(2); ?>';
var segment_properti = "<?= $this->uri->segment(3); ?>";

$(document).ready(function() {
    let start = 0; // Starting index
    let limit = window.innerWidth <= 768 ? 4 : 5; // Set initial limit based on screen size mobile 4 dekstop 5
    let lastLoadedStart = 0;
    let data_properti = 'all';

    function button_city() {
        $('.li-city-sm').on('click', function() {
            segment_city = $(this).data('city');
            const currentPath = window.location.pathname.split('/');
            load_data_properti(segment_city);
            const segment = currentPath[3];
            const targetElement = $('#' + segment);
            const city = segment_city;
            // console.log('btn' + city);
            add_city_url(city);
        });
    }

    $('.row-btn-vw-next, .next-slide').on('click', function(e) {
        e.preventDefault(); // Prevent default link behavior
        lastLoadedStart = start; // Store the last loaded start index
        start = start + limit; // Update start index
        data_properti = $(this).data('properti');
        load_data_properti(segment_city); // Load more data
    });

    function load_data_kota() {
        // console.log(segment_city + '-' + start + '-' + limit)
        let formData = new FormData();
        formData.append('filter-kota', '<?= $this->uri->segment(4); ?>');
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url('Properti/get_kota'); ?>",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(data) {
                $('#load-data-kota-bottom').html(data);

                if (segment_penawaran == 'proyek_baru' || segment_penawaran == 'jualsewa') {
                    load_data_properti(segment_city);
                }
                button_city();
            },
            error: function() {
                alert("Data Gagal Diupload");
            }
        });
    }
    let loadedIds = {
        rumah: [],
        perumahan: [],
        ruko: [],
        kavling: []
    };

    function load_data_properti(segment_city) {
        // console.log(segment_city + '-' + start + '-' + limit + '-' + segment_penawaran)
        $.ajax({
            url: "<?php echo base_url('Properti/get_properti/'); ?>",
            type: 'POST', // or 'POST' if that's what you are using
            dataType: 'json',
            data: {
                segment_penawaran: segment_penawaran,
                segment_city: segment_city,
                data_properti: data_properti,
                start: start,
                limit: limit
            },
            success: function(response) {
                if (response == 'No more data available') {
                    // Handle the case when no more data is available
                    // console.log('No more data to load');
                } else {
                    // Function to avoid appending duplicate data
                    function appendUniqueData(container, data) {
                        let tempDiv = $('<div>').html(data); // Load data into a temporary div
                        tempDiv.children().each(function() {
                            let itemId = $(this).attr(
                                'data-id'
                            ); // Assuming each item has a unique data-id attribute
                            if ($('#' + container + ' [data-id="' + itemId + '"]')
                                .length === 0) {
                                $('#' + container).append($(
                                    this)); // Append only if it doesn't exist
                            }
                        });
                    }

                    // If this is the initial load, replace the existing content
                    if (start === lastLoadedStart) {
                        $('#load-data-rumah').html(response.rumah); // Load initial data for Rumah
                        $('#load-data-perumahan').html(response
                            .perumahan); // Load initial data for Perumahan
                        $('#load-data-ruko').html(response.ruko); // Load initial data for Ruko
                        $('#load-data-kavling').html(response
                            .kavling); // Load initial data for Kavling
                        dataLoaded = true;

                        const currentPath = window.location.pathname.split('/');
                        const segment = currentPath[4];
                        $('#main-page').removeAttr('hidden', true);
                        if (dataLoaded && segment) {
                            scrollToSection(segment);
                            activateMenuItem(segment);
                            $("#li-" + segment_properti).trigger('click');

                        }
                    } else {
                        // If it's not the initial load, append new data and avoid duplicates
                        if (data_properti == 'rumah') {
                            appendUniqueData('load-data-rumah', response.rumah);
                        } else if (data_properti == 'perumahan') {
                            appendUniqueData('load-data-perumahan', response.perumahan);
                        } else if (data_properti == 'ruko') {
                            appendUniqueData('load-data-ruko', response.ruko);
                        } else if (data_properti == 'kavling') {
                            appendUniqueData('load-data-kavling', response.kavling);
                        }
                        // console.log('New data loaded');
                    }
                }
            },
            error: function() {
                alert("Data Gagal Diupload");
            }
        });
    }

    function appendData(container, newData, loadedIdsArray) {
        // Parse new data if it's in a string format (JSON to HTML)
        let newDataParsed = $(newData);

        // Loop through new data and check for duplicates
        newDataParsed.each(function() {
            let id = $(this).data('id'); // Assuming each item has a data-id attribute

            if (!loadedIdsArray.includes(id)) {
                loadedIdsArray.push(id); // Track the ID as loaded
                $(container).append($(this)); // Append only non-duplicate data
            }
        });
    }
    load_data_kota();

    // Trigger click event on the element with the dynamically generated class

    $('.btn-penawaran, .dijual, .disewa, .takeover, .lelang').click(function() {
        // alert('yaa');
        var url_banner = 'https://admin.solaceproperti.com/upload/banner/';
        var target_penawaran = '';
        // Check if the button already has 'active' data-btn
        if ($(this).attr('data-btn') == 'active') {
            $(this).removeClass('active');
            $(this).attr('data-btn', ''); // Clear the data-btn attribute
            $('#banner-penawaran').attr('src', url_banner +
                'All_Properti.jpg'); // Reset banner to default
            target_penawaran = 'jualsewa';
        } else {
            // Remove 'active' class and data-btn from all buttons
            $('.btn-penawaran').removeClass('active').attr('data-btn', '');

            // Set the appropriate banner based on the clicked button
            if ($(this).data('penawaran') == 'dijual') {
                $('#banner-penawaran').attr('src', url_banner + 'Properti_Dijual.jpg');
            } else if ($(this).data('penawaran') == 'disewa') {
                $('#banner-penawaran').attr('src', url_banner + 'Properti_Disewa.jpg');
            } else if ($(this).data('penawaran') == 'takeover') {
                $('#banner-penawaran').attr('src', url_banner + 'Properti_Disewa.jpg');
            } else if ($(this).data('penawaran') == 'lelang') {
                $('#banner-penawaran').attr('src', url_banner + 'Properti_Disewa.jpg');
            }
            // Add 'active' class and set the data-btn attribute to 'active'
            $(this).addClass('active').attr('data-btn', 'active');
            target_penawaran = $(this).data('penawaran');
        }
        segment_penawaran = target_penawaran;
        change_url_penawaran(target_penawaran);
        showhide_display(segment_penawaran);
        load_data_properti(segment_city);
    });

    $("." + segment_penawaran).trigger('click');
    $(".main-segment").attr('id', segment_penawaran);

});

var swiper = new Swiper('.swiper', {
    loop: true,
    watchSlidesProgress: true,
    autoplay: {
        delay: 3000,
    },
    pagination: {
        el: '.swiper-pagination',
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    scrollbar: {
        el: '.swiper-scrollbar',
    },
    slidesPerView: 1, // Display 4 slides per view
    spaceBetween: 10, // Adjust space between slides if needed
});

const initSlider = () => {
    const sliderWrappers = document.querySelectorAll(".slider-wrapper");

    sliderWrappers.forEach(wrapper => {
        const imageList = wrapper.querySelector(".image-list");
        const prevButton = wrapper.querySelector(".prev-slide");
        const nextButton = wrapper.querySelector(".next-slide");
        const maxScrollLeft = imageList.scrollWidth - imageList.clientWidth;

        prevButton.addEventListener("click", () => {
            imageList.scrollBy({
                left: -imageList.clientWidth,
                behavior: "smooth"
            });
        });

        nextButton.addEventListener("click", () => {
            imageList.scrollBy({
                left: imageList.clientWidth,
                behavior: "smooth"
            });
        });
        const handleSlideButtons = () => {
            // console.log('scoll swiper');
            // Calculate the maximum scrollable width
            const maxScrollLeft = imageList.scrollWidth - imageList.clientWidth;
            // Show or hide buttons depending on the current scroll position
            prevButton.style.display = imageList.scrollLeft <= 0 ? "none" : "block";
            nextButton.style.display = imageList.scrollLeft >= maxScrollLeft ? "none" : "block";
        };

        imageList.addEventListener("scroll", handleSlideButtons);
        nextButton.style.display = "block";

        // Initial button state
        handleSlideButtons();
    });
};

// Initialize the slider after DOM content is fully loaded
document.addEventListener("DOMContentLoaded", initSlider);
window.addEventListener("resize", initSlider);
window.addEventListener("load", initSlider);

let dataLoaded = false;

const sectionIdMapping = {
    'header': 'header',
    'rumah': 'rumah',
    'perumahan': 'perumahan',
    'ruko': 'ruko',
    'kavling': 'kavling'
};

function scrollToSection(segment) {
    if (segment) {
        const targetSectionId = sectionIdMapping[segment];
        if (targetSectionId) {
            const targetElement = document.getElementById(targetSectionId);
            if (targetElement) {
                const isMobile = window.innerWidth <= 768;
                let mobileOffset = 230;
                let desktopOffset = 110;

                if (segment_city !== '') {
                    mobileOffset = 230;
                }

                const customOffset = isMobile ? mobileOffset : desktopOffset;
                setTimeout(() => {
                    const elementPosition = targetElement.getBoundingClientRect().top + window.pageYOffset;
                    const offsetPosition = elementPosition - customOffset;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });
                }, 300);
            }
        }
    }
}

let gripBox = document.getElementById('rollbox');
let gripBanner = document.getElementById('bannerbox');

$('.toggleOn').click(function() {
    if ($(this).attr('data-toggle') == 'active') {
        $(this).attr('data-toggle', 'off');
        gripBox.className = 'rollNow';
        $('.main').addClass('filter-city-active');
    } else {
        $(this).attr('data-toggle', 'active');
        gripBox.className = 'rollNot';
        $('.main').removeClass('filter-city-active');
    }
});

function rollout() {
    gripBox.className = 'rollNow';
    gripBanner.className = 'bannerOut';
}

function rollin() {
    gripBox.className = 'rollNot';
}

function activateMenuItem(segment) {
    const targetId = sectionIdMapping[segment];
    listItems.forEach(item => {
        const itemTarget = item.getAttribute('data-target');
        const icon = item.querySelector('.menu-li-properi');
        if (itemTarget === targetId && icon) {
            icon.classList.add('active');
            change_url(targetId);
            gripBox.className = 'rollNot';
            $('.main').removeClass('filter-city-active');
        } else if (icon) {
            icon.classList.remove('active');
        }

        // if (targetId == 'perumahan') {
        //     $('.main-segment').attr('id', 'perumahan');
        // } else {
        //     $('.main-segment').attr('id', 'dijual');
        // }
        if (targetId == 'header') {
            // console.log(targetId);
            $('#ul-menu-left').removeClass('active');
            // $('.text-penawarann-properti').removeClass('active');
        } else {
            $('#ul-menu-left').addClass('active');
            // $('.text-penawarann-properti').addClass('active');
        }
    });
}

const listItems = document.querySelectorAll('.li-menu-properti');
const sections = document.querySelectorAll('section');

window.addEventListener('scroll', () => {
    let top = window.innerWidth <= 768 ? 2 : 2;
    let bottom = window.innerWidth <= 768 ? 8 : 4;
    if (dataLoaded) {
        sections.forEach(section => {
            const rect = section.getBoundingClientRect();
            const targetId = section.getAttribute('id');
            if (rect.top <= window.innerHeight / top && rect.bottom >= window.innerHeight / bottom) {
                activateMenuItem(targetId);
            }
        });
    }
});

listItems.forEach(item => {
    item.addEventListener('click', function() {
        // console.log('click menu')
        if (dataLoaded) {
            const targetId = this.getAttribute('data-target');
            const targetElement = document.getElementById(targetId);

            if (targetElement) {
                const isMobile = window.innerWidth <= 768;
                let mobileOffset = 230;
                let desktopOffset = 110;

                if (segment_city !== '') {
                    mobileOffset = 230;
                }

                const customOffset = isMobile ? mobileOffset : desktopOffset;

                const elementPosition = targetElement.getBoundingClientRect().top + window.pageYOffset;
                const offsetPosition = elementPosition - customOffset;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            }
        }
    });
});
showhide_display(segment_penawaran);

function showhide_display(segment_penawaran) {
    if (segment_penawaran === 'proyek_baru') {
        $('#banner-penawaran,#li-kavling, #kavling, #li-ruko, #ruko, #li-rumah, #rumah').hide();
        $('.posi-btn-jualsewa').hide();
        $('.text-penawarann-properti').addClass('active');
        $('#perumahan').addClass('pt-5');
    } else if (segment_penawaran === 'disewa') {
        $('#li-perumahan, #perumahan, #li-kavling, #kavling').hide();
    } else {
        $('#banner-penawaran,#li-kavling, #kavling, #li-ruko, #ruko, #li-rumah, #rumah, #li-perumahan,#perumahan')
            .show();
        $('.posi-btn-jualsewa').show();
        $('.text-penawarann-properti').removeClass('active');
        $('#perumahan').removeClass('pt-5');
    }
}

function change_url(targetId) {
    var currentUrl = window.location.href;
    var url = new URL(currentUrl);
    var segments = url.pathname.split('/');
    var dijualIndex = segments.indexOf('Properti');

    if (dijualIndex !== -1) {
        if (segments[dijualIndex + 2]) {
            segments[dijualIndex + 2] = targetId;
        } else {
            segments[dijualIndex + 2] = targetId;
        }

        url.pathname = segments.join('/');
        history.pushState(null, null, url.toString());
        change_meta();
    }
}

function change_url_penawaran(target_penawaran) {
    var currentUrl = window.location.href;
    var url = new URL(currentUrl);
    var segments = url.pathname.split('/');
    var dijualIndex = segments.indexOf('Properti');

    if (dijualIndex !== -1) {
        if (segments[dijualIndex + 1]) {
            segments[dijualIndex + 1] = target_penawaran;
        } else {
            segments[dijualIndex + 1] = target_penawaran;
        }

        url.pathname = segments.join('/');
        history.pushState(null, null, url.toString());
        change_meta();
    }
}

function add_city_url(city) {
    var currentUrl = window.location.href;
    var url = new URL(currentUrl);
    var segments = url.pathname.split('/');
    var dijualIndex = segments.indexOf('Properti');

    if (dijualIndex !== -1) {
        if (segments[dijualIndex + 3]) {
            segments[dijualIndex + 3] = city;
        } else {
            segments[dijualIndex + 3] = city;
        }

        url.pathname = segments.join('/');
        history.pushState(null, null, url.toString());
        change_meta();
    }
}

function change_meta() {
    var currentUrl = window.location.href;
    var urlSegments = currentUrl.split('/');
    var segmentPenawaran = urlSegments[5];
    var segmentProperti = urlSegments[6];
    var segmentCity = urlSegments[7];
    console.log(segmentPenawaran + ' ' + segmentProperti + ' ' + segmentCity);

    if (segmentCity == '#disewa' || segmentCity == '#dijual') {
        segmentCity = '';
    }

    if (segmentPenawaran == 'jualsewa') {
        segmentPenawaran = 'Dijual & Disewa';
    } else {
        segmentPenawaran = segmentPenawaran.charAt(0).toUpperCase() + segmentPenawaran.slice(1)
        if (segmentPenawaran.startsWith('di')) {
            Penawaranremovedi = segmentPenawaran.slice(2); // Remove the first two characters 'di'
        }
    }

    var formattedCity = segmentCity ? segmentCity.replace(/[^a-z0-9]+/gi, ' ') : '';
    if (formattedCity !== '') { // Correct condition to check if formattedCity is not empty
        formattedCity = 'Di ' + formattedCity;
    } else {
        formattedCity = 'Di Indonesia';
    }
    $('#text-url-aktif').text("Properti " + segmentPenawaran + ' ' + segmentProperti + ' ' + formattedCity);


    if (segmentProperti == 'rumah') {
        console.log('Rumah')
        // Rumah
        //  primary
        document.title = segmentPenawaran + 'Rumah Terbaik ' + formattedCity + ' 2024 - Temukan Rumah Impian Anda ' +
            formattedCity;
        $('meta[name="description"]').attr('content', 'Temukan rumah ' + segmentPenawaran + ' terbaik Anda' +
            formattedCity +
            '  Dapatkan rumah impian Anda dengan harga terjangkau dan pilihan yang sesuai kebutuhan.');
        $('meta[name="keywords"]').attr('content', Penawaranremovedi + 'rumah,' + segmentPenawaran + ' rumah ' +
            formattedCity + ', rumah ' + segmentPenawaran + formattedCity + ', rumah murah' + formattedCity +
            ', rumah impian 2024' + formattedCity + ', properti rumah' + formattedCity);
        // facebook
        $('meta[property="og:title"]').attr('content', segmentPenawaran + ' Rumah Terbaik 2024 ' + formattedCity +
            ' - Temukan Rumah Impian Anda' + formattedCity);
        $('meta[property="og:description"]').attr('content',
            'Cari rumah idaman Anda dengan mudah di marketplace terpercaya. ' + Penawaranremovedi +
            ' rumah dengan harga terbaik ' + formattedCity + '.');
        // twitter
        $('meta[name="twitter:]').attr('content', segmentPenawaran + ' Rumah Terbaik 2024 - Temukan Rumah Impian Anda');
        $('meta[name="twitter:]').attr('content', 'Temukan rumah yang sesuai dengan kebutuhan Anda ' + formattedCity +
            '. Penawaran terbaik ' + formattedCity + '.');

    } else if (segmentProperti == 'perumahan') {
        console.log('Perumahan')
        // Perumahan
        //  primary
        document.title = 'Perumahan Terbaik 2024 - ' + segmentPenawaran + ' Perumahan ' + formattedCity;
        $('meta[name="description"]').attr('content', 'Temukan perumahan impian Anda ' + formattedCity +
            '. Dijual perumahan dengan fasilitas lengkap dan harga bersaing. ' + segmentCity);
        $('meta[name="keywords"]').attr('content', 'perumahan ' + segmentCity + ', dijual perumahan ' + segmentCity +
            ', perumahan baru ' + segmentCity + ', perumahan 2024 ' + segmentCity + ', properti perumahan' +
            segmentCity);
        // facebook
        $('meta[property="og:title"]').attr('content', 'Perumahan Terbaik 2024 - ' + segmentPenawaran + ' Perumahan ' +
            segmentCity);
        $('meta[property="og:description"]').attr('content', 'Cari perumahan terbaik di lokasi strategis ' +
            segmentCity + '. Dijual perumahan dengan harga bersaing dan fasilitas unggulan ' + segmentCity);
        // twitter
        $('meta[name="twitter:]').attr('content', 'Perumahan Terbaik 2024 - ' + segmentPenawaran + ' Perumahan ' +
            segmentCity);
        $('meta[name="twitter:]').attr('content', 'Jual perumahan ' + segmentCity +
            ' dengan fasilitas terbaik. Temukan perumahan impian Anda sekarang.' + segmentCity);

    } else if (segmentProperti == 'ruko') {
        console.log('Ruko')
        // Ruko
        //  primary
        document.title = segmentPenawaran + ' Ruko Strategis 2024 - Investasi Properti Terbaia';
        $('meta[name="description"]').attr('content', 'Temukan ruko di lokasi strategis untuk keperluan bisnis ' +
            segmentCity + '. ' + segmentPenawaran + ' ruko dengan harga terbaik ' + segmentCity + '.');
        $('meta[name="keywords"]').attr('content', segmentPenawaran + ' ruko, ' + Penawaranremovedi +
            ' ruko, ruko strategis ' + segmentCity + ', investasi ruko, ruko 2024, ruko untuk bisnis' + segmentCity);
        // facebook
        $('meta[property="og:title"]').attr('content', segmentPenawaran +
            ' Ruko Strategis 2024 - Investasi Properti Terbaik' + segmentCity);
        $('meta[property="og:description"]').attr('content', 'Ruko ' + segmentPenawaran +
            ' dengan lokasi strategis untuk bisnis Anda. Dapatkan penawaran terbaik ' + segmentCity + '.');
        // twitter
        $('meta[name="twitter:]').attr('content', segmentPenawaran +
            ' Ruko Strategis 2024 - Investasi Properti Terbaik' + segmentCity);
        $('meta[name="twitter:]').attr('content', 'Temukan ruko di lokasi terbaik untuk usaha Anda ' + segmentCity +
            '. ' + segmentPenawaran + ' ruko ' + segmentCity + ' dengan penawaran menarik.');

    } else if (segmentProperti == 'kavling') {
        console.log('Kavling')
        // Kavling
        //  primary
        document.title = 'Kavling Terbaik 2024 - Jual Kavling di Lokasi Strategis ' + segmentCity;
        $('meta[name="description"]').attr('content', 'Cari kavling strategis untuk investasi atau pembangunan ' +
            segmentCity + '. Jual kavling dengan pilihan lokasi terbaik ' + segmentCity + '.');
        $('meta[name="keywords"]').attr('content', 'jual kavling ' + segmentCity + ', Dijual kavling ' + segmentCity +
            ', kavling strategis ' + segmentCity + ', properti kavling ' + segmentCity + ', kavling 2024 ' +
            segmentCity + ', investasi tanah ' + segmentCity);
        // facebook
        $('meta[property="og:title"]').attr('content', 'Kavling Terbaik 2024 - Dijual Kavling di Lokasi Strategis ' +
            segmentCity);
        $('meta[property="og:description"]').attr('content', 'Temukan kavling di lokasi strategis ' + segmentCity +
            ' untuk investasi atau pembangunan properti. Jual kavling dengan harga menarik.');
        // twitter
        $('meta[name="twitter:]').attr('content', 'Kavling Terbaik 2024 - Dijual Kavling di Lokasi Strategis ' +
            segmentCity);
        $('meta[name="twitter:]').attr('content', 'Jual kavling di lokasi strategis ' + segmentCity +
            ' untuk investasi properti. Temukan pilihan kavling terbaik ' + segmentCity + '.');
    }
    var currentUrl = window.location.href;
    $('meta[property="og:url"]').attr('content', currentUrl);
    // console.log(currentUrl);

}

// $('meta[name="robots"]').attr('content', 'index, follow');
// $('meta[property="og:type"]').attr('cont', 'ent="website');
// $('meta[name="twitter:]').attr('ard', 'content="summary_large_image');


// if (targetElement.length) {
//     // Determine if the device is mobile or desktop based on window width
//     const isMobile = $(window).width() <= 768;
//     const customOffset = isMobile ? 160 : 100;

//     // Calculate the exact scroll position
//     const elementPosition = targetElement.offset().top;
//     const offsetPosition = elementPosition - customOffset;

//     // Scroll to the calculated position with smooth behavior
//     $('html, body').animate({
//         scrollTop: offsetPosition
//     }, 100); // 600ms duration for smooth scroll
// }

// function get_segments() {
//     var currentUrl = window.location.href;

//     // Remove any trailing slash at the end if it exists
//     if (currentUrl.endsWith('/')) {
//         currentUrl = currentUrl.slice(0, -1);
//     }

//     // Split the URL into segments
//     var urlSegments = currentUrl.split('/');

//     // Return each segment dynamically
//     return {
//         segment1: urlSegments[2], // 'localhost'
//         segment2: urlSegments[3], // 'ecom_kanpa'
//         segment3: urlSegments[4], // 'Properti'
//         segment4: urlSegments[5], // 'dijual'
//         segment5: urlSegments[6], // 'rumah' (or whatever the last segment is)
//     };
// }

// // Example usage:
// var segments = get_segments();
// console.log('Segment 1:', segments.segment1);
// console.log('Segment 2:', segments.segment2);
// console.log('Segment 3:', segments.segment3);
// console.log('Segment 4:', segments.segment4);
// console.log('Segment 5:', segments.segment5);
</script>