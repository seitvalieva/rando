<?php

namespace Model\Entities;

use App\Entity;

final class Image extends Entity {

    private $id;
    private $fileName;
    private $fileCreationTime;
    // private $rando;

    public function __construct($data){         
        $this->hydrate($data);        
    }
}