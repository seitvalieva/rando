<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use PDO;
use Model\Managers\UserManager;


class SecurityController extends AbstractController{
    // will contain the methods related to authentication: register, login and logout
    
    //setting up the REGISTER function
    public function register(){
    
           if (isset($_POST["submitRegister"])) {
            
                //FILTRER LES CHAMPS DU FORMULAIRE D INSCRIPTION:
                $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
                $pass1 = filter_input(INPUT_POST, "pass1", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $pass2 = filter_input(INPUT_POST, "pass2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                //check filter validity
                if($username && $email && $pass1 && $pass2){

                    // var_dump("ok");die;
                    $userManager = new UserManager();
                    //creation of the function checkUserExists in userManager to check if the user exists
                    $user = $userManager->checkUserExists($email);
                    //if the user is connected
                    if($user){
                        header("Location: index.php?ctrl=security&action=register"); 
                        exit; 
                    } else {
                        //var_dump("user doesn't exist");die;
                        //inserting the user into the database
                        if($pass1 == $pass2 && strlen($pass1) >= 5) {//verification that passwords are identique
                            //we retrieve the add function from the Manager file
                            $userManager->add([ 
                                "username" => $username,
                                "email" => $email,
                                "password" => password_hash($pass1, PASSWORD_DEFAULT)
                            ]);

                            //redirection after the registration
                            header("Location: index.php?ctrl=security&action=login");
                            exit;
                        } else {
                            header("Location: index.php?ctrl=security&action=register");
                            exit;
                        }
                    }
                }
            }
             return [
                "view" => VIEW_DIR . "connection/register.php",
                "meta_description" => "Formulaire d'inscription"
            ];
    }  

    //  SETTING UP THE LOG IN FUNCTION
    public function login() {

            if(isset($_POST["submitLogin"])) {
       
                //PROTECTION XSS (=FILTRES)
                $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
                $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
                if($email && $password) {                   // PREPARED QUERY TO FIGHT SQL INJECTIONS
                    // var_dump("ok");die;
                    //if the user exists
                    $userManager = new UserManager();
                    $user = $userManager->checkUserExists($email);

                    if($user){
                        // var_dump($utilisateur);die;
                        $hash = $user->getPassword();

                        if(password_verify($password, $hash)){                      // PASSWORD VERIFICATION 
                            $_SESSION["user"] = $user;                // we store all the user's information in a SESSION table
                            header("Location:index.php?ctrl=home&action=index");    //IF CONNECTION SUCCESSFUL: REDIRECTION TO HOME PAGE
                        //Dans Forum, la redirection sera par exemple: header("Location: index.php?ctrl=home&action=index&id=");    
                            exit;  
                        
                            } else {
                        // in case of Email address or password error
                            header("Location: index.php?ctrl=security&action=login");
                            exit;
                            }
                        } else {
                            // if User not found
                            header("Location: index.php?security&action=login");
                            exit;
                        }
                    }
            }
                // displaying login form
            return [
                "view" => VIEW_DIR . "connection/login.php",
                "meta_description" => "Formulaire de connexion"
            ];
    }
    
    public function logout() {
        session_unset();                        // Delete all session data
        // redirection after logging out
        header("Location: index.php");
        exit;
    }

}
