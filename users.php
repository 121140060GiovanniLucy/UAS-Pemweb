<?php
include "koneksi.php";

require "OOP.php";
$UList = new UList($conn);

$users = $UList->fetch_objects("SELECT * FROM users");

include "templates/header.php";
?>

<section class="container-fluid p-0" id="main">
    <div class="row justify-content-center align-items-center w-50">
        <div class="col">
            <div class="card bg-dark dark-mode bg-opacity-75">
                <div class="card-body">
                    <h4 class="card-title mb-4">Users</h4>
                    <?php if ($alert = @$_SESSION["success"]) : ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <?= $alert ?>
                        </div>
                        <?php unset($_SESSION["success"]) ?>
                    <?php elseif ($alert = @$_SESSION["error"]) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <?= $alert ?>
                        </div>
                        <?php unset($_SESSION["error"]) ?>
                    <?php endif ?>
                    <table class="table table-secondary text-center">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Username</th>
                                <th scope="col">Aktif</th>
                                <th scope="col">User Agent</th>
                                <th scope="col">IP</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($users as $user) : ?>
                                <tr>
                                    <th class="align-middle" scope="row"><?= $no++ ?></th>
                                    <td class="align-middle"><?= $user->username ?></td>
                                    <td class="align-middle"><?= $user->is_active ? "true" : "false" ?></td>
                                    <td class="align-middle"><?= $user->user_agent ?></td>
                                    <td class="align-middle"><?= $user->ip ?></td>
                                    <td class="align-middle">
                                        <a href="user.php?id=<?= $user->id ?>" class="btn btn-warning m-2">EDIT</a>
                                        <a href="delete.php?id=<?= $user->id ?>" class="btn btn-danger" onclick="return confirm('Apakah yakin ingin menghapus?')">HAPUS</a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</section>

<?php
include "templates/footer.php";
?>