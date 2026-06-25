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
mysqli_stmt_close($stmt);

$query = "DELETE FROM menu_items WHERE id = ?";
$stmt_delete = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt_delete, 'i', $id);
if (mysqli_stmt_execute($stmt_delete)) {
	mysqli_stmt_close($stmt_delete);
	
	if ($image_path && file_exists('../../' . $image_path)) {
		unlink('../../' . $image_path);
	}
	header('Location: index.php?deleted=1');
	exit;
}
mysqli_stmt_close($stmt_delete);

header('Location: index.php?deleted=0');
exit;
exit;
