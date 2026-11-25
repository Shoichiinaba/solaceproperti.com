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
            console.log("progress" + i);
            if (i >= 1) {
                swiper.destroy(false, false);
                params.autoplay = false;
                swiper = new Swiper('.swiper', params);
            }
        }
    }
});

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

// Example value and operation
var m = '1000000000';
var jt = '1000000';

var nominal = $('.nominal').text();
var satuan = $('.satuan').text();
if (satuan == 'M-an') {
    nominal = parseFloat(nominal) * m;
} else if (satuan == 'Jt-an') {
    nominal = parseFloat(nominal) * jt;
}

// Set formatted value to the input field
$('#hargaProperti').val(formatCurrency(nominal));

// Attach event listeners to inputs for calculation and formatting
$('input').on('input', function() {
    // Format the value before calculating
    $(this).val(formatCurrency(parseCurrency($(this).val())));

    calculateKPR(); // Calculate KPR
});

function toggleDetailHome() {
    const section = document.getElementById("home");
    if (window.innerWidth >= 992) { // desktop breakpoint
        section.classList.add("detail-home");
    } else {
        section.classList.remove("detail-home");
    }
}

// jalankan saat load dan resize
toggleDetailHome();
window.addEventListener("resize", toggleDetailHome);

$(document).on('click', '.view-properti', function(e) {
    var id = $(this).data('id-properti');

    // Update viewer ke server
    $.ajax({
        url: "<?php echo base_url('Dashboard/add_viewer_properti'); ?>",
        method: "POST",
        data: {
            id_properti: id
        },
        success: function(res) {
            try {
                var data = JSON.parse(res);
                if (data.status === 'success') {
                    // Cari counter sesuai ID
                    var counter = $('[data-viewer-target="' + id + '"]');
                    if (counter.length) {
                        var current = parseInt(counter.text().replace(/\D/g, '')) || 0;
                        counter.html('<i class="bi bi-eye"></i> ' + (current + 1).toLocaleString(
                            'id-ID'));
                    }
                }
            } catch (e) {
                console.error("Invalid JSON:", res);
            }
        }
    });
});
</script>