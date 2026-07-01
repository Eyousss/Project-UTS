<?php
session_start();

$username = $_SESSION['username'] ?? '';
$role = $_SESSION['role'] ?? '';

if ($username == "") {
    header("Location: ../login.php");
    exit;
}
?>