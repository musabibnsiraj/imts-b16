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

// Insert multiple records in a transaction
try {
  // begin the transaction
  $conn->beginTransaction();

  // our SQL statements
  $conn->exec("INSERT INTO users (firstname, lastname, email)
      VALUES ('Musab', 'Ibn Siraj', 'musab.ibnsiraj@example.com')");
  //
  $conn->exec("INSERT INTO users (firstname, lastname, email)
      VALUES ('Musab', 'Mishary', 'musab.mishary@example.com')");
  //
  $conn->exec("INSERT INTO users (firstname, lastname, email)
      VALUES ('Nawas', 'Zara', 'nawas.zara@example.com')");

  // commit the transaction
  $conn->commit();
  echo "New records created successfully";
} catch (PDOException $e) {
  // roll back the transaction if something failed
  $conn->rollBack();
  echo "Error: " . $e->getMessage();
}

$conn = null;
