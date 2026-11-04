<?php
include 'AppManager.php';
$sm = AppManager::getSM();
// $sm->setAttribute("user_name", "musab");

echo $sm->isKeySet("user_name");
echo "<br>get session";
echo $sm->getAttribute("user_name");