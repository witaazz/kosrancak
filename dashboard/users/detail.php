<?php
$id_user = $_GET['id_user'];
$users = mysqli_query($koneksi, "SELECT * FROM users WHERE id_user='$id_user'");
?>

<div class="content-wrapper">
    <div class="row ml-0 mr-0">
        <a href="?page=kos/index" class="btn btn-primary mb-2 ml-3">Kembali</a>

        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <?php
                    while ($user = mysqli_fetch_array($users)) {
                    ?>
                        <h4 class="card-title mb-1"><?= $user['namalengkap'] ?> (<?= $user['role'] ?>)</h4>
                        <p class="font-weight-bold mt-4">Jenis Kelamin</p>
                        <p><?= $user['jeniskelamin'] ?></p>
                        <p class="font-weight-bold">Email</p>
                        <p><?= $user['email'] ?></p>
                        <p class="font-weight-bold">No HP (Whatsapp)</p>
                        <p><?= $user['nohp'] ?></p>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>