<?php include 'conex.php';

$id = $_GET['id'] ?? null;

if ($id === null) {
    die("Invalid user ID");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = $_POST['firstname'] ?? '';
    $lastname = $_POST['lastname'] ?? '';
    $email = $_POST['email'] ?? '';

    $stmt = $myDB->prepare("UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email WHERE id = :id");
    $stmt->execute([
        'firstname' => $firstname,
        'lastname' => $lastname,
        'email' => $email,
        'id' => $id
    ]);

    $successMessage = "User updated successfully.";
}


$stmt = $myDB->prepare("SELECT * FROM users WHERE id = :id");
$stmt->execute(['id' => $id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);


if ($user === false) {
    die("User not found");
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #eff6ff, #f8fafc 55%, #eef2ff);
            color: #1f2937;
        }
        .card {
            width: 100%;
            max-width: 520px;
            padding: 36px;
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 18px;
            box-shadow: 0 20px 45px rgba(15, 23, 42, .10);
        }
        h1 { margin: 0 0 8px; font-size: 28px; color: #0f172a; }
        .subtitle { margin: 0 0 24px; color: #64748b; }
        .success {
            margin-bottom: 22px;
            padding: 12px 14px;
            border: 1px solid #bbf7d0;
            border-radius: 8px;
            background: #f0fdf4;
            color: #166534;
            font-size: 14px;
        }
        .field { margin-bottom: 18px; }
        label { display: block; margin-bottom: 7px; font-weight: 600; }
        input {
            width: 100%;
            padding: 11px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 15px;
            transition: border-color .2s, box-shadow .2s;
        }
        input:focus { outline: none; border-color: #2563eb; box-shadow: 0 0 0 3px rgba(37, 99, 235, .15); }
        .actions { display: flex; gap: 12px; margin-top: 26px; }
        button, .cancel {
            flex: 1;
            padding: 12px;
            border: 0;
            border-radius: 6px;
            text-align: center;
            text-decoration: none;
            font-size: 15px;
            cursor: pointer;
        }
        button { background: #2563eb; color: #fff; }
        button:hover { background: #1d4ed8; }
        .cancel { background: #e2e8f0; color: #334155; }
    </style>
</head>
<body>
    <main class="card">
        <h1>Edit User</h1>
        <p class="subtitle">Update the user's information below.</p>

        <?php if (!empty($successMessage)): ?>
            <div class="success" role="status"><?= htmlspecialchars($successMessage, ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>

        <form method="post">
            <input type="hidden" name="id" value="<?= htmlspecialchars((string) $id, ENT_QUOTES, 'UTF-8') ?>">

            <div class="field">
                <label for="firstname">First Name</label>
                <input type="text" id="firstname" name="firstname" value="<?= htmlspecialchars($user['firstname'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
            </div>

            <div class="field">
                <label for="lastname">Last Name</label>
                <input type="text" id="lastname" name="lastname" value="<?= htmlspecialchars($user['lastname'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
            </div>

            <div class="field">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
            </div>

            <div class="actions">
                <a class="cancel" href="index.php">Cancel</a>
                <button type="submit">Save Changes</button>
            </div>
        </form>
    </main>
</body>
</html>