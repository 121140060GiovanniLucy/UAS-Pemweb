<?php
include "koneksi.php";
require "OOP.php";
$UList = new UList($conn);
$UList->delete_active($_SESSION['id']);
session_unset();
header("Location: login.php");
