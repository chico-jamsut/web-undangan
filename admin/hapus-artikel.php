<?php
include '../koneksi.php';

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  $stmt = $conn->prepare("DELETE FROM articles WHERE id = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();

  header("Location: ../admin.php");
  exit;
} else {
  echo "ID tidak ditemukan.";
}
?>
