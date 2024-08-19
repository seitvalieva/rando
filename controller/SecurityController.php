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
    
    //MISE EN PLACE DE LA FONCTION SE CONNECTER
    public function login() {

            if(isset($_POST["submitLogin"])) {
       
                //PROTECTION XSS (=FILTRES)
                $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
                $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
                if($email && $password) {//REQUETE PREPARE POUR LUTTER CTRE LES INJECTIONS SQL
                    // var_dump("ok");die;
                    //si l'utilisateur existe
                    $userManager = new UtilisateurManager();
                    $utilisateur = $userManager->checkUserExists($email);

                    if($utilisateur){
                        // var_dump($utilisateur);die;
                        $hash = $utilisateur->getPassword();

                        if(password_verify($password, $hash)){//VERIFICATION DU MDP
                            $_SESSION["utilisateur"] = $utilisateur; //on stocke dans un tableau SESSION l'intégralité des infos du user
                            header("Location:index.php?ctrl=home&action=index");//SI CONNEXION REUSSIE: REDIRECTION VERS PAGE D ACCUEIL
                        //Dans Forum, la redirection sera par exemple: header("Location: index.php?ctrl=home&action=index&id=");    
                            exit;  
                        
                            } else {
                        // Erreur d'adresse mail ou de mot de passe
                            header("Location: index.php?ctrl=security&action=login");
                            exit;
                            }
                        } else {
                            // Utilisateur introuvable
                            header("Location: index.php?security&action=login");
                            exit;
                        }
                    }

                // Afficher le formulaire de connexion
            }
            return [
                "view" => VIEW_DIR . "connexion/login.php",
                "meta_description" => "Formulaire de connexion"
            ];
    }
    
    
    public function logout() {
        session_unset();// Supprimer toutes les données de la session
        // Redirection après la déconnexion
        header("Location: index.php");
        exit;
    }
}