<?php
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $description = $_POST['description'];
  $imageName = null;

  if ($_FILES['image']['name']) {
    $imageName = basename($_FILES["image"]["name"]);
    $targetPath = "../uploads/" . $imageName;
    move_uploaded_file($_FILES["image"]["tmp_name"], $targetPath);
  }

  $stmt = $conn->prepare("INSERT INTO gallery (image, description) VALUES (?, ?)");
  $stmt->bind_param("ss", $imageName, $description);
  $stmt->execute();

  header("Location: ../admin.php");
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Tambah Galeri</title>
  <link rel="stylesheet" href="../style/output.css">
</head>
<body class="bg-gray-100 p-10">
  <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-semibold mb-4">Tambah Gambar Galeri</h2>
    <form method="POST" enctype="multipart/form-data">
      <label class="block mb-2">Deskripsi</label>
      <textarea name="description" rows="3" class="w-full border px-3 py-2 rounded mb-4" required></textarea>

      <label class="block mb-2">Upload Gambar</label>
      <input type="file" name="image" class="w-full border px-3 py-2 rounded mb-4" required>

      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
    </form>
  </div>
</body>
</html>
