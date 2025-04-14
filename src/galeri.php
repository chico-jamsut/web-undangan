<?php
include 'koneksi.php';
$result = $conn->query("SELECT * FROM gallery ORDER BY created_at DESC LIMIT 6"); // ambil max 6 data terbaru
?>

<section id="galeri" class="px-6 md:px-24 py-16 bg-gray-50">
  <div class="mb-12">
    <h2 class="text-4xl font-bold text-red-600 section-title">Galeri Foto</h2>
    <p class="text-gray-500 mt-2">Dokumentasi kegiatan kami</p>
  </div>

  <?php if ($result->num_rows > 0): ?>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
      <?php while($row = $result->fetch_assoc()): ?>
        <div class="overflow-hidden rounded-xl shadow-md group cursor-zoom-in">
          <img 
            src="uploads/<?= $row['image'] ?>" 
            alt="Foto Galeri" 
            class="w-full h-60 object-cover transition-transform duration-300 group-hover:scale-105"
            onclick="openModal('uploads/<?= $row['image'] ?>')"
          >
          <div class="bg-white p-4">
            <p class="text-gray-700 text-sm"><?= $row['description'] ?></p>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  <?php else: ?>
    <div class="text-center text-gray-500 py-10">
      Belum ada foto di galeri.
    </div>
  <?php endif; ?>
</section>

<!-- Modal Zoom -->
<div id="zoomModal" class="fixed inset-0 bg-black bg-opacity-70 hidden justify-center items-center z-50" onclick="closeModal()">
  <img id="zoomImage" class="max-w-full max-h-[90vh] rounded shadow-lg">
</div>

<script>
  function openModal(src) {
    document.getElementById('zoomImage').src = src;
    document.getElementById('zoomModal').classList.remove('hidden');
    document.getElementById('zoomModal').classList.add('flex');
  }

  function closeModal() {
    document.getElementById('zoomModal').classList.remove('flex');
    document.getElementById('zoomModal').classList.add('hidden');
  }
</script>
