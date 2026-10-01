<?php
/**
 * Cookies demo: setting, reading, and deleting cookies in PHP.
 *
 * What is a cookie?
 *   A small piece of data (name = value) that the SERVER asks the BROWSER to
 *   store. On every later request to the same site, the browser sends the
 *   cookie back automatically, so PHP can "remember" things between page loads
 *   (username, theme, language, etc.).
 *
 * How it works (the request/response cycle):
 *   1. setcookie() adds a "Set-Cookie" HTTP header to the RESPONSE.
 *   2. The browser receives the response and saves the cookie.
 *   3. On the NEXT request, the browser sends a "Cookie" header back.
 *   4. PHP reads that header and fills the $_COOKIE superglobal array.
 *
 *   => A cookie set on this page load will NOT appear in $_COOKIE until the
 *      page is loaded again (refresh the page to see the values).
 *
 * IMPORTANT: setcookie() sends an HTTP header, and headers must be sent before
 * any page content. So call setcookie() BEFORE any echo/HTML output, otherwise
 * PHP shows "Cannot modify header information - headers already sent".
 */


/* ---------------------------------------------------------------------------
 * 1. Setting a cookie: the classic (positional arguments) syntax
 * ---------------------------------------------------------------------------
 * setcookie(name, value, expires, path, domain, secure, httponly)
 */

$cookie_name  = "username";   // Key used to identify the cookie
$cookie_value = "John Doe";   // Data stored in the cookie (always a string)

// Expiry is a Unix timestamp (seconds since 1 Jan 1970).
//   time()         -> the current timestamp
//   86400          -> seconds in one day (60 * 60 * 24)
//   86400 * 30     -> 30 days
// So this cookie expires 30 days from now.
// If expires is 0 (or left out), it becomes a "session cookie" that is
// deleted when the browser is closed.
//
// Path "/" means the cookie is sent for EVERY page on the site. A path like
// "/session-7/" would limit it to pages inside that folder only.
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day


/* ---------------------------------------------------------------------------
 * 2. Setting a cookie: the modern (options array) syntax, PHP 7.3+
 * ---------------------------------------------------------------------------
 * setcookie(name, value, [options]). Easier to read, and it is the only way
 * to set the "samesite" attribute.
 */

// Set: name, value, options
setcookie('theme', 'dark', [
    // 86400 * 365 * 10 = 10 years. Cookies cannot be truly "permanent",
    // so a far-future date is the usual way to make them last a long time.
    'expires'  => time() + (86400 * 365 * 10), // 10 years (effectively unlimited)

    // Available on every page of the site.
    'path'     => '/',

    // secure = true: the browser only stores and sends this cookie over HTTPS.
    // NOTE: on a plain http:// site (for example http://imts.test on Laragon
    // without SSL) the browser will ignore this cookie completely. Set it to
    // false while testing locally over HTTP.
    'secure'   => true,   // HTTPS only

    // httponly = true: JavaScript cannot read the cookie via document.cookie.
    // This protects it from being stolen by XSS (injected script) attacks.
    // PHP can still read it normally through $_COOKIE.
    'httponly' => true,   // JS cannot read it

    // samesite controls whether the cookie is sent on requests coming from
    // OTHER websites (helps protect against CSRF attacks):
    //   'Strict' -> never sent on cross-site requests
    //   'Lax'    -> sent when the user clicks a normal link to our site,
    //               but not on cross-site forms/images/iframes (good default)
    //   'None'   -> always sent (requires 'secure' => true)
    'samesite' => 'Lax',
]);

// Same options, for a second cookie that stores the user's language.
// Set: name, value, options
setcookie('lang', 'en', [
    'expires'  => time() + (86400 * 365 * 10), // 10 years (effectively unlimited)
    'path'     => '/',
    'secure'   => true,   // HTTPS only
    'httponly' => true,   // JS cannot read it
    'samesite' => 'Lax',
]);


/* ---------------------------------------------------------------------------
 * 3. Checking whether a cookie exists
 * ---------------------------------------------------------------------------
 * $_COOKIE is an associative array: ['cookie_name' => 'cookie_value', ...].
 * isset() checks that the key exists, so we never read a missing key
 * (which would cause an "Undefined array key" warning).
 *
 * First visit: "not set", because the browser has not sent it back yet.
 * After a refresh: "is set" and the value is shown.
 */
if (isset($_COOKIE[$cookie_name])) {
    echo "Cookie '" . $cookie_name . "' is set!<br>";
    echo "Value is: " . $_COOKIE[$cookie_name];
} else {
    echo "Cookie named '" . $cookie_name . "' is not set!";
}


/* ---------------------------------------------------------------------------
 * 4. Deleting a cookie
 * ---------------------------------------------------------------------------
 * PHP has no "deletecookie()" function. To delete a cookie, set it again with:
 *   - an empty value, and
 *   - an expiry time in the PAST (time() - 3600 = one hour ago).
 * The browser sees that it has already expired and removes it.
 *
 * The path (and domain) must MATCH the ones used when the cookie was set,
 * otherwise the browser treats it as a different cookie and nothing is deleted.
 *
 * NOTE: 'theme' was set earlier on this same page, so the response now carries
 * two Set-Cookie headers for 'theme'. The browser applies them in order, so
 * this later "delete" wins and 'theme' ends up removed. Comment out this line
 * to keep the 'theme' cookie.
 *
 * NOTE: This line calls setcookie() AFTER the echo statements above. It only
 * works if PHP output buffering is on (it is on by default in Laragon);
 * otherwise you get a "headers already sent" warning.
 */
// Delete
setcookie('theme', '', time() - 3600, '/');


/* ---------------------------------------------------------------------------
 * 5. Reading cookies with a default value
 * ---------------------------------------------------------------------------
 * The null coalescing operator (??) returns the left side if it exists and
 * is not null, otherwise the right side. It is short for:
 *   $theme = isset($_COOKIE['theme']) ? $_COOKIE['theme'] : 'light';
 *
 * Use it to give a sensible default when the cookie has not been set yet,
 * has expired, or was deleted.
 */

// Read (available on the NEXT request)
// Falls back to 'light' if there is no 'theme' cookie.
$theme = $_COOKIE['theme'] ?? 'light';

// Read (available on the NEXT request)
// Falls back to 'ta' (Tamil) if there is no 'lang' cookie.
$lang = $_COOKIE['lang'] ?? 'ta';


/* ---------------------------------------------------------------------------
 * 6. Output the values
 * ---------------------------------------------------------------------------
 * Cookie values come from the browser, so the user can edit them.
 * In real projects, escape them before printing, e.g.
 *   echo htmlspecialchars($theme);
 * so a tampered cookie cannot inject HTML/JavaScript into the page.
 */
echo "<br>";
echo "<br>";
echo "theme<br>";
echo $theme;

echo "<br>";
echo "<br>";
echo "lang <br>";
echo $lang;
