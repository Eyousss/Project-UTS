<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $service_rating = isset($_POST['service_rating']) ? (int)$_POST['service_rating'] : 0;
    $menu_rating = isset($_POST['menu_rating']) ? (int)$_POST['menu_rating'] : 0;
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($service_rating < 1 || $service_rating > 5 || $menu_rating < 1 || $menu_rating > 5) {
        header('Location: feedback.php?error=' . urlencode('Pilih skor pelayanan dan skor menu dengan benar.'));
        exit;
    }

    if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('Location: feedback.php?error=' . urlencode('Format email tidak valid.'));
        exit;
    }

    $query = "INSERT INTO feedback (service_rating, menu_rating, email, message, created_at) VALUES (?, ?, ?, ?, NOW())";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'iiss', $service_rating, $menu_rating, $email, $message);

    if (mysqli_stmt_execute($stmt)) {
        header('Location: feedback.php?success=1');
        exit;
    }

    $error = 'Gagal menyimpan feedback: ' . mysqli_error($conn);
    header('Location: feedback.php?error=' . urlencode($error));
    exit;
}

header('Location: feedback.php');
exit;
