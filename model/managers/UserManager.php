<?php

namespace Model\Managers;

use App\Manager;
use App\DAO;
// use Model\Managers\SujetManager;


class UserManager extends Manager{

    // we indicate the POO class and the corresponding table in the BDD for the manager concerned

    protected $classname = "Model\Entities\User";
    protected $tableName = "user";

    public function __construct(){
        parent::connect();
    }

    public function checkUserExists($email) {       //Query that allows you to check if the user exists via their email
        $sql ="SELECT * 
                FROM ".$this->tableName. " t
                WHERE email = :email";

        // the query returns an object or nothing --> getOneOrNullResult (cf functions in Manager)
        return  $this->getOneOrNullResult(
            DAO::select($sql, ['email' => $email], false), //we add "false" because the public static function select in DAO returns multiple "true" responses
            $this->className
        );
    }
}