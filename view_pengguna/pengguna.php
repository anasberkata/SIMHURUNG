<?php
include "../templates/header.php";

$pengguna = query("SELECT *
                    FROM users
                    INNER JOIN user_role ON users.role_id = user_role.id_role
                ");
?>



<h1 class="h3 mb-3">Pengguna</h1>

<div class="row">
    <div class="col-12 d-flex">
        <div class="card flex-fill">
            <div class="card-header d-flex justify-content-between">
                <h5 class="card-title mb-0 d-inline">Data Pengguna</h5>
                <a href="pengguna_add.php" class="btn btn-primary d-inline">
                    <i class="align-middle" data-feather="user-plus"></i> Tambah Pengguna
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover my-0" id="data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Foto</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($pengguna as $p): ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><img src="../assets/img/users/<?= $p["image"] ?>" class="img-thumbnail"
                                            width="50px"></td>
                                    <td><?= $p["nama"] ?></td>
                                    <td><?= $p["username"] ?></td>
                                    <td><?= $p["email"] ?></td>
                                    <td><?= $p["phone"] ?></td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="pengguna_edit.php?user_id=<?= $p["id_user"] ?>"
                                                class="btn btn-info d-inline">
                                                <i class="align-middle" data-feather="edit"></i>
                                            </a>
                                            <a href="pengguna_delete.php?user_id=<?= $p['id_user'] ?>&gambar=<?= $p['image'] ?>"
                                                class="btn btn-danger d-inline"
                                                onclick="return confirm('Yakin ingin menghapus pengguna?');">
                                                <i class="align-middle" data-feather="trash"></i>
                                            </a>

                                        </div>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



<?php
include "../templates/footer.php";
?>