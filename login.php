<?php
<<<<<<< HEAD
$page_css = './css/login.css';
include "header.php";
?>

<br>
<section>
    <form action="sv_login.php" method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
    </form>
</section>
=======
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <section class="login-section">
        <form id="login-form" class="login-form" action="sv_login.php" method="post">
            <input id="username" class="login-input" type="text" name="username" placeholder="Username" required>
            <input id="password" class="login-input" type="password" name="password" placeholder="Password" required>
            <button class="login-button" type="submit" name="login">Login</button>
        </form>
    </section>
</body>
</html> 
>>>>>>> aurelio
