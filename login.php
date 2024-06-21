<?php
include 'includes/koneksi.php';
if (isset($_POST['login'])) {
    $email = htmlspecialchars($_POST['email']);
    $password = md5($_POST['password']);
    $role = $_POST['role'];
    if ($role == 'Admin') {
        $login = mysqli_query($koneksi, "SELECT * FROM admin WHERE email='$email' AND password='$password'");
        if (mysqli_num_rows($login) > 0) {
            $data = mysqli_fetch_array($login);
            session_start();
            $_SESSION['id'] = $data['id'];
            $_SESSION['nama'] = $data['nama'];
            $_SESSION['role'] = "Admin";
            $_SESSION['verif'] = "";
            echo '<script>alert("Anda berhasil login!");window.location="dashboard/index.php";</script>';
        } else {
            echo '<script>alert("Login gagal!");window.location="login.php";</script>';
        }
    } else if ($role == 'Pemilik Kos') {
        $login = mysqli_query($koneksi, "SELECT * FROM users WHERE email='$email' AND password='$password'");
        if (mysqli_num_rows($login) > 0) {
            $data = mysqli_fetch_array($login);
            session_start();
            $_SESSION['id_pemilik_kos'] = $data['id_user'];
            $_SESSION['nama'] = $data['namalengkap'];
            $_SESSION['verif'] = $data['verif'];
            $_SESSION['role'] = $data['role'];
            echo '<script>alert("Anda berhasil login!");window.location="dashboard/index.php";</script>';
        } else {
            echo '<script>alert("Login gagal!");window.location="login.php";</script>';
        }
    } else if ($role == 'Pencari Kos') {
        $login = mysqli_query($koneksi, "SELECT * FROM users WHERE email='$email' AND password='$password'");
        if (mysqli_num_rows($login) > 0) {
            $data = mysqli_fetch_array($login);
            session_start();
            $_SESSION['id_pencari_kos'] = $data['id_user'];
            $_SESSION['nama_pencari_kos'] = $data['namalengkap'];
            $_SESSION['verif_pencari_kos'] = $data['verif'];
            $_SESSION['login_pencari_kos'] = $data['role'];
            echo '<script>alert("Anda berhasil login!");window.location="index.php";</script>';
        } else {
            echo '<script>alert("Login gagal!");window.location="login.php";</script>';
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>KosRancak</title>
    <!-- base:css -->
    <link rel="stylesheet" href="dashboard/assets/vendors/typicons.font/font/typicons.css">
    <link rel="stylesheet" href="dashboard/assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="dashboard/assets/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="dashboard/assets/images/favicon.png" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="brand-logo">
                                <img src="dashboard/assets/images/kosrancaklogo.png" alt="logo">
                            </div>
                            <h4>Selamat datang!</h4>
                            <!-- <h6 class="font-weight-light">Sign in to continue.</h6> -->
                            <form class="pt-3" method="POST" action="">
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-12 col-form-label">Masuk sebagai:</label>
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="role" id="membershipRadios1" value="Admin">
                                                Admin
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="role" id="membershipRadios2" value="Pencari Kos">
                                                Pencari Kos
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="role" id="membershipRadios2" value="Pemilik Kos">
                                                Pemilik Kos
                                            </label>
                                        </div>
                                    </div>

                                </div>
                                <div class="mt-3">
                                    <button type="submit" name="login" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">LOGIN</button>
                                </div>
                                <div class="text-center mt-4 font-weight-light">
                                    Belum punya akun? <a href="register.php" class="text-primary">Register</a>
                                </div>
                                <div class="text-center text-danger mt-4 font-weight-light">
                                    <a href="index.php" class="text-primary">Kembali</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>



    <!-- container-scroller -->
    <!-- base:js -->
    <script src="dashboard/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="dashboard/assets/js/off-canvas.js"></script>
    <script src="dashboard/assets/js/hoverable-collapse.js"></script>
    <script src="dashboard/assets/js/template.js"></script>
    <script src="dashboard/assets/js/settings.js"></script>
    <script src="dashboard/assets/js/todolist.js"></script>
    <!-- endinject -->
</body>

</html>