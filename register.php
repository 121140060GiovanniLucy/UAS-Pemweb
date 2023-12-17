<?php
include "koneksi.php";
if (isset($_SESSION['username'])) {
    header("Location: users.php");
}

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    if ($password == $confirm) {
        $query = "INSERT INTO users (username, password) VALUES ('$username', '$password') ";
        if (!mysqli_query($conn, $query)) {
            $_SESSION["error"] = mysqli_error($conn);
        } else {
            $_SESSION["success"] = "Registrasi berhasil, silahkan login!";
            header("Location: login.php");
        }
    } else {
        $_SESSION["error"] = "Password tidak sama!";
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
                    <h5 class="card-title text-center fs-2">Register</h5>
                    <?php if ($alert = @$_SESSION["error"]) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <?= $alert ?>
                        </div>
                        <?php unset($_SESSION["error"]) ?>
                    <?php endif ?>
                    <form id="registerForm" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" id="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="inputPassword" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password" aria-describedby="passwordHelp" required>
                        </div>
                        <div class="mb-3">
                            <label for="inputPassword" class="form-label">Confirm Password</label>
                            <input type="password" name="confirm" class="form-control" id="confirm" aria-describedby="passwordHelp" required="">
                        </div>
                        <div class="mb-4">
                            <div class="form-check">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Setuju dengan Syarat & Ketentuan
                                </label>
                                <input class="form-check-input" name="agreeTerms" type="checkbox" value="" id="flexCheckDefault">
                            </div>
                        </div>
                        <div class="mb-2">
                            <button type="submit" name="register" class="btn btn-success w-100 rounded-2">Daftar</button>
                        </div>
                        <div class="mb-2">
                            <a href="login.php" class="btn btn-primary w-100 rounded-2">Login</a>
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