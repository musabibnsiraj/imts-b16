<?php
include 'conex.php';

$db = $myDB ?? ($conn ?? null);
if (!$db instanceof PDO) {
    exit('Database connection is unavailable.');
}

$search = trim((string) ($_GET['search'] ?? $_GET['q'] ?? ''));
$page = filter_var($_GET['page'] ?? 1, FILTER_VALIDATE_INT);
$page = ($page !== false && $page > 0) ? $page : 1;
$perPage = 4;

function e($value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function userRows(PDO $db, string $search, int $limit, int $offset): string
{
    $term = "%{$search}%";
    $stmt = $db->prepare(
        'SELECT id, firstname, lastname, email, reg_date
         FROM users
         WHERE firstname LIKE :first OR lastname LIKE :last OR email LIKE :email
         ORDER BY id DESC LIMIT :limit OFFSET :offset'
    );
    $stmt->bindValue(':first', $term, PDO::PARAM_STR);
    $stmt->bindValue(':last', $term, PDO::PARAM_STR);
    $stmt->bindValue(':email', $term, PDO::PARAM_STR);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();

    $rows = '';
    foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
        $id = (int) $row['id'];
        $rows .= '<tr>'
            . '<td>' . $id . '</td>'
            . '<td>' . e($row['firstname']) . '</td>'
            . '<td>' . e($row['lastname']) . '</td>'
            . '<td>' . e($row['email']) . '</td>'
            . '<td>' . e($row['reg_date']) . '</td>'
            . '<td><div class="actions">'
            . '<a class="edit-link" href="edit.php?id=' . $id . '">✎ Edit</a>'
            . '<form method="post" onsubmit="return confirm(\'Are you sure you want to delete this user?\');">'
            . '<input type="hidden" name="delete_id" value="' . $id . '">'
            . '<button class="delete-button" type="submit">Delete</button></form>'
            . '</div></td></tr>';
    }

    return $rows ?: '<tr><td class="empty" colspan="6">No users found.</td></tr>';
}

if (($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '') === 'XMLHttpRequest') {
    try {
        echo userRows($db, $search, $perPage, 0);
    } catch (PDOException $e) {
        http_response_code(500);
        echo '<tr><td class="empty" colspan="6">Unable to search users.</td></tr>';
    }
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $deleteId = filter_var($_POST['delete_id'], FILTER_VALIDATE_INT);
    if ($deleteId !== false && $deleteId > 0) {
        $stmt = $db->prepare('DELETE FROM users WHERE id = :id');
        $stmt->execute([':id' => $deleteId]);
    }
}

$term = "%{$search}%";
$countStmt = $db->prepare(
    'SELECT COUNT(*) FROM users
     WHERE firstname LIKE :first OR lastname LIKE :last OR email LIKE :email'
);
$countStmt->execute([':first' => $term, ':last' => $term, ':email' => $term]);
$totalUsers = (int) $countStmt->fetchColumn();
$totalPages = max(1, (int) ceil($totalUsers / $perPage));
$page = min($page, $totalPages);

echo "<style>
    :root { color-scheme: light; font-family: Inter, Arial, sans-serif; }
    * { box-sizing: border-box; }
    body { margin: 0; padding: 32px 16px; background: #f4f7fb; color: #172033; }
    .page { max-width: 1100px; margin: 0 auto; }
    .header { display: flex; justify-content: space-between; align-items: center; gap: 16px; margin-bottom: 22px; }
    h1 { margin: 0; font-size: 28px; color: #172033; }
    .subtitle { margin: 6px 0 0; color: #68758a; font-size: 14px; }
    .card { background: #fff; border: 1px solid #e4eaf2; border-radius: 14px; box-shadow: 0 8px 24px rgba(31, 55, 90, .07); overflow: hidden; }
    .toolbar { display: flex; justify-content: space-between; align-items: center; gap: 12px; padding: 18px 20px; border-bottom: 1px solid #edf1f6; }
    .search { display: flex; flex: 1; max-width: 480px; gap: 8px; }
    input[type='search'] { width: 100%; padding: 10px 13px; border: 1px solid #d5deea; border-radius: 8px; font-size: 14px; outline: none; }
    input[type='search']:focus { border-color: #4779d1; box-shadow: 0 0 0 3px rgba(71, 121, 209, .14); }
    button, .button { border: 0; border-radius: 8px; padding: 10px 14px; font-size: 14px; font-weight: 600; cursor: pointer; text-decoration: none; display: inline-block; }
    .search button, .button-primary { background: #356dcc; color: #fff; }
    .search button:hover, .button-primary:hover { background: #285bb0; }
    .table-wrap { overflow-x: auto; }
    table { width: 100%; border-collapse: collapse; }
    th { padding: 14px 18px; background: #f8fafc; color: #657389; font-size: 12px; text-align: left; text-transform: uppercase; letter-spacing: .04em; white-space: nowrap; }
    td { padding: 15px 18px; border-top: 1px solid #edf1f6; font-size: 14px; vertical-align: middle; }
    tr:hover td { background: #fbfcfe; }
    .actions { display: flex; align-items: center; gap: 12px; }
    .edit-link { padding: 7px 11px; border: 1px solid #c9d9f5; border-radius: 8px; background: #eef4ff; color: #285bb0; font-weight: 600; text-decoration: none; transition: .2s ease; }
    .edit-link:hover { background: #dce9ff; border-color: #9ebce9; transform: translateY(-1px); }
    .delete-button { padding: 7px 10px; background: #fff0f0; color: #c43d3d; }
    .delete-button:hover { background: #ffe0e0; }
    .empty { text-align: center; color: #68758a; padding: 32px 18px; }
    .pagination { display: flex; justify-content: center; gap: 6px; padding: 18px; border-top: 1px solid #edf1f6; }
    .pagination a, .pagination strong { min-width: 34px; padding: 8px 10px; border-radius: 7px; text-align: center; text-decoration: none; }
    .pagination a { color: #356dcc; background: #f1f5fc; }
    .pagination a:hover, .pagination strong { background: #356dcc; color: #fff; }
    @media (max-width: 650px) { body { padding: 20px 10px; } .header, .toolbar { align-items: stretch; flex-direction: column; } .search { max-width: none; } h1 { font-size: 24px; } }
</style>";

echo "<main class='page'>";
echo "<header class='header'><div><h1>User Directory</h1><p class='subtitle'>Manage registered users and their account details.</p></div><a class='button button-primary' href='create.php'>+ Create User</a></header>";
echo "<section class='card'>";

// Delete only the user whose submitted ID is a valid positive integer.
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $deleteId = filter_var($_POST['delete_id'], FILTER_VALIDATE_INT);
    if ($deleteId !== false && $deleteId > 0) {
        $stmt = $myDB->prepare("DELETE FROM users WHERE id = :id");
        $stmt->execute([':id' => $deleteId]);
    }
}

echo "<div class='toolbar'><form class='search' method='get'>";
echo "<input type='search' name='search' id='search' oninput='ajaxCall(this.value)' placeholder='Search users' value='" . e($search) . "'>";
echo "<button type='submit'>Search</button>";
echo "</form>";
echo "</div>";

echo "<div class='table-wrap'><table><thead><tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Registration Date</th><th>Action</th></tr></thead><tbody id='txtHint'>";

try {
    echo userRows($db, $search, $perPage, ($page - 1) * $perPage);
} catch (PDOException $e) {
    echo '<tr><td class="empty" colspan="6">Unable to load users.</td></tr>';
}
echo "</tbody></table></div>";

if ($totalPages > 1) {
    echo "<footer class='pagination' aria-label='Pagination'>";
    for ($number = 1; $number <= $totalPages; $number++) {
        $query = http_build_query(['search' => $search, 'page' => $number]);
        echo $number === $page
            ? '<strong aria-current="page">' . $number . '</strong>'
            : '<a href="?' . e($query) . '">' . $number . '</a>';
    }
    echo "</footer>";
}
echo "</section></main>";

?>

<script>
    let searchTimer;

    function ajaxCall(value) {
        clearTimeout(searchTimer);
        searchTimer = setTimeout(() => {
            fetch('search.php?search=' + encodeURIComponent(value), {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.text())
                .then(html => document.getElementById('txtHint').innerHTML = html)
                .catch(() => document.getElementById('txtHint').innerHTML = '<tr><td class="empty" colspan="6">Unable to search users.</td></tr>');
        }, 150);
    }
</script>