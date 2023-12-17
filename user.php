<?php
include "koneksi.php";

require "OOP.php";
$UList = new UList($conn);

if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $edit_data = [
        "username" => $username,
        "password" => $password
    ];

    $UList->edit_user_by_id($edit_data, $id);
    $_SESSION['success'] = "Akun berhasil diubah.";
    header("Location: users.php");
}

$id = $_GET['id'];
$user = $UList->get_user_by_id($id);

include "templates/header.php";
?>

<section class="container-fluid p-0" id="main">
    <div class="row justify-content-center align-items-center w-50">
        <div class="col">
            <div class="card bg-dark dark-mode bg-opacity-75">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <h4 class="card-title mb-4">Users</h4>
                    <form id="editForm" class="w-50" method="post">
                        <input type="hidden" name="id" value="<?= $user->id ?>">
                        <div class="mb-3 row">
                            <label for="username" class="col-sm-3 col-form-label">Username</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="username" id="username" value="<?= $user->username ?>" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="password" id="password" value="<?= $user->password ?>" required>
                            </div>
                        </div>
                        <div class="mb-2">
                            <button type="submit" name="edit" class="btn btn-success w-50 rounded-2">Edit</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<?php
include "templates/footer.php";
?>