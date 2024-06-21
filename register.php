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

                            <form class="pt-3" method="POST" action="" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="">Nama Lengkap</label>
                                    <input type="text" name="namalengkap" class="form-control form-control-lg" id="exampleInputUsername1" placeholder="Nama Lengkap" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" name="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Jenis Kelamin</label>
                                    <select name="jeniskelamin" class="form-control form-control-lg" id="exampleFormControlSelect2" required>
                                        <option selected disabled>----</option>
                                        <option>Perempuan</option>
                                        <option>Laki-laki</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Nomor HP (Whatsapp)</label>
                                    <input type="text" name="nohp" class="form-control form-control-lg" id="exampleInputUsername1" placeholder="Nomor HP (Whatsapp)" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Upload foto kartu identitas (KTP/SIM/Passport/dll)</label>
                                    <input type="file" name="idcard" class="form-control form-control-lg" id="exampleInputUsername1" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Upload foto selfie dengan kartu identitas (KTP/SIM/Passport/dll)</label>
                                    <input type="file" name="selfie" class="form-control form-control-lg" id="exampleInputUsername1" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Apakah anda pencari kos atau pemilik kos?</label>
                                    <select name="role" class="form-control form-control-lg" id="exampleFormControlSelect2" required>
                                        <option value="" selected disabled>----</option>
                                        <option>Pencari Kos</option>
                                        <option>Pemilik Kos</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" class="form-check-input">
                                            I agree to all Terms & Conditions
                                        </label>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <button type="submit" name="register" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN UP</button>

                                </div>
                                <div class="text-center mt-4 font-weight-light">
                                    Sudah punya akun? <a href="login.php" class="text-primary">Login</a>
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
    <?php
    include 'includes/koneksi.php';

    function upload($gambar)
    {

        $namaFile = $gambar['name'];
        $ukuranFile = $gambar['size'];
        $error = $gambar['error'];
        $tmpName = $gambar['tmp_name'];

        // cek apakah tidak ada gambar yang diupload
        if ($error === 4) {
            echo "<script>
				alert('pilih gambar terlebih dahulu!');
			  </script>";
            return false;
        }

        // cek apakah yang diupload adalah gambar
        $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
        $ekstensiGambar = explode('.', $namaFile);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
            echo "<script>
				alert('yang anda upload bukan gambar!');
			  </script>";
            return false;
        }

        // cek jika ukurannya terlalu besar
        if ($ukuranFile > 20000000) {
            echo "<script>
				alert('ukuran gambar terlalu besar!');
			  </script>";
            return false;
        }

        // lolos pengecekan, gambar siap diupload
        // generate nama gambar baru
        $namaFileBaru = uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .= $ekstensiGambar;


        move_uploaded_file($tmpName, 'dashboard/assets/images/uploads/users/' . $namaFileBaru);

        return $namaFileBaru;
    }

    if (isset($_POST['register'])) {
        $namalengkap = htmlspecialchars($_POST['namalengkap']);
        $email = htmlspecialchars($_POST['email']);
        $password = md5($_POST['password']);
        $jeniskelamin = $_POST['jeniskelamin'];
        $nohp = htmlspecialchars($_POST['nohp']);
        $role = $_POST['role'];
        $idcard = upload($_FILES['idcard']);
        $selfie = upload($_FILES['selfie']);

        $check_email_terdaftar = mysqli_query($koneksi, "SELECT * FROM users WHERE email='$email'");
        if (mysqli_num_rows($check_email_terdaftar) > 0) {
            echo '<script>alert("Email sudah terdaftar!");window.location="register.php";</script>';
        } else {
            $register = mysqli_query($koneksi, "INSERT INTO users VALUES ('','$namalengkap','$email','$password','$jeniskelamin','$nohp','$idcard','$selfie','Pending','$role')");
            if ($register) {
                echo '<script>alert("Berhasil register! Silahkan login!");window.location="login.php";</script>';
            } else {
                echo '<script>alert("gagal register. Terjadi kesalahan!");window.location="register.php";</script>';
            }
        }
    }

    ?>

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