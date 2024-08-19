<?php

namespace App;

abstract class AbstractController{

    public function index() {}

    public function redirectTo($ctrl = null, $action = null, $id = null){
        $url = $ctrl ? "?ctrl=".$ctrl : "";
        $url.= $action ? "&action=".$action : "";
        $url.= $id ? "&id=".$id : "";

        header("Location: $url");
        die();
    }

    public function restrictTo($role){

        if(!Session::getUser() || !Session::getUser()->hasRole($role)){
            $this->redirectTo("security", "login");
        }
        return;
    }
}
/*
In object-oriented programming, an abstract class is a class that cannot be instantiated directly. 
This means that you cannot create an object directly from an abstract class.
Abstract classes:
-- can contain both abstract methods (methods without implementation) and concrete methods (methods with implementation).
-- can have properties (variables) with default values.
-- a class can extend a single abstract class.
-- are used to provide some base implementation.
*/