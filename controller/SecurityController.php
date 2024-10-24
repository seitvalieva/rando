<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use App\Session;
use PDO;
use Model\Managers\UserManager;
use Model\Managers\RandoManager;
use Model\Managers\ImageManager;
use Model\Managers\SubscriptionManager;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class SecurityController extends AbstractController{
    // will contain the methods related to authentication: register, login and logout
    //setting up the REGISTER function
    public function register(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            if(isset($_POST['csrf_token']) && isset($_SESSION['csrf_token'])) {
                if(!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
                     // If the CSRF token is invalid, stop the request
                    die("Invalid CSRF token.");
                }
            }
            if (isset($_POST["agree"])) {
                // reCAPTCHA validation
                $recaptcha_secret = '6Leyol0qAAAAAImWdHDATp6U7uQDp7SmXE0hjwnn';  // Replace with your secret key from reCAPTCHA
                $recaptcha_response = $_POST['g-recaptcha-response']; // The reCAPTCHA response from the form
    
                // Verify the reCAPTCHA response with Google
                $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$recaptcha_secret}&response={$recaptcha_response}");
                $response_keys = json_decode($response, true);
         
                // If the reCAPTCHA validation fails
                if(intval($response_keys["success"]) !== 1) {
                    Session::addFlash('error', "reCAPTCHA verification failed. Please try again.");
                    header("Location: index.php?ctrl=security&action=register");
                    exit;
                }
                //filtering registration form fields
                $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
                $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $confirmPassword = filter_input(INPUT_POST, "confirmPassword", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                //checks that username starts with letter, can contain only letters, numbers and underscore min 4 max 25 characters, doesn't end with underscore
                if(!preg_match('/^[a-z]\w{2,23}[^_]$/i', $username)) {
                    Session::addFlash('error',"Le nom d'utilisateur n'est pas valid.");
                    header("Location: index.php?ctrl=security&action=register");
                    exit;
                }
                // checking password requirements
                $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{12,}$/';
                if (! preg_match($pattern, $password)) {
                    Session::addFlash('error',"Le mot de passe doit contenir au moins une lettre, un chiffre, un caractère spécial et comporter au moins 8 caractères");
                    header("Location: index.php?ctrl=security&action=register");
                    exit;
                    // die("Password must contain at least one letter, one number, one special symbol and be at least 8 characters long");
                }
                //check filter validity
                if($username && $email && $password && $confirmPassword){
                    // var_dump("ok");die;
                    $userManager = new UserManager();
                    //function to check if the user with the same email exists
                    $user = $userManager->checkUserExists($email);
                    $usernameExists = $userManager->checkUsernameExists($username);
                    //if the user is connected
                    if($user || $usernameExists){
                        Session::addFlash('error',"Le mail ou pseudo est déjà pris");
                        header("Location: index.php?ctrl=security&action=register"); 
                        exit; 
                    } else {
                        
                        //inserting the user into the database
                        if($password == $confirmPassword && strlen($password) >= 12) {//verification that passwords are identical
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
        }
            // check if POST method is submitted and the checkbox is checked
        return [
            "view" => VIEW_DIR."connection/register.php",
            "meta_description" => "Formulaire d'inscription",
            "title" => "Formulaire d'inscription"
        ];
    }  

    //  SETTING UP THE LOG IN FUNCTION
    public function login() {

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                
                if(isset($_POST['csrf_token']) && isset($_SESSION['csrf_token'])) {

                    if(hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
                         
                        //PROTECTION XSS (=FILTRES)
                        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
                        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
                        if($email && $password) {                   
                            
                            $userManager = new UserManager();
                            $user = $userManager->checkUserExists($email);
    
                            if($user){
                                
                                $hash = $user->getPassword();
                            
                                if(password_verify($password, $hash)){          // PASSWORD VERIFICATION
                                                                                
                                    $_SESSION["user"] = $user;                // we store all the user's information in a SESSION table
                                    header("Location:index.php?ctrl=home&action=index");    //IF CONNECTION SUCCESSFUL: REDIRECTION TO HOME PAGE 
                                    exit; 
                                } else {
                                // in case of password error
                                    Session::addFlash('error',"Le mail ou mot de passe n'est pas correct");
                                }
                            } else {
                                // if User not found
                                Session::addFlash('error',"Le mail ou mot de passe n'est pas correct");
                            }
                        } else {
                            // if email or password is empty
                            Session::addFlash('error',"Le mail et le mot de passe sont obligatoires");
                        }   
                    } else {
                        // If the CSRF token is invalid, stop the request
                        Session::addFlash('error',"Invalid CSRF token.");
                    }
                } 
            }
            // displaying login form
            return [
                "view" => VIEW_DIR . "connection/login.php",
                "meta_description" => "Formulaire de connexion",
                "title" => "Formulaire de connexion"
            ];
    }
    // function sends a link with unique token to user's email to reset forgotten password when logging in
    public function sendForgottenPasswordReset() {

        // if(isset($_POST["submitReset"])) 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // $tokenCSRF = $_POST['csrf_token'];
            if(isset($_POST['csrf_token']) && isset($_SESSION['csrf_token'])) {
                if(!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
                     // If the CSRF token is invalid, stop the request
                    die("Invalid CSRF token.");
                }
            }
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
            $token = bin2hex(random_bytes(16));
            $token_hash = hash("sha256", $token);
            $expiry = date("Y-m-d H:i:s", time() + 60 * 10); // token is valid for only 10 minutes
            
            if($email) {
                // var_dump($email); var_dump($token);die;              
                $userManager = new UserManager();
                $user = $userManager->checkUserExists($email);

                if($user) {
                    
                    $userManager->addToken($email,$token_hash,$expiry);

                    $mail = require  __DIR__ . "/MailController.php";
                    // $mail->setFrom("noreply@gmail.com");
                    $mail->addAddress($email);
                    $mail->Subject = "Password Reset";
                    $mail->Body = <<<END

                    Cliquez <a href="http://localhost/rando/index.php?ctrl=security&action=resetPassword&token=$token">ici</a>
                    pour réinitialiser votre mot de passe. Il n'est valable que 10 minutes.
                    Click <a href="http://localhost/rando/index.php?ctrl=security&action=resetPassword&token=$token">here</a> 
                    to reset your password. It is valid for 10 minutes only.

                    END;

                    try {
                        $mail->send();                
                    } catch (Exception $e) {               
                        echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";                
                    }               
                }
            }
            // echo "Message sent, check your inbox";
            header("Location: index.php?ctrl=security&action=sentResetLinkSuccess");
            exit;
        }
        return [
            "view" => VIEW_DIR."connection/forgottenPassword.html",
            "meta_description" => "Réinitialisation du mot de passe oublié",
            "title" => "Réinitialisation du mot de passe oublié"
        ];
    }
    //display a message that a reset link for forgotten password is sent
    public function sentResetLinkSuccess() {
        return [
            "view" => VIEW_DIR."connection/sentResetLink.html",
            "meta_description" => "Réinitialisation du mot de passe avec succès",
            "title" => "Réinitialisation du mot de passe avec succès"
        ];
    }
    // gets token from the url, finds the user by token, checks if the token is valid, and displays a page to create new password
    public function resetPassword() {
        $token = $_GET["token"];    // var_dump($token);die; 
        $token_hash = hash("sha256", $token);
        
        $userManager = new UserManager();
        $user = $userManager->findUserByToken($token_hash);

        // var_dump($user);die;    //true
        // sendForgottenPasswordReset() already checks if checkUserExists($email)
        if (strtotime($user->getTokenExpiresAt()) <= time()) {
            Session::addFlash('error',"Le token est expiré");
            header("Location: index.php?ctrl=security&action=login");
            exit;
            // die("token has expired");
        }
        // echo "token is valid";
        return [
            "view" => VIEW_DIR."connection/resetPassword.php",
            "meta_description" => "Réinitialisation du mot de passe",
            "title" => "Réinitialisation du mot de passe"
        ];
        
    }

    public function setNewPassword() {

        // if(isset($_POST["submitNewPassword"])) 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // $tokenCSRF = $_POST['csrf_token'];
            if(isset($_POST['csrf_token']) && isset($_SESSION['csrf_token'])) {
                if(!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
                     // If the CSRF token is invalid, stop the request
                    die("Invalid CSRF token.");
                }
            }
            $token = $_POST["token"];
            $token_hash = hash("sha256", $token);
            $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{12,}$/';
            // $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
            $userManager = new UserManager();
            $user = $userManager->findUserByToken($token_hash);

            if (strtotime($user->getTokenExpiresAt()) <= time()) {
                Session::addFlash('error',"Le token est expiré");
                header("Location: index.php?ctrl=security&action=login");
                exit;
                // die("token has expired");
            }
            if (! preg_match($pattern, $_POST["newPassword"])) {
                    Session::addFlash('error',"Le mot de passe doit contenir au moins une lettre, un chiffre, un symbole spécial et comporter au moins 8 caractères");
                    header("Location: index.php?ctrl=security&action=setNewPassword");
                    exit;
                // die("Password must contain at least one letter, one number, one special symbol and be at least 8 characters long");
            }
            
            if ($_POST["newPassword"] !== $_POST["confirmNewPassword"]) {
                Session::addFlash('error',"Les mots de passe ne sont pas identiques");
                header("Location: index.php?ctrl=security&action=setNewPassword");
                exit;
                // die("Passwords must match");
            }
            $password_hash = password_hash($_POST["newPassword"], PASSWORD_DEFAULT);
            $user = $userManager->updatePassword($token_hash, $password_hash);
            
            header("Location: index.php?ctrl=security&action=setNewPasswordSuccess");
            // header("Location: index.php?ctrl=security&action=login");
            exit;
        }
        return [
            "view" => VIEW_DIR."connection/resetPassword.php",
            "meta_description" => "Création d'un nouveau mot de passe",
            "title" => "Création d'un nouveau mot de passe"
        ];
    }
    public function setNewPasswordSuccess() {

        return [
            "view" => VIEW_DIR."connection/setNewPasswordSuccess.html",
            "meta_description" => "Création du mot de passe avec succès",
            "title" => "Création du mot de passe avec succès"
        ];
    }
        
    public function logout() {
        session_unset();                        // Delete all session data
        // redirection after logging out
        header("Location: index.php");
        exit;
    }

    public function profile() {
        
        if(Session::getUser()) {
            $userId = Session::getUser()->getId();
            $userManager = new UserManager();
            $user = $userManager->findOneById($userId);
        } else {
            header("Location: index.php?ctrl=security&action=login");
        }
   
        return [
            "view" => VIEW_DIR."connection/profile.php",
            "meta_description" => "Mon compte",
            "title" => "Mon compte",
            "data" => [
                "user" => $user,  
            ]
        ];
    }

    public function deleteProfile() {

        if(isset($_POST['deleteConfirmation'])) {

            if(isset($_POST['csrf_token']) && isset($_SESSION['csrf_token'])) {
                if(!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
                     // If the CSRF token is invalid, stop the request
                    die("Invalid CSRF token.");
                }
            }
            if(Session::getUser()) {

                $uid = Session::getUser()->getId();
                // echo $uid; die();
                $userManager = new UserManager();

                if($userManager->delete($uid)) {
                    Session::setUser(null);
                    header("Location:index.php?ctrl=security&action=deleteProfileSuccess");
                    exit;
                } else {
                    Session::addFlash('error', 'Erreur lors de la suppression de votre compte.');
                    header('Location: index.php?ctrl=security&action=profile');
                    exit;
                }
            }
        } 
        return [
            "view" => VIEW_DIR."connection/deleteProfileConfirmation.php",
            "meta_description" => "Confirmation de la suppression du compte",
            "title" => "Confirmation de la suppression du compte",
            
        ];
        
    }
    public function deleteProfileSuccess() {
        return [
            "view" => VIEW_DIR."connection/deleteProfileSuccess.php",
            "meta_description" => "Suppression du compte avec succès",
            "title" => "Suppression du compte avec succès",
            
        ];
    }
    

}
