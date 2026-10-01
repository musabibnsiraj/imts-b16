<?php

// echo readfile('student.csv');


$myfile = fopen("assets/data.txt", "r") or die("Unable to open file!");
echo fread($myfile, filesize("assets/data.txt"));

echo "<br><br>";

$myfile = fopen("assets/data.txt", "r") or die("Unable to open file!");

// Output one line until end-of-file
while (!feof($myfile)) {
    echo fgets($myfile) . "<br>";
}

echo "<br><br>";

//------------------------------------

$file = fopen('assets/student.csv', 'r') or die('Unable to open file!');

echo '<table border="1" cellpadding="5">';

while (($row = fgetcsv($file)) !== false) {
    echo '<tr>';

    foreach ($row as $value) {
        echo '<td>' . htmlspecialchars($value, ENT_QUOTES, 'UTF-8') . '</td>';
    }

    echo '</tr>';
}

echo '</table>';
fclose($file);
