<?php
$id = $_SESSION['id_pencari_kos'];
?>
<section class="hero-wrap hero-wrap-2" style="background-image: url('assets/images/room-3.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.php">Home <i class="fa fa-chevron-right"></i></a></span> <span>Contact <i class="fa fa-chevron-right"></i></span></p>
                <h1 class="mb-0 bread">Profil</h1>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section bg-light">
    <div class="container">
        <div class="row no-gutters">

            <div class="col-md-12">
                <div class="wrapper">
                    <div class="row no-gutters">
                        <div class="col-lg-12 col-md-7 d-flex align-items-stretch">
                            <div class="contact-wrap w-100 p-md-5 p-4">
                                <h3 class="mb-4">Profil Saya</h3>

                                <!-- <div id="form-message-warning" class="mb-4"></div>
                                <div id="form-message-success" class="mb-4">
                                    Your message was sent, thank you!
                                </div> -->
                                <form method="POST" id="contactForm" name="contactForm" class="contactForm">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <?php
                                            $profil = mysqli_query($koneksi, "SELECT * FROM users WHERE id_user='$id' ");
                                            while ($p = mysqli_fetch_array($profil)) {
                                                if ($p['verif'] == 'Telah Diverifikasi') {
                                                    echo ' <p class="text-success">
                                                Verified
                                            </p>';
                                                } else {
                                                    echo ' <p class="text-danger">
                                                Unverified
                                            </p>';
                                                }
                                            ?>
                                        </div>

                                    </div>
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label" for="namalengkap">Nama Lengkap</label>
                                                <input type="text" class="form-control" name="namalengkap" id="namalengkap" placeholder="Masukkan nama lengkap" value="<?= $p['namalengkap'] ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label" for="#">Jenis Kelamin</label>
                                                <select class="form-control" id="jeniskelamin" name="jeniskelamin" required>
                                                    <option value="Laki-laki" <?php if ($p['jeniskelamin'] == 'Laki-laki')  echo 'selected';
                                                                                else echo ''; ?>>Laki-laki</option>
                                                    <option value="Perempuan" <?php if ($p['jeniskelamin'] == 'Perempuan')  echo 'selected';
                                                                                else echo ''; ?>>Perempuan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label" for="email">Email</label>
                                                <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?= $p['email'] ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label" for="nohp">No HP (Whatsapp)</label>
                                                <input type="text" class="form-control" name="nohp" id="nohp" placeholder="Masukkan No HP (Whatsapp)" value="<?= $p['nohp'] ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label" for="password">Password</label>
                                                <input type="hidden" name="password_lama" value="<?= $p['password'] ?>">
                                                <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan Password">
                                                <p class="text-info"><i>Masukkan password baru jika ingin mengubah password lama</i></p>
                                            </div>
                                        </div>

                                    <?php
                                            }
                                    ?>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" name="ubah_profil" class="btn btn-primary">Edit Profil</button>

                                            <div class="submitting"></div>
                                        </div>
                                    </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- <div class="col-lg-4 col-md-5 d-flex align-items-stretch">
                            <div class="info-wrap bg-primary w-100 p-md-5 p-4">
                                <h3>Let's get in touch</h3>
                                <p class="mb-4">We're open for any suggestion or just to have a chat</p>
                                <div class="dbox w-100 d-flex align-items-start">
                                    <div class="icon d-flex align-items-center justify-content-center">
                                        <span class="fa fa-map-marker"></span>
                                    </div>
                                    <div class="text pl-3">
                                        <p><span>Address:</span> 198 West 21th Street, Suite 721 New York NY 10016</p>
                                    </div>
                                </div>
                                <div class="dbox w-100 d-flex align-items-center">
                                    <div class="icon d-flex align-items-center justify-content-center">
                                        <span class="fa fa-phone"></span>
                                    </div>
                                    <div class="text pl-3">
                                        <p><span>Phone:</span> <a href="tel://1234567920">+ 1235 2355 98</a></p>
                                    </div>
                                </div>
                                <div class="dbox w-100 d-flex align-items-center">
                                    <div class="icon d-flex align-items-center justify-content-center">
                                        <span class="fa fa-paper-plane"></span>
                                    </div>
                                    <div class="text pl-3">
                                        <p><span>Email:</span> <a href="mailto:info@yoursite.com">info@yoursite.com</a></p>
                                    </div>
                                </div>
                                <div class="dbox w-100 d-flex align-items-center">
                                    <div class="icon d-flex align-items-center justify-content-center">
                                        <span class="fa fa-globe"></span>
                                    </div>
                                    <div class="text pl-3">
                                        <p><span>Website</span> <a href="#">yoursite.com</a></p>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
if (isset($_POST['ubah_profil'])) {
    $namalengkap = $_POST['namalengkap'];
    $email = $_POST['email'];
    $nohp = $_POST['nohp'];
    $jeniskelamin = $_POST['jeniskelamin'];

    if ($_POST['password'] == '') {
        $password = $_POST['password_lama'];
    } else {
        $password = md5($_POST['password']);
    }

    $check_email_terdaftar = mysqli_query($koneksi, "SELECT * FROM users WHERE email='$email' AND id_user!='$id'");
    if (mysqli_num_rows($check_email_terdaftar) > 0) {
        echo '<script>alert("Email sudah terdaftar!");window.location="?page=profil";</script>';
    } else {
        $ubah_profil = mysqli_query($koneksi, "UPDATE users SET namalengkap='$namalengkap',email='$email',nohp='$nohp',jeniskelamin='$jeniskelamin',password='$password' WHERE id_user='$id'");
        if ($ubah_profil) {
            echo '<script>alert("Profil berhasil diubah!");window.location="?page=profil";</script>';
        } else {
            echo '<script>alert("Profil gagal diubah!");window.location="?page=profil";</script>';
        }
    }
}
