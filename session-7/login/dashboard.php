<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location: index.php');
}

?>

<h1> Welcome <?= $_SESSION['full_name'] ?? 'User' ?></h1>

<img src="<?= $_SESSION['profile_pic'] ?? 'User' ?>" height="100">
<a href="logout.php"> Logout </a>