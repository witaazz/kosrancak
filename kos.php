<?php
if (isset($_POST['cari'])) {

    if ($_POST['harga_min'] == '') {
        $minharga = 0;
    } else {
        $minharga = $_POST['harga_min'];
    }

    if ($_POST['harga_max'] == '') {
        $maxharga = 1000000000000;
    } else {
        $maxharga = $_POST['harga_max'];
    }

    if ($_POST['jenis'] === 'Semua' || $_POST['jenis'] === 'Jenis Kos') {
        $where = "WHERE harga<=$maxharga AND harga>=$minharga";
    } else {
        $jenis = $_POST['jenis'];
        $where = "WHERE jenis='$jenis' AND harga<=$maxharga AND harga>=$minharga";
    }
    $kos = mysqli_query($koneksi, "SELECT * FROM kos $where ");
} else {
    $kos = mysqli_query($koneksi, "SELECT * FROM kos");
}
?>

<section class="hero-wrap hero-wrap-2" style="background-image: url('assets/images/room-3.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs mb-2"><span class="mr-2"><a href="?page=home">Home <i class="fa fa-chevron-right"></i></a></span> <span>Kosan <i class="fa fa-chevron-right"></i></span></p>
                <h1 class="mb-0 bread">Kosan</h1>
            </div>
            <div class="col-md-6 px-4">
                <form method="POST" class="text-center">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="select-wrap">
                                <select name="jenis" id="" class="form-control">
                                    <option value="Semua" selected>Semua</option>
                                    <option value="Putra">Kos Putra</option>
                                    <option value="Putri">Kos Putri</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <input type="number" name="harga_min" class="form-control" placeholder="Minimal Harga">
                        </div>
                        <div class="col-md-4">
                            <input type="number" name="harga_max" class="form-control" placeholder="Maximal Harga">
                        </div>
                        <div class="col-md-12 mt-3">
                            <button type="submit" name="cari" class="btn btn-primary py-3 px-4">Cari</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section bg-light ftco-no-pt ftco-no-pb">
    <div class="container-fluid px-md-0">
        <div class="row no-gutters mb-5">
            <?php
            while ($k = mysqli_fetch_array($kos)) { ?>
                <div class="col-lg-6">
                    <div class="room-wrap d-md-flex">
                        <a href="#" class="img" style="background-image: url(assets/images/kos/<?= $k['fotopreview'] ?>);"></a>
                        <div class="half left-arrow d-flex align-items-center">
                            <div class="text p-4 p-xl-5 text-center">
                                <p class="star mb-0"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span></p>
                                <p class="mb-0"><span class="price mr-1">Rp. <?= number_format($k['harga'], 2, '.', ',') ?></span> <span class="per">per bulan</span></p>
                                <h3 class="mb-3"><a href="rooms.html"><?= $k['namakos'] ?></a></h3>
                                <ul class="list-accomodation">
                                    <li><span>Kos</span> <b><?= $k['jenis'] ?></b></li>
                                    <li><span>Ukuran</span> <?= $k['ukuran'] ?></li>
                                </ul>
                                <p class="pt-1"><a href="?page=detail&id_kos=<?= $k['id_kos'] ?>" class="btn-custom px-3 py-2">Details <span class="icon-long-arrow-right"></span></a></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            } ?>
        </div>
    </div>
</section>