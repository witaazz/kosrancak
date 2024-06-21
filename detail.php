<section class="hero-wrap hero-wrap-2" style="background-image: url('assets/images/room-3.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs mb-2">
                    <span class="mr-2"><a href="index.php">Home <i class="fa fa-chevron-right"></i></a></span>
                    <span class="mr-2">Kosan <i class="fa fa-chevron-right"></i></span>
                    <span class="mr-2">Detail <i class="fa fa-chevron-right"></i></span>
                </p>
                <h1 class="mb-0 bread">Detail</h1>
            </div>

        </div>
    </div>
</section>

<section class="ftco-section bg-light">
    <div class="container">
        <div class="row no-gutters">
            <?php
            $id_kos = $_GET['id_kos'];
            $kos_detail = mysqli_query($koneksi, "SELECT * FROM kos WHERE id_kos='$id_kos'");
            $gallery_kos = mysqli_query($koneksi, "SELECT foto FROM gallery_kos WHERE id_kos='$id_kos'");
            while ($kos = mysqli_fetch_array($kos_detail)) { ?>
                <div class="col-md-6 wrap-about">
                    <!-- Big image -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <img id="bigImage" class="img-fluid" src="assets/images/kos/<?= $kos['fotopreview'] ?>" alt="<?= $kos['fotopreview'] ?>">
                        </div>
                    </div>
                    <!-- Thumbnails -->
                    <div class="row">
                        <?php
                        while ($g = mysqli_fetch_array($gallery_kos)) {
                        ?>
                            <div class="col-md-6 mb-4">
                                <img class="img-fluid thumbnail" src="assets/images/kos/<?= $g['foto'] ?>" alt="<?= $g['foto'] ?>">
                            </div>
                        <?php
                        }
                        ?>
                        <!-- Add more thumbnails as needed -->
                    </div>
                </div>

                <div class="col-md-6 wrap-about ftco-animate">
                    <div class="heading-section">
                        <div class="pl-md-5">
                            <h2 class="mb-2"><?= $kos['namakos'] ?></h2>
                            <h4>(<?= $kos['jenis'] ?>)</h4>
                            <i class="fas fa-map-marker-alt"> <?= $kos['alamat'] ?></i>
                            <br>
                            <p><i>
                                    Tersisa <b><?= $kos['avail_room'] ?></b> kamar
                                </i></p>
                            <?php
                            $id = $kos['id_user'];
                            $kontakpemilik = mysqli_query($koneksi, "SELECT nohp from users WHERE id_user='$id'");
                            while ($kontak = mysqli_fetch_assoc($kontakpemilik)) { ?>

                                <p><a href="https://wa.me/<?= preg_replace('/\D/', '', $kontak['nohp']) ?>" class="btn btn-primary">Hubungi Pemilik Kos</a>
                                <?php
                            } ?> <a href="#" class="btn btn-white" id="bookRoomBtn">Booking Kamar</a></p>

                                <!-- Hidden modal -->
                                <div id="myModal" class="modal">
                                    <div class="modal-content">
                                        <span class="close">&times;</span>
                                        <p id="roomPrice"><?= number_format($kos['harga'], 2, '.', ',') ?></p>
                                        <form action="?page=booking" method="POST">
                                            <input type="hidden" name="id_kos" value="<?= $kos['id_kos'] ?>">
                                            <button type="submit" id="confirmBooking" class="btn btn-primary">Lanjutkan Proses Booking</button>
                                        </form>
                                        <!-- <button id="cancelBooking" class="btn btn-secondary">Batal</button> -->
                                    </div>
                                </div>


                                <script>
                                    // Get the modal
                                    var modal = document.getElementById("myModal");

                                    // Get the button that opens the modal
                                    var btn = document.getElementById("bookRoomBtn");

                                    // Get the <span> element that closes the modal
                                    var span = document.getElementsByClassName("close")[0];

                                    // When the user clicks on the button, open the modal
                                    btn.onclick = function(event) {
                                        modal.style.display = "block";
                                        // Fetch room price from the database here and display it in the modal


                                        var roomPrice = <?php echo json_encode(number_format($kos['harga'], 2, '.', ',')); ?>;
                                        document.getElementById("roomPrice").innerHTML = "Total harga: Rp. " + roomPrice;

                                        // Prevent the default behavior of the anchor element
                                        event.preventDefault();
                                    }

                                    // When the user clicks on <span> (x), close the modal
                                    span.onclick = function() {
                                        modal.style.display = "none";
                                    }

                                    // When the user clicks anywhere outside of the modal, close it
                                    window.onclick = function(event) {
                                        if (event.target == modal) {
                                            modal.style.display = "none";
                                        }
                                    }

                                    // Confirm booking
                                    document.getElementById("confirmBooking").onclick = function() {
                                        // Add code to handle booking confirmation
                                        // alert("Room booked!");
                                        // modal.style.display = "none";
                                    }

                                    // Cancel booking
                                    document.getElementById("cancelBooking").onclick = function() {
                                        modal.style.display = "none";
                                    }
                                </script>
                        </div>
                    </div>
                    <hr>
                    <div class="pl-md-5">
                        <div class="row">

                            <div class="services-2 col-lg-6 d-flex w-100">
                                <div class="icon d-flex justify-content-center align-items-center">
                                    <span class="flaticon-first"></span>
                                </div>
                                <div class="media-body pl-4">
                                    <h3 class="heading">Harga</h3>
                                    <p>Rp. <?= number_format($kos['harga'], 2, '.', ',') ?>/bulan</p>
                                </div>
                            </div>

                            <div class="services-2 col-lg-6 d-flex w-100">
                                <div class="icon d-flex justify-content-center align-items-center">
                                    <span class="flaticon-first"></span>
                                </div>
                                <div class="media-body pl-3">
                                    <h3 class="heading">Listrik</h3>
                                    <p><?= $kos['listrik'] ?></p>

                                </div>
                            </div>

                            <div class="services-2 col-lg-6 d-flex w-100">
                                <div class="icon d-flex justify-content-center align-items-center">
                                    <span class="flaticon-first"></span>
                                </div>
                                <div class="media-body pl-3">
                                    <h3 class="heading">Ukuran</h3>
                                    <p><?= $kos['ukuran'] ?> meter</p>
                                </div>
                            </div>

                            <div class="services-2 col-lg-6 d-flex w-100">
                                <div class="icon d-flex justify-content-center align-items-center">
                                    <span class="flaticon-first"></span>
                                </div>
                                <div class="media-body pl-3">
                                    <h3 class="heading">Isi per kamar</h3>
                                    <p>Maks. <?= $kos['isi'] ?> orang/kamar</p>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pl-md-5">
                        <div class="row">

                            <div class="col-md-12 mb-md-0 mb-4 mr-3">
                                <h2 class="footer-heading">Fasilitas</h2>
                                <div class="tagcloud">
                                    <?php
                                    // Explode the string of fasilitas by comma to create an array
                                    $array_fasilitas = explode(",", $kos['fasilitas_kos']);

                                    // Loop through each element of the array
                                    foreach ($array_fasilitas as $value) {
                                        // Echo the value
                                        $namafasilitas = mysqli_query($koneksi, "SELECT namafasilitas FROM fasilitas WHERE id_fasilitas='$value'");
                                        while ($nf = mysqli_fetch_assoc($namafasilitas)) { ?>
                                            <a href="#" class="tag-cloud-link"><?= $nf['namafasilitas'] ?></a>

                                    <?php
                                        }
                                    } ?>
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="pl-md-5">
                        <h2>Deskripsi</h2>
                        <p><?= $kos['deskripsi'] ?></p>
                    </div>
                </div>
            <?php } ?>




        </div>
    </div>

</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $(".thumbnail").click(function() {
            var imgUrl = $(this).attr('src');
            $("#bigImage").attr('src', imgUrl);
        });
    });
</script>