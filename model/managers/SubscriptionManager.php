<?php

namespace Model\Managers;

use App\Manager;
use App\DAO;


class SubscriptionManager extends Manager{

    protected $className = "Model\Entities\Subscription";
    protected $tableName = "subscription";

    public function __construct(){
        parent::connect();
    }

    public function checkUserSubscribed($userId, $id) {//Query that checks if the user exists by his email
        $sql ="SELECT * 
                FROM ".$this->tableName. " t
                WHERE user_id = :userId
                AND rando_id =:id";

        // the query returns an object or nothing getOneOrNullResult (fonctions in Manager)
        return  $this->getOneOrNullResult(
            DAO::select($sql, ['userId' => $userId, 'id' => $id], false), //we add "false" because the public static function select in DAO returns multiple "true" responses
            $this->className
        );
    }

    public function deleteParticipation($userId, $id) {
        $sql =  "DELETE  
                FROM ".$this->tableName. "
                WHERE user_id = :userId
                AND rando_id =:id";

            return $this->getSingleScalarResult(
                DAO::select($sql, ['userId' => $userId, 'id' => $id]),
                $this->className
            );
    }

    public function findParticipationsByUser($userId) {
        $sql ="SELECT * 
                FROM ".$this->tableName. " t
                INNER JOIN rando ON t.rando_id = rando.id_rando                
                WHERE t.user_id = :userId"; 

        return $this->getMultipleResults(
        DAO::select($sql, ['userId' => $userId]),
        $this->className
        );
    }

    public function findUsersSubscribed($id) {

        $sql = "SELECT * 
                FROM ".$this->tableName. "
                WHERE rando_id = :id";

        return $this->getMultipleResults(
        DAO::select($sql, ['id' => $id]),
        $this->className
        );
    }
}