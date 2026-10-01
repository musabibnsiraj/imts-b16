<?php
session_start();
if (isset($_SESSION['username'])) {
    header('location: index.php');
}
?>

<form action="checklogin.php" method="post"> <br>
    <input type="text" name="username" />
    <br>
    <input type="text" name="password" /> <br>
    <button>Login</button>
</form>