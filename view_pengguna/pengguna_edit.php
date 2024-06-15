<?php
include "../templates/header.php";

$user_id = $_GET["user_id"];
function crud($btn_name, $crud_function, $success_message, $failure_message)
{
    global $user_id;

    if (isset($_POST[$btn_name])) {
        if ($crud_function($_POST) > 0) {
            echo "<script>
                alert('$success_message');
                document.location.href = 'pengguna.php';
            </script>";
        } else {
            echo "<script>
                alert('$failure_message');
                document.location.href = 'pengguna_edit.php?user_id=$user_id';
            </script>";
        }
    }
}

crud("btn_ubah_pengguna", "pengguna_ubah", "Pengguna Berhasil Diubah!", "Pengguna Gagal Diubah!");

$p = query("SELECT *
                    FROM users
                    INNER JOIN user_role ON users.role_id = user_role.id_role
                    WHERE id_user = $user_id
                ")[0];
?>



<h1 class="h3 mb-3">Pengguna</h1>

<div class="row">
    <div class="col-12 col-md-8 d-flex">
        <div class="card flex-fill">
            <div class="card-header d-flex justify-content-between">
                <h5 class="card-title mb-0 d-inline">Data Pengguna</h5>
                <a href="pengguna.php" class="btn btn-primary d-inline">
                    <i class="align-middle" data-feather="arrow-left"></i> Kembali
                </a>
            </div>
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="row">

                        <input type="hidden" class="form-control" name="user_id" value="<?= $p["id_user"] ?>">
                        <input type="hidden" class="form-control" name="gambar_lama" value="<?= $p["image"] ?>">
                        <input type="hidden" class="form-control" name="password_lama" value="<?= $p["password"] ?>">

                        <div class="col-4">
                            <img src="../assets/img/users/<?= $p["image"] ?>" class="img-thumbnail">
                        </div>
                        <div class="col-8">
                            <label class="mt-4 mb-2">Foto</label>
                            <input type="file" class="form-control" name="gambar">
                        </div>
                        <div class="col-12">
                            <label class="mt-4 mb-2">Nama</label>
                            <input type="text" class="form-control" name="nama" value="<?= $p["nama"] ?>">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="mt-4 mb-2">Username</label>
                            <input type="text" class="form-control" name="username" value="<?= $p["username"] ?>">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="mt-4 mb-2">E-Mail</label>
                            <input type="email" class="form-control" name="email" value="<?= $p["email"] ?>">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="mt-4 mb-2">password</label>
                            <input type="password" class="form-control" name="password">
                            <span class="small">Kosongkan jika tidak ingin merubah password</span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="mt-4 mb-2">Phone</label>
                            <input type="text" class="form-control" name="phone" value="<?= $p["phone"] ?>">
                        </div>
                        <div class="col-12 col-md-6">
                            <button type="submit" class="btn btn-primary my-4" name="btn_ubah_pengguna">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<?php
include "../templates/footer.php";
?>