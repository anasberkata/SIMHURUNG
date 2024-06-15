<?php
include "../templates/header.php";

function crud($btn_name, $crud_function, $success_message, $failure_message)
{
    if (isset($_POST[$btn_name])) {
        if ($crud_function($_POST) > 0) {
            echo "<script>
                alert('$success_message');
                document.location.href = 'pengguna.php';
            </script>";
        } else {
            echo "<script>
                alert('$failure_message');
                document.location.href = 'pengguna_add.php';
            </script>";
        }
    }
}

crud("btn_tambah_pengguna", "pengguna_tambah", "Pengguna Berhasil Ditambah!", "Pengguna Gagal Ditambah!");

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
                        <div class="col-12">
                            <label class="mt-4 mb-2">Foto</label>
                            <input type="file" class="form-control" name="gambar">
                        </div>
                        <div class="col-12">
                            <label class="mt-4 mb-2">Nama</label>
                            <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="mt-4 mb-2">Username</label>
                            <input type="text" class="form-control" name="username" placeholder="Username">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="mt-4 mb-2">E-Mail</label>
                            <input type="email" class="form-control" name="email" placeholder="E-Mail">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="mt-4 mb-2">password</label>
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="mt-4 mb-2">Phone</label>
                            <input type="text" class="form-control" name="phone" placeholder="Phone">
                        </div>
                        <div class="col-12 col-md-6">
                            <button type="submit" class="btn btn-primary my-4"
                                name="btn_tambah_pengguna">Simpan</button>
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