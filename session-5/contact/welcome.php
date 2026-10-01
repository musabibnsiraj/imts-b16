<?php
$errors = [];

$name = clean($_POST['name'] ?? '');
$email = clean($_POST['email'] ?? '');
$subject = clean($_POST['subject'] ?? '');
$message = clean($_POST['message'] ?? '');


if ($name === '' || strlen($name) < 3) {
    $errors[] = 'Name must be at least 3 characters.';
}


if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Please provide a valid email address.';
}

if ($subject === '' || strlen($subject) < 4) {
    $errors[] = 'Subject must be at least 4 characters.';
}

if ($message === '' || strlen($message) < 10) {
    $errors[] = 'Message must be at least 10 characters.';
}

// Helper function to escape HTML special characters
function escape_html(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}


function clean(mixed $data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


?>
<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Submission</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f7fb;
            color: #1f2937;
        }

        .page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .card {
            width: 100%;
            max-width: 560px;
            background: #ffffff;
            border-radius: 16px;
            padding: 28px;
            box-shadow: 0 12px 40px rgba(15, 23, 42, 0.12);
        }

        h1 {
            margin: 0 0 8px;
            font-size: 30px;
        }

        p {
            margin: 0 0 14px;
            line-height: 1.6;
        }

        .errors {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #b91c1c;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 18px;
        }

        .success {
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            color: #047857;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 18px;
        }

        .back {
            display: inline-block;
            margin-top: 12px;
            color: #2563eb;
            text-decoration: none;
            font-weight: 700;
        }
    </style>
</head>

<body>
    <div class="page">
        <div class="card">
            <?php if ($errors): ?>
                <h1>Validation Failed</h1>
                <div class="errors">
                    <?php foreach ($errors as $error): ?>
                        <p><?php echo escape_html($error); ?></p>
                    <?php endforeach; ?>
                </div>
                <p><strong>Name:</strong> <?php echo escape_html($name ?: 'Not provided'); ?></p>
                <p><strong>Email:</strong> <?php echo escape_html($email ?: 'Not provided'); ?></p>
                <p><strong>Subject:</strong> <?php echo escape_html($subject ?: 'Not provided'); ?></p>
                <p><strong>Message:</strong> <?php echo escape_html($message ?: 'Not provided'); ?></p>
            <?php else: ?>
                <h1>Message Received</h1>
                <div class="success">
                    Your contact form was submitted successfully.
                </div>
                <p><strong>Name:</strong> <?php echo escape_html($name); ?></p>
                <p><strong>Email:</strong> <?php echo escape_html($email); ?></p>
                <p><strong>Subject:</strong> <?php echo escape_html($subject); ?></p>
                <p><strong>Message:</strong> <?php echo nl2br(escape_html($message)); ?></p>
            <?php endif; ?>

            <a class="back" href="index.php">Back to form</a>

            <?php include 'footer.php'; ?>
        </div>


    </div>

</body>

</html>