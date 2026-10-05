<?php include 'conex.php';

// Check if table exists
$tableName = "users";
$stmt = $conn->query("SHOW TABLES LIKE '$tableName'");
//
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
        echo "Table users created successfully";
    } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
} else {
    echo "Table users already exists";
}
