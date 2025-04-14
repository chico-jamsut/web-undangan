<?php
$host = 'localhost';
$user = 'root';
$pass = ''; // atau sesuai konfigurasi kamu
$db = 'gsx';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
