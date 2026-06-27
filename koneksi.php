<?php

$host = "localhost";
$user = "root";
$pass = "";
$db   = "backend_noma";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

$newsTableCheck = mysqli_query($conn, "SHOW TABLES LIKE 'news'");
if ($newsTableCheck && mysqli_num_rows($newsTableCheck) === 0) {
    mysqli_query($conn, "CREATE TABLE news (
        id INT NOT NULL AUTO_INCREMENT,
        title VARCHAR(255) NOT NULL,
        description TEXT NOT NULL,
        image VARCHAR(255) DEFAULT NULL,
        button_text VARCHAR(100) DEFAULT 'View More',
        button_url VARCHAR(255) DEFAULT '#',
        created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
}

?>