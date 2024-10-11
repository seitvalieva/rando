<?php
namespace App;

abstract class Manager{

    protected function connect(){
        DAO::connect();
    }

    // 
    //  * get all the records of a table, sorted by optionnal field and order
    //  * 
    //  * @param array $order an array with field and order option
    //  * @return Collection a collection of objects hydrated by DAO, which are results of the request sent
    //  
    public function findAll($order = null, $limit = null) {

        $orderQuery = ($order) ?                    
            "ORDER BY ".$order[0]. " ".$order[1] :
            "";
        
        $limitQuery = ($limit) ? 
            "LIMIT ".$limit : 
            "";

        $sql = "SELECT *
                FROM ".$this->tableName." a
                ".$orderQuery."
                ".$limitQuery;

        return $this->getMultipleResults(
            DAO::select($sql), 
            $this->className
        );
    }
    
    public function findOneById($id){

        $sql = "SELECT *
                FROM ".$this->tableName." a
                WHERE a.id_".$this->tableName." = :id
                ";

        return $this->getOneOrNullResult(
            DAO::select($sql, ['id' => $id], false), 
            $this->className
        );
    }

    public function add($data){
        
        $keys = array_keys($data);
        
        $values = array_values($data);
        
        $sql = "INSERT INTO ".$this->tableName."
                (".implode(',', $keys).") 
                VALUES
                ('".implode("','",$values)."')";
                
        
        try{
            return DAO::insert($sql);
        }
        catch(\PDOException $e){
            echo $e->getMessage();
            die();
        }
    }
    // UPDATE
    public function update($data, $id) {
        // Extract the keys (column names) from the data array
        $keys = array_keys($data);
    
        // Build the SET part of the query with named placeholders
        $updateFields = [];
        foreach ($keys as $key) {
            $updateFields[] = "$key = :$key"; // Named placeholder
        }
    
        // Prepare the SQL query for updating
        $sql = "UPDATE " . $this->tableName . " 
                SET " . implode(', ', $updateFields) . " 
                WHERE id_" . $this->tableName . " = :id";
    
        // Add the id to the data array for the WHERE condition
        $data['id'] = $id;
    
        try {
            // Execute the update query with named placeholders
            return DAO::update($sql, $data);  // $data contains all named parameters including 'id'
        } catch (\PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }
    // end UPDATE
    
    public function delete($id){
        $sql = "DELETE FROM ".$this->tableName."
                WHERE id_".$this->tableName." = :id
                ";

        return DAO::delete($sql, ['id' => $id]); 
    }

    private function generate($rows, $class){
        foreach($rows as $row){
            yield new $class($row);
        }
    }
    
    protected function getMultipleResults($rows, $class){

        if(is_iterable($rows)){
            return $this->generate($rows, $class);
        }
        else return null;
    }

    protected function getOneOrNullResult($row, $class){

        if($row != null){
            return new $class($row);
        }
        return false;
    }

    protected function getSingleScalarResult($row){

        if($row != null){
            $value = array_values($row);
            return $value[0];
        }
        return false;
    }

}