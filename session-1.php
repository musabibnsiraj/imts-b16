<!DOCTYPE html>
<html>
<body>
 
<?php
$x = 5; // Integer variable
$y = 10; // Integer variable


$z = $x + $y; // Integer variable // 15
$w = $z; // 15
echo "<p>The sum of $x and $y is: $w</p>";


$a = 5; // Integer variable
$b = 5; // Integer variable
$c = $a == $b; // true

var_dump($c);

echo "<br>";

$a = 20; // Integer variable
$b = "20"; // Integer variable
$c = $a === $b; // false

var_dump($c);

echo "<br>";

$q = 10; // Integer variable
$r = 10; // Integer variable
$s = $q != $r; // false

var_dump($s);

echo "<br>";
$u = 10; // Integer variable
$v = 100; // Integer variable
$w = $u < $v; // true

var_dump($w);

echo "<br>";

// Logical AND (&&)
$p = 5;
$q = 10;
$result_and = ($p < 10 && $q > 5); // true
var_dump($result_and);

echo "<br>";

// Logical OR (||)
$x_val = 5;
$y_val = 2;
$result_or = ($x_val > 10 || $y_val < 5); // true
var_dump($result_or);

echo "<br>";


define("GREETING", "Assalamu Alaikkum!");

const NAME = "Mishary"; // String constant

$age = 1; // Integer variable
$city = "Puttalam"; // String variable
$price  = 10.5; // Float variable
$isStudent = false; // Boolean variable
$marks = array(85, 90, 78); // Array variable

var_dump($marks); // Display the structure and contents of the $marks array

echo "<h1>" . GREETING . ", " . NAME . "!</h1>";
echo "<p>You are $age years old.</p>";
echo '<p>You live in ' . $city . '.</p>';
echo "<p>You are " . ($isStudent ? "a student" : "not a student") . ".</p>";

echo "<p>The marks are: " . implode(" | ", $marks) . ".</p>";
echo "<p>The price is $$price.</p>";
?>

</body>
</html>

