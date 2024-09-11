<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use App\Session;
use PDO;
use Model\Managers\UserManager;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\src\SMTP;
use PHPMailer\PHPMailer\src\Exception;


class SecurityController extends AbstractController{
    // will contain the methods related to authentication: register, login and logout
    //setting up the REGISTER function
    public function register(){

           if (isset($_POST["submitRegister"])) {
            
                //filtering registration form fields
                $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
                $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $confirmPassword = filter_input(INPUT_POST, "confirmPassword", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                //check filter validity
                if($username && $email && $password && $confirmPassword){

                    // var_dump("ok");die;
                    $userManager = new UserManager();
                    //creation of the function checkUserExists in userManager to check if the user exists
                    $user = $userManager->checkUserExists($email);
                    $usernameExists = $userManager->checkUsernameExists($username);
                    //if the user is connected
                    if($user || $usernameExists){
                        Session::addFlash('error',"Le mail ou pseudo est déjà pris");
                        header("Location: index.php?ctrl=security&action=register"); 
                        exit; 
                    } else {
                        //var_dump("user doesn't exist");die;
                        //inserting the user into the database
                        if($password == $confirmPassword && strlen($password) >= 5) {//verification that passwords are identique
                            //we retrieve the add function from the Manager file
                            $userManager->add([ 
                                "username" => $username,
                                "email" => $email,
                                "password" => password_hash($password, PASSWORD_DEFAULT)
                            ]);
                            //redirection after the registration
                            header("Location: index.php?ctrl=security&action=login");
                            exit;
                        } else {
                            Session::addFlash('error',"Les mots de passe ne sont pas identique");
                            header("Location: index.php?ctrl=security&action=register");
                            exit;
                        }
                    }
                }
            }
             return [
                "view" => VIEW_DIR."connection/register.php",
                "meta_description" => "Formulaire d'inscription"
            ];
    }  

    //  SETTING UP THE LOG IN FUNCTION
    public function login() {

            if(isset($_POST["submitLogin"])) {
                //PROTECTION XSS (=FILTRES)
                $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
                $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
                if($email && $password) {                   
                    // var_dump("ok");die;
                    //if the user exists
                    $userManager = new UserManager();
                    $user = $userManager->checkUserExists($email);

                    if($user){
                        // var_dump($user);die;
                        $hash = $user->getPassword();

                        if(password_verify($password, $hash)){                      // PASSWORD VERIFICATION 
                            $_SESSION["user"] = $user;                // we store all the user's information in a SESSION table
                            header("Location:index.php?ctrl=home&action=index");    //IF CONNECTION SUCCESSFUL: REDIRECTION TO HOME PAGE 
                            exit; 

                        } else {
                        // in case of Email address or password error
                            Session::addFlash('error',"Le mail ou pseudo n'est pas correct");
                            header("Location: index.php?ctrl=security&action=login");
                            exit;
                            }
                        } else {
                            // if User not found
                            Session::addFlash('error',"User not found");
                            header("Location: index.php?ctrl=security&action=login");
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
    
    public function forgottenPassword() {

        if(isset($_POST["submitReset"])) {
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
            $token = bin2hex(random_bytes(16));
            $token_hash = hash("sha256", $token);
            $expiry = date("Y-m-d H:i:s", time() + 60 * 5); // token is valid for only 5 minutes
            
            if($email) {
                // var_dump($email);
                // var_dump($token);die;
                $userManager = new UserManager();
                $user = $userManager->checkUserExists($email);

                if($user) {
                    $userManager->addToken($email,$token_hash,$expiry);

                    $mail = require  __DIR__ . "/mailer.php";
                    $mail->setFrom("noreply@gmail.com");
                    $mail->addAddress($email);
                    $mail->Subject = "Password Reset";
                    $mail->Body = <<<END

                    Click <a href="http://localhost/index.php?ctrl=security&action=forgottenPassword&token=$token">here</a> 
                    to reset your password.
                                // Click <a href="http://example.com/reset-password.php?token=$token">here</a> 
                                // to reset your password.

                    END;

                    try {

                        $mail->send();
                
                    } catch (Exception $e) {
                
                        echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
                
                    }               
                }
            }
            echo "Message sent, check your inbox";
                    // header("Location: index.php?ctrl=security&action=sent");
                    // exit;
        }

        return [
            "view" => VIEW_DIR."connection/forgottenPassword.html",
            "meta_description" => "Réinitialisation de votre mot de passe"
        ];
    }

    public function sent() {
        return [
            "view" => VIEW_DIR."connection/sent.html",
            "meta_description" => "Réinitialisation de votre mot de passe"
        ];
    }

    public function logout() {
        session_unset();                        // Delete all session data
        // redirection after logging out
        header("Location: index.php");
        exit;
    }

    

}
