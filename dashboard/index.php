<?php
session_start();
if (!isset($_SESSION['role'])) {
    echo '<script>alert("Anda harus login terlebih dahulu!");window.location.href="../login.php"</script>';
}

include '../includes/koneksi.php';
include 'layout/header.php';
include 'layout/navbar.php';
include 'content.php';
include 'layout/footer.php';
