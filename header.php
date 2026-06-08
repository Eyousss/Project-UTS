<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title : 'Noma Coffee & Taichan'; ?></title>
    <link rel="stylesheet" href="<?php echo isset($page_css) ? $page_css : './css/Homepage.css'; ?>">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <nav class="navbar">
        <div class="logo">
            <a href="index.php" class="logo-text">noma</a>
        </div>
        <ul class="menu">
            <li><a href="index.php" class="active-page" id="home">HOME</a></li>
            <li><a href="menu.php" id="menu">MENU</a></li>
            <li><a href="galery.php" id="galery">GALERI</a></li>
            <li><a href="feedback.php" id="feedback">FEEDBACK</a></li>
        </ul>
    </nav>