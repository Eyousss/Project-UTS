<?php
include '../security.php';
include '../../koneksi.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
	header('Location: ../dashboard.php');
	exit;
}

$id = (int) $_GET['id'];

// Get image path before deleting
$stmt = mysqli_prepare($conn, 'SELECT image FROM menu_items WHERE id = ? LIMIT 1');
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $image_path);
mysqli_stmt_fetch($stmt);

$query = "DELETE FROM menu_items WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 'i', $id);
if (mysqli_stmt_execute($stmt)) {
	// Delete image file if it exists
	if ($image_path && file_exists('../../' . $image_path)) {
		unlink('../../' . $image_path);
	}
	header('Location: index.php?deleted=1');
	exit;
}

header('Location: index.php?deleted=0');
exit;
exit;
