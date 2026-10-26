<?php

namespace MyNamespace;

class MyClass
{
    public function myMethod()
    {
        echo "Hello from MyNamespace\\MyClass!";
    }
}

class OurClass
{
    public function myMethod()
    {
        echo "Hello from MyNamespace\\MyClass!";
    }
}



$obj = new \MyNamespace\MyClass();
$obj2 = new \MyNamespace\OurClass();