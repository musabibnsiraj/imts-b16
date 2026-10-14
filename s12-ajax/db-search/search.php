<?php

require 'conex.php';

if (!$myDB instanceof PDO) {
    http_response_code(500);
    exit('Database connection is unavailable.');
}

function escape(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function searchUsers(PDO $db, string $search): array
{
    $term = "%{$search}%";
    $statement = $db->prepare(
        'SELECT id, firstname, lastname, email, reg_date
         FROM users
         WHERE firstname LIKE :firstname
            OR lastname LIKE :lastname
            OR email LIKE :email
         ORDER BY id DESC'
    );
    $statement->execute([
        'firstname' => $term,
        'lastname' => $term,
        'email' => $term,
    ]);

    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
        $id = filter_var($_POST['delete_id'], FILTER_VALIDATE_INT);

        if ($id === false || $id < 1) {
            http_response_code(400);
            exit('Invalid user ID.');
        }

        $statement = $myDB->prepare('DELETE FROM users WHERE id = :id');
        $statement->execute(['id' => $id]);
        header('Location: index.php');
        exit;
    }
    
    $search = trim((string) ($_GET['search'] ?? ''));
    $users = searchUsers($myDB, $search);
} catch (PDOException $exception) {
    http_response_code(500);
    exit('Unable to search users.');
}

if (!$users) {
    echo '<tr><td class="empty" colspan="6">No users found.</td></tr>';
    exit;
}

foreach ($users as $user) {
    $id = (int) $user['id'];
    echo '<tr>';
    echo '<td>' . $id . '</td>';
    echo '<td>' . escape((string) $user['firstname']) . '</td>';
    echo '<td>' . escape((string) $user['lastname']) . '</td>';
    echo '<td>' . escape((string) $user['email']) . '</td>';
    echo '<td>' . escape((string) $user['reg_date']) . '</td>';
    echo '<td><div class="actions">';
    echo '<a class="edit-link" href="edit.php?id=' . $id . '">Edit</a>';
    echo '<form method="post" action="search.php" onsubmit="return confirm(\'Are you sure you want to delete this user?\');">';
    echo '<input type="hidden" name="delete_id" value="' . $id . '">';
    echo '<button class="delete-button" type="submit">Delete</button>';
    echo '</form></div></td>';
    echo '</tr>';
}
