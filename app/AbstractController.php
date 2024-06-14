<?php

namespace App;

abstract class AbstractController{

    public function index() {}

    public function redirectTo($ctrl = null, $action = null, $id = null){
    }

    public function restrictTo($role){
    }

}