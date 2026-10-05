<?php
include 'conex.php';

echo "<table style='border: solid 1px black;'>";
echo "<tr><th>Id</th><th>Firstname</th><th>Lastname</th><th>Email</th><th>Reg Date</th></tr>";

class TableRows extends RecursiveIteratorIterator
{
    function __construct($it)
    {
        parent::__construct($it, self::LEAVES_ONLY);
    }

    function current(): mixed
    {
        return "<td style='width:150px;border:1px solid black;'>" . parent::current() . "</td>";
    }

    function beginChildren(): void
    {
        echo "<tr>";
    }

    function endChildren(): void
    {
        echo "</tr>" . "\n";
    }
}

try {
    // // All Data
    // $stmt = $conn->prepare("SELECT * FROM users");

    // // Where
    // $stmt = $conn->prepare("SELECT * FROM users where firstname = 'Musab'"); 

    // // Order By
    // $stmt = $conn->prepare("SELECT * FROM users order by id desc");

    // // Limit Data
    // $stmt = $conn->prepare("SELECT * FROM users order by id desc limit 3 ");

    // Limit with offset Data
    $stmt = $conn->prepare("SELECT * FROM users limit 5 OFFSET 3");

    $stmt->execute();

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    // var_dump(($stmt->fetchAll()));
    // die;
    foreach (new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k => $v) {
        echo $v;
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
