<?php
include 'koneksi.php'; // Pastikan path benar
$query = "SELECT * FROM events ORDER BY date DESC";
$result = $conn->query($query);
?>

<div id="event" class="admin-tab max-w-6xl mx-auto">
  <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
    <div>
      <h2 class="text-2xl font-bold text-gray-800">Daftar Event</h2>
      <p class="text-gray-500 text-sm">Kelola event GSX Brotherhood</p>
    </div>
    <a href="tambah-event.php" 
       class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md flex items-center gap-2 transition-colors">
      <i class="fas fa-plus"></i> Tambah Event
    </a>
  </div>

  <?php if ($result->num_rows > 0): ?>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php while ($row = $result->fetch_assoc()): ?>
        <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200 hover:shadow-xl transition-shadow">
          <?php if ($row['image']): ?>
            <div class="relative h-48 overflow-hidden">
              <img src="./uploads/<?= htmlspecialchars($row['image']) ?>" 
                   alt="<?= htmlspecialchars($row['title']) ?>" 
                   class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
              <span class="absolute top-3 right-3 bg-red-600 text-white text-xs font-bold px-3 py-1 rounded-full">
                <?= date('d M', strtotime($row['date'])) ?>
              </span>
            </div>
          <?php endif; ?>
          
          <div class="p-5">
            <div class="flex justify-between items-start gap-2">
              <h3 class="text-xl font-bold text-gray-800 mb-2"><?= htmlspecialchars($row['title']) ?></h3>
              <span class="text-xs bg-gray-100 text-gray-800 px-2 py-1 rounded-full whitespace-nowrap">
                <?= htmlspecialchars($row['type'] ?? 'Event') ?>
              </span>
            </div>
            
            <div class="flex items-center text-gray-600 mb-3">
              <i class="fas fa-map-marker-alt text-red-500 mr-2"></i>
              <span class="text-sm"><?= htmlspecialchars($row['location']) ?></span>
            </div>
            
            <p class="text-gray-700 text-sm mb-4 line-clamp-3">
              <?= nl2br(htmlspecialchars($row['description'])) ?>
            </p>
            
            <div class="flex justify-between items-center">
              <span class="text-xs text-gray-500">
                <i class="fas fa-users mr-1"></i> <?= $row['participants'] ?? '0' ?> Peserta
              </span>
              <div class="flex gap-2">
                <a href="edit-event.php?id=<?= $row['id'] ?>" 
                   class="text-yellow-600 hover:text-yellow-800 transition-colors"
                   title="Edit">
                  <i class="fas fa-edit"></i>
                </a>
                <a href="hapus-event.php?id=<?= $row['id'] ?>" 
                   onclick="return confirm('Yakin hapus event ini?')"
                   class="text-red-600 hover:text-red-800 transition-colors"
                   title="Hapus">
                  <i class="fas fa-trash"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  <?php else: ?>
    <div class="text-center py-12 bg-gray-50 rounded-lg">
      <i class="fas fa-calendar-times text-4xl text-gray-400 mb-3"></i>
      <h3 class="text-lg font-medium text-gray-600">Belum ada event</h3>
      <p class="text-gray-500 text-sm mt-1">Tambahkan event pertama Anda</p>
    </div>
  <?php endif; ?>
</div>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
