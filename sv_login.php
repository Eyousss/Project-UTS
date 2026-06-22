<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.php');
    exit;
}

include 'koneksi.php';

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if ($username === '' || $password === '') {
    header('Location: login.php?error=1');
    exit;
}

$stmt = mysqli_prepare($conn, 'SELECT id, username, password FROM users WHERE username = ? LIMIT 1');
mysqli_stmt_bind_param($stmt, 's', $username);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);

if (mysqli_stmt_num_rows($stmt) === 0) {
    header('Location: login.php?error=1');
    exit;
}

mysqli_stmt_bind_result($stmt, $id, $db_user, $db_pass_hash);
mysqli_stmt_fetch($stmt);

$verified = false;
if (password_verify($password, $db_pass_hash)) {
    $verified = true;
} else {
    // Fallback: allow legacy MD5 or plain text match (not recommended)
    if ($db_pass_hash === md5($password) || $db_pass_hash === $password) {
        $verified = true;
    }
}

if ($verified) {
    $_SESSION['username'] = $db_user;
    $_SESSION['user_id'] = $id;
    $_SESSION['admin'] = true;
    header('Location: admin/dashboard.php');
    exit;
}

header('Location: login.php?error=1');
exit;
?>