<?php

// a = apped || w = write || r = read

$myfile = fopen("assets/test.txt", "w"); 

$txt = "Musab Ibn Siraj\n";
fwrite($myfile, $txt);

$txt = "Mishary Ibn Musab\n";
fwrite($myfile, $txt);

$txt = "Mishary \n";
fwrite($myfile, $txt);

$txt = "Benazir \n";
fwrite($myfile, $txt);

$txt = "Muizza \n";
fwrite($myfile, $txt);

fclose($myfile);

echo "Data written successfully.";

