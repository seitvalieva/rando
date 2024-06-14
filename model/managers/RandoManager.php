<?php

namespace Model\Managers;

use App\Manager;
use App\DAO;


class RandoManager extends Manager{

    protected $classname = "Model\Entities\Rando";
    protected $tableName = "rando";

    public function __construct(){
        parent::connect();
    }
}