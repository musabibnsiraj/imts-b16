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
        :root { --primary: #2563eb; --text: #172033; --muted: #64748b; }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, sans-serif;
            color: var(--text);
            background: linear-gradient(135deg, #eff6ff, #f8fafc);
        }
        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 7%;
            background: #fff;
            border-bottom: 1px solid #e5e7eb;
        }
        .brand { color: var(--primary); font-size: 21px; font-weight: 700; }
        .nav-link { color: #475569; text-decoration: none; font-weight: 600; }
        .container { width: min(100% - 32px, 560px); margin: 55px auto; }
        .card {
            padding: 36px;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(15, 23, 42, .08);
        }
        h1 { margin: 0 0 8px; font-size: 30px; }
        .subtitle { margin: 0 0 28px; color: var(--muted); }
        .success {
            margin-bottom: 20px;
            padding: 13px 15px;
            border: 0;
            border-radius: 8px;
            background: #ecfdf5;
            color: #047857;
        }
        .field { margin-bottom: 0; }
        label { display: block; margin: 17px 0 7px; font-size: 14px; font-weight: 700; }
        input {
            width: 100%;
            padding: 13px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 15px;
        }
        input:focus { outline: 3px solid #dbeafe; border-color: var(--primary); }
        .actions { display: flex; gap: 12px; margin-top: 28px; }
        button, .cancel {
            flex: 1;
            padding: 13px 16px;
            border: 0;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 700;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
        }
        button { color: #fff; background: var(--primary); }
        button:hover { background: #1d4ed8; }
        .cancel { color: #475569; background: #f1f5f9; }
        @media (max-width: 480px) { .card { padding: 24px; } .actions { flex-direction: column-reverse; } }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="brand">User Management</div>
        <a class="nav-link" href="index.php">Search Users</a>
    </nav>

    <main class="container">
        <section class="card">
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
        </section>
    </main>
</body>
</html>