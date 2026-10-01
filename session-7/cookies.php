<?php

$cookie_name = "username";
$cookie_value = "John Doe";
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

// Set: name, value, options
setcookie('theme', 'dark', [
    'expires'  => time() + (86400 * 365 * 10), // 10 years (effectively unlimited)
    'path'     => '/',
    'secure'   => true,   // HTTPS only
    'httponly' => true,   // JS cannot read it
    'samesite' => 'Lax',
]);

// Set: name, value, options
setcookie('lang', 'en', [
    'expires'  => time() + (86400 * 365 * 10), // 10 years (effectively unlimited)
    'path'     => '/',
    'secure'   => true,   // HTTPS only
    'httponly' => true,   // JS cannot read it
    'samesite' => 'Lax', 
]);

if (isset($_COOKIE[$cookie_name])) {
    echo "Cookie '" . $cookie_name . "' is set!<br>";
    echo "Value is: " . $_COOKIE[$cookie_name];
} else {
    echo "Cookie named '" . $cookie_name . "' is not set!";
}

// Delete
setcookie('theme', '', time() - 3600, '/');

// Read (available on the NEXT request)
$theme = $_COOKIE['theme'] ?? 'light';

// Read (available on the NEXT request)
$lang = $_COOKIE['lang'] ?? 'ta';

echo "<br>";
echo "<br>";
echo "theme<br>";
echo $theme;

echo "<br>";
echo "<br>";
echo "lang <br>";
echo $lang;
