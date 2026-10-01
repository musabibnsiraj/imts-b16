<!DOCTYPE html>
<html>

<body>

    <?php
    $x = 'Musab'; //or 'Admin'
    $y = 5; // Integer variable
    //
    // Ternary operator: condition ? value_if_true : value_if_false
    $result = ($y >= 10) ? "The value is at least 10" : "The value is less than 10";
    echo $result;

    // Null coalescing operator: $value ?? 'default'
    $username = $x ?? 'Guest'; // If 'user' parameter is not set, default to 'Guest'
    echo "<br>Welcome, " . $username;
    //
    echo "<br>";
    echo "<br>";

    if ($username === 'Guest') {
        echo "You are not logged in.";
    } else {
        echo "You are logged in.";
    }

    echo "<br>";
    echo "<br>";

    $cut = 134;
    $mark = 100;

    if ($mark > $cut) {
        echo "scholarship pass.";
    } else {
        echo "scholarship fail";
    }
    echo "<br>";
    echo "<br>";

    $mark = 70;

    if ($mark < 35) {
        echo "Result: Weak";
    } elseif ($mark < 45) {
        echo "Result: Average";
    } else if ($mark < 60) {
        echo "Result: Good";
    } else if ($mark < 80) {
        echo "Result: Excellent";
    } else {
        echo "Result: Outstanding";
    }

    echo "<br>";
    echo "<br>";

    // Real-world example: approve a product discount only when the order
    // total meets the minimum requirement and the customer is a member.
    $orderTotal = 200;
    $minForDiscount = 150;
    $disLimit = 500;
    $isMember = true;

    if ($orderTotal >= $minForDiscount and $orderTotal <= $disLimit && $isMember) {
        echo "Discount applied: 10% off your order.";
    } else {
        echo "No discount available for this order.";
    }

    echo "<br>";
    echo "<br>";

    // Sample for `or` operator
    $isAdmin = true;
    $isOwner = false;

    if ($isAdmin or $isOwner) {
        echo "Access granted using.";
    } else {
        echo "Access denied.";
    }

    echo "<br>";
    echo "<br>";

    // Sample for `xor` operator
    $isAdmin = true;

    // Sample for `not` operator
    if (!$isAdmin) {
        echo "Access denied because the user is not an admin.";
    } else {
        echo "Admin access granted.";
    }

    echo "<br>";
    echo "<br>";

    $a = 13;

    if ($a > 10) {
        echo "Above 10";
        if ($a > 20) {
            echo " and also above 20";
        } else {
            echo " but not above 20";
        }
    }

    echo "<br>";
    echo "<br>";

    $marks = 45;

    // Combining cases: multiple case labels share one code block.
    switch ($marks) {
        case 45:
        case 50:
            echo "Result: Good";
            break;
        case 60:
        case 70:
            echo "Result: Excellent";
            break;
        case 80:
        case 90:
        case 100:
            echo "Result: Outstanding";
            break;
        default:
            echo "Result: Average or Weak";
    }

    echo "<br>";
    echo "<br>";

    // Real-world try-catch example: validate and process an order payment.
    $orderTotal = 250;
    $paymentAmount = 0;

    try {
        if ($paymentAmount <= 0) {
            throw new Exception("Payment amount must be greater than zero.");
        }

        if ($paymentAmount < $orderTotal) {
            throw new Exception("Payment failed: insufficient amount.");
        }

        echo "Payment successful. Order confirmed.";
    } catch (Exception $e) {
        echo "Payment error: " . $e->getMessage();
    }

    echo "<br>";
    echo "<br>";

    $marks = 45;

    $result = match (true) {
        $marks >= 80 => "Result: Outstanding",
        $marks >= 60 => "Result: Excellent",
        $marks >= 45 => "Result: Good",
        $marks >= 35 => "Result: Average",
        default => "Result: Weak",
    };

    echo $result;

    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";

    $i = 1; // Initialize counter
    while ($i < 20 ) { // Check condition
        echo $i . '<br>'; // Execute code
        $i++; // Increment counter 3 = 2 + 1
    }

    echo "<br>";
    echo "<br>";
    echo "<br>";


    // Real-world example: process items in a shopping cart.
    $cartItems = [
        "Laptop",
        "Wireless mouse",
        "Keyboard"
    ];
    $i = 0;

    while ($i < count($cartItems)) {
        echo "Cart item " . ($i + 1) . ": " . $cartItems[$i] . "<br>";
        $i++;
    }

    ?>

</body>

</html>