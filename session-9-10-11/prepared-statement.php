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

// Safe SQL injection demonstration:
// This payload is treated as plain text when it is passed as a bound parameter.
$maliciousEmail = "' OR 1=1 -- ";

// Never build SQL by concatenating user input. The following is intentionally
// commented out so it cannot be executed:
$unsafeSql = "SELECT id FROM users WHERE email = '$maliciousEmail'";

// $safeStmt = $myDB->prepare("SELECT id FROM users WHERE email = :email");
// $safeStmt->execute([':email' => $maliciousEmail]);
// echo "Safe query matched " . $safeStmt->rowCount() . " record(s).<br>";


// Insert multiple records using prepared statement in a transaction
try {
    $myDB->beginTransaction();

    $stmt = $myDB->prepare("INSERT INTO users (firstname, lastname, email) 
    VALUES (:firstname, :lastname, :email)");

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

    $myDB->commit();
    echo "New records created successfully";
} catch (PDOException $e) {
    $myDB->rollBack();
    echo "Error: " . $e->getMessage();
}

$myDB = null;
