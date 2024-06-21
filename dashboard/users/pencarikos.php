<?php
// $role = $_GET['role'];
$role = "Pencari Kos";
$users = mysqli_query($koneksi, "SELECT * FROM users WHERE role='$role' ORDER BY id_user DESC");
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Daftar User</h4>
                    <p class="card-description">
                        Role <code><?= $role ?></code>
                    </p>
                    <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Lengkap</th>
                                    <th>E-mail</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Nomor HP (Whatsapp)</th>

                                    <th>Kartu Identitas</th>
                                    <th>Swafoto</th>
                                    <th>Verified</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                while ($user = mysqli_fetch_array($users)) { ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $user['namalengkap'] ?></td>
                                        <td><?= $user['email'] ?></td>
                                        <td><?= $user['jeniskelamin'] ?></td>
                                        <td><?= $user['nohp'] ?></td>

                                        <td><a href="assets/images/uploads/users/<?= $user['idcard'] ?>">Lihat kartu identitas</a></td>
                                        <td><a href="assets/images/uploads/users/<?= $user['selfie'] ?>">Lihat swafoto</a></td>
                                        <?php
                                        if (($user['verif']) === 'Telah Diverifikasi') {
                                            $verifstat = "text-success";
                                        } else if (($user['verif']) === 'Ditolak') {
                                            $verifstat = "text-danger";
                                        } else {
                                            $verifstat = "text-warning";
                                        } ?>
                                        <td class='<?= $verifstat ?>'><?= $user['verif'] ?></td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <form action="" method="POST" id="userVerification<?= $user['id_user'] ?>">
                                                    <input type="hidden" name="id_user" value="<?= $user['id_user'] ?>">
                                                    <button type="button" name="verified" class="btn btn-success btn-sm btn-fw mr-2" onclick="verifyUser(<?= $user['id_user'] ?>)"><i class="mdi mdi-marker-check"></i></button>
                                                    <button type="button" name="denied" class="btn btn-danger btn-sm btn-fw" onclick="denyUser(<?= $user['id_user'] ?>)"><i class="mdi mdi-minus-circle-outline"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        <p>Total data : <b><?= mysqli_num_rows($users) ?></b></p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php
if (isset($_POST['verified'])) {
    $id_user = $_POST['id_user'];
    $verified_user = mysqli_query($koneksi, "UPDATE users SET verif='Telah Diverifikasi' WHERE id_user='$id_user'");
    if ($verified_user) {
        echo '<script>alert("Pengguna telah diverifikasi!");window.location="?page=users/pencarikos";</script>';
    } else {
        echo '<script>alert("Terjadi kesalahan!");window.location="?page=users/pencarikos";</script>';
    }
} else if (isset($_POST['denied'])) {
    $id_user = $_POST['id_user'];
    $denied_user = mysqli_query($koneksi, "UPDATE users SET verif='Ditolak' WHERE id_user='$id_user'");
    if ($denied_user) {
        echo '<script>alert("Pengguna anda tolak!");window.location="?page=users/pencarikos";</script>';
    } else {
        echo '<script>alert("Terjadi kesalahan!");window.location="?page=users/pencarikos";</script>';
    }
}
?>

<script>
    function verifyUser(userId) {
        if (confirm('Verifikasi user ini?')) {
            document.getElementById('userVerification' + userId).innerHTML += '<input type="hidden" name="verified" value="verified">';
            document.getElementById('userVerification' + userId).submit();
        }
    }

    function denyUser(userId) {
        if (confirm('Tolak user ini?')) {
            document.getElementById('userVerification' + userId).innerHTML += '<input type="hidden" name="denied" value="denied">';
            document.getElementById('userVerification' + userId).submit();
        }
    }
</script>