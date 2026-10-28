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
        echo "Hello from MyNamespace\\OurClass!";
    }
}

$obj = new \MyNamespace\MyClass();
$obj2 = new \MyNamespace\OurClass();

$obj->myMethod();
$obj2->myMethod();

namespace MyNamespace\SubNamespace;

class SubClass
{
    public function myMethod()
    {
        echo "Hello from MyNamespace\\SubNamespace\\SubClass!";
    }
}

namespace MyNamespace;

use MyNamespace\SubNamespace\SubClass as NewSubClass;

$obj3 = new NewSubClass();
$obj3->myMethod();