<?php
include '../koneksi.php';
$query = "SELECT * FROM articles ORDER BY date DESC LIMIT 3";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Artikel GSX Brotherhood</title>
  <link rel="stylesheet" href="../style/output.css" />
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
    .header-divider {
      height: 3px;
      background: linear-gradient(90deg, #dc2626, #7f1d1d);
      width: 150px;
    }
    .article-card {
      background: linear-gradient(145deg, #111111, #0a0a0a);
      border: 1px solid #2a2a2a;
      box-shadow: 0 10px 15px rgba(0, 0, 0, 0.5);
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .article-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 20px 25px rgba(220, 38, 38, 0.2);
      border-color: #dc2626;
    }
    .article-image {
      height: 220px;
      transition: transform 0.5s ease;
    }
    .article-card:hover .article-image {
      transform: scale(1.05);
    }
    .date-badge {
      background: linear-gradient(135deg, #dc2626, #991b1b);
      padding: 0.25rem 1rem;
      border-radius: 9999px;
      font-size: 0.75rem;
      font-weight: bold;
      text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
    }
    .content-preview {
      display: -webkit-box;
      -webkit-line-clamp: 3;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }
    .stats {
      color: #a3a3a3;
      font-size: 0.75rem;
    }
    .stats i {
      color: #dc2626;
    }
    .empty-state {
      background: rgba(17, 17, 17, 0.7);
      backdrop-filter: blur(5px);
      border: 1px solid #2a2a2a;
    }

    .modal {
    background-color: rgba(0, 0, 0, 0.7);
    backdrop-filter: blur(6px);
  }
  </style>
</head>
<body class="min-h-screen">

<?php include '../nav.php' ?>

<!-- Main Content -->
<main class="py-20 px-4 sm:px-6 lg:px-8">
  <div class="max-w-6xl mx-auto">
    <!-- Header -->
    <div class="text-center mb-16 mt-48">
      <h2 class="text-5xl text-red-600 mb-4">ARTIKEL GSX BROTHERHOOD</h2>
      <div class="header-divider mx-auto mb-6"></div>
      <p class="text-gray-400 max-w-2xl mx-auto">Update terbaru seputar komunitas, modifikasi, dan event GSX</p>
    </div>

    <!-- Articles Grid -->
    <?php if ($result->num_rows > 0): ?>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php while ($row = $result->fetch_assoc()): ?>
          <article class="article-card rounded-xl overflow-hidden">
            <?php if ($row['image']): ?>
              <div class="relative overflow-hidden">
                <img src="../uploads/<?= htmlspecialchars($row['image']) ?>" 
                     alt="<?= htmlspecialchars($row['title']) ?>" 
                     class="w-full article-image object-cover">
                <span class="date-badge absolute top-4 right-4"><?= date('d M Y', strtotime($row['date'])) ?></span>
              </div>
            <?php endif; ?>
            
            <div class="p-6">
              <h3 class="text-2xl text-white mb-3 leading-tight"><?= htmlspecialchars($row['title']) ?></h3>
              
              <div class="content-preview text-gray-300 mb-4">
  <?= nl2br(htmlspecialchars(mb_substr($row['content'], 0, 150))) ?>...
</div>

<button 
  class="text-red-500 hover:underline text-sm font-semibold"
  onclick="openModal(`<?= htmlspecialchars(addslashes($row['title'])) ?>`, `<?= nl2br(htmlspecialchars(addslashes($row['content']))) ?>`)">
  Read More
</button>


              <?php if (!empty($row['list'])): ?>
                <ul class="space-y-2 mb-4 text-sm text-gray-400">
  <?php foreach (array_slice(explode("\n", $row['list']), 0, 3) as $item): ?>
    <li class="flex items-start">
      <i class="fas fa-check-circle text-red-600 mt-1 mr-2 flex-shrink-0"></i>
      <span><?= htmlspecialchars(trim($item)) ?></span>
    </li>
  <?php endforeach; ?>
</ul>

              <?php endif; ?>

              <div class="flex justify-between items-center pt-4 border-t border-gray-800">
                <div class="stats flex space-x-4">
                 
                </div>
                
              </div>
            </div>
          </article>
        <?php endwhile; ?>
      </div>

      <div class="text-center mt-16">
       
      </div>
    <?php else: ?>
      <div class="empty-state rounded-xl p-12 text-center max-w-2xl mx-auto">
        <i class="fas fa-newspaper text-5xl text-gray-600 mb-4"></i>
        <h3 class="text-xl text-gray-300 mb-2">Belum Ada Artikel</h3>
        <p class="text-gray-500">Kami sedang mempersiapkan konten terbaik untuk Anda</p>
      </div>
    <?php endif; ?>
  </div>
</main>
<!-- Modal -->
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
  function openModal(title, content) {
    document.getElementById('modal-title').innerHTML = title;
    document.getElementById('modal-content').innerHTML = content;
    document.getElementById('modal').classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
  }

  function closeModal() {
    document.getElementById('modal').classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
  }
</script>
</html>