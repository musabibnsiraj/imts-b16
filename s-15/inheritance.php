
<?php

// Parent class
class Fruit
{

    const CATEGORY = "Fruit";

    public $name;
    public $color;

    public function __construct($name, $color)
    {
        $this->name = $name;
        $this->color = $color;
    }

    public function intro()
    {
        echo "The fruit is $this->name and the color is $this->color.<br>";
    }

    protected function getColor()
    {
        return $this->color;
    }

    protected function alertMsg()
    {
        return $this->color;
    }

    final public function getLog()
    {
        return $this->name . " is a " . self::CATEGORY . ".";
    }
}

// Strawberry is inherited from Fruit
class Strawberry extends Fruit
{
    public function message()
    {
        echo "Am I a fruit or a berry? ";
        echo "The color is " . $this->getColor() . ".<br>";
        echo "Alert: " . $this->alertMsg() . "<br>";
        echo self::CATEGORY . "<br>";
    }

    //overriding the alertMsg() method from the parent class
    public function alertMsg()
    {
        return $this->name;
    }

    //overriding the getLog() method from the parent class
    //   public function getLog() {
    //     return "This is a strawberry.";
    //   }
}


$strawberry = new Strawberry("Strawberry", "red");
$strawberry->intro();
$strawberry->message();

$strawberry->alertMsg();


// $strawberry->getColor(); // This will cause an error because getColor() is protected and cannot be accessed from outside the class.
echo  "<br><br><br><br>";
echo Strawberry::CATEGORY;
