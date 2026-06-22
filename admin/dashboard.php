    <?php
    include "security.php";
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Dashboard - Noma Coffee & Taichan</title>
        <link rel="stylesheet" href="../css/dashboard.css">
    </head>
    <body>
        <div class="container">
            <div class="header">
                <div>
                    <h1>Dashboard Admin</h1>
                    <p>Selamat datang, <?php echo htmlspecialchars($username); ?></p>
                </div>
                <a href="logout.php" class="logout-btn">Logout</a>
            </div>

            <div class="nav-menu">
                <div class="nav-card">
                    <h3>Manajemen Menu</h3>
                    <p>Tambah, edit, dan hapus item menu</p>
                    <a href="add_menu/index.php">Kelola Menu</a>
                </div>
            </div>
        </div>
    </body>
    </html>
    <?php include '../footer.php'; ?>