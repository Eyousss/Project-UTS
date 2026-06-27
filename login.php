<?php
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