<!-- partial:partials/_navbar.html -->
<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="index.php"><img src="assets/images/kosrancaklogo.png" alt="logo" /></a>
        <!-- <a class="navbar-brand brand-logo-mini" href="index.html"><img src="images/logo-mini.svg" alt="logo" /></a> -->
        <button class="navbar-toggler navbar-toggler align-self-center d-none d-lg-flex" type="button" data-toggle="minimize">
            <span class="typcn typcn-th-menu"></span>
        </button>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav navbar-nav-right">
            <?php
            if ($_SESSION['role'] == 'Admin') { ?>
                <li class="nav-item dropdown d-flex">
                    <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="messageDropdown" href="#" data-toggle="dropdown">
                        <i class="typcn typcn-message-typing"></i>
                        <?php
                        $ulasan = mysqli_query($koneksi, "SELECT * FROM ulasan WHERE status='Delivered' ");
                        $unseen = mysqli_num_rows($ulasan);

                        ?>
                        <span class="count bg-success"><?= $unseen ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">

                        <p class="mb-0 font-weight-normal float-left dropdown-header">Ulasan baru</p>
                        <?php
                        while ($u = mysqli_fetch_array($ulasan)) { ?>
                            <a class="dropdown-item preview-item" href="?page=ulasan&id_ulasan=<?= $u['id_ulasan'] ?>">

                                <div class="preview-item-content flex-grow">
                                    <h6 class="preview-subject ellipsis font-weight-normal"><?= $u['namapengirim'] ?>
                                    </h6>
                                    <p class="font-weight-light small-text mb-0"><?= substr($u['ulasan'], 0, 50) ?></p>
                                </div>
                            </a>
                        <?php
                        }
                        ?>
                    </div>
                </li>
            <?php
            } ?>

            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle  pl-0 pr-0" href="#" data-toggle="dropdown" id="profileDropdown">
                    <i class="typcn typcn-user-outline mr-0"></i>
                    <span class="nav-profile-name"><?= $_SESSION['nama'] ?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">

                    <?php
                    if ($_SESSION['role'] == 'Pemilik Kos') { ?><a class="dropdown-item" href="?page=profil/index">
                            <i class="typcn typcn-cog text-primary"></i>
                            Profil
                        </a>
                    <?php
                    } ?>
                    <a class="dropdown-item" href="../logout.php">
                        <i class="typcn typcn-power text-primary"></i>
                        Logout
                    </a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="typcn typcn-th-menu"></span>
        </button>
    </div>
</nav>


<!-- partial -->
<div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_settings-panel.html -->
    <div class="theme-setting-wrapper">
        <div id="settings-trigger"><i class="typcn typcn-cog-outline"></i></div>
        <div id="theme-settings" class="settings-panel">
            <i class="settings-close typcn typcn-delete-outline"></i>
            <p class="settings-heading">SIDEBAR SKINS</p>
            <div class="sidebar-bg-options" id="sidebar-light-theme">
                <div class="img-ss rounded-circle bg-light border mr-3 selected"></div>
                Light
            </div>
            <div class="sidebar-bg-options" id="sidebar-dark-theme">
                <div class="img-ss rounded-circle bg-dark border mr-3"></div>
                Dark
            </div>
            <p class="settings-heading mt-2">HEADER SKINS</p>
            <div class="color-tiles mx-0 px-4">
                <div class="tiles success"></div>
                <div class="tiles warning"></div>
                <div class="tiles danger"></div>
                <div class="tiles primary"></div>
                <div class="tiles info"></div>
                <div class="tiles dark"></div>
                <div class="tiles default border"></div>
            </div>
        </div>
    </div>
    <!-- partial -->
    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <li class="nav-item">
                <!-- <div class="d-flex sidebar-profile">
                    <div class="sidebar-profile-image">
                        <img src="images/faces/face29.png" alt="image">
                        <span class="sidebar-status-indicator"></span>
                    </div>
                    <div class="sidebar-profile-name">
                        <p class="sidebar-name">

                        </p>
                        <p class="sidebar-designation">
                            Welcome
                        </p>
                    </div>
                </div> -->
                <!-- <div class="nav-search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Type to search..." aria-label="search" aria-describedby="search">
                        <div class="input-group-append">
                            <span class="input-group-text" id="search">
                                <i class="typcn typcn-zoom"></i>
                            </span>
                        </div>
                    </div>
                </div> -->
                <!-- <p class="sidebar-menu-title">Dash Menu</p> -->
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?page=home">
                    <i class="typcn typcn-device-desktop menu-icon"></i>
                    <span class="menu-title">Dashboard </span>
                </a>
            </li>
            <?php
            if ($_SESSION['role'] == 'Admin') { ?>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                        <i class="typcn typcn-group menu-icon"></i>
                        <span class="menu-title">Users</span>
                        <i class="typcn typcn-chevron-right menu-arrow"></i>
                    </a>

                    <div class="collapse" id="ui-basic">
                        <ul class="nav flex-column sub-menu">
                            <!-- <li class="nav-item"> <a class="nav-link" href="?page=users/index&role=Pemilik Kos">Pemilik Kos</a></li>
                        <li class="nav-item"> <a class="nav-link" href="?page=users/index&role=Pencari Kos">Pencari Kos</a></li> -->
                            <li class="nav-item"> <a class="nav-link" href="?page=users/pemilikkos">Pemilik Kos</a></li>
                            <li class="nav-item"> <a class="nav-link" href="?page=users/pencarikos">Pencari Kos</a></li>

                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
                        <i class="typcn typcn-home menu-icon"></i>
                        <span class="menu-title">Kos</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="form-elements">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"><a class="nav-link" href="?page=kos/index">Kos</a></li>
                        </ul>
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"><a class="nav-link" href="?page=fasilitaskos/index">Fasilitas Kos</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
                        <i class="typcn typcn-chart-pie-outline menu-icon"></i>
                        <span class="menu-title">Transaksi</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="charts">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="?page=booking/index">Riwayat Booking Kos</a></li>
                        </ul>
                    </div>
                </li>
            <?php
            } else {  ?>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
                        <i class="typcn typcn-home menu-icon"></i>
                        <span class="menu-title">Kos</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="form-elements">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"><a class="nav-link" href="?page=kos/index">Kos</a></li>
                        </ul>

                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"><a class="nav-link" href="?page=gallerykos/index">Gallery Kos</a></li>
                        </ul>

                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"><a class="nav-link" href="?page=penghunikos/index">Penghuni Kos</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
                        <i class="typcn typcn-chart-pie-outline menu-icon"></i>
                        <span class="menu-title">Transaksi</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="charts">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="?page=booking/index">Riwayat Booking Kos</a></li>
                        </ul>
                    </div>
                </li>
            <?php
            }
            ?>

        </ul>

    </nav>