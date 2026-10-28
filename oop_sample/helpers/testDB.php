<?php

include 'AppManager.php';
$pm = AppManager::getPM();

// // get count without any params
// $count = $pm->getCount("SELECT COUNT(1) as c FROM users");
// echo $count;


// // get count with params
// $firstname = "Musab";
// $param = array(':firstname' => $firstname);
// $count = $pm->getCount("SELECT COUNT(1) as c FROM users WHERE firstname = :firstname", $param);
// echo $count;

// select records without params
$recs = $pm->run("SELECT * FROM users");
print('<pre>');
print_r($recs);
print('</pre>');

die();
// // select records with params
// $userName = "we@ew.com";
// $password = "f1290186a5d0b1ceab27f4e77c0c5d68";
// $param = array(':email' => $userName, ':pw' => $password);
// $recs = $pm->run("SELECT * FROM User WHERE pf_Email = :email and pf_password = :pw", $param);
// //print_r($recs);

// // insert and get last row id
// $param = array(':city' => 'ewewewewe');
// $recs = $pm->insertAndGetLastRowId("INSERT INTO Cities(pf_City) values(:city)", $param);
// echo $recs;

// // insert / update / delete
// $param = array(':city' => 'nnnnnnnnnnnn');
// $pm->run("INSERT INTO Cities(pf_City) values(:city)", $param);




?>