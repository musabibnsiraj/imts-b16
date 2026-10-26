<?php

interface EVCar
{
    public function sound();
    public function price();
}


class BMW implements EVCar
{
    public function sound()
    {
        echo "BMW makes a vroom vroom sound.<br>";
    }

    public function price()
    {
        echo "The price of a BMW is $50,000.<br>";
    }
}


$car = new BMW();
$car->sound();
$car->price();