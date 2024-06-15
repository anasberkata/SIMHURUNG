<?php
session_start();

if (!isset($_SESSION['login'])) {
	header("Location: ../index.php");
	exit;
}

require "../functions.php";

// Ambil user_id dan gambar dari URL
$user_id = $_GET['user_id'];
$gambar = $_GET['gambar'];

// Buat array data untuk dikirim ke fungsi pengguna_hapus
$data = [
	'user_id' => $user_id,
	'gambar' => $gambar
];

if (pengguna_hapus($data) > 0) {
	echo "
        <script>
            alert('Pengguna berhasil dihapus!');
            document.location.href = 'pengguna.php';
        </script>
    ";
} else {
	echo "
        <script>
            alert('Pengguna gagal dihapus!');
            document.location.href = 'pengguna.php';
        </script>
    ";
}
