<?php
include "../security.php";
include "../../koneksi.php";

// Cek apakah user adalah owner
if ($role !== 'owner') {
    header("Location: index.php");
    exit;
}

$action = isset($_POST['action']) ? $_POST['action'] : '';

if ($action === 'add') {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $new_role = isset($_POST['role']) ? $_POST['role'] : '';

    // Validasi input
    if (empty($username) || empty($password) || empty($new_role)) {
        $_SESSION['error'] = 'Semua field harus diisi';
        header("Location: add_admin.php");
        exit;
    }

    // Cek apakah username sudah ada
    $check_query = "SELECT id FROM users WHERE username = '" . mysqli_real_escape_string($conn, $username) . "'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        $_SESSION['error'] = 'Username sudah terdaftar';
        header("Location: add_admin.php");
        exit;
    }

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert data baru
    $insert_query = "INSERT INTO users (username, password, role) VALUES (
        '" . mysqli_real_escape_string($conn, $username) . "',
        '" . $hashed_password . "',
        '" . mysqli_real_escape_string($conn, $new_role) . "'
    )";

    if (mysqli_query($conn, $insert_query)) {
        $_SESSION['success'] = 'Admin baru berhasil ditambahkan';
        header("Location: index.php?success=added");
        exit;
    } else {
        $_SESSION['error'] = 'Gagal menambahkan admin: ' . mysqli_error($conn);
        header("Location: add_admin.php");
        exit;
    }
} elseif ($action === 'edit') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $new_role = isset($_POST['role']) ? $_POST['role'] : '';

    // Validasi input
    if (empty($id) || empty($new_role)) {
        $_SESSION['error'] = 'Data tidak valid';
        header("Location: index.php");
        exit;
    }

    // Update query
    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $update_query = "UPDATE users SET role = '" . mysqli_real_escape_string($conn, $new_role) . "', password = '" . $hashed_password . "' WHERE id = $id";
    } else {
        $update_query = "UPDATE users SET role = '" . mysqli_real_escape_string($conn, $new_role) . "' WHERE id = $id";
    }

    if (mysqli_query($conn, $update_query)) {
        $_SESSION['success'] = 'Admin berhasil diperbarui';
        header("Location: index.php?success=updated");
        exit;
    } else {
        $_SESSION['error'] = 'Gagal memperbarui admin: ' . mysqli_error($conn);
        header("Location: edit.php?id=$id");
        exit;
    }
}

// Jika tidak ada action yang valid, redirect ke index
header("Location: index.php");
exit;
?>
