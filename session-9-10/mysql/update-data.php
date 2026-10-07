<?php
include 'conex.php';

// Update data
try {
    $sql = "UPDATE users SET email='musab.dot@yahoo.com', firstname='M Musab ',lastname='' WHERE id=7";

    // Prepare statement
    $stmt = $conn->prepare($sql);

    // execute the query
    $stmt->execute();

    // echo a message to say the UPDATE succeeded
    echo $stmt->rowCount() . " records UPDATED successfully";
} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
