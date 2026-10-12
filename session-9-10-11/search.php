<?php
include 'conex.php';

// Use the connection created by conex.php and stop before calling methods on
// a null value. The fallback also supports connection files using $conn.
$db = $myDB ?? ($conn ?? null);
if (!($myDB instanceof PDO)) {
    exit('Database connection is unavailable.');
}

// Read the optional search value from the query string.
$search = trim($_GET['search'] ?? '');
$page = filter_var($_GET['page'] ?? 1, FILTER_VALIDATE_INT);
$page = ($page !== false && $page > 0) ? $page : 1;
$perPage = 4;

// Delete only the user whose submitted ID is a valid positive integer.
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $deleteId = filter_var($_POST['delete_id'], FILTER_VALIDATE_INT);
    if ($deleteId !== false && $deleteId > 0) {
        $stmt = $myDB->prepare("DELETE FROM users WHERE id = :id");
        $stmt->execute([':id' => $deleteId]);
    }
}

echo "<form method='get'>";
echo "<input type='search' name='search' placeholder='Search users' value='" . htmlspecialchars($search, ENT_QUOTES, 'UTF-8') . "'>";
echo "<button type='submit'>Search</button>";
echo "</form>";

echo "<a href='create.php'>Create User</a> <br><br>";

echo "<table border='1' cellpadding='10' cellspacing='0' style='width: 100%;'>";
echo "<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Email</th>
    <th>Registration Date</th>
    <th>Action</th></tr>";

try {
    // Count matching users so the pagination links can be generated.
    $searchValue = "%$search%";
    $countStmt = $myDB->prepare("SELECT COUNT(*) FROM users WHERE firstname LIKE :search OR lastname LIKE :search OR email LIKE :search");
    $countStmt->execute(['search' => $searchValue]);
    $totalUsers = (int) $countStmt->fetchColumn();
    $totalPages = max(1, (int) ceil($totalUsers / $perPage));
    $page = min($page, $totalPages);
    $offset = ($page - 1) * $perPage;

    // print_r("Total: " . $totalUsers . "<br>");
    // print_r("Limit: " . $perPage . "<br>");
    // print_r("Offset: " . $offset . "<br>");
    // print_r("Total pages: " . $totalPages . "<br>");
    // print_r("Current page: " . $page . "<br>");


    // Prepared statements keep the search value separate from the SQL query.
    $stmt = $myDB->prepare("SELECT * FROM users WHERE firstname LIKE :search OR lastname LIKE :search OR email LIKE :search ORDER BY id DESC LIMIT :limit OFFSET :offset");
    $stmt->bindValue(':search', $searchValue, PDO::PARAM_STR);
    $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll();
    if (empty($result)) {
        echo "<tr><td colspan='6'>No users found</td></tr>";
    } else {
        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['firstname'] . "</td>";
            echo "<td>" . $row['lastname'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['reg_date'] . "</td>";
            echo "<td>";
            // Provide a link to edit this user.
            echo "<a href='edit.php?id=" . (int) $row['id'] . "'>Edit</a><br><br>";

            // Ask for confirmation before submitting the delete request.
            echo "<form method='post' 
        onsubmit=\"return confirm('Are you sure you want to delete this user?');\">";
            echo "<input type='hidden' name='delete_id' value='" . (int) $row['id'] . "'>";
            echo "<button type='submit'>Delete</button>";
            echo "</form>";

            echo "</td>";
            echo "</tr>";
        }

        if ($totalPages > 1) {
            echo "<div style='margin-top: 15px;'>";
            for ($pageNumber = 1; $pageNumber <= $totalPages; $pageNumber++) {
                $query = http_build_query(['search' => $search, 'page' => $pageNumber]);
                if ($pageNumber === $page) {
                    echo " <strong>" . $pageNumber . "</strong> ";
                } else {
                    echo " <a href='?" . htmlspecialchars($query, ENT_QUOTES, 'UTF-8') . "'>" . $pageNumber . "</a> ";
                }
            }
            echo "</div>";
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
echo "</table>";

// Release the active database connection when the page is complete.
$myDB = null;
