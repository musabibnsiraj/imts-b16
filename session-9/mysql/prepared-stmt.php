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

// Insert multiple records using prepared statement in a transaction
try {
  $conn->beginTransaction();

  $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, email) VALUES (:firstname, :lastname, :email)");

  $stmt->bindParam(':firstname', $firstname);
  $stmt->bindParam(':lastname', $lastname);
  $stmt->bindParam(':email', $email);

  $data = [
    ['Musab', 'Ibn Siraj', 'musab.ibnsiraj@example.com'],
    ['Musab', 'Mishary', 'musab.mishary@example.com'],
    ['Nawas', 'Zara', 'nawas.zara@example.com']
  ];

  foreach ($data as $row) {
    $firstname = $row[0];
    $lastname = $row[1];
    $email = $row[2];
    $stmt->execute();
  }

  $conn->commit();
  echo "New records created successfully";
} catch (PDOException $e) {
  $conn->rollBack();
  echo "Error: " . $e->getMessage();
}

$conn = null;
