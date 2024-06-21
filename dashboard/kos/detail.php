<?php
$id_kos = $_GET['id_kos'];
$kos = mysqli_query($koneksi, "SELECT * FROM kos JOIN users ON kos.id_user=users.id_user WHERE kos.id_kos='$id_kos'");
?>

<div class="content-wrapper">
    <div class="row ml-0 mr-0">
        <a href="?page=kos/index" class="btn btn-primary mb-2 ml-3">Kembali</a>

        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <?php
                    while ($k = mysqli_fetch_array($kos)) {
                    ?>
                        <h4 class="card-title mb-1"><?= $k['namakos'] ?> (<?= $k['jenis'] ?>)</h4>
                        <?php
                        if ($_SESSION['role'] == 'Admin') { ?>
                            <p>Disewakan oleh : <b><?= $k['namalengkap'] ?></b> </p>
                        <?php
                        } ?>
                        <img src="../assets/images/kos/<?= $k['fotopreview'] ?>" alt="<?= $k['fotopreview'] ?>" class="mb-3">

                        <p class="font-weight-bold">Alamat</p>
                        <p><?= $k['alamat'] ?></p>
                        <p class="font-weight-bold">Kamar Tersisa</p>
                        <p><?= $k['avail_room'] ?></p>
                        <p class="font-weight-bold">Harga</p>
                        <p>Rp. <?= number_format($k['harga'], 2, '.', ',') ?> /bulan</p>
                        <p class="font-weight-bold">Listrik</p>
                        <p><?= $k['listrik'] ?></p>
                        <p class="font-weight-bold">Ukuran</p>
                        <p><?= $k['ukuran'] ?> meter</p>
                        <p class="font-weight-bold">Maks. isi</p>
                        <p><?= $k['isi'] ?> per kamar</p>
                        <p class="font-weight-bold">Deskripsi</p>
                        <p><?= $k['deskripsi'] ?></p>
                        <p class="font-weight-bold">Fasilitas</p>
                        <?php
                        // Explode the string of fasilitas by comma to create an array
                        $array_fasilitas = explode(",", $k['fasilitas_kos']);

                        // Loop through each element of the array
                        foreach ($array_fasilitas as $value) {
                            // Echo the value
                            $namafasilitas = mysqli_query($koneksi, "SELECT namafasilitas FROM fasilitas WHERE id_fasilitas='$value'");
                            while ($nf = mysqli_fetch_assoc($namafasilitas)) { ?>

                                <button class="btn btn-inverse-info btn-fw mb-2 mr-2"><?= $nf['namafasilitas'] ?></button>
                        <?php
                            }
                        }


                        ?>



                    <?php
                    }


                    ?>
                </div>
            </div>
        </div>

    </div>
</div>