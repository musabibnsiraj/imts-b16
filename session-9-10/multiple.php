<?php
include 'conex.php';

// Check if table exists
$tableName = "users";
$stmt = $myDB->query("SHOW TABLES LIKE '$tableName'");

if ($stmt->rowCount() == 0) {
    // sql to create table
    $sql = "CREATE TABLE users (
      id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      firstname VARCHAR(30) NOT NULL,
      lastname VARCHAR(30) NOT NULL,
      email VARCHAR(50),
      reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

    try {
        $myDB->exec($sql);
    } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
        exit;
    }
}

//multiple insert
try {
    $myDB->beginTransaction();

    $myDB->exec("INSERT INTO users (firstname, lastname, email)
            VALUES ('1', 'Ibn Siraj', 'musab@gmail.com')");

    $myDB->exec("INSERT INTO users (firstname, lastname, email)
            VALUES ('2', 'Ibn Siraj', 'musab@gmail.com')");

    $myDB->exec("INSERT INTO users (firstname, lastname, email)
            VALUES ('3', 'Ibn Siraj', 'musab@gmail.com')");

    $myDB->exec("INSERT INTO users (firstname, lastname, email)
            VALUES ('4', 'Ibn Siraj', 'musab@gmail.com')");

    $myDB->commit();
    echo "New records created successfully";
} catch (PDOException $e) {
    $myDB->rollBack();
    echo "Error: " . $e->getMessage();
}


$myDB = null;
