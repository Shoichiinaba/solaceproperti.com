<script>
    var swiper = new Swiper('.swiper', {
        loop: true,
        watchSlidesProgress: true,
        autoplay: {
            delay: 3000
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
        on: {
            slideChangeTransitionEnd: function(s) {
                var i = s.progress;
                var params = s.params;
                // console.log("progress" + i);
                if (i >= 1) {
                    swiper.destroy(false, false);
                    params.autoplay = false;
                    swiper = new Swiper('.swiper', params);
                }
            }
        }
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
                prevButton.style.display = imageList.scrollLeft <= 0 ? "none" : "block";
                nextButton.style.display = imageList.scrollLeft >= maxScrollLeft ? "none" : "block";
            };

            imageList.addEventListener("scroll", () => {
                handleSlideButtons();
            });

            // Initial button state
            handleSlideButtons();
        });
    };

    // Initialize the slider after DOM content is fully loaded
    document.addEventListener("DOMContentLoaded", initSlider);

    window.addEventListener("resize", initSlider);
    window.addEventListener("load", initSlider);

    function formatCurrency(value) {
        // Convert the value to a string and remove any non-numeric characters
        var inputVal = value.toString().replace(/[^0-9]/g, '');

        // Format the number with commas as thousands separators
        return inputVal.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    }

    function parseCurrency(value) {
        // Remove non-numeric characters and parse as float
        return parseFloat(value.replace(/[^0-9]/g, '')) || 0;
    }

    function calculateKPR() {
        // Get and parse input values
        var hargaProperti = parseCurrency($("#hargaProperti").val());
        var uangMuka = parseCurrency($("#uangMuka").val());

        // Calculate the loan amount (Jumlah Pinjaman)
        var jumlahPinjaman = hargaProperti - uangMuka;
        $("#jumlahPinjaman").val(formatCurrency(jumlahPinjaman));

        var jangkaWaktu = parseFloat($("#jangkaWaktu").val()) || 0;
        var sukuBunga = parseFloat($("#sukuBunga").val()) || 0;

        // Calculate the monthly interest rate
        var bungaPerBulan = sukuBunga / 100 / 12;

        // Calculate the total number of installments (Jumlah Angsuran)
        var jumlahAngsuran = jangkaWaktu * 12;

        if (jumlahPinjaman > 0 && sukuBunga > 0 && jumlahAngsuran > 0) {
            // Calculate the monthly payment (Angsuran per Bulan)
            var angsuranPerBulan = (jumlahPinjaman * bungaPerBulan) / (1 - Math.pow(1 + bungaPerBulan, -jumlahAngsuran));

            // Round to the nearest integer and format the result
            var roundedAngsuranPerBulan = Math.round(angsuranPerBulan);

            // Update the result in the DOM
            $('#hasil').text('Rp.' + formatCurrency(roundedAngsuranPerBulan));
        } else {
            $('#hasil').text('Rp.-');
        }
    }
    $('#hargaProperti').on('input', function() {
        $('#hasil-hargaProperti').text('Rp.' + formatCurrency($(this).val()));
    })
    // Attach event listeners to inputs for calculation and formatting
    $('input').on('input', function() {
        // Format the value before calculating
        $(this).val(formatCurrency(parseCurrency($(this).val())));
        calculateKPR(); // Calculate KPR
    });

    $('li').each(function(index) {
        // Set new ID for the checkbox and the label
        var checkboxId = 'chek' + (index + 1);

        // Find the input (checkbox) and label within the current li element
        $(this).find('input[type="checkbox"]').attr('id', checkboxId);
        $(this).find('label').attr('for', checkboxId);
    });
</script>