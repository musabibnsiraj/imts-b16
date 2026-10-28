<?php

include 'AppManager.php';
$pm = AppManager::getPM();

// get count without any params
$count = $pm->getCount("SELECT COUNT(1) as c FROM users");
echo $count;
echo "<br>";

// get count with params
$firstname = "Musab";
$param = array(':firstname' => $firstname);
$count = $pm->getCount("SELECT COUNT(1) as c FROM users WHERE firstname = :firstname", $param);
echo $count;
echo "<br>";

// select records without params
$recs = $pm->run("SELECT * FROM users");
print('<pre>');
print_r($recs);
print('</pre>');
echo "<br>";

// select records with params
$firstname = "Musab";
$param = array(':firstname' => $firstname);
$recs = $pm->run("SELECT * FROM users WHERE firstname = :firstname", $param);

print('<pre>');
print_r($recs);
print('</pre>');

echo "<br>";

// insert and get last row id
$param = array(':firstname' => 'Zara', ':lastname' => 'Sahfiya ');
$recs = $pm->insertAndGetLastRowId("INSERT INTO users(firstname, lastname) values(:firstname, :lastname)", $param);
echo $recs;

// delete user by first name
$param = array(':firstname' => 'Musab');
$pm->run("DELETE FROM users WHERE firstname = :firstname", $param);

// update user by id
$param = array(':firstname' => 'Hafeel Nawas', ':lastname' => 'Zara Sahfiya', ':id' => 70);
$pm->run("UPDATE users SET firstname = :firstname, lastname = :lastname WHERE id = :id", $param);
