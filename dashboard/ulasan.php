<?php
$id_ulasan = $_GET['id_ulasan'];
$baca = mysqli_query($koneksi, "UPDATE ulasan SET status='Seen' WHERE id_ulasan='$id_ulasan'");

$ulasan = mysqli_query($koneksi, "SELECT * FROM ulasan WHERE id_ulasan='$id_ulasan' ");
?>

<div class="content-wrapper">
    <div class="row ml-0 mr-0">
        <a href="?page=kos/index" class="btn btn-primary mb-2 ml-3">Kembali</a>

        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <?php
                    while ($u = mysqli_fetch_array($ulasan)) {
                    ?>
                        <p class="font-weight-bold mt-4">Nama Pengirim</p>
                        <p><?= $u['namapengirim'] ?></p>
                        <p class="font-weight-bold">Email</p>
                        <p><?= $u['emailpengirim'] ?></p>
                        <p class="font-weight-bold">Ulasan</p>
                        <p><?= $u['ulasan'] ?></p>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>