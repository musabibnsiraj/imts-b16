<?php
// Start the session
session_start();

// Set session variables
$_SESSION["favcolor"] = "green";
$_SESSION["favanimal"] = "cat";
echo "Session variables are set.";

echo "<br><br><br>";

// Output session variables that were set on previous page
if (isset($_SESSION["favcolor"])) {
    echo "Favorite color is " . $_SESSION["favcolor"] . ".<br>";
    echo "Favorite animal is " . $_SESSION["favanimal"] . ".";
} else {
    echo "No session data found.";
}
?>