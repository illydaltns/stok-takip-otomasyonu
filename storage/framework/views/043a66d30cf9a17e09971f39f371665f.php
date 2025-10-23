<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>STOK TAKİP SİSTEMİ</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;700&family=Open+Sans:wght@400;600&family=Poppins:wght@700&display=swap" rel="stylesheet">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    html, body {
      font-family: 'Open Sans', sans-serif;
      scroll-behavior: smooth;
      background: url('<?php echo e(asset('images/mavi.jpg')); ?>') no-repeat center center fixed;
      background-size: cover;
      color: #000;
    }

    .follower {
      position: fixed;
      top: 0;
      left: 0;
      width: 180px;
      height: 180px;
      border-radius: 50%;
      pointer-events: none;
      z-index: 0;
      transform: translate(-50%, -50%);
      background: radial-gradient(circle, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0));
      filter: blur(50px);
      animation: pulse 3s infinite ease-in-out;
    }

    @keyframes pulse {
      0%, 100% {
        transform: scale(1) translate(-50%, -50%);
        opacity: 1;
      }
      50% {
        transform: scale(1.3) translate(-50%, -50%);
        opacity: 0.6;
      }
    }

    .hero {
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
      padding: 30px;
      position: relative;
      z-index: 1;
    }

    .site-title {
      font-family: 'Poppins', sans-serif;
      font-size: 4rem;
      text-transform: uppercase;
      letter-spacing: 4px;
      margin-bottom: 20px;
    }

    .coffee-text {
      font-size: 1.2rem;
      max-width: 700px;
      margin: 0 auto 30px auto;
      line-height: 1.7;
    }

    .login-buttons {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      justify-content: center;
    }

    .login-buttons button {
      background-color: transparent;
      color: #000;
      border: 2px solid #000;
      padding: 10px 28px;
      font-size: 1.1rem;
      border-radius: 25px;
      font-family: 'Montserrat', sans-serif;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .login-buttons button:hover {
      background-color: #000;
      color: #fff;
    }

    .section {
      padding: 100px 20px;
      background-color: #fff;
      text-align: center;
      position: relative;
      z-index: 1;
    }

    .section h2 {
      font-size: 2.5rem;
      margin-bottom: 20px;
      font-family: 'Poppins', sans-serif;
    }

    .section p {
      font-size: 1.1rem;
      max-width: 800px;
      margin: 0 auto;
      line-height: 1.8;
    }

    /* Kayan yazı efekti */
    .slide-in {
      opacity: 0;
      transform: translateY(50px);
      animation: slideIn 1s ease-out forwards;
    }

    .slide-delay-1 { animation-delay: 0.3s; }
    .slide-delay-2 { animation-delay: 0.6s; }
    .slide-delay-3 { animation-delay: 0.9s; }

    @keyframes slideIn {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @media (max-width: 768px) {
      .site-title {
        font-size: 2.5rem;
      }

      .coffee-text {
        font-size: 1rem;
        padding: 0 10px;
      }

      .login-buttons {
        flex-direction: column;
        gap: 15px;
      }
    }
  </style>
</head>
<body>

  <!-- FARE TAKİP EFEKTİ -->
  <div class="follower" id="mouse-follower"></div>

  <!-- GİRİŞ -->
  <section class="hero">
    <div>
      <div class="site-title slide-in slide-delay-1">STOK TAKİP SİSTEMİ</div>
      <p class="coffee-text slide-in slide-delay-2">
        Bu sistem, kafenizin tüm stok süreçlerini kolaylaştırmak için geliştirildi.<br>
        Satışlarla otomatik güncellenen stoklar, kritik seviyeye indiğinde sizi uyarır.<br>
        Hem çalışanlar hem yöneticiler için sade, hızlı ve akıllı bir çözüm sunar.<br><br>
        <strong>Stok yönetimini dijitalleştir, kontrolü elinde tut.</strong>
      </p>
      <div class="login-buttons slide-in slide-delay-3">
        <button onclick="location.href='/login?role=employee'">ÇALIŞAN GİRİŞİ</button>
        <button onclick="location.href='/login?role=admin'">YÖNETİCİ GİRİŞİ</button>
      </div>
    </div>
  </section>

  <!-- BİLGİLENDİRME -->
  <section class="section">
    <h2>Neden Bu Sistemi Kullanmalısınız?</h2>
    <p>
      Kafe yönetiminde stok takibi artık daha kolay. Ürün satışlarınız anlık olarak stoktan düşer, 
      kritik seviyelere ulaşan malzemeler için otomatik uyarılar alırsınız. Günlük raporlar, kullanıcı 
      yetkilendirme ve daha fazlasıyla operasyonel yükünüz azalır. Her şey kontrolünüz altında.
    </p>
  </section>

  <!-- ALT TANITIM -->
  <section class="hero">
    <div>
      <div class="site-title slide-in">KAFENİZİN GELECEĞİ</div>
      <p class="coffee-text slide-in">
        Akıllı stok takibiyle kayıpları önleyin, verimliliği artırın.<br>
        Bu sistem sadece bir araç değil, işinizi kolaylaştıran bir asistandır.<br><br>
        <strong>Her yudum, doğru bir veriyle desteklenmeli.</strong>
      </p>
      <div class="login-buttons slide-in">
        <button onclick="location.href='/register'">SİSTEME KAYIT OL</button>
      </div>
    </div>
  </section>

  <!-- JS: FARE TAKİP -->
  <script>
    const follower = document.getElementById('mouse-follower');
    document.addEventListener('mousemove', e => {
      follower.style.left = e.clientX + 'px';
      follower.style.top = e.clientY + 'px';
    });
  </script>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\Projelerim\StokTakipOtomasyonu\resources\views/home.blade.php ENDPATH**/ ?>