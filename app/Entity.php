<?php
namespace App;

abstract class Entity{

    protected function hydrate($data){

        foreach($data as $field => $value){
            
            $fieldArray = explode("_", $field);

            if(isset($fieldArray[1]) && $fieldArray[1] == "id"){
                
                $manName = ucfirst($fieldArray[0])."Manager";
                
                $FQCName = "Model\Managers\\".$manName;
                
                $man = new $FQCName();
               
                $value = $man->findOneById($value);
            }

            $method = "set".ucfirst($fieldArray[0]);        // making the name of the setter to call (ex: setName)
            
            if(method_exists($this, $method)){              // if setName is a method that exists in the entity (this)
                
                $this->$method($value);                     // $this->setName("value")
            }
        }
    }

    public function getClass(){
        return get_class($this);
    }
}