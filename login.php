<?php
include "koneksi.php";
if (isset($_SESSION['username'])) {
    header("Location: users.php");
}

require "OOP.php";
$UList = new UList($conn);

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    $user = mysqli_fetch_object($sql);

    if (isset($user)) {
        $_SESSION['id'] = $user->id;
        $_SESSION['username'] = $user->username;

        $UList->set_active($user->id);
        $_SESSION["success"] = "Anda berhasil masuk!";
        header("Location: users.php");
    } else {
        $_SESSION["error"] = "Username / Password salah!";
    }
}

include "templates/header.php";
?>

<section class="container-fluid p-0" id="login">
    <div class="row h-100 m-0 justify-content-center align-items-center">
        <div class="col-6 text-dark d-flex justify-content-center align-items-center" style="
                position: relative;
            ">
            <div class="card text-white dark-modeB" style="width:20rem;opacity: 0.85;">
                <div class="card-body">
                    <h5 class="card-title text-center fs-2">Login</h5>
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
                    <form id="loginForm" method="post">
                        <div class="mb-4">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" id="username" required>
                        </div>
                        <div class="mb-4">
                            <label for="inputPassword" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control mb-3" id="password" aria-describedby="passwordHelp" required>
                        </div>
                        <div class="mb-2">
                            <button type="submit" name="login" class="btn btn-success w-100 rounded-2">Login</button>
                        </div>
                        <div class="mb-2">
                            <a href="register.php" class="btn btn-primary w-100 rounded-2">Register</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FOOTER -->
<?php
include "templates/footer.php";
?>