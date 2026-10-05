<?php
include 'conex.php';

// Check if table exists
$tableName = "users";
$stmt = $conn->query("SHOW TABLES LIKE '$tableName'");

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
        $conn->exec($sql);
    } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
        exit;
    }
}

// Insert data
try {
    $sql = "INSERT INTO users (firstname, lastname, email)
      VALUES ('Musab', 'ibn Siraj', 'musab@gmail.com')";

    $conn->exec($sql);
    echo "New record created successfully";
    echo "<br>";
    $last_id = $conn->lastInsertId();
    echo "Last inserted ID is: " . $last_id;
} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
