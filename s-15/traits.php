<?php
trait message1
{
    public function msg1()
    {
        echo "PHP OOP is fun! ";
    }
    public function msg2()
    {
        echo "Traits reduce code duplication! ";
    }
    public function msg3()
    {
        echo "Hello World!";
    }
}

trait alert
{
    public function alert1()
    {
        echo "alert1 PHP OOP is fun! ";
    }
    public function alert2()
    {
        echo "Traits reduce code duplication! ";
    }
    public function alert3()
    {
        echo "Hello World!";
    }
}

class Welcome
{
    use message1, alert;
}

class Welcome2
{
    use message1;
}

$obj = new Welcome();
$obj->msg1();
$obj->alert1();
echo "<br>";

$obj2 = new Welcome2();
$obj2->msg1();
$obj2->msg2();
$obj2->msg3();
