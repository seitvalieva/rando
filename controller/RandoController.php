<?php
namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;

use Model\Managers\RandoManager;
use Model\Managers\UserManager;
use Model\Managers\ImageManager;
use Model\Managers\SubscriptionManager;

class RandoController extends AbstractController implements ControllerInterface {

    // list all randos 
    public function index() {
        
        $randoManager = new RandoManager();                 // new instance of RandoManager
                            // retrieves the list of all rando using the findAll method of Manager.php (sorted by name)
        $randos = $randoManager->findAll(["dateRando", "DESC"]);

        // the controller communicates with the "list randos" view  to send it the list of randos (data)
        return [
            "view" => VIEW_DIR."rando/listRandos.php",
            "meta_description" => "Liste des randonnées",
            "title" => "Liste des randonnées",
            "data" => [
                "randos" => $randos
            ]
        ];
    }
    
     // display details of a rando
    public function randoDetails($id) {
        
        $id = (isset($_GET["id"])) ? $_GET["id"] : null;
        $randoManager = new RandoManager();
        $imageManager = new ImageManager();
        $subscriptionManager = new SubscriptionManager();

        $lastRandos = $randoManager->findAll(["dateRando", "DESC"], 3);

        if(Session::getUser()) {
            $userId = Session::getUser()->getId(); 
            $subscription =  $subscriptionManager->checkUserSubscribed($userId, $id);
        } else {
            $subscription = null;
        }   
        $participants = $subscriptionManager->findUsersSubscribed($id); 

        return [
            "view" => VIEW_DIR . "rando/randoDetails.php",
            "meta_description" => "Details de la randonnée",
            "title" => "Details de la randonnée",
            "data" => [
                "rando" => $randoManager->getRandoById($id),
                "imagesNames" => $imageManager->getImagesByRandoId($id),
                "subscription" => $subscription,
                "lastRandos" => $lastRandos,
                "participants" => $participants
            ]
        ];
    }

     // create une rando
    public function addNewRando() {
        
        if(isset($_POST['submitRando'])){

            $randoTitle = filter_input(INPUT_POST, "randoTitle", FILTER_SANITIZE_SPECIAL_CHARS);
            $randoSubtitle = filter_input(INPUT_POST, "randoSubtitle", FILTER_SANITIZE_SPECIAL_CHARS);
            $departure = filter_input(INPUT_POST, "departure", FILTER_SANITIZE_SPECIAL_CHARS);
            $destination = filter_input(INPUT_POST, "destination", FILTER_SANITIZE_SPECIAL_CHARS);
            $description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_SPECIAL_CHARS);
            $userId = Session::getUser()->getId();

            if($randoTitle){
                $randoManager = new RandoManager();

                $data = [
                    'title' =>$randoTitle,
                    'subtitle'=>$randoSubtitle,
                    'dateRando'=>$_POST['dateRando'],
                    'timeRando'=> $_POST['timeRando'],
                    'durationDays'=>$_POST['durationDays'],
                    'durationHours'=>$_POST['durationHours'],
                    'distance'=> $_POST['distance'],        //min 1 step 0.5
                    'departure'=>$departure,
                    'destination'=>$destination,
                    'description'=>$description,
                    // 'image' => NULL,
                    'user_id' => $userId
                ];
                // var_dump($data); die();
                $lastInsertRandoId = $randoManager->add($data);

                $subscriptionManager = new SubscriptionManager();
                $data = [
                    'user_id' => $userId,
                    'rando_id' => $lastInsertRandoId
                ];
                $subscriptionManager->add($data);

                if ($lastInsertRandoId) {
                    // echo "Last Inserted ID: " . $lastInsertRandoId; die();  // For debugging or logging
                    $extensionAllowed = array('jpeg', 'jpg', 'png', 'gif', 'webp');     // array of allowed extensions for images

                    foreach($_FILES['image']['tmp_name'] as $key => $value)  {
                        $fileSize = $_FILES['image']['size'][$key];

                        if ($fileSize > 1048576) {
                            exit('Error: File too large (max 1MB)');
                        }
                        $filename = $_FILES['image']['name'][$key];
                        $filename_tmp = $_FILES['image']['tmp_name'][$key];

                        $extension = pathinfo($filename, PATHINFO_EXTENSION);       // get the extension of the file
                        $fileName = '';
                        if(in_array($extension, $extensionAllowed)) {

                            if(!file_exists('uploads/'.$filename)) {
                                move_uploaded_file($filename_tmp, 'uploads/'.$filename);
                                $fileName = $filename;
                            } else {                                      // if a file with the same name is already exists in the uploads folder
                                $filename = str_replace('.','-', basename($filename, $extension));
                                //add current date and time to make the file name unique and protect personal info
                                $newFilename = $filename.time().".".$extension;
                                move_uploaded_file($filename_tmp, 'uploads/'.$newFilename);
                                $fileName = $newFilename;
                            }

                            // add images info to the database 
                            $imageManager = new ImageManager();
                            $data = [
                                'fileName' =>$fileName,
                                'rando_id' => $lastInsertRandoId
                            ];
                            $imageManager->add($data);
                            //update image name in the rando table
                            $randoManager->addImage($fileName, $lastInsertRandoId);
                        } else {
                            //display error
                        } 
                    } // end foreach

                }
                $this->redirectTo("rando","index");
            }
        }  
        return [
            "view" => VIEW_DIR."rando/newRando.php",
            "meta_description" => "Créer une randonnée",
            "title" => "Formulaire de création d'une randonnée",
        ];
          
    }
    
     // search randos by keyword
    public function searchRando() {

        if (isset($_POST['keyword'])) {
            
            $keyword = htmlspecialchars($_POST['keyword']);
            $keyword = trim(strip_tags($keyword));
            // var_dump($keyword);die;
            $randoManager = new RandoManager();

            $randos = $randoManager->searchByKeyword($keyword);
            
            if(!empty($randos)) {

                return [
                    "view" => VIEW_DIR."rando/searchResults.php",
                    "meta_description" => "Recherche de randonnées",
                    "title" => "Resultats de la recherche de randonnées",
                    "data" => [
                        "randos" => $randos,
                        "keyword" => $keyword
                    ]
                ];

            } else {
                die("No results");
            }
        } 
         
    } 

    public function modifyRandoForm() {

        $id = (isset($_GET["id"])) ? $_GET["id"] : null;
        
        if(isset($_GET['id'])) {

        $randoManager = new RandoManager();
        
        return [
            "view" => VIEW_DIR . "connection/modifyRandoForm.php",
            "meta_description" => "Modifier la randonnée",
            "title" => "Formulaire de modification de la randonnée",           
            "data" => [
                "rando" => $randoManager->getRandoById($id)
            ]
        ];
        }
    }

    public function modifyRando() {

        // if(isset($_POST['updateRando'])) 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // $tokenCSRF = $_POST['csrf_token'];
            if(isset($_POST['csrf_token']) && isset($_SESSION['csrf_token'])) {
                if(!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
                     // If the CSRF token is invalid, stop the request
                    die("Invalid CSRF token.");
                }
            }

            $id = intval($_GET['id']);
            // echo $id; die();
            $randoTitle = filter_input(INPUT_POST, "randoTitle", FILTER_SANITIZE_SPECIAL_CHARS);
            $randoSubtitle = filter_input(INPUT_POST, "randoSubtitle", FILTER_SANITIZE_SPECIAL_CHARS);
            $departure = filter_input(INPUT_POST, "departure", FILTER_SANITIZE_SPECIAL_CHARS);
            $destination = filter_input(INPUT_POST, "destination", FILTER_SANITIZE_SPECIAL_CHARS);
            $description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_SPECIAL_CHARS);
            $userId = Session::getUser()->getId();

            if($randoTitle) {
                $randoManager = new RandoManager();

                $data = [
                    'title' =>$randoTitle,
                    'subtitle'=>$randoSubtitle,
                    'dateRando'=>$_POST['dateRando'],
                    'timeRando'=> $_POST['timeRando'],
                    'durationDays'=>$_POST['durationDays'],
                    'durationHours'=>$_POST['durationHours'],
                    'distance'=> $_POST['distance'],
                    'departure'=>$departure,
                    'destination'=>$destination,
                    'description'=>$description,
                    'user_id' => $userId
                ];

                $updatedRando = $randoManager->update($data, $id);
                if ($updatedRando) {
                    
                    $extensionAllowed = array('jpeg', 'jpg', 'png', 'gif', 'webp');     // array of allowed extensions for images

                    foreach($_FILES['image']['tmp_name'] as $key => $value)  {
                        $fileSize = $_FILES['image']['size'][$key];

                        if ($fileSize > 1048576) {
                            exit('Error: File too large (max 1MB)');
                        }
                        $filename = $_FILES['image']['name'][$key];
                        $filename_tmp = $_FILES['image']['tmp_name'][$key];

                        $extension = pathinfo($filename, PATHINFO_EXTENSION);       // get the extension of the file
                        $fileName = '';
                        if(in_array($extension, $extensionAllowed)) {

                            if(!file_exists('uploads/'.$filename)) {
                                move_uploaded_file($filename_tmp, 'uploads/'.$filename);
                                $fileName = $filename;
                            } else {                                      // if a file with the same name is already exists in the uploads folder
                                $filename = str_replace('.','-', basename($filename, $extension));
                                //add current date and time to make the file name unique and protect personal info
                                $newFilename = $filename.time().".".$extension;
                                move_uploaded_file($filename_tmp, 'uploads/'.$newFilename);
                                $fileName = $newFilename;
                            }

                            // add images info to the database 
                            $imageManager = new ImageManager();
                            $data = [
                                'fileName' =>$fileName,
                                'rando_id' => $id
                            ];
                            $imageManager->add($data);
                            //update image name in the rando table
                            $randoManager->addImage($fileName, $id);
                        } else {
                            //display error
                        } 
                    } // end foreach

                }
                $this->redirectTo("rando","index");
            }
        }
    }
    // delete rando
    public function deleteRandoConfirmation() {

        return [
            "view" => VIEW_DIR."rando/deleteRandoConfirmation.php",
            "meta_description" => "Confirmation de suppression de la rando",
            "title" => "Confirmation de suppression de la rando"
        ];
    }
    public function deleteRando() {

        $id = intval($_GET["id"]);
        // if (isset($_POST['deleteConfirmation'])) 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // $tokenCSRF = $_POST['csrf_token'];
            if(isset($_POST['csrf_token']) && isset($_SESSION['csrf_token'])) {
                if(!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
                     // If the CSRF token is invalid, stop the request
                    die("Invalid CSRF token.");
                }
            }
            // echo $id; die();            
            $randoManager = new RandoManager();
            $randoManager->delete($id);

            header("Location: index.php");
            exit;
        } else {
            header("Location: index.php?ctrl=rando&action=randoDetails&id=".$id);
        }   
    }
    public function myRandosList() {
        if(Session::getUser()) {
            $userId = Session::getUser()->getId();
            $userManager = new UserManager();
            $user = $userManager->findOneById($userId);
        } else {
            header("Location: index.php?ctrl=security&action=login");
        }
        $randoManager = new RandoManager();
        $created_randos = $randoManager->findRandosByUser($userId);

        return [
            "view" => VIEW_DIR."rando/myRandosList.php",
            "meta_description" => "Mes randonnées créées",
            "title" => "Mes randonnées créées",
            "data" => [
                "user" => $user,
                "created_randos" => $created_randos, 
            ]
        ];
    }
    public function myParticipationsList() {
        if(Session::getUser()) {
            $userId = Session::getUser()->getId();
            $userManager = new UserManager();
            $user = $userManager->findOneById($userId);
        } else {
            header("Location: index.php?ctrl=security&action=login");
        }
        $subscriptionManager = new SubscriptionManager();
        $participations = $subscriptionManager->findParticipationsByUser($userId);
   
        return [
            "view" => VIEW_DIR."rando/myParticipationsList.php",
            "meta_description" => "Mes randonnées à participer",
            "title" => "Mes participqtions aux randonnées",
            "data" => [
                "participations" => $participations
            ]
        ];
    }

 
}

 

