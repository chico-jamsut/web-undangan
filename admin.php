<?php
session_start();
if (!isset($_SESSION['user'])) {
  header("Location: login.php");
  exit();
}

// Get username safely
$username = is_array($_SESSION['user']) ? 
    ($_SESSION['user']['username'] ?? 'Admin') : 
    $_SESSION['user'];

// Database connection and queries
include 'koneksi.php';
$artikelQuery = "SELECT * FROM articles ORDER BY date DESC";
$artikelResult = $conn->query($artikelQuery);

$eventQuery = "SELECT * FROM events ORDER BY date DESC";
$eventResult = $conn->query($eventQuery);

$galeriQuery = "SELECT * FROM gallery ORDER BY id DESC";  // Order by `id` or another column

$galeriResult = $conn->query($galeriQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="./style/output.css" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #0f172a;
      color: #e2e8f0;
    }
    .sidebar {
      width: 250px;
      transition: all 0.3s;
    }
    .sidebar-link {
      transition: all 0.2s;
    }
    .sidebar-link:hover {
      background-color: #1e293b;
    }
    .sidebar-link.active {
      background-color: #1e40af;
    }
    .content-area {
      margin-left: 250px;
      transition: all 0.3s;
    }
    .card {
      background-color: #1e293b;
      border-radius: 0.5rem;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    @media (max-width: 768px) {
      .sidebar {
        width: 0;
        overflow: hidden;
      }
      .content-area {
        margin-left: 0;
      }
      .sidebar.active {
        width: 250px;
      }
      .content-area.active {
        margin-left: 250px;
      }
    }
  </style>
</head>
<body class="min-h-screen flex">
  <!-- Sidebar -->
  <div class="sidebar fixed h-full bg-slate-800 p-4">
    <div class="flex items-center justify-between mb-8">
      <div class="flex items-center">
        <img src="./public/logo.png" alt="Logo" class="h-8 mr-2">
        <span class="text-xl font-bold">GSX Admin</span>
      </div>
      <button id="sidebarToggle" class="md:hidden text-gray-400">
        <i class="fas fa-times"></i>
      </button>
    </div>
    
    <div class="mb-6 px-2">
      <p class="text-sm text-gray-400">Welcome back,</p>
      <p class="font-medium"><?php echo htmlspecialchars($username); ?></p>
    </div>
    
    <nav>
      <a href="#artikel" class="sidebar-link active flex items-center px-4 py-3 rounded-lg mb-2">
        <i class="fas fa-newspaper mr-3"></i>
        <span>Artikel</span>
      </a>
      <a href="#event" class="sidebar-link flex items-center px-4 py-3 rounded-lg mb-2">
        <i class="fas fa-calendar-alt mr-3"></i>
        <span>Event</span>
      </a>
      <a href="#galeri" class="sidebar-link flex items-center px-4 py-3 rounded-lg mb-2">
        <i class="fas fa-images mr-3"></i>
        <span>Galeri</span>
      </a>
  
<a href="logout.php" class="logout-button flex items-center px-4 py-3 rounded-lg text-red-400 hover:bg-red-900/20">  <i class="fas fa-sign-out-alt mr-3"></i>Logout</a>


    </nav>
  </div>

  <!-- Main Content -->
  <div class="content-area flex-1 p-6">
    <button id="mobileMenuButton" class="md:hidden bg-slate-700 p-2 rounded-lg mb-4">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Artikel Section -->
    <div id="artikel" class="section">
      <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Daftar Artikel</h2>
        <a href="./admin/tambah-artikel.php" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
          <i class="fas fa-plus mr-2"></i> Tambah Artikel
        </a>
      </div>

      <?php if ($artikelResult->num_rows > 0): ?>
        <div class="grid gap-6">
          <?php while ($row = $artikelResult->fetch_assoc()): ?>
            <div class="card p-6">
              <div class="flex gap-4">
                <?php if (!empty($row['image'])): ?>
                  <img src="uploads/<?= htmlspecialchars($row['image']) ?>" alt="Thumbnail" class="w-40 h-28 object-cover rounded-lg shadow">
                <?php endif; ?>
                
                <div class="flex-1">
                  <h3 class="text-xl font-semibold mb-1"><?= htmlspecialchars($row['title']) ?></h3>
                  <p class="text-sm text-gray-400 mb-2"><?= date('d M Y', strtotime($row['date'])) ?></p>
                  <p class="text-gray-300 text-sm mb-2"><?= nl2br(htmlspecialchars(substr($row['content'], 0, 150))) ?>...</p>
                  
                  <div class="flex gap-2 mt-4">
                    <a href="./admin/edit-artikel.php?id=<?= $row['id'] ?>" class="bg-yellow-600 hover:bg-yellow-700 text-white px-3 py-1 rounded text-sm">
                      <i class="fas fa-edit mr-1"></i> Edit
                    </a>
                    <a href="./admin/hapus-artikel.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus artikel ini?')" 
                       class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">
                      <i class="fas fa-trash mr-1"></i> Hapus
                    </a>
                  </div>
                </div>
              </div>
            </div>
          <?php endwhile; ?>
        </div>
      <?php else: ?>
        <div class="card p-8 text-center">
          <i class="fas fa-newspaper text-4xl text-gray-500 mb-3"></i>
          <p class="text-gray-400">Belum ada artikel yang ditambahkan.</p>
        </div>
      <?php endif; ?>
    </div>

    <!-- Event Section -->
    <div id="event" class="section hidden">
      <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Daftar Event</h2>
        <a href="./admin/tambah-event.php" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
          <i class="fas fa-plus mr-2"></i> Tambah Event
        </a>
      </div>

      <?php if ($eventResult->num_rows > 0): ?>
        <div class="grid md:grid-cols-2 gap-6">
          <?php while ($row = $eventResult->fetch_assoc()): ?>
            <div class="card p-6">
              <?php if (!empty($row['image'])): ?>
                <img src="uploads/<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['title']) ?>" class="w-full h-48 object-cover rounded-lg mb-4">
              <?php endif; ?>
              
              <h3 class="text-xl font-semibold mb-1"><?= htmlspecialchars($row['title']) ?></h3>
              <p class="text-sm text-gray-400 mb-2">
                <i class="fas fa-calendar-day mr-2"></i><?= date('d M Y', strtotime($row['date'])) ?>
              </p>
              <p class="text-sm text-gray-400 mb-3">
                <i class="fas fa-map-marker-alt mr-2"></i><?= htmlspecialchars($row['location']) ?>
              </p>
              <p class="text-gray-300 text-sm mb-4"><?= nl2br(htmlspecialchars($row['description'])) ?></p>
              
              <div class="flex gap-2">
                <a href="./admin/edit-event.php?id=<?= $row['id'] ?>" class="bg-yellow-600 hover:bg-yellow-700 text-white px-3 py-1 rounded text-sm">
                  <i class="fas fa-edit mr-1"></i> Edit
                </a>
                <a href="./admin/hapus-event.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus event ini?')" 
                   class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">
                  <i class="fas fa-trash mr-1"></i> Hapus
                </a>
              </div>
            </div>
          <?php endwhile; ?>
        </div>
      <?php else: ?>
        <div class="card p-8 text-center">
          <i class="fas fa-calendar-times text-4xl text-gray-500 mb-3"></i>
          <p class="text-gray-400">Belum ada event yang ditambahkan.</p>
        </div>
      <?php endif; ?>
    </div>

    <!-- Galeri Section -->
   <!-- Galeri Section -->
<div id="galeri" class="section hidden">
  <div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">Daftar Galeri</h2>
    <a href="./admin/tambah-galeri.php" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
      <i class="fas fa-plus mr-2"></i> Tambah Foto
    </a>
  </div>

  <?php if ($galeriResult->num_rows > 0): ?>
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
      <?php while ($row = $galeriResult->fetch_assoc()): ?>
        <div class="card overflow-hidden">
          <img src="uploads/<?= htmlspecialchars($row['image']) ?>" alt="Galeri Foto" class="w-full h-48 object-cover">
          <div class="p-4">
            <div class="flex gap-2">
              <a href="./admin/edit-galeri.php?id=<?= $row['id'] ?>" class="text-blue-400 hover:text-blue-300">
                <i class="fas fa-edit"></i>
              </a>
              <a href="./admin/hapus-galeri.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus foto ini?')" 
                 class="text-red-400 hover:text-red-300">
                <i class="fas fa-trash"></i>
              </a>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  <?php else: ?>
    <div class="card p-8 text-center">
      <i class="fas fa-images text-4xl text-gray-500 mb-3"></i>
      <p class="text-gray-400">Belum ada foto di galeri.</p>
    </div>
  <?php endif; ?>
</div>

  </div>

  <script>
    // Navigation between sections
    document.querySelectorAll('.sidebar-link').forEach(link => {
      link.addEventListener('click', function(e) {
        e.preventDefault();
        
        // Hide all sections
        document.querySelectorAll('.section').forEach(section => {
          section.classList.add('hidden');
        });
        
        // Show selected section
        const targetId = this.getAttribute('href').substring(1);
        document.getElementById(targetId).classList.remove('hidden');
        
        // Update active link
        document.querySelectorAll('.sidebar-link').forEach(link => {
          link.classList.remove('active');
        });
        this.classList.add('active');
      });
    });

    // Mobile menu toggle
    const sidebar = document.querySelector('.sidebar');
    const content = document.querySelector('.content-area');
    const mobileMenuButton = document.getElementById('mobileMenuButton');
    const sidebarToggle = document.getElementById('sidebarToggle');

    mobileMenuButton.addEventListener('click', () => {
      sidebar.classList.add('active');
      content.classList.add('active');
    });

    sidebarToggle.addEventListener('click', () => {
      sidebar.classList.remove('active');
      content.classList.remove('active');
    });
  </script>
</body>
</html>