<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use PDO;
use Model\Managers\UserManager;


class SecurityController extends AbstractController{

     // contiendra les méthodes liées à l'authentification : register, login et logout
     // Affiche la vue du formulaire register
          //session_start();
    
    //MISE EN PLACE DE LA FONCTION S INSCRIRE
    public function register(){
    
           if (isset($_POST["submitRegister"])) {
            
                //FILTRER LES CHAMPS DU FORMULAIRE D INSCRIPTION:
                $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
                $pass1 = filter_input(INPUT_POST, "pass1", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $pass2 = filter_input(INPUT_POST, "pass2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
                //VERIFIER LA VALIDITE DES FILTRES:
                if($username && $email && $pass1 && $pass2){

                    // var_dump("ok");die;
                    $userManager = new UserManager();
                    $utilisateur = $userManager->checkUserExists($email);//création de la function checkUserExists dans utilisateurManager pour vérifier si l'utilisateur existe
                //SI L UTILISATEUR EXISTE
                    if($utilisateur){
                        header("Location: index.php?ctrl=security&action=register"); 
                        exit; 
                    } else {
                        //var_dump("utilisateur inexistant");die;
                        //insertion de l'utilisateur en BDD
                        if($pass1 == $pass2 && strlen($pass1) >= 5) {//VERIFICATION QUE LES MDP SONT IDENTIQUES
                            
                            $userManager->add([//on récupère la function add du fichier Manager
                                "username" => $username,
                                "email" => $email,
                                "password" => password_hash($pass1, PASSWORD_DEFAULT)
                            ]);

                            //REDIRECTION APRES L INSCRIPTION
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
                    $utilisateur = $userManager->checkUserExists($email);

                    if($utilisateur){
                        // var_dump($utilisateur);die;
                        $hash = $utilisateur->getPassword();

                        if(password_verify($password, $hash)){                      // PASSWORD VERIFICATION 
                            $_SESSION["utilisateur"] = $utilisateur;                // we store all the user's information in a SESSION table
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
