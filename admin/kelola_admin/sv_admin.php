<?php
include "../security.php";
include "../../koneksi.php";

if ($role !== 'owner') {
    header("Location: index.php?error=" . urlencode('Akses ditolak. Hanya owner yang dapat mengelola admin.'));
    exit;
}

$action = isset($_POST['action']) ? $_POST['action'] : '';

if ($action === 'add') {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $new_role = isset($_POST['role']) ? $_POST['role'] : '';

    if ($username === '' || $password === '' || $new_role === '') {
        header("Location: add_admin.php?error=" . urlencode('Semua field harus diisi.'));
        exit;
    }

    $escaped_username = mysqli_real_escape_string($conn, $username);
    $escaped_role = mysqli_real_escape_string($conn, $new_role);

    $check_query = "SELECT id FROM users WHERE username = '$escaped_username'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        header("Location: add_admin.php?error=" . urlencode('Username sudah terdaftar.'));
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $insert_query = "INSERT INTO users (username, password, role) VALUES ('$escaped_username', '$hashed_password', '$escaped_role')";

    if (mysqli_query($conn, $insert_query)) {
        header("Location: index.php?success=added");
        exit;
    }

    header("Location: add_admin.php?error=" . urlencode('Gagal menambahkan admin.'));
    exit;
}

if ($action === 'edit') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $new_role = isset($_POST['role']) ? $_POST['role'] : '';

    if ($id <= 0 || $new_role === '') {
        header("Location: edit.php?id=$id&error=" . urlencode('Data tidak valid.'));
        exit;
    }

    $escaped_role = mysqli_real_escape_string($conn, $new_role);

    if ($password !== '') {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $update_query = "UPDATE users SET role = '$escaped_role', password = '$hashed_password' WHERE id = $id";
    } else {
        $update_query = "UPDATE users SET role = '$escaped_role' WHERE id = $id";
    }

    if (mysqli_query($conn, $update_query)) {
        header("Location: index.php?success=updated");
        exit;
    }

    header("Location: edit.php?id=$id&error=" . urlencode('Gagal memperbarui admin.'));
    exit;
}

header("Location: index.php");
exit;
?>
