<?php

abstract class Fruit
{
    const CATEGORY = "Fruit";

    public $name;
    public $color;

    public function __construct($name, $color)
    {
        $this->name = $name;
        $this->color = $color;
    }

    abstract public function intro();

    // Abstract method with an argument
    abstract public function msg($msg, $msg2);

    // Abstract method with an argument
    abstract public function user($name);
}

class Mango extends Fruit
{
    public function intro()
    {
        echo "The fruit is $this->name and the color is $this->color.<br>";
    }

    public function msg($msg, $msg2)
    {
        echo "I am a mango and I am a " . self::CATEGORY . ".<br>";
        echo "Message: $msg<br>";
        echo "Message 2: $msg2<br>";
    }

    public function user($name,$age = 0, $gender = "male")
    {
        echo "User: $name<br>";
        if ($age > 0) {
            echo "Age: $age<br>";
        }
        echo "Gender: $gender<br>";
    }
}

$mango = new Mango("Mango", "Yellow");
$mango->intro();
$mango->msg("Hello", "World");
$mango->user("Alice", 25, "female");
