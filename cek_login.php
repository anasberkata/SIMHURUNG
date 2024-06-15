<?php
session_start();

if (isset($_SESSION['login'])) {
    header("Location: view_admin/index.php");
    exit;
}

require "functions.php";

$username = $_POST['username'];
$password = $_POST['password'];

$login = mysqli_query($conn, "SELECT * FROM `users` WHERE `username` = '$username'");
$cek = mysqli_num_rows($login);

if ($cek > 0) {
    $data = mysqli_fetch_assoc($login);

    if (password_verify($password, $data['password'])) {
        if ($data['role_id'] == 1) {
            $_SESSION['login'] = true;
            $_SESSION['id'] = $data['id_user'];

            header("Location: view_admin/index.php");
        } elseif ($data['role_id'] == 2) {
            $_SESSION['login'] = true;
            $_SESSION['id'] = $data['id_user'];

            header("Location: view_admin/index.php");
        }
    } else {
        header("Location: index.php?pesan=Password salah");
    }
} else {
    header("Location: index.php?pesan=Anda tidak terdaftar");
}
