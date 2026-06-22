<?php
include '../security.php';
include '../../koneksi.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
	header('Location: ../dashboard.php');
	exit;
}

$id = (int) $_GET['id'];

$query = "DELETE FROM menu_items WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 'i', $id);
if (mysqli_stmt_execute($stmt)) {
	header('Location: index.php?deleted=1');
	exit;
}

header('Location: index.php?deleted=0');
exit;
