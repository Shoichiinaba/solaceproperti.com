<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Website Title</title>
  
  <!-- Font Awesome untuk ikon sosial media -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <style>
    /* CSS untuk tombol berbagi sosial media */
    .social-share {
      display: flex;
      gap: 10px;
      margin-top: 20px;
    }

    .btn-share {
      display: inline-block;
      padding: 10px 15px;
      border-radius: 5px;
      color: white;
      text-decoration: none;
      font-size: 16px;
      transition: background-color 0.3s ease;
    }

    .btn-share i {
      margin-right: 5px;
    }

    /* Warna latar belakang untuk setiap media sosial */
    #share-whatsapp { background-color: #25d366; }
    #share-messenger { background-color: #0084ff; }
    #share-facebook { background-color: #3b5998; }
    #share-telegram { background-color: #0088cc; }
    #copy-link { background-color: #333; }

    /* Warna sukses ketika berhasil menyalin */
    #copy-link.success {
      background-color: #28a745;
    }

    /* Responsif pada layar kecil */
    @media (max-width: 768px) {
      .social-share {
        flex-direction: column;
      }
    }

    /* Animasi untuk perubahan warna sukses */
    @keyframes successAnimation {
      0% {
        transform: scale(1);
      }
      50% {
        transform: scale(1.1);
      }
      100% {
        transform: scale(1);
      }
    }

    #copy-link.success {
      animation: successAnimation 0.5s ease-in-out;
    }
  </style>
</head>
<body>

  <h1>Contoh Artikel</h1>
  <p>Ini adalah contoh konten artikel yang bisa dibagikan ke media sosial.</p>

  <!-- Tombol berbagi sosial media -->
  <div class="social-share">
    <a href="#" id="share-whatsapp" class="btn-share" target="_blank">
      <i class="fab fa-whatsapp"></i> Share on WhatsApp
    </a>
    <a href="#" id="share-messenger" class="btn-share" target="_blank">
      <i class="fab fa-facebook-messenger"></i> Share on Messenger
    </a>
    <a href="#" id="share-facebook" class="btn-share" target="_blank">
      <i class="fab fa-facebook"></i> Share on Facebook
    </a>
    <a href="#" id="share-telegram" class="btn-share" target="_blank">
      <i class="fab fa-telegram"></i> Share on Telegram
    </a>
    <a href="#" id="copy-link" class="btn-share">
      <i class="fas fa-link"></i> Copy Link
    </a>
  </div>

  <!-- JavaScript untuk mengatur URL berbagi -->
  <script>
    const url = window.location.href;
    const title = document.title;

    // WhatsApp
    document.getElementById('share-whatsapp').href = 
      `https://api.whatsapp.com/send?text=${encodeURIComponent(title + " " + url)}`;

    // Facebook Messenger
    document.getElementById('share-messenger').href = 
      `fb-messenger://share/?link=${encodeURIComponent(url)}&app_id=YOUR_APP_ID`;

    // Facebook Branda
    document.getElementById('share-facebook').href = 
      `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`;

    // Telegram
    document.getElementById('share-telegram').href = 
      `https://t.me/share/url?url=${encodeURIComponent(url)}&text=${encodeURIComponent(title)}`;

    // Copy Link
    document.getElementById('copy-link').addEventListener('click', function(e) {
      e.preventDefault();
      navigator.clipboard.writeText(url).then(() => {
        const copyLinkBtn = document.getElementById('copy-link');
        copyLinkBtn.textContent = "Link Copied!";
        copyLinkBtn.classList.add('success');
        
        // Mengembalikan tampilan tombol setelah 2 detik
        setTimeout(() => {
          copyLinkBtn.textContent = "Copy Link";
          copyLinkBtn.classList.remove('success');
        }, 2000);
      }).catch(err => {
        console.error("Failed to copy the link: ", err);
      });
    });
  </script>

</body>
</html>
