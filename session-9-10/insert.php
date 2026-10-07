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

try{
    $sql = "INSERT INTO users (firstname, lastname, email)
        VALUES ('Mishary', 'Mishary', 'mishary@gmail.com')";

    $myDB->exec($sql);

    $last_id = $myDB->lastInsertId();

    echo "New record created successfully <br>";
    echo "Record ID is: " . $last_id;
} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

$myDB = null;