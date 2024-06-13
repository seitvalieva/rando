<?php

namespace Model\Entities;

use App\Entity;

final class User extends Entity {

    private $id;
    private $username;
    private $email;
    private $password;
    private $registrationDate;

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

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }
 
    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }
 
    public function getRegistrationDate()
    {
        return $this->registrationDate;
    }
 
    public function setRegistrationDate($registrationDate)
    {
        $this->registrationDate = $registrationDate;

        return $this;
    }

    public function __toString() {
        return $this->username;
    }
}