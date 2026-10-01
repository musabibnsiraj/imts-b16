<!DOCTYPE html>
<html>

<body>

    <?php

    $str = "Visit W3Schools";
    $pattern = "/w3schools/i";
    echo preg_match($pattern, $str);

    echo "<br>";
    echo "<br>";

    $str = "The rain in SPAIN falls mainly on the plains.";
    $pattern = "/ain/i";
    echo preg_match_all($pattern, $str);

    echo "<br>";
    echo "<br>";

    $email = "student@example.com";
    $pattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
    echo preg_match($pattern, $email) ? "Valid email address" : "Invalid email address";

    echo "<br>";
    echo "<br>";


    // Another sample
    $sampleText = "apple, banana, apricot, avocado";
    $samplePattern = "/a/i";
    echo "  " . preg_match_all($samplePattern, $sampleText);

    echo "<br>";
    echo "<br>";

    $str = "Visit Microsoft!";
    $pattern = "/microsoft/i";
    echo preg_replace($pattern, "W3Schools", $str);

    echo "<br>";
    echo "<br>";

    //  sample
    $text = "The quick brown fox jumps over the lazy dog.";

    $search = "/fox/i";
    $replace = "cat";

    echo preg_replace($search, $replace, $text);

    echo "<br>";
    $search2 = "/dog/i";
    $replace2 = "lion";
    echo preg_replace($search2, $replace2, $text);

    echo "<br>";
    echo "<br>";

    $students = [
        [
            "first_name" => "Musab",
            "last_name" => "Ibn Siraj",
            "age" => 20,
            "country" => "Sri Lanka"
        ],
        [
            "first_name" => "Mishary",
            "last_name" => "Ibn Siraj",
            "age" => 18,
            "country" => "Kuwait"
        ],
        [
            "first_name" => "Mahas",
            "last_name" => "Ibn Siraj",
            "age" => 15,
            "country" => "Qatar"
        ],
        [
            "first_name" => "Mishal",
            "last_name" => "Ibn Siraj",
            "age" => 10,
            "country" => "Bahrain"
        ],
        [
            "first_name" => "Mishal",
            "last_name" => "Ibn Siraj",
            "age" => 10,
            "country" => "Bahrain"
        ]
    ];

    echo "<table border='1' cellpadding='10' cellspacing='0'>";
    echo "<tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Age</th>
            <th>Country</th>
        </tr>";

    foreach ($students as $student) {
        echo "<tr>";
        echo "<td>" . $student['first_name'] . "</td>";
        echo "<td>" . $student['last_name'] . "</td>";
        echo "<td>" . $student['age'] . "</td>";
        echo "<td>" . $student['country'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";

    echo "<br>";
    echo "<br>";

    echo $students[1]['country'];
    echo "<br>";
    echo "<br>";

    echo $students[0]['first_name'] . " " . $students[0]['last_name'] . " is " . $students[0]['age'] . " years old and lives in " . $students[0]['country'] . ".<br>";

    echo $students[1]['first_name'] . " " . $students[1]['last_name'] . " is " . $students[1]['age'] . " years old and lives in " . $students[1]['country'] . ".<br>";

    echo $students[2]['first_name'] . " " . $students[2]['last_name'] . " is " . $students[2]['age'] . " years old and lives in " . $students[2]['country'] . ".<br>";

    echo "<br>";
    echo "<br>";



    //Associative arrays are arrays that use named keys that you assign to them.

    $student = [];
    $student = [
        "first_name" => "Musab",
        "last_name" => "Ibn Siraj",
        "age" => 20,
        "country" => "Kuwait"
    ];

    $student['age'] = 30;
    $student['phone'] = "123-456-7890";

    $student += [
        "email" => "musab.ibn.siraj@example.com"
    ];

    unset($student['country']);
    ksort($student);
    echo "<pre>";
    print_r($student);
    echo "</pre>";
    echo "<br>";

    $cars = array(
        "brand" => "Ford",
        "model" => "Mustang",
        "year" => 2026
    );

    echo $cars['year'];

    echo "<br>";
    echo "<br>";

    foreach ($cars as $key => $value) {
        echo "$key: $value <br>";
    }

    echo "<br>";

    var_dump($cars);
    echo "<br>";
    echo "<br>";

    //indexed arrays are arrays with a numeric index.

    $fruits = array("Apple", "Orange", "Banana", "Mango");

    foreach ($fruits as $value) {
        echo "$value <br>";
    }

    $fruits[1] = 'Grapes';
    echo $fruits[1];

    echo "<br>";
    echo "<br>";

    var_dump($fruits);

    echo "<br>";
    echo "<br>";

    $myArr = array("Volvo", 15, ["apples", "bananas"]);

    echo count($fruits);
    echo "<br>";
    echo count($myArr);

    echo "<br>";
    echo "<br>";

    function add_five(&$value)
    {
        $value += 5;
    }

    $num = 2;
    add_five($num);
    add_five($num);
    add_five($num);

    echo $num;

    echo "<br>";
    echo "<br>";
    echo "<br>";

    function addShippingFee(float &$total, float $fee): void
    {
        $total += $fee;
    }

    $total = 120.00;
    addShippingFee($total, 15.50);
    addShippingFee($total, 8.75);

    echo "Total bill: $" . number_format($total, 2);



    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";

    ?>

</body>

</html>