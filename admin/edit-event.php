<?php
include '../koneksi.php';

$id = $_GET['id'] ?? null;
if (!$id) {
  header("Location: ../admin.php");
  exit;
}

$query = $conn->prepare("SELECT * FROM events WHERE id = ?");
$query->bind_param("i", $id);
$query->execute();
$result = $query->get_result();
$event = $result->fetch_assoc();

if (!$event) {
  echo "Event tidak ditemukan.";
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title = $_POST['title'];
  $date = $_POST['date'];
  $location = $_POST['location'];
  $description = $_POST['description'];

  // Cek apakah gambar baru diupload
  if ($_FILES['image']['name']) {
    $imageName = basename($_FILES["image"]["name"]);
    $targetPath = "../uploads/" . $imageName;
    move_uploaded_file($_FILES["image"]["tmp_name"], $targetPath);
  } else {
    $imageName = $event['image']; // tetap pakai yang lama
  }

  $stmt = $conn->prepare("UPDATE events SET title = ?, date = ?, location = ?, image = ?, description = ? WHERE id = ?");
  $stmt->bind_param("sssssi", $title, $date, $location, $imageName, $description, $id);
  $stmt->execute();

  header("Location: ../admin.php");
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Event</title>
  <link rel="stylesheet" href="../style/output.css">
</head>
<body class="bg-gray-100 p-10">
  <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-semibold mb-4">Edit Event</h2>
    <form method="POST" enctype="multipart/form-data">
      <label class="block mb-2">Judul Event</label>
      <input type="text" name="title" value="<?= htmlspecialchars($event['title']) ?>" class="w-full border px-3 py-2 rounded mb-4" required>

      <label class="block mb-2">Tanggal Event</label>
      <input type="date" name="date" value="<?= htmlspecialchars($event['date']) ?>" class="w-full border px-3 py-2 rounded mb-4" required>

      <label class="block mb-2">Lokasi Event</label>
      <input type="text" name="location" value="<?= htmlspecialchars($event['location']) ?>" class="w-full border px-3 py-2 rounded mb-4" required>

      <label class="block mb-2">Gambar (Kosongkan jika tidak diganti)</label>
      <input type="file" name="image" class="w-full border px-3 py-2 rounded mb-4">
      <?php if ($event['image']): ?>
        <img src="../uploads/<?= $event['image'] ?>" alt="Event Image" class="w-32 h-32 object-cover rounded mb-4">
      <?php endif; ?>

      <label class="block mb-2">Deskripsi Event</label>
      <textarea name="description" rows="5" class="w-full border px-3 py-2 rounded mb-4"><?= htmlspecialchars($event['description']) ?></textarea>

      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
    </form>
  </div>
</body>
</html>
