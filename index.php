<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Navbar Example</title>
  <link rel="stylesheet" href="./style/output.css">
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Oswald:wght@400;600&display=swap" rel="stylesheet">

<style>
    html{
scroll-behavior: smooth;
    }
    body {
    font-family: 'Oswald', sans-serif;
    background-color: #111;
    color: white;
  }

    .slider-track {
      transition: transform 0.5s ease;
    }
    h1, .logo {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 28px;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: #ff2d2d;
  }

  .section-title {
            position: relative;
            display: inline-block;
            margin-bottom: 3rem;
        }
        .section-title:after {
            content: '';
            position: absolute;
            width: 50%;
            height: 3px;
            background: #dc2626;
            bottom: -10px;
            left: 25%;
        }
  </style>
</head>
<body>

<?php include './src/nav.php'; ?>

  <!-- Slider -->
<!-- Slider -->
<div class="relative overflow-hidden w-full h-[500px]">

  <!-- Overlay background + text -->
  <div class="absolute inset-0 bg-black/50 flex items-center justify-center z-10 pointer-events-none">
  <div class="text-center px-4 max-w-3xl mx-auto pointer-events-auto">
    <h2 class="text-4xl md:text-5xl font-bold text-white mb-2">Bersama Dalam Satu Jalan, Satu Tujuan</h2>
    <p class="text-lg md:text-xl text-gray-200">
      Kami bukan sekadar komunitas, kami adalah keluarga. Klub motor kami menyatukan jiwa-jiwa petualang yang tak takut menghadapi tantangan di setiap tikungan kehidupan. Bergabunglah dan rasakan semangat persaudaraan sejati di atas dua roda.
    </p>
  </div>
</div>


  <!-- Gambar slider -->
  <div id="slider" class="flex transition-transform duration-500 ease-in-out">
    <img src="./public/gsx.webp" class="w-screen h-full object-cover" />
    <img src="./public/gsx2.webp" class="w-screen h-full object-cover" />
  </div>

  <!-- Tombol Next & Prev -->
  <button id="prevBtn" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/60 text-black px-3 py-1 rounded hover:bg-white z-20">❮</button>
  <button id="nextBtn" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/60 text-black px-3 py-1 rounded hover:bg-white z-20">❯</button>
</div>

  
  
  
<?php include './src/profile.php' ?>
<?php include './src/visi.php' ?>
<?php include './src/galeri.php' ?>
<?php include './src/produk.php' ?>
<?php include './src/kontak.php' ?>
<?php include './src/tentang.php' ?>

<!-- Footer -->
<?php include './src/footer.php' ?>


  <script>
    const slider = document.getElementById('slider');
    const totalSlides = slider.children.length;
    let currentIndex = 0;
    let interval;
  
    function updateSlider() {
      slider.style.transform = `translateX(-${currentIndex * 100}vw)`;
    }
  
    function showNextSlide() {
      currentIndex = (currentIndex + 1) % totalSlides;
      updateSlider();
    }
  
    function showPrevSlide() {
      currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
      updateSlider();
    }
  
    function startAutoSlide() {
      interval = setInterval(showNextSlide, 3000); // ganti slide tiap 3 detik
    }
  
    function stopAutoSlide() {
      clearInterval(interval);
    }
  
    document.getElementById('nextBtn').addEventListener('click', () => {
      stopAutoSlide();
      showNextSlide();
      startAutoSlide();
    });
  
    document.getElementById('prevBtn').addEventListener('click', () => {
      stopAutoSlide();
      showPrevSlide();
      startAutoSlide();
    });
  
    // Mulai auto slide saat halaman dimuat
    startAutoSlide();


    const navbar = document.getElementById('navbar');

window.addEventListener('scroll', () => {
  if (window.scrollY > 50) {
    navbar.classList.remove('bg-black/60', 'text-white');
    navbar.classList.add('bg-white', 'text-black', 'shadow-md');
  } else {
    navbar.classList.remove('bg-white', 'text-black', 'shadow-md');
    navbar.classList.add('bg-black/60', 'text-white');
  }
});
  </script>
    </body>
</html>
