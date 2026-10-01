<?php

function clean(mixed $data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$name = clean($_POST['name'] ?? 'Guest');

echo "Hello, $name! Welcome";
echo "<br>";
echo "Method: " . $_SERVER['REQUEST_METHOD'] . "<br>";
