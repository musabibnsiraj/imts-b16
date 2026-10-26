<?php
class Greeting
{




    // static method
    public static function welcome()
    {
        echo "Assalamualaikum, PHP OOP!<br>";
    }

    public function salam()
    {
        echo "Salam, PHP OOP!<br>";
    }
}

// Call static method directly
Greeting::welcome();

// Greeting::salam(); // This will cause an error because salam() is not a static method.

// Create an instance of the class to call the non-static method
$obj = new Greeting();
$obj->salam(); // This will work because salam() is a non-static method


//

class domain
{
    protected static function getWebsiteName()
    {
        return "W3Schools.com";
    }
}

class domainW3 extends domain
{

    public $websiteName;

    public function __construct()
    {
        $this->websiteName = parent::getWebsiteName();
    }
}

$domainW3 = new domainW3;
echo $domainW3->websiteName;


//static properties

class pi
{

    public static $value = 3.14159;

    public function staticValue()
    {
        return self::$value;
    }
}

$pi = new pi();
echo $pi->staticValue();

// 

class pi2
{
    public static $value = 3.14159;
}

class x extends pi2
{
    public function xStatic()
    {
        return parent::$value;
    }
}

// Get value of static property directly via child class
echo x::$value;

// or get value of static property via xStatic() method
$x = new x();
echo $x->xStatic();
