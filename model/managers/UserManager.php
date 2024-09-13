<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;


class UserManager extends Manager{

    // we indicate the OOP class and the corresponding table in the BDD for the manager concerned
    protected $className = "Model\Entities\User";
    protected $tableName = "user";

    public function __construct(){
        parent::connect();
    }

    public function checkUserExists($email) {//Query that checks if the user exists by his email
        $sql ="SELECT * 
                FROM ".$this->tableName. " t
                WHERE email = :email";

        // the query returns an object or nothing getOneOrNullResult (fonctions in Manager)
        return  $this->getOneOrNullResult(
            DAO::select($sql, ['email' => $email], false), //we add "false" because the public static function select in DAO returns multiple "true" responses
            $this->className
        );
    }
    public function checkUsernameExists($username) {//Query that checks if the user exists by his username
        $sql ="SELECT * 
                FROM ".$this->tableName. " t
                WHERE username = :username";

        return  $this->getOneOrNullResult(
            DAO::select($sql, ['username' => $username], false), 
            $this->className
        );

    }

    public function addToken($email,$token_hash, $expiry) {
        $sql = "UPDATE ".$this->tableName."
                SET resetTokenHash = :resetTokenHash,
                    tokenExpiresAt = :tokenExpiresAt
                    WHERE email = :email";

        return $this->getSingleScalarResult (
                DAO::select($sql, ['email' => $email, 'resetTokenHash' => $token_hash, 'tokenExpiresAt' => $expiry]),
                
                $this->className
            );
    }

    public function findUserByToken($token_hash) {
        $sql = "SELECT *
                FROM ".$this->tableName. " t
                WHERE resetTokenHash = :resetTokenHash";

        return $this->getOneOrNullResult(
            DAO::select($sql, ['resetTokenHash' => $token_hash], false),
            $this->className
        );
    }

    public function updatePassword($token_hash, $password_hash) {
        $sql = "UPDATE ".$this->tableName."
                SET password = :password
                WHERE resetTokenHash = :resetTokenHash";

        return $this->getSingleScalarResult (
                DAO::select($sql, ['resetTokenHash' => $token_hash, 'password' => $password_hash]),
                
                $this->className
            );
    }
}
