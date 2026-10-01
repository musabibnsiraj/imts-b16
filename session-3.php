<!DOCTYPE html>
<html>

<body>

    <?php
   
    function addNumbers(float $a, float $b): float
    {
        return $a + $b;
    }
    echo addNumbers(1.2, 5.2);

    echo "<br>";
    echo "<br>";

    function sumMyNumbers(...$x)
    {
        $n = 0;
        $len = count($x);
        for ($i = 0; $i < $len; $i++) {
            $n += $x[$i];
        }
        return $n;
    }

    echo sumMyNumbers(5, 2, 6);

    echo "<br>";
    echo "<br>";

    function myFamily($lastname, ...$firstname)
    {
        $txt = "";
        $len = count($firstname);
        for ($i = 0; $i < $len; $i++) {
            $txt = $txt . "Hi, $firstname[$i] $lastname.<br>";
        }
        return $txt;
    }

    $a = myFamily("Ahmed", "Musab", "Mishary", "Muawwidh");
    echo $a;

    echo "<br>";
    echo "<br>";
    function sum(int $a, int $b)
    {
        return $a + $b;
    }

    echo sum(5, 10);

    echo "<br>";
    echo "<br>";


    function welcomeCard(string $name = "Guest", int $age = 0)
    {
        echo "Assalamu alaikum, $name! You are $age years old. <br>";
    }

    welcomeCard('Mishary', 25);
    welcomeCard('Musab', 30);
    welcomeCard('Ahmed', 35);

    welcomeCard();

    echo "<br>";
    echo "<br>";


    $i = 0; // Initialize counter
    while ($i < 12) { // Check condition
        $i++; // Increment counter 
        if ($i == 10) {
            break; // Skip the rest of the loop when $i is 10
        }
        echo $i . '<br>'; // Execute code

    }

    echo "<br>";
    echo "<br>";

    $i = 0; // Initialize counter
    while ($i < 12) { // Check condition
        $i++; // Increment counter 
        if ($i == 10) {
            continue; // Skip the rest of the loop when $i is 10
        }
        echo $i . '<br>'; // Execute code

    }

    echo "<br>";
    echo "<br>";
    echo "<br>";

    $i = 1;

    do {
        echo $i;
        $i++;
    } while ($i < 6);

    echo "<br>";
    echo "<br>";


    for ($x = 0; $x < 10; $x++) {
        echo "The number is: $x <br>";
    }
    echo "<br>";
    echo "<br>";

    for ($x = 10; $x >= 0; $x--) {
        echo "The number is: $x <br>";
    }

    echo "<br>";
    echo "<br>";

    $colors = array("red", "green", "blue", "yellow");

    foreach ($colors as $color) {
        echo "$color <br>";
    }

    echo "<br>";
    echo "<br>";

    $members = array("Peter" => "35", "Ben" => "37");

    foreach ($members as $name => $age) {
        echo "$name is $age years old.<br>";
    }


    class Car
    {
        public $color;
        public $model;
        public function __construct($color, $model)
        {
            $this->color = $color;
            $this->model = $model;
        }
    }

    $myCar = new Car("red", "Volvo");

    foreach ($myCar as $x => $y) {
        echo "$x: $y <br>";
    }

    echo "<br>";
    echo "<br>";


    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";

    ?>

</body>

</html>