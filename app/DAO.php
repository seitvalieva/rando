<?php
namespace App;

// 
// * Database data access class, abstract
// *
// * @property static $bdd the PDO instance that the class will store when connect() is called
// *
// * @method static connect() connection to the database
// * @method static insert() insert queries into the database
// * @method static select() select queries
// 
abstract class DAO{

    private static $host   = 'mysql:host=127.0.0.1;port=3306';
    private static $dbname = 'rando';
    private static $dbuser = 'root';
    private static $dbpass = '';

    private static $bdd;

//This method creates the unique PDO instance of the application

    public static function connect(){
        
        self::$bdd = new \PDO(
            self::$host.';dbname='.self::$dbname,
            self::$dbuser,
            self::$dbpass,
            array(
                \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
            )   
        );
    }

    public static function insert($sql){
        try{
            $stmt = self::$bdd->prepare($sql);
            $stmt->execute();
                //we return the id of the record that has just been added to the database,
                //to use it immediately in the controller
            return self::$bdd->lastInsertId();
            
        }
        catch(\Exception $e){
            echo $e->getMessage();
        }
    }

    public static function update($sql, $params){
        try{
            $stmt = self::$bdd->prepare($sql);
            
            //we return the state of the statement after execution (true or false)
            return $stmt->execute($params);
            
        }
        catch(\Exception $e){
            
            echo $e->getMessage();
        }
    }
    
    public static function delete($sql, $params){
        try{
            $stmt = self::$bdd->prepare($sql);
            
            //we return the state of the statement after execution (true or false)
            return $stmt->execute($params);
            
        }
        catch(\Exception $e){
            echo $sql;
            echo $e->getMessage();
            die();
        }
    }

        
    //  This method allows SELECT type queries
    // *
    // * @param string $sql the string containing the query itself
    // * @param mixed $params=null the query parameters
    // * @param bool $multiple=true true if the result is composed of several records (default), false if only one result must be retrieved
    // *
    // * @return array|null the records in FETCH_ASSOC or null if no result
    // 
    public static function select($sql, $params = null, bool $multiple = true):?array
    {
        try{
            $stmt = self::$bdd->prepare($sql);
            $stmt->execute($params);
            
            $results = ($multiple) ? $stmt->fetchAll() : $stmt->fetch();

            $stmt->closeCursor();
            return ($results == false) ? null : $results;
        }
        catch(\Exception $e){
            echo $e->getMessage();
        }
    }
}