<?php

class Student
{
    public $name;
    private $age;
    protected $grade;

    public function __construct($name, $age, $grade)
    {
        $this->name = $name;
        $this->age = $age;
        $this->grade = $grade;
    }

    private function getAge()
    {
        $this->age = 33; // Accessible
        echo $this->age . "<br>";
    }

    protected function getGrade()
    {
        echo $this->grade . "<br>";
    }

    public function getName()
    {
        echo $this->name . "<br>";
        $this->getGrade();
    }
}

$student = new Student("John", 20, "A");

$student->name = "Benz"; // Accessible
$student->getName(); // Accessible

// $student->age = 33; //Not Accessible
// $student->getAge(); //Not Accessible

// $student->getGrade(); //Not Accessible


class Fruit {
  protected $name;

  public function setType($name) {
    $this->name = $name;
  }
}

$fruit = new Fruit();
// $fruit->name = "Apple"; // Error: Cannot access protected property


class Apple extends Fruit {
  public function getType() {
    echo "Name: " . $this->name . ".";
  }
}

$apple = new Apple();
$apple->setType("Apple");

// $apple->name = "Banana"; // Not Accessible

$apple->getType(); // Accessible

class Fruit2 {
  private $name;

  public function get_details() {
    echo "Name: " . $this->name . ".";
  }
}

$apple = new Fruit2();
// $apple->name = "Apple"; // Error: Cannot access private property