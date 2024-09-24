<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;


class RandoManager extends Manager{

    // we indicate the OOP class and the corresponding table in the BDD for the manager concerned
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

    public function searchByKeyword($keyword) {
        
        $sql = "SELECT *
                FROM ".$this->tableName." 
                WHERE LOWER(title) LIKE :keyword";
                
        return $this->getMultipleResults(
            DAO::select($sql, ['keyword' => '%' . $keyword . '%']),
            $this->className
        );
        
    }
    public function addImage($fileName, $lastInsertRandoId) {
        $sql = "UPDATE ".$this->tableName."
        SET image = :image
        WHERE id_rando = :id";

        return $this->getSingleScalarResult (
            DAO::select($sql, ['image' => $fileName, 'id' => $lastInsertRandoId]),            
            $this->className
        );
    }

}