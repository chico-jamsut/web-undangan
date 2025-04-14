<?php
include '../koneksi.php';

$id = $_GET['id'];
$query = $conn->query("SELECT * FROM gallery WHERE id=$id");
$data = $query->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $description = $_POST['description'];

  // Proses gambar baru jika ada
  if ($_FILES['image']['name']) {
    $targetDir = "../uploads/";
    $filename = time() . '_' . basename($_FILES["image"]["name"]);
    $targetFilePath = $targetDir . $filename;
    $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

    if (in_array($imageFileType, $allowedTypes)) {
      if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
        // (Opsional) Hapus gambar lama jika ada
        if (!empty($data['image']) && file_exists("../uploads/" . $data['image'])) {
          unlink("../uploads/" . $data['image']);
        }

        // Update data beserta gambar baru
        $conn->query("UPDATE gallery SET description='$description', image='$filename' WHERE id=$id");
      }
    }
  } else {
    // Hanya update deskripsi
    $conn->query("UPDATE gallery SET description='$description' WHERE id=$id");
  }

  header("Location: ../admin.php");
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Galeri</title>
  <link rel="stylesheet" href="../style/output.css">
</head>
<body class="bg-gray-100 p-10">

  <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-semibold mb-4">Edit Deskripsi Galeri</h2>
    <form method="POST" enctype="multipart/form-data">
      <img src="../uploads/<?= htmlspecialchars($data['image']) ?>" class="w-full h-60 object-cover rounded mb-4" />
      
      <label class="block mb-2 font-semibold">Deskripsi:</label>
      <textarea name="description" rows="4" class="w-full border px-3 py-2 rounded mb-4"><?= htmlspecialchars($data['description']) ?></textarea>

      <label class="block mb-2 font-semibold">Ganti Gambar (Opsional):</label>
      <input type="file" name="image" accept="image/*" class="mb-4">

      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan Perubahan</button>
    </form>
  </div>

</body>
</html>
