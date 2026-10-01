<?php
/**
 * PHP Error Handling Hierarchy:
 * 
 *                  Throwable (Interface)
 *                 /                     \
 *         Exception (Class)             Error (Class)
 *         - RuntimeException            - TypeError
 *         - InvalidArgumentException    - DivisionByZeroError
 *         - Custom Exceptions           - ParseError, etc.
 */

echo "<h2>1. Catching an Exception</h2>";
// Exceptions are usually manually thrown by application/business logic
function withdrawMoney(float $balance, float $amount): float
{
    if ($amount > $balance) {
        throw new Exception("Insufficient balance! You tried to withdraw $amount from $balance.");
    }
    return $balance - $amount;
}

try {
    echo "Remaining: " . withdrawMoney(100, 250);
} catch (Exception $e) {
    echo "Caught Exception: " . $e->getMessage() . "<br>";
} finally {
    echo "Withdrawal attempt completed.<br>";
}

echo "<hr>";

echo "<h2>2. Catching an Error (PHP Engine Error)</h2>";
// Errors are internal PHP engine errors (e.g., TypeError, DivisionByZeroError)
function divide(int $x, int $y): int
{
    return intdiv($x, $y); // Throws DivisionByZeroError when $y is 0
}

try {
    echo divide(10, 0);
} catch (Error $e) {
    // You can also catch DivisionByZeroError specifically
    echo "Caught Error: " . $e->getMessage() . " (" . get_class($e) . ")<br>";
} finally {
    echo "Division attempt completed.<br>";
}

echo "<hr>";

echo "<h2>3. Catching Throwable (Catches BOTH Exception and Error)</h2>";
// Throwable is the top-level interface. Use it to catch ANY problem safely.
function riskyOperation($mode)
{
    if ($mode === 'exception') {
        throw new Exception("Custom user exception occurred!");
    } else {
        // Will cause a TypeError because string is passed to an int parameter
        return strlen($mode) + $mode(); // Invoking string as a function -> TypeError
    }
}

foreach (['exception', 'error'] as $case) {
    try {
        echo "<br><strong>Testing case: $case</strong><br>";
        riskyOperation($case);
    } catch (Throwable $t) {
        echo "Caught via Throwable: " . $t->getMessage() . " [Type: " . get_class($t) . "]<br>";
    }
}
