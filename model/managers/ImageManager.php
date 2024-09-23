<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;


class ImageManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Image";
    protected $tableName = "image";

    public function __construct(){
        parent::connect();
    }

    public function getImagesByRandoId($id) {
        $sql = "SELECT filename 
        FROM ".$this->tableName."
        WHERE rando_id = :id";

        return $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]),
            $this->className
        );
    }
}