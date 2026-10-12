<?php include 'conex.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = $_POST['firstname'] ?? '';
    $lastname = $_POST['lastname'] ?? '';
    $email = $_POST['email'] ?? '';

    $stmt = $myDB->prepare("INSERT INTO users (firstname, lastname, email) VALUES (:firstname, :lastname, :email)");
    $stmt->execute([
        'firstname' => $firstname,
        'lastname' => $lastname,
        'email' => $email
    ]);

    $success = 'User created successfully.';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
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
        .intro { margin: 0 0 28px; color: var(--muted); }
        .success { margin-bottom: 20px; padding: 13px 15px; color: #047857; background: #ecfdf5; border-radius: 8px; }
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
        button, .back {
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
        .back { color: #475569; background: #f1f5f9; }
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
            <h1>Create User</h1>
            <p class="intro">Add a new user to the directory.</p>

            <?php if (!empty($success)): ?>
                <div class="success"><?= htmlspecialchars($success) ?></div>
            <?php endif; ?>

            <form method="post">
                <label for="firstname">First Name</label>
                <input type="text" id="firstname" name="firstname" required>

                <label for="lastname">Last Name</label>
                <input type="text" id="lastname" name="lastname" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>

                <div class="actions">
                    <a class="back" href="index.php">Back to Search</a>
                    <button type="submit">Create User</button>
                </div>
            </form>
        </section>
    </main>
</body>
</html>