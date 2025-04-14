<?php
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title = $_POST['title'];
  $date = $_POST['date'];
  $content = $_POST['content'];
  $list = $_POST['list'];
  $quote = $_POST['quote'];
  $note = $_POST['note'];

  // Cek apakah ada file diupload
  if ($_FILES['image']['name']) {
    $imageName = basename($_FILES["image"]["name"]);
    $targetPath = "../uploads/" . $imageName;
    move_uploaded_file($_FILES["image"]["tmp_name"], $targetPath);
  } else {
    $imageName = null; // default kosong
  }

  $stmt = $conn->prepare("INSERT INTO articles (title, date, image, content, list, quote, note) VALUES (?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("sssssss", $title, $date, $imageName, $content, $list, $quote, $note);
  $stmt->execute();

  header("Location: ../admin.php");
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Tambah Artikel</title>
  <link rel="stylesheet" href="../style/output.css">
</head>
<body class="bg-gray-100 p-10">
  <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-semibold mb-4">Tambah Artikel Baru</h2>
    <form method="POST" enctype="multipart/form-data">
      <label class="block mb-2">Judul</label>
      <input type="text" name="title" class="w-full border px-3 py-2 rounded mb-4" required>

      <label class="block mb-2">Tanggal</label>
      <input type="date" name="date" class="w-full border px-3 py-2 rounded mb-4" required>

      <label class="block mb-2">Upload Gambar</label>
      <input type="file" name="image" class="w-full border px-3 py-2 rounded mb-4">

      <label class="block mb-2">Konten</label>
      <textarea name="content" rows="5" class="w-full border px-3 py-2 rounded mb-4"></textarea>

      <label class="block mb-2">List (dipisahkan dengan koma)</label>
      <textarea name="list" rows="3" class="w-full border px-3 py-2 rounded mb-4"></textarea>

      <label class="block mb-2">Quote</label>
      <textarea name="quote" rows="2" class="w-full border px-3 py-2 rounded mb-4"></textarea>

      <label class="block mb-2">Catatan (Note)</label>
      <textarea name="note" rows="3" class="w-full border px-3 py-2 rounded mb-4"></textarea>

      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
    </form>
  </div>
</body>
</html>
