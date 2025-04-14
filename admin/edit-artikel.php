<?php
include '../koneksi.php';

$id = $_GET['id'];
$query = "SELECT * FROM articles WHERE id = $id";
$result = $conn->query($query);
$artikel = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title = $_POST['title'];
  $date = $_POST['date'];
  $content = $_POST['content'];
  $list = $_POST['list'];
  $quote = $_POST['quote'];
  $note = $_POST['note'];

  // Cek jika ada upload file baru
  if ($_FILES['image']['name']) {
    $imageName = basename($_FILES["image"]["name"]);
    $targetPath = "../uploads/" . $imageName;
    move_uploaded_file($_FILES["image"]["tmp_name"], $targetPath);
  } else {
    $imageName = $artikel['image'];
  }

  $stmt = $conn->prepare("UPDATE articles SET title=?, date=?, image=?, content=?, list=?, quote=?, note=? WHERE id=?");
  $stmt->bind_param("sssssssi", $title, $date, $imageName, $content, $list, $quote, $note, $id);
  $stmt->execute();

  header("Location: ../admin.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Artikel</title>
  <link href="../style/output.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen py-10 px-4">

  <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4 text-gray-800">Edit Artikel</h2>
    <form action="" method="POST" enctype="multipart/form-data" class="grid gap-4">
      <input type="text" name="title" placeholder="Judul Artikel" value="<?= htmlspecialchars($artikel['title']) ?>" class="border p-2 rounded w-full" required>
      <input type="date" name="date" value="<?= $artikel['date'] ?>" class="border p-2 rounded w-full" required>
      <textarea name="content" placeholder="Isi Artikel" rows="5" class="border p-2 rounded w-full"><?= htmlspecialchars($artikel['content']) ?></textarea>
      <textarea name="list" placeholder="List (pisahkan dengan enter)" rows="3" class="border p-2 rounded w-full"><?= htmlspecialchars($artikel['list']) ?></textarea>
      <textarea name="quote" placeholder="Quote" rows="2" class="border p-2 rounded w-full"><?= htmlspecialchars($artikel['quote']) ?></textarea>

      <!-- NOTE -->
      <textarea name="note" placeholder="Catatan (Note)" rows="3" class="border p-2 rounded w-full"><?= htmlspecialchars($artikel['note']) ?></textarea>

      <div>
        <p class="text-sm text-gray-500 mb-1">Gambar Saat Ini:</p>
        <?php if ($artikel['image']): ?>
          <img src="../uploads/<?= $artikel['image'] ?>" class="w-40 mb-2 rounded shadow">
        <?php endif; ?>
        <input type="file" name="image" class="border p-2 rounded w-full">
      </div>

      <div class="flex justify-between">
        <a href="artikel_list.php" class="bg-gray-400 text-white px-4 py-2 rounded">Kembali</a>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
      </div>
    </form>
  </div>

</body>
</html>
