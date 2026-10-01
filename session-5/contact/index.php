<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
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
            font-size: 32px;
        }

        p {
            margin: 0 0 20px;
            color: #6b7280;
        }

        .field {
            margin-bottom: 16px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
        }

        input,
        textarea {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            font: inherit;
            outline: none;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        input:focus,
        textarea:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
        }

        textarea {
            resize: vertical;
            min-height: 140px;
        }

        .error {
            display: none;
            margin-top: 6px;
            color: #dc2626;
            font-size: 14px;
        }

        .actions {
            margin-top: 20px;
        }

        button {
            width: 100%;
            padding: 12px 16px;
            border: 0;
            border-radius: 10px;
            background: #2563eb;
            color: #fff;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
        }

        button:hover {
            background: #1d4ed8;
        }

        input.invalid,
        textarea.invalid {
            border-color: #dc2626;
        }

        input.invalid+.error,
        textarea.invalid+.error {
            display: block;
        }
    </style>
</head>

<body>
    <div class="page">
        <div class="card">
            <h1>Contact Us</h1>
            <p>Send us a message and we will get back to you.</p>

            <form action="welcome.php" method="post" id="contactForm" novalidate>
                <div class="field">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter your name" required minlength="3">
                    <!-- <div class="error">Please enter at least 3 characters.</div> -->
                </div>

                <div class="field">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                    <!-- <div class="error">Please enter a valid email address.</div> -->
                </div>

                <div class="field">
                    <label for="subject">Subject</label>
                    <input type="text" id="subject" name="subject" placeholder="Enter subject" required minlength="4">
                    <!-- <div class="error">Please enter at least 4 characters.</div> -->
                </div>

                <div class="field">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" placeholder="Write your message" required minlength="10"></textarea>
                    <!-- <div class="error">Please enter at least 10 characters.</div> -->
                </div>

                <div class="actions">
                    <button type="submit">Send Message</button>
                </div>
            </form>
            <?php include 'footer.php'; ?>
        </div>
    </div>

    <!-- <script>
        const form = document.getElementById('contactForm');
        const fields = ['name', 'email', 'subject', 'message'];

        function validateField(field) {
            const value = field.value.trim();
            let valid = true;

            if (field.type === 'email') {
                valid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);
            } else if (field.name === 'name') {
                valid = value.length >= 3;
            } else if (field.name === 'subject') {
                valid = value.length >= 4;
            } else if (field.name === 'message') {
                valid = value.length >= 10;
            } else {
                valid = value.length > 0;
            }

            field.classList.toggle('invalid', !valid);
            return valid;
        }

        fields.forEach((id) => {
            const field = document.getElementById(id);
            field.addEventListener('blur', () => validateField(field));
            field.addEventListener('input', () => {
                if (field.classList.contains('invalid')) {
                    validateField(field);
                }
            });
        });

        form.addEventListener('submit', (event) => {
            const isValid = fields
                .map((id) => document.getElementById(id))
                .every((field) => validateField(field));

            if (!isValid) {
                event.preventDefault();
            }
        });
    </script>  -->
</body>

</html>