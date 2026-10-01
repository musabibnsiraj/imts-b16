<?php
session_start();

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// check the username / password in db

if ($username == 'musab' && $password == 'asd') {
    $_SESSION['username'] = $username;
    $_SESSION['profile_pic'] = "user.jpg";
    $_SESSION['full_name'] = "Musab Ibn Siraj";
    header('location: index.php');
} else {
    echo "invalid username / password";
    echo "<a href='index.php'> Back </a>";
}
