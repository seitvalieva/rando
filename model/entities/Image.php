<?php

namespace Model\Entities;

use App\Entity;

final class Image extends Entity {

    private $id;
    private $fileName;
    private $fileCreationTime;
    private $rando;

    public function __construct($data){         
        $this->hydrate($data);        
    }
 
    public function getId()
    {
        return $this->id;
    }
 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
 
    public function getFileName()
    {
        return $this->fileName;
    }
 
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;

        return $this;
    }
 
    public function getFileCreationTime()
    {
        return $this->fileCreationTime;
    }
 
    public function setFileCreationTime($fileCreationTime)
    {
        $this->fileCreationTime = $fileCreationTime;

        return $this;
    }
 
    public function getRando()
    {
        return $this->rando;
    }
 
    public function setRando($rando)
    {
        $this->rando = $rando;

        return $this;
    }
}