<?php
namespace App;

interface ControllerInterface{

    public function index();
}
/*
In object-oriented programming, an interface is a concept that defines a behavioral contract that a class must follow. 
An interface in OOP contains only method signatures (methods without implementation), but does not provide a concrete implementation. 
It simply defines the structure that classes that implement that interface must follow.
Abstract classes:
-- can only contain method signatures (methods without implementation).
-- cannot have properties with default values ​​(until PHP 8.0, where properties can be declared, but without default values).
-- a class can implement multiple interfaces.
-- provide a form of contract where classes that implement an interface must provide an implementation for all methods declared in the interface.
*/