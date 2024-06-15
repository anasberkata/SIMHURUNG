<?php

// KONEKSI DATABASE =====================================================
$conn = mysqli_connect("localhost", "root", "", "db_simhurung");

require "vendor/autoload.php";

function format_tanggal($tanggal)
{
    $bulan = array(
        1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );

    $tanggal = explode('-', $tanggal);
    return $tanggal[2] . ' ' . $bulan[(int) $tanggal[1]] . ' ' . $tanggal[0];
}

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// ROLE
function role_tambah($data)
{
    global $conn;

    $role = $data['role'];

    $cek_role = mysqli_query($conn, "SELECT `role` FROM `user_role` WHERE `role` = '$role'");

    // Periksa apakah username sudah terdaftar
    if (mysqli_num_rows($cek_role) > 0) {
        echo "<script>
            alert('Role Sudah Ada!');
            document.location.href = 'pengguna_role.php';
            </script>";
        return false;
    }

    $query = "INSERT INTO `user_role` (`role`)
                VALUES ('$role')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function role_ubah($data)
{
    global $conn;

    $id_role = $data['id_role'];
    $role = $data['role'];

    $query = "UPDATE `user_role` SET
			`role` = '$role'

            WHERE `id_role` = '$id_role'
			";

    mysqli_query(
        $conn,
        $query
    );

    return mysqli_affected_rows($conn);
}

function role_hapus($data)
{
    global $conn;

    $id_role = $data['id_role'];

    mysqli_query($conn, "DELETE FROM user_role WHERE id_role = $id_role");
    return mysqli_affected_rows($conn);
}

// PENGGUNA
function pengguna_tambah($data)
{
    global $conn;

    $nama = $data['nama'];
    $username = $data['username'];
    $email = $data['email'];
    $password = password_hash($data['password'], PASSWORD_DEFAULT);
    $phone = $data['phone'];

    if ($_FILES["gambar"]["error"] === 4) {
        // Tidak ada file yang diupload, gunakan default nama file
        $image = "default.jpg";
    } else {
        $image = upload_user();
    }

    $role_id = 1;

    $cek_username = mysqli_query($conn, "SELECT `username` FROM `users` WHERE `username` = '$username'");
    $cek_email = mysqli_query($conn, "SELECT `email` FROM `users` WHERE `email` = '$email'");

    // Periksa apakah username sudah terdaftar
    if (mysqli_num_rows($cek_username) > 0) {
        echo "<script>
            alert('Username Sudah Terdaftar!');
            document.location.href = 'pengguna.php';
            </script>";
        return false;
    } elseif (mysqli_num_rows($cek_email) > 0) {
        echo "<script>
            alert('Email Sudah Terdaftar!');
            document.location.href = 'pengguna.php';
            </script>";
        return false;
    }

    $query = "INSERT INTO `users` (`nama`, `username`, `email`, `password`, `phone`, `role_id`, `image`)
                VALUES ('$nama', '$username', '$email', '$password', '$phone', '$role_id', '$image')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function pengguna_ubah($data)
{
    global $conn;


    $user_id = $data['user_id'];
    $gambar_lama = $data['gambar_lama'];
    $nama = $data['nama'];
    $username = $data['username'];
    $email = $data['email'];

    if (empty($data['password'])) {
        $password = $data['password_lama'];
    } else {
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
    }

    $phone = $data['phone'];

    if ($_FILES["gambar"]["error"] === 4) {
        $gambar = $gambar_lama;
    } else {
        $gambar = upload_user();

        // Hapus file gambar produk
        if ($gambar_lama && $gambar_lama !== "default.jpg") {
            $path_gambar = "../assets/img/users/" . $gambar_lama;
            if (file_exists($path_gambar)) {
                unlink($path_gambar);
            }
        }
    }

    $query = "UPDATE `users` SET
			`nama` = '$nama',
			`username` = '$username',
			`email` = '$email',
			`password` = '$password',
			`phone` = '$phone',
			`image` = '$gambar'

            WHERE `id_user` = '$user_id'
			";

    mysqli_query(
        $conn,
        $query
    );

    return mysqli_affected_rows($conn);
}

function pengguna_hapus($data)
{
    global $conn;

    // Ambil user_id dan gambar dari array data
    $user_id = $data['user_id'];
    $gambar = $data['gambar'];



    // Cek apakah gambar ada dan bukan gambar default
    if ($gambar && $gambar !== "default.jpg") {
        $path_gambar = "../assets/img/users/" . $gambar;

        // Hapus file gambar jika ada
        if (file_exists($path_gambar)) {
            unlink($path_gambar);
        }
    }

    // Hapus user dari database
    mysqli_query($conn, "DELETE FROM `users` WHERE `id_user` = '$user_id'");

    // Kembalikan jumlah baris yang terpengaruh
    return mysqli_affected_rows($conn);
}



function profile_ubah($data)
{
    global $conn;

    $id_user = $data['id_user'];
    $gambar_lama = $data['gambar_lama'];

    $nama = $data['nama'];
    $username = $data['username'];
    $email = $data['email'];

    if (empty($data['password'])) {
        $password = $data['password_lama'];
    } else {
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
    }

    $phone = $data['phone'];

    if ($_FILES["gambar"]["error"] === 4) {
        // Tidak ada file yang diupload, gunakan default nama file
        $gambar = $gambar_lama;
    } else {
        $gambar = upload_user();

        // Hapus file gambar produk
        if ($gambar_lama && $gambar_lama !== "default.jpg") {
            $path_gambar = "../assets/images/users/" . $gambar_lama;
            if (file_exists($path_gambar)) {
                unlink($path_gambar);
            }
        }
    }

    $query = "UPDATE `users` SET
			`nama` = '$nama',
			`username` = '$username',
			`email` = '$email',
			`password` = '$password',
			`phone` = '$phone',
			`image` = '$gambar'

            WHERE `id_user` = '$id_user'
			";

    mysqli_query(
        $conn,
        $query
    );

    return mysqli_affected_rows($conn);
}


// SETTING
function setting_text_ubah($data)
{
    global $conn;

    $nama_aplikasi = $data['nama_aplikasi'];
    $nama_aplikasi_singkat = $data['nama_aplikasi_singkat'];
    $nama_instansi = $data['nama_instansi'];
    $nama_instansi_singkat = $data['nama_instansi_singkat'];
    $alamat_instansi = $data['alamat_instansi'];

    $query = "UPDATE `setting` SET

			`nama_aplikasi` = '$nama_aplikasi',
			`nama_aplikasi_singkat` = '$nama_aplikasi_singkat',
			`nama_instansi` = '$nama_instansi',
			`nama_instansi_singkat` = '$nama_instansi_singkat',
			`alamat_instansi` = '$alamat_instansi'

            WHERE `id_setting` = 1
			";

    mysqli_query(
        $conn,
        $query
    );

    return mysqli_affected_rows($conn);
}
function setting_gambar_ubah($post_data, $files)
{
    global $conn;

    $allowed_mime_types = [
        'image/jpeg',
        'image/png',
        'image/bmp'
    ];

    $max_file_size = 104857600; // 100 MB
    $success = true;
    $upload_dir = "../assets/images/setting/";
    $errors = [];

    // Ambil nama file lama dari database
    $query = "SELECT `logo_instansi`, `logo_pictogram`, `logo_favicon`, `login_images` FROM `setting` WHERE `id_setting` = 1";
    $result = mysqli_query($conn, $query);
    $old_files = mysqli_fetch_assoc($result);

    foreach ($files as $key => $value) {
        if (isset($value['name']) && $value['error'] !== UPLOAD_ERR_NO_FILE) {
            $file_name = basename($value['name']);
            $file_size = $value['size'];
            $tmp_name = $value['tmp_name'];
            $mime_type = mime_content_type($tmp_name);

            if (!in_array($mime_type, $allowed_mime_types)) {
                $errors[] = "Tipe file salah untuk '$key' ({$file_name}). Hanya JPEG, PNG, dan BMP yang diperbolehkan.";
                $success = false;
                continue;
            }

            if ($file_size > $max_file_size) {
                $errors[] = "Ukuran file '$key' ({$file_name}) melebihi batas maksimum (100 MB).";
                $success = false;
                continue;
            }

            $new_file_name = $key . "_" . uniqid() . '.' . pathinfo($file_name, PATHINFO_EXTENSION);

            // Upload file
            $upload_path = $upload_dir . $new_file_name;
            if (!move_uploaded_file($tmp_name, $upload_path)) {
                $errors[] = "Gagal upload '$key' ({$file_name}).";
                $success = false;
                continue;
            }

            // Hapus file lama jika ada
            if (!empty($old_files[$key])) {
                $old_file_path = $upload_dir . $old_files[$key];
                if (file_exists($old_file_path)) {
                    unlink($old_file_path);
                }
            }

            // Update database
            $update_query = "UPDATE `setting` SET `" . $key . "` = '$new_file_name' WHERE `id_setting` = 1";
            $result = mysqli_query($conn, $update_query);

            if (!$result) {
                $errors[] = "Terjadi kesalahan saat memperbarui data untuk '$key' ({$file_name}): " . mysqli_error($conn);
                $success = false;
                continue;
            }
        }
    }

    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }

    return $success;
}

function setting_author_ubah($data)
{
    global $conn;

    $author = $data['author'];
    $link_author = $data['link_author'];

    $query = "UPDATE `setting` SET

			`author` = '$author',
			`link_author` = '$link_author'

            WHERE `id_setting` = 1
			";

    mysqli_query(
        $conn,
        $query
    );

    return mysqli_affected_rows($conn);
}

// LAYANAN
function layanan_tambah($data)
{
    global $conn;

    $layanan = $data['layanan'];
    $layanan_kategori_id = $data['layanan_kategori_id'];
    $biaya = $data['biaya'];

    $cek_layanan = mysqli_query($conn, "SELECT `layanan` FROM `layanan` WHERE `layanan` = '$layanan'");

    // Periksa apakah username sudah terdaftar
    if (mysqli_num_rows($cek_layanan) > 0) {
        echo "<script>
            alert('Layanan Sudah Ada!');
            document.location.href = 'layanan.php';
            </script>";
        return false;
    }

    $query = "INSERT INTO `layanan` (`layanan`, `layanan_kategori_id`, `biaya`)
                VALUES ('$layanan', '$layanan_kategori_id', '$biaya')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function layanan_ubah($data)
{
    global $conn;


    $layanan_id = $data['layanan_id'];
    $layanan = $data['layanan'];
    $layanan_kategori_id = $data['layanan_kategori_id'];
    $biaya = $data['biaya'];

    $query = "UPDATE `layanan` SET
			`layanan` = '$layanan',
			`layanan_kategori_id` = '$layanan_kategori_id',
			`biaya` = '$biaya'

            WHERE `id_layanan` = '$layanan_id'
			";

    mysqli_query(
        $conn,
        $query
    );

    return mysqli_affected_rows($conn);
}

function layanan_hapus($layanan_id)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM `layanan` WHERE `id_layanan` = '$layanan_id'");

    return mysqli_affected_rows($conn);
}

// LINK
function live_ubah($data)
{
    global $conn;


    $live_id = 1;
    $link = $data['link'];

    $query = "UPDATE `live` SET
			`link` = '$link'

            WHERE `id_live` = '$live_id'
			";

    mysqli_query(
        $conn,
        $query
    );

    return mysqli_affected_rows($conn);
}









// UPLOAD GAMBAR USER
function upload_user()
{
    $namaFile = $_FILES["gambar"]["name"];
    $ukuranFile = $_FILES["gambar"]["size"];
    $tmpName = $_FILES["gambar"]["tmp_name"];

    $ekstensiFileValid = ["jpg", "jpeg", "png", "gif"];
    $ekstensiFile = explode(".", $namaFile);
    $ekstensiFile = strtolower(end($ekstensiFile));

    if (!in_array($ekstensiFile, $ekstensiFileValid)) {
        echo "<script>
                alert('File yang diupload bukan file gambar!');
            </script>";

        return false;
    }

    $maxFileSize = 20 * 1024 * 1024; // 20 MB dalam bytes

    if ($ukuranFile > $maxFileSize) {
        echo "<script>
                alert('Ukuran gambar terlalu besar, Maksimal 20 MB!');
            </script>";

        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiFile;

    move_uploaded_file($tmpName, "../assets/img/users/" . $namaFileBaru);

    return $namaFileBaru;
}