<?php
include "koneksi.php";
require "OOP.php";
$UList = new UList($conn);

$id = $_GET['id'];
$UList->delete_user_by_id($id);
$_SESSION['success'] = "Akun berhasil dihapus.";
header("Location: users.php");
