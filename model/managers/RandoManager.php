<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;


class RandoManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Rando";
    protected $tableName = "rando";

    public function __construct(){
        parent::connect();
    }

    public function getRandoById($id) {

        $queryRando = "SELECT *
        FROM ".$this->tableName."
        WHERE id_rando = :id";

        return $this->getOneOrNullResult(
            DAO::select($queryRando, ['id' => $id], false),
            $this->className
        );
    }

}