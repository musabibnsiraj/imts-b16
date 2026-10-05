<?php
include 'conex.php';

echo "<table style='border: solid 1px black;'>";
echo "<tr><th>Id</th><th>Firstname</th><th>Lastname</th><th>Email</th><th>Reg Date</th></tr>";

try {
    $stmt = $conn->prepare("SELECT * FROM users");
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        echo "<tr>";
        echo "<td style='width:150px;border:1px solid black;'>" . $row['id'] . "</td>";
        echo "<td style='width:150px;border:1px solid black;'>" . $row['firstname'] . "</td>";
        echo "<td style='width:150px;border:1px solid black;'>" . $row['lastname'] . "</td>";
        echo "<td style='width:150px;border:1px solid black;'>" . $row['email'] . "</td>";
        echo "<td style='width:150px;border:1px solid black;'>" . $row['reg_date'] . "</td>";
        echo "</tr>" . "\n";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
