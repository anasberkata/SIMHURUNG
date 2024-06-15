<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../index.php");
    exit;
}

require "../functions.php";

$id = $_SESSION['id'];

$user = query(
    "SELECT * FROM users
    INNER JOIN user_role ON users.role_id = user_role.id_role
    WHERE id_user = $id"
)[0];

ini_set('display_errors', 1); //Atau error_reporting(E_ALL && ~E_NOTICE);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywors"
        content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="../assets/img/setting/favicon.png" />

    <link rel="canonical" href="https://demo-basic.adminkit.io/" />

    <title>Sistem Informasi Monitoring Hama Burung</title>

    <link href="../assets/css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Other -->
    <link href="../vendor/simple-datatables/style.css" rel="stylesheet">
</head>

<body>
    <div class="wrapper">

        <?php
        include "../templates/aside.php";
        ?>

        <div class="main">

            <?php
            include "../templates/topbar.php";
            ?>

            <main class="content">
                <div class="container-fluid p-0">