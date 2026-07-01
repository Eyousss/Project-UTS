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

$galleryTableCheck = mysqli_query($conn, "SHOW TABLES LIKE 'gallery_items'");
if ($galleryTableCheck && mysqli_num_rows($galleryTableCheck) === 0) {
    mysqli_query($conn, "CREATE TABLE gallery_items (
        id INT NOT NULL AUTO_INCREMENT,
        title VARCHAR(100) NOT NULL,
        image VARCHAR(255) NOT NULL,
        section INT NOT NULL DEFAULT 1,
        section_name VARCHAR(100) DEFAULT NULL,
        position VARCHAR(10) NOT NULL DEFAULT 'right',
        created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
} else {
    $positionColumnCheck = mysqli_query($conn, "SHOW COLUMNS FROM gallery_items LIKE 'position'");
    if ($positionColumnCheck && mysqli_num_rows($positionColumnCheck) === 0) {
        mysqli_query($conn, "ALTER TABLE gallery_items ADD COLUMN position VARCHAR(10) NOT NULL DEFAULT 'right'");
    }

    $sectionNameColumnCheck = mysqli_query($conn, "SHOW COLUMNS FROM gallery_items LIKE 'section_name'");
    if ($sectionNameColumnCheck && mysqli_num_rows($sectionNameColumnCheck) === 0) {
        mysqli_query($conn, "ALTER TABLE gallery_items ADD COLUMN section_name VARCHAR(100) DEFAULT NULL");
    }

    $sectionColumnCheck = mysqli_query($conn, "SHOW COLUMNS FROM gallery_items LIKE 'section'");
    if ($sectionColumnCheck && mysqli_num_rows($sectionColumnCheck) === 0) {
        $sectionOrderColumnCheck = mysqli_query($conn, "SHOW COLUMNS FROM gallery_items LIKE 'section_order'");
        mysqli_query($conn, "ALTER TABLE gallery_items ADD COLUMN section INT NOT NULL DEFAULT 1 AFTER image");
        if ($sectionOrderColumnCheck && mysqli_num_rows($sectionOrderColumnCheck) === 1) {
            mysqli_query($conn, "UPDATE gallery_items SET section = section_order");
        }
    }
}

?>