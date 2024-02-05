<?php

namespace Mypackage\Greeting;

class Greet
{
    public function greet(String $name)
    {
        return 'Hello ' . $name . '! Welcome to MyPackage.com';
    }
}