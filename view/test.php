<?php
    public function register() {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // csrf token validation
            if(!isset($_POST['csrf_token']) || !isset($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
                $errors['csrf'] = "Invalid CSRF token.";
                return $errors;
            }
            //username validation
            if (isset($_POST['username'])) {
                $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                if($username && preg_match('/^[a-z]\w{2,23}[^_]$/i', $username)) {
                    $userManager = new UserManager();
                    $usernameExists = $userManager->checkUsernameExists($username);
                    // if username is already taken
                    if($usernameExists) {
                        $errors['username'] = "Le pseudo est déjà pris";
                    }
                } else {
                    $errors['username'] = "Le nom d'utilisateur n'est pas valid.";
                }
            } else {
                $errors['username'] = "Le champ du pseudo est requis.";
            }
            // Email validation
            if (isset($_POST['email']))  {
                $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
                if($email){
                    $userManager = new UserManager();
                    $user = $userManager->checkUserExists($email);
                    // if user exists in db
                    if($user) {
                        $errors['email'] = "L'email est déjà pris";
                    }
                } else {
                    $errors['email'] = "L'email n'est pas valid.";
                }
            } else {
                    $errors['email'] = "Le champ du email est requis.";
            }
            // Password validation
            if (isset($_POST['password'])) {
                $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                // checking password requirements
                $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{12,}$/';

                if(!$password || !preg_match($pattern, $password)) {

                    $errors['password'] = "Le mot de passe doit contenir au moins une lettre, un chiffre, 
                    un caractère spécial et comporter au moins 12 caractères";
                } 
            } else {
                $errors['password'] = "Le champ mot de passe est requis.";
            }
            // Confirm Password validation
            if (isset($_POST['confirmPassword'])) {
                $confirmPassword = filter_input(INPUT_POST, "confirmPassword", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                if($password !== $confirmPassword) {
                    $errors['confirmPassword'] = "Les mots de passe doivent être identiques.";
                }
            } else {
                $errors['confirmPassword'] = "Veuillez confirmer votre mot de passe.";
            }
            // Checkbox validation 
            if (!isset($_POST["agree"])) {
                $errors['agree'] = "Veuillez accepter les conditions générales d’utilisation";
            }
            // ReCaptcha validation
            $recaptcha_secret = '6Leyol0qAAAAAImWdHDATp6U7uQDp7SmXE0hjwnn';  // Replace with your secret key from reCAPTCHA
            $recaptcha_response = $_POST['g-recaptcha-response']; // The reCAPTCHA response from the form
            // Verify the reCAPTCHA response with Google
            $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$recaptcha_secret}&response={$recaptcha_response}");
            $response_keys = json_decode($response, true);
            // If the reCAPTCHA validation fails
            if(intval($response_keys["success"]) !== 1) {
                $errors['recaptcha'] = "Veuillez vérifier le reCAPTCHA.";
            }
                
            if (empty($errors)) {
                //inserting the user into the database
                //we retrieve the add function from the Manager
                $userManager->add([ 
                "username" => $username,
                "email" => $email,
                "password" => password_hash($password, PASSWORD_DEFAULT)
                ]);
                //redirection after the registration
                header("Location: index.php?ctrl=security&action=login");
                exit;
            }
        }
        return [
            "view" => VIEW_DIR."connection/register.php",
            "meta_description" => "Formulaire d'inscription",
            "title" => "Formulaire d'inscription"
        ];
    }

    public function register(){

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];

            if(isset($_POST['csrf_token']) && isset($_SESSION['csrf_token'])) {
                if(hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
                        //filtering registration form fields
                        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
                        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        $confirmPassword = filter_input(INPUT_POST, "confirmPassword", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                    // check if checkbox is checked
                    if (isset($_POST["agree"])) {

                        // reCAPTCHA validation
                        $recaptcha_secret = '6Leyol0qAAAAAImWdHDATp6U7uQDp7SmXE0hjwnn';  // Replace with your secret key from reCAPTCHA
                        $recaptcha_response = $_POST['g-recaptcha-response']; // The reCAPTCHA response from the form

                        // Verify the reCAPTCHA response with Google
                        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$recaptcha_secret}&response={$recaptcha_response}");
                        $response_keys = json_decode($response, true);
                 
                        // If the reCAPTCHA validation fails
                        if(intval($response_keys["success"]) == 1) {
                            

                            if($username && $email && $password && $confirmPassword) {

                                $userManager = new UserManager();
                                //function to check if the user with the same email/username exists
                                $user = $userManager->checkUserExists($email);
                                $usernameExists = $userManager->checkUsernameExists($username);

                                if(!$user || !$usernameExists) {
                                    //checks that username starts with letter, can contain only letters, numbers and underscore min 4 max 25 characters, doesn't end with underscore
                                    if(preg_match('/^[a-z]\w{2,23}[^_]$/i', $username)) {
                                        // checking password requirements
                                        $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{12,}$/';
                                        if (preg_match($pattern, $password)) {
                                            //verification that passwords are identical
                                            if($password == $confirmPassword && strlen($password) >= 12) {
                                                //inserting the user into the database
                                                //we retrieve the add function from the Manager
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
                                            } 
                                        }else {
                                            Session::addFlash('error',"Le mot de passe doit contenir au moins une lettre, un chiffre, un caractère spécial et comporter au moins 8 caractères");
                                        }
                                    } else {
                                        Session::addFlash('error',"Le nom d'utilisateur n'est pas valid.");
                                    }
                                } else {
                                    Session::addFlash('error',"Le mail ou le pseudo est déjà pris");
                                }
                            } else {
                                Session::addFlash('error',"Tout les champs sont obligatoires");
                            }
                            
                        } else {
                            Session::addFlash('error', "reCAPTCHA verification failed. Please try again.");//
                        }
                    } else {
                        Session::addFlash('error',"Veuillez accepter les conditions générales d’utilisation");//
                    }
                } else {
                    // If the CSRF token is invalid, stop the request
                    Session::addFlash('error', "Invalid CSRF token.");
                    // die("Invalid CSRF token.");
                }
            } 
        }
        
        return [
            "view" => VIEW_DIR."connection/register.php",
            "meta_description" => "Formulaire d'inscription",
            "title" => "Formulaire d'inscription"
        ];
    }  