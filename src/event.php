<?php
include '../koneksi.php';
$query = "SELECT * FROM events ORDER BY date DESC LIMIT 3";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acara GSX Brotherhood</title>
    <link rel="stylesheet" href="../style/output.css">
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&family=Roboto+Condensed:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Oswald:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        html {
            scroll-behavior: smooth;
            background-color: #000;
        }
        body {
    font-family: 'Oswald', sans-serif;
    background-color: #111;
    color: white;
  }

    h1, .logo {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 28px;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: #ff2d2d;
  }
        .event-header {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('../public/event-banner.jpg');
            background-size: cover;
            background-position: center;
            height: 60vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            border-bottom: 3px solid #dc2626;
        }
        h1, .event-title {
            font-family: 'Russo One', sans-serif;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: #dc2626;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }
        .event-card {
            background: linear-gradient(145deg, #1a1a1a, #0d0d0d);
            border: 1px solid #333;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.5);
            transition: all 0.3s ease;
            overflow: hidden;
        }
        .event-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(220, 38, 38, 0.3);
            border-color: #dc2626;
        }
        .event-date {
            background-color: #dc2626;
            padding: 0.5rem 1rem;
            display: inline-block;
            font-weight: bold;
            position: absolute;
            top: 1rem;
            right: 1rem;
            z-index: 2;
        }
        .event-image {
            height: 250px;
            transition: transform 0.5s ease;
        }
        .event-card:hover .event-image {
            transform: scale(1.05);
        }
        .event-details {
            position: relative;
            padding: 1.5rem;
        }
        .register-btn {
            background-color: #dc2626;
            transition: all 0.3s ease;
            font-weight: bold;
            letter-spacing: 1px;
        }
        .register-btn:hover {
            background-color: #b91c1c;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(220, 38, 38, 0.4);
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

        .modal {
    background-color: rgba(0, 0, 0, 0.7);
    backdrop-filter: blur(6px);
  }
    </style>
</head>
<body>

<?php include '../nav.php' ?>

<!-- Banner Header Event -->
<div class="event-header">
    <h1 class="text-5xl md:text-6xl mb-4">EVENT MENDATANG</h1>
    <p class="text-xl max-w-2xl px-4">Ikuti perjalanan dan kumpul bareng GSX Brotherhood!</p>
    <div class="mt-8">
        <a href="#events" class="register-btn px-8 py-3 rounded-md text-white font-bold">
            LIHAT EVENT <i class="fas fa-chevron-down ml-2"></i>
        </a>
    </div>
</div>

<!-- Bagian Event -->
<section id="events" class="py-20 px-4 md:px-8 lg:px-16">
    <div class="max-w-6xl mx-auto">
        <h2 class="text-4xl text-center section-title">AGENDA GSX BROTHERHOOD</h2>
        
        <?php if ($result->num_rows > 0): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="event-card rounded-lg">
                        <div class="relative overflow-hidden">
                            <span class="event-date rounded-md">
                                <?= date('d M', strtotime($row['date'])) ?>
                            </span>
                            <img src="../uploads/<?= htmlspecialchars($row['image']) ?>" 
                                 alt="<?= htmlspecialchars($row['title']) ?>" 
                                 class="w-full event-image object-cover">
                        </div>
                        <div class="event-details">
  <h3 class="event-title text-2xl mb-2"><?= htmlspecialchars($row['title']) ?></h3>
  <p class="text-gray-400 mb-4 flex items-center">
    <i class="fas fa-map-marker-alt mr-2 text-red-600"></i>
    <?= htmlspecialchars($row['location']) ?>
  </p>
  <p class="text-gray-300 mb-4"><?= mb_strimwidth(htmlspecialchars($row['description']), 0, 100, '...') ?></p>
  <button 
    onclick="showModal('<?= htmlspecialchars(addslashes($row['title'])) ?>', '<?= htmlspecialchars(addslashes($row['description'])) ?>')" 
    class="register-btn px-4 py-2 rounded text-sm">
    Read More
  </button>
</div>

                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-16">
                <i class="fas fa-calendar-times text-6xl text-gray-600 mb-4"></i>
                <h3 class="text-2xl text-gray-300 mb-2">BELUM ADA EVENT</h3>
                <p class="text-gray-500">Pantau terus jadwal kami untuk acara berikutnya.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Call to Action -->
<!-- <section class="py-16 bg-black bg-opacity-70 border-y border-gray-800">
    <div class="max-w-4xl mx-auto text-center px-4">
        <h2 class="text-3xl md:text-4xl mb-6">MAU BIKIN ACARA BARENG KAMI?</h2>
        <p class="text-gray-400 mb-8 text-lg">Hubungi tim acara kami untuk kolaborasi dalam touring, kopdar, atau kegiatan sosial.</p>
        <a href="#contact" class="register-btn inline-block px-10 py-3 text-lg rounded-md">
            HUBUNGI KAMI <i class="fas fa-envelope ml-2"></i>
        </a>
    </div>
</section> -->
<!-- Modal -->
<div id="modal" class="fixed inset-0 hidden z-50 modal flex items-center justify-center px-4">
  <div class="bg-[#111] text-white rounded-lg max-w-2xl w-full p-6 relative shadow-2xl border border-gray-800 max-h-[80vh] overflow-y-auto">
    <h3 id="modal-title" class="text-2xl text-red-600 mb-4 font-bold"></h3>
    <div id="modal-content" class="text-gray-300 space-y-4 leading-relaxed"></div>
    <button onclick="closeModal()" class="absolute top-3 right-4 text-gray-500 hover:text-red-500 text-xl">
      &times;
    </button>
  </div>
</div>

<!-- Footer -->
<?php include 'footer.php' ?>


</body>
<script>
    function showModal(title, content) {
    document.getElementById('modal-title').textContent = title;
    document.getElementById('modal-content').innerHTML = content;
    document.getElementById('modal').classList.remove('hidden');
  }

  function closeModal() {
    document.getElementById('modal').classList.add('hidden');
  }
</script>
</html>
