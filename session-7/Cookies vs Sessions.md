# Cookies vs Sessions

## Where they're stored

| | **Cookie** | **Session** |
|---|---|---|
| Storage location | **Client** (user's browser) | **Server** (file, database, Redis, memcached) |
| What the browser holds | The actual data | Only a **session ID** (in a cookie, usually `PHPSESSID`) |
| Size limit | ~4 KB per cookie | Limited by server memory/disk |
| Security | Readable/editable by the user | Data is hidden from the user |
| Lifetime | Set by `expires` (can persist for days/years) | Ends when the browser closes or after server timeout (`gc_maxlifetime`, default 24 min) |

**Key point:** a session still uses a cookie, but only to carry the ID. The real data lives on the server.

In PHP the default session storage is a file on the server, at the path set by `session.save_path` (e.g. `/var/lib/php/sessions/sess_abc123`).

---

## PHP examples

### Cookie

```php
<?php
// Set: name, value, options
setcookie('theme', 'dark', [
    'expires'  => time() + (86400 * 30), // 30 days
    'path'     => '/',
    'secure'   => true,   // HTTPS only
    'httponly' => true,   // JS cannot read it
    'samesite' => 'Lax',
]);

// Read (available on the NEXT request)
$theme = $_COOKIE['theme'] ?? 'light';

// Delete
setcookie('theme', '', time() - 3600, '/');
```

### Session

```php
<?php
session_start(); // must be called before any output

// Login
$_SESSION['user_id'] = 42;
$_SESSION['role']    = 'admin';

// Read on any other page
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: /login.php');
    exit;
}

// Logout
session_start();
$_SESSION = [];
session_destroy();
```

### Secure login flow (both together)

```php
<?php
session_start();

if (password_verify($password, $user['password_hash'])) {
    session_regenerate_id(true); // prevent session fixation
    $_SESSION['user_id'] = $user['id'];

    // "Remember me": store a random token, NOT the user ID or password
    if (!empty($_POST['remember'])) {
        $token = bin2hex(random_bytes(32));
        // save hash('sha256', $token) in DB against the user
        setcookie('remember_token', $token, [
            'expires'  => time() + (86400 * 30),
            'path'     => '/',
            'secure'   => true,
            'httponly' => true,
            'samesite' => 'Strict',
        ]);
    }
}
```

---

## Real-world usage

**Use cookies for:**
- Remember-me login tokens
- Theme, language, or UI preferences
- Cart ID for guest users
- Analytics/tracking IDs
- "Don't show this banner again" flags

**Use sessions for:**
- Logged-in user identity (`user_id`, `role`)
- CSRF tokens
- Flash messages (e.g. "Saved successfully")
- Multi-step form data (checkout, wizards)
- Anything sensitive that users must not tamper with

---

## Rules of thumb

1. **Never store sensitive data in cookies** (passwords, roles, prices). Users can edit them.
2. **Always set `httponly`, `secure`, and `samesite`** on cookies.
3. **Call `session_regenerate_id(true)`** after login.
4. **Sessions don't scale across multiple servers by default.** Use Redis or a database as the session store (in Laravel: `SESSION_DRIVER=redis` or `database`).
5. In Laravel, `session()` and `cookie()` helpers wrap all this, and cookie values are encrypted automatically.