<?php
$id = $_SESSION['id_pemilik_kos'];
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Profil Saya</h4>
                    <form class="forms-sample" method="POST" action="">
                        <?php
                        $profil = mysqli_query($koneksi, "SELECT * FROM users WHERE id_user='$id'");
                        while ($p = mysqli_fetch_array($profil)) {
                            if ($p['verif'] == 'Telah Diverifikasi') {
                                echo '<p class="text-success">
                                Verified
                              </p>';
                            } else {
                                echo '<p class="text-danger">
                                Unverified
                              </p>';
                            }
                        ?>
                            <div class="form-group row">
                                <label for="namalengkap" class="col-sm-3 col-form-label">Nama Lengkap</label>
                                <div class="col-sm-9">
                                    <input type="text" name="namalengkap" value="<?= $p['namalengkap'] ?>" class="form-control" id="namalengkap" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" name="email" value="<?= $p['email'] ?>" class="form-control" id="email" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-3 col-form-label">password</label>
                                <div class="col-sm-9">
                                    <input type="hidden" name="password_lama" value="<?= $p['password'] ?>">
                                    <input type="password" name="password" class="form-control" id="password">
                                    <h6 class="text-secondary mt-1"><i>Masukkan password baru jika ingin mengubah password lama</i></h6>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nohp" class="col-sm-3 col-form-label">No HP (Whatsapp)</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nohp" value="<?= $p['nohp'] ?>" class="form-control" id="nohp" required>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="jeniskelamin" class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="jeniskelamin" name="jeniskelamin" required>
                                        <option value="Laki-laki" <?php if ($p['jeniskelamin'] == 'Laki-laki')  echo 'selected';
                                                                    else echo ''; ?>>Laki-laki</option>
                                        <option value="Perempuan" <?php if ($p['jeniskelamin'] == 'Perempuan')  echo 'selected';
                                                                    else echo ''; ?>>Perempuan</option>
                                    </select>
                                </div>
                            </div>
                        <?php

                        }
                        ?>
                        <button type="submit" name="ubah_profil" class="btn btn-primary btn-sm mr-2">Edit Profil</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Rekening Saya</h4>

                    <?php
                    $rekening = mysqli_query($koneksi, "SELECT * FROM rekening WHERE id_user='$id'");
                    if (mysqli_num_rows($rekening) == 0) { ?>
                        <p class="text-danger">Mohon tambahkan info rekening!</p>
                    <?php
                    }
                    ?>
                    <button type="button" class="btn btn-primary btn-sm mb-2 ml-3" data-toggle="modal" data-target="#tambahModal">
                        Tambah
                    </button>
                    <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                        <table class="table">
                            <tbody>
                                <?php
                                $no = 1;
                                while ($rek = mysqli_fetch_array($rekening)) { ?>
                                    <tr>
                                        <td>
                                            Nama Bank
                                            <div class="font-weight-bold  mt-1"><?= $rek['namabank'] ?> </div>
                                        </td>
                                        <td>
                                            Nomor Rekening
                                            <div class="font-weight-bold  mt-1"><?= $rek['norekening'] ?> </div>
                                        </td>
                                        <td>
                                            <a href="" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editModal<?php echo $rek['norekening']; ?>">Edit</a>
                                            <a href="" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#hapusModal<?php echo $rek['norekening']; ?>">Hapus</a>

                                            <!-- editModal -->
                                            <div class="modal fade" id="editModal<?= $rek['norekening'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Rekening</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST" action="">
                                                                <input type="hidden" name="norek" value="<?= $rek['norekening'] ?>">
                                                                <div class="form-group">
                                                                    <input type="text" name="namabank" class="form-control form-control-sm" placeholder="Nama bank" value="<?= $rek['namabank'] ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="text" name="norekening" class="form-control form-control-sm" placeholder="Nomor rekening" value="<?= $rek['norekening'] ?>">
                                                                </div>
                                                                <button type="submit" name="edit_rekening" class="btn btn-primary mr-2">Submit</button>
                                                                <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end of editModal -->

                                            <!-- hapusModal -->
                                            <div class="modal fade" id="hapusModal<?= $rek['norekening'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Hapus info rekening ini?</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Apakah Anda yakin ingin menghapus info rekening ini?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form method="POST">
                                                                <input type="hidden" name="norekening" value="<?= $rek['norekening'] ?>">
                                                                <button type="submit" name="hapus_rekening" class="btn btn-danger">Hapus</button>
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end of hapusModal -->
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>

                            </tbody>
                        </table>

                        <!-- tambahModal -->
                        <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Fasilitas</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST">
                                            <div class="form-group">
                                                <input type="text" name="namabank" class="form-control form-control-sm" placeholder="Nama bank" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="norekening" class="form-control form-control-sm" placeholder="Nomor rekening" required>
                                            </div>
                                            <button type="submit" name="tambah_rekening" class="btn btn-primary mr-2">Submit</button>
                                            <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end of tambahModal -->
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Proses -->
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
        echo '<script>alert("Email sudah terdaftar!");window.location="?page=profil/index";</script>';
    } else {
        $ubah_profil = mysqli_query($koneksi, "UPDATE users SET namalengkap='$namalengkap',email='$email',nohp='$nohp',jeniskelamin='$jeniskelamin',password='$password' WHERE id_user='$id'");
        if ($ubah_profil) {
            echo '<script>alert("Profil berhasil diubah!");window.location="?page=profil/index";</script>';
        } else {
            echo '<script>alert("Profil gagal diubah!");window.location="?page=profil/index";</script>';
        }
    }
} else if (isset($_POST['tambah_rekening'])) {
    $namabank = $_POST['namabank'];
    $norekening = $_POST['norekening'];
    $tambah_rekening = mysqli_query($koneksi, "INSERT INTO rekening (namabank,norekening,id_user) VALUES ('$namabank','$norekening','$id')");
    if ($tambah_rekening) {
        echo '<script>alert("Rekening berhasil ditambah!");window.location="?page=profil/index";</script>';
    } else {
        echo '<script>alert("Terjadi kesalahan!");window.location="?page=profil/index";</script>';
    }
} else if (isset($_POST['edit_rekening'])) {
    $norek = $_POST['norek'];
    $namabank = $_POST['namabank'];
    $norekening = $_POST['norekening'];
    $edit_rekening = mysqli_query($koneksi, "UPDATE rekening SET namabank='$namabank',norekening='$norekening' WHERE norekening='$norek'");
    if ($edit_rekening) {
        echo '<script>alert("Rekening berhasil diubah!");window.location="?page=profil/index";</script>';
    } else {
        echo '<script>alert("Terjadi kesalahan!");window.location="?page=profil/index";</script>';
    }
} else if (isset($_POST['hapus_rekening'])) {
    $norekening = $_POST['norekening'];
    $hapus_rekening = mysqli_query($koneksi, "DELETE FROM rekening WHERE norekening='$norekening'");
    if ($hapus_rekening) {
        echo '<script>alert("Rekening berhasil dihapus!");window.location="?page=profil/index";</script>';
    } else {
        echo '<script>alert("Terjadi kesalahan!");window.location="?page=profil/index";</script>';
    }
}

?>