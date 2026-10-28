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

// // select records without params
// $recs = $pm->run("SELECT * FROM users");
// print('<pre>');
// print_r($recs);
// print('</pre>');



// select records with params
$firstname = "Musab";
$param = array(':firstname' => $firstname);
$recs = $pm->run("SELECT * FROM users WHERE firstname = :firstname", $param);

print('<pre>');
print_r($recs);
print('</pre>');


// // insert and get last row id
// $param = array(':city' => 'ewewewewe');
// $recs = $pm->insertAndGetLastRowId("INSERT INTO Cities(pf_City) values(:city)", $param);
// echo $recs;

// // insert / update / delete
// $param = array(':city' => 'nnnnnnnnnnnn');
// $pm->run("INSERT INTO Cities(pf_City) values(:city)", $param);




?>