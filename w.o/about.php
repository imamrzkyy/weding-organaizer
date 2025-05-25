<?php
    include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>About Us - Wedding Organizer</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      padding-top: 80px;
    }

    .about-section {
      background: linear-gradient(to right, #fff, #fdf3f3);
      color: #4b0000;
    }

    .about-title {
      color: #4b0000;
      font-weight: bold;
    }

    .about-description {
      text-align: justify;
      color: #4b0000;
    }

    .about-img {
      position: relative;
      width: 300px;
      height: 300px;
      object-fit: cover;
      border-radius: 50%;
      border: 5px solid #4b0000;
      box-shadow: 0 4px 15px rgba(0,0,0,0.2);
      transition: transform 0.3s ease;
    }

    .about-img:hover {
      transform: scale(1.05);
    }

    .founder-name {
      font-size: 1.5rem;
      font-weight: 700;
      margin-top: 15px;
      color: #4b0000;
    }

    .founder-title {
      color: #6c757d;
      font-size: 1rem;
    }

    .section-bg {
      background-color: #fdf3f3;
    }

    .vision-mission-section {
  background-color: #4b0000;
  color:  #f3c623;
  }

    .section-title {
      font-weight: bold;
      color: #f3c623;
    }

    .section-subtitle {
      color: #ffffff;
      font-size: 1.1rem;
    }

    .vision-box, .mission-box {
      background-color: #fff8dc;
      border: none;
      border-radius: 15px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
      transition: transform 0.3s ease;
    }

    .vision-box:hover, .mission-box:hover {
      transform: translateY(-5px);
    }

    .card-title {
      color: #4b0000;
      font-weight: 600;
      margin-bottom: 15px;
    }

    .card-text li {
      margin-bottom: 10px;
    }

    .wa-button {
      position: fixed;
      bottom: 20px;
      right: 20px;
      z-index: 999;
    }

    .wa-button img {
      width: 160px;
    }

  </style>
</head>
<body>
<?php
    include 'header.php';
?>

  <!-- About Section -->
  <section class="about-section py-5 section-bg" >
    <div class="container">
      <div class="row align-items-center">
        <!-- Left: Text -->
        <div class="col-md-6 mb-4 mb-md-0">
          <h2 class="about-title mb-3">Tentang Kami</h2>
          <p class="about-description">
            Kami adalah wedding organizer profesional yang berdedikasi membantu Anda merencanakan pernikahan impian dengan penuh kehangatan dan ketelitian.
            Dengan pengalaman bertahun-tahun dan tim kreatif, kami memastikan setiap detail berjalan sempurna. Dari konsep hingga hari-H, kami siap menjadi mitra Anda.
          </p>
          <p class="about-description">
            Visi kami adalah menciptakan momen pernikahan yang tak terlupakan dan penuh kebahagiaan bagi setiap pasangan.
          </p>
        </div>

        <!-- Right: Founder Photo & Name -->
        <div class="col-md-6 text-center">
          <img src="assets/img/photo-8.jpg" alt="Founder Photo" class="about-img">
          <div class="founder-name"> -- </div>
          <div class="founder-title">Founder & Lead Planner</div>
        </div>
      </div>
    </div>
    <!-- Visi dan Misi Section -->
<section class="vision-mission-section py-5">
  <div class="container">
    <div class="row text-center mb-5">
      <div class="col">
        <h2 class="section-title">Visi & Misi Kami</h2>
        <p class="section-subtitle">Mewujudkan momen terbaik dalam hidup Anda dengan penuh cinta dan profesionalisme.</p>
      </div>
    </div>
    <div class="row">
      <!-- Visi -->
      <div class="col-md-6 mb-4">
        <div class="card h-100 vision-box">
          <div class="card-body">
            <h3 class="card-title">Visi</h3>
            <p class="card-text">
              Menjadi wedding organizer terkemuka yang dipercaya menciptakan pernikahan impian yang elegan, berkesan, dan penuh kebahagiaan di setiap langkahnya.
            </p>
          </div>
        </div>
      </div>
      <!-- Misi -->
      <div class="col-md-6 mb-4">
        <div class="card h-100 mission-box">
          <div class="card-body">
            <h3 class="card-title">Misi</h3>
            <ul class="card-text text-start">
              <li>Mendengarkan dan memahami keinginan setiap pasangan.</li>
              <li>Menghadirkan konsep kreatif dan inovatif sesuai tema impian.</li>
              <li>Memberikan layanan terbaik dengan tim profesional dan ramah.</li>
              <li>Menjaga kualitas dan detail agar hari pernikahan berjalan sempurna.</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- WhatsApp Button -->
  <div class="wa-button">
    <a href="https://wa.me/6289506112503" target="_blank">
      <img src="assets/img/whatsapp-icon.png" alt="Hubungi Kami via WhatsApp">
    </a>
  </div>
  
  <?php
    include 'footer.php';
?>
</section>

  </section>

</body>
</html>
