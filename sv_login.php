<?php
session_start();

include "koneksi.php";

$username = $_POST['username'] ?? '';
$password = MD5($_POST['password'] ?? '');

$stmt = $conn->prepare("SELECT id, username, role FROM users WHERE username = ? AND password = ?");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();

$result = $stmt->get_result();
$num = $result->num_rows;

if ($num > 0) {
    $row = $result->fetch_assoc();
    $_SESSION['username'] = $row['username'];
    $_SESSION['role'] = $row['role'];
    $_SESSION['admin'] = true;
    header("Location: admin/dashboard.php");
    exit;
} else {
    header("Location: login.php");
    exit;
}
?>