    <?php
    include "security.php";
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Dashboard - Noma Coffee & Taichan</title>
        <style>
            * { margin: 0; padding: 0; box-sizing: border-box; }
            body { font-family: Arial, sans-serif; background-color: #f5f5f5; }
            .container { max-width: 1200px; margin: 0 auto; padding: 20px; }
            .header { background-color: #333; color: white; padding: 20px; margin-bottom: 30px; border-radius: 5px; display: flex; justify-content: space-between; align-items: center; }
            .header h1 { font-size: 24px; }
            .header p { font-size: 14px; }
            .nav-menu { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 30px; }
            .nav-card { background-color: white; padding: 20px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); text-align: center; transition: transform 0.3s; }
            .nav-card:hover { transform: translateY(-5px); box-shadow: 0 5px 15px rgba(0,0,0,0.2); }
            .nav-card a { display: inline-block; padding: 10px 20px; background-color: #2d89ef; color: white; text-decoration: none; border-radius: 4px; margin-top: 10px; }
            .nav-card a:hover { background-color: #1e5bb8; }
            .nav-card h3 { margin-bottom: 10px; color: #333; }
            .logout-btn { background-color: #dc3545; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px; display: inline-block; }
            .logout-btn:hover { background-color: #c82333; }
        </style>
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
                    <h3>📋 Manajemen Menu</h3>
                    <p>Tambah, edit, dan hapus item menu</p>
                    <a href="add_menu/index.php">Kelola Menu</a>
                </div>
            </div>
        </div>
    </body>
    </html>