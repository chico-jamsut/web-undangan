<?php
include 'koneksi.php'; // Pastikan path koneksi.php benar

$query = "SELECT * FROM articles ORDER BY date DESC";
$result = $conn->query($query);
?>

<div id="artikel" class="max-w-5xl mx-auto bg-white p-6 rounded shadow">
  <div class="flex justify-between items-center mb-6">
    <h2 class="text-3xl font-bold text-gray-800">Daftar Artikel</h2>
    <a href="tambah-artikel.php" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Tambah Artikel</a>
  </div>

  <?php if ($result->num_rows > 0): ?>
    <div class="grid gap-6">
    <?php while ($row = $result->fetch_assoc()): ?>
      <div class="bg-gray-50 border border-gray-200 rounded p-4">
        <div class="flex gap-4">
          <?php if (!empty($row['image'])): ?>
            <img src="../uploads/<?= htmlspecialchars($row['image']) ?>" alt="Thumbnail"
                 class="w-40 h-28 object-cover rounded shadow">
          <?php endif; ?>
          
          <div class="flex-1">
            <h3 class="text-xl font-semibold text-gray-800 mb-1"><?= htmlspecialchars($row['title']) ?></h3>
            <p class="text-sm text-gray-500 mb-2">Tanggal: <?= date('d M Y', strtotime($row['date'])) ?></p>
            <p class="text-gray-700 text-sm mb-2"><?= nl2br(htmlspecialchars(substr($row['content'], 0, 150))) ?>...</p>

            <?php if (!empty($row['list'])): ?>
              <ul class="list-disc list-inside text-sm text-gray-600 mb-2">
                <?php foreach (explode("\n", $row['list']) as $item): ?>
                  <li><?= htmlspecialchars(trim($item)) ?></li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>

            <?php if (!empty($row['quote'])): ?>
              <blockquote class="border-l-4 border-cyan-400 pl-4 italic text-gray-500 text-sm">
                "<?= htmlspecialchars($row['quote']) ?>"
              </blockquote>
            <?php endif; ?>

            <?php if (!empty($row['note'])): ?>
              <p class="text-sm text-blue-600 italic mt-2">Catatan: <?= htmlspecialchars($row['note']) ?></p>
            <?php endif; ?>
          </div>

          <div class="flex flex-col gap-2">
            <a href="edit-artikel.php?id=<?= $row['id'] ?>"
               class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 text-sm">Edit</a>
            <a href="hapus-artikel.php?id=<?= $row['id'] ?>&type=article"
               onclick="return confirm('Yakin hapus artikel ini?')"
               class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 text-sm">Hapus</a>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
    </div>
  <?php else: ?>
    <p class="text-gray-500 text-center py-8">Belum ada artikel yang ditambahkan.</p>
  <?php endif; ?>
</div>