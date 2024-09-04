<?php
namespace App;

class Session{

    private static $categories = ['error', 'success'];

    //   adds a message in session, in category $categ
    
    public static function addFlash($categ, $msg){
        $_SESSION[$categ] = $msg;
    }
    // returns a message from the category $categ, if there are any!
    public static function getFlash($categ){
        
        if(isset($_SESSION[$categ])){
            $msg = $_SESSION[$categ];  
            unset($_SESSION[$categ]);
        }
        else $msg = "";
        
        return $msg;
    }

    //    puts a user in the session (to keep them logged in)
    
    public static function setUser($user){
        $_SESSION["user"] = $user;
    }

    //   The following method is used to verify that a user is logged in:
     
    public static function getUser(){
        return (isset($_SESSION['user'])) ? $_SESSION['user'] : false;
    }

    public static function isAdmin(){
        // be careful to define the "hasRole" method in the User entity according to the way roles are managed in the database
        if(self::getUser()) {//&& self::getUser()->hasRole("ROLE_ADMIN")){
            return true;
        }
        return false;
    }
}