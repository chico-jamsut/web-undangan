<?php
include 'koneksi.php';
$result = $conn->query("SELECT * FROM gallery ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Kelola Galeri</title>
  <link rel="stylesheet" href="../style/output.css">
</head>
<body class="bg-gray-100 p-10">

  <div id="galeri" class="max-w-6xl mx-auto bg-white p-6 rounded shadow admin-tab hidden">
    <h2 class="text-3xl font-semibold text-gray-800 mb-6">Manajemen Galeri</h2>

    <a href="./admin/tambah-galeri.php" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-6 inline-block">+ Tambah Galeri</a>

    <?php if ($result->num_rows > 0): ?>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php while($row = $result->fetch_assoc()): ?>
          <div class="bg-gray-50 border rounded p-4 shadow hover:shadow-md transition">
            <img src="uploads/<?= $row['image'] ?>" class="w-full h-48 object-cover rounded mb-3" />
            <p class="text-sm text-gray-700 mb-3"><?= $row['description'] ?></p>
            <div class="flex justify-between text-sm text-gray-600">
              <a href="gallery-edit.php?id=<?= $row['id'] ?>" class="text-blue-600 hover:underline">Edit</a>
              <a href="gallery-delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin mau hapus?')" class="text-red-600 hover:underline">Hapus</a>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
    <?php else: ?>
      <div class="text-center py-10 text-gray-500 text-lg">
        Belum ada data galeri yang ditambahkan.
      </div>
    <?php endif; ?>
  </div>

</body>
</html>
