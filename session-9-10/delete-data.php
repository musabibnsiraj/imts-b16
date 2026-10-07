<?php
include 'conex.php';

// Delete data
try {
    $stmt = $myDB->prepare("DELETE FROM users WHERE id = :id");
    $stmt->execute([':id' => 2]);
    echo "Delete record successfully";
} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
