<?php
class Car
{
    // Properties
    public $make;
    public $model;
    public $year;

    // methods
    public function getCarInfo()
    {
        echo "{$this->year} | {$this->make} | {$this->model}";
    }

    public function setCarInfo($make, $model, $year)
    {
        $this->make = $make;
        $this->model = $model;
        $this->year = $year;
    }
}

class Fruit
{
    // Properties
    public $name;
    public $color;
    public $taste;

    // methods
    public function getFruitInfo()
    {
        echo "{$this->name} | {$this->color} | {$this->taste}";
    }

    public function setFruitInfo($name, $color, $taste = "Spicy")
    {
        $this->name = $name;
        $this->color = $color;
        $this->taste = $taste;
    }
}

echo "<h2>Fruit Class</h2>";

$apple = new Fruit();
$apple->setFruitInfo("Apple", "Red");

$apple->getFruitInfo(); // Output: Apple | Red | Spicy
echo "<br>";

$banana = new Fruit();
$banana->setFruitInfo("Banana", "Yellow", "Sweet");
$banana->getFruitInfo(); // Output: Banana | Yellow | Sweet

echo "<br>";
echo "<h2>Car Class</h2>";

$benz = new Car();
$benz->setCarInfo("Mercedes-Benz", "C-Class", 2022);
$benz->getCarInfo(); // Output: 2022 | Mercedes-Benz | C-Class

echo "<br>";

$bmw = new Car();
$bmw->setCarInfo("BMW", "3 Series", 2021);
$bmw->getCarInfo(); // Output: 2021 | BMW | 3 Series

echo "<br><br>";
echo "<h2>Instance of</h2>";

if ($apple instanceof Fruit) {
    echo "<br>Apple is an instance of Fruit class";
}

if ($benz instanceof Car) {
    echo "<br>BenZ is an instance of Car class";
}


