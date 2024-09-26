<?php

namespace Model\Entities;

use App\Entity;

final class Subscription extends Entity {

    private $id;
    private $user;
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

    public function getUser()
    {
        return $this->user;
    }
 
    public function setUser($user)
    {
        $this->user = $user;

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