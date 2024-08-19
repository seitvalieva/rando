<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use PDO;

use Model\Managers\UserManager;

class SecurityController extends AbstractController {
                    // will contain the methods related to authentication: register, login and logout
                    // Displays the register form view
                    //session_start();   
    // setting up the REGISTER function
    public function register() {
        if (isset($_POST["submitRegister"])) {

            // filter the registration form fields
            $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
            $pass1 = filter_input(INPUT_POST, "pass1", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $pass2 = filter_input(INPUT_POST, "pass2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            //CHECK THE VALIDITY OF THE FILTERS:
            if($username && $email && $pass1 && $pass2) {
                // var_dump("ok");die;
                $userManager = new UtilisateurManager();
                //creation of the function checkUserExists in userManager to check if the user exists
                $user = $userManager->checkUserExists($email);
                
                // if the user exists
                if($utilisateur){
                    header("Location: index.php?ctrl=security&action=register"); 
                    exit;
                } else {
                    //var_dump("utilisateur inexistant");die;

                    //insert user into database
                    if($pass1 == $pass2 && strlen($pass1) >= 8) {   //VERIFY THAT THE PASSWORDS ARE IDENTICAL
                        $userManager->add([                         //we retrieve the add function from the Manager file
                            "pseudo" => $pseudo,
                            "email" => $email,
                            "password" => password_hash($pass1, PASSWORD_DEFAULT)
                        ]);
                        //REDIRECTION AFTER REGISTRATION
                        header("Location: index.php?ctrl=security&action=login");
                        exit;
                    } else {
                        header("Location: index.php?ctrl=security&action=register");
                        exit;
                        // $this->redirectTo("security","register")
                    }
                }
            }
        }
        return [
            "view" => VIEW_DIR . "connection/register.php",
            "meta_description" => "Formulaire d'inscription"
        ];
    }      
}