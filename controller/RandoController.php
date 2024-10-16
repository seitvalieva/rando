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
            "meta_description" => "Liste des randos",
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

        return [
            "view" => VIEW_DIR . "rando/randoDetails.php",
            "meta_description" => "Rando Details",
            "data" => [
                "rando" => $randoManager->getRandoById($id),
                "imagesNames" => $imageManager->getImagesByRandoId($id),
                "subscription" => $subscription,
                "lastRandos" => $lastRandos
            ]
        ];
    }

     // create une rando
    public function addNewRando() {
        
        if(isset($_POST['submitRando'])){
            // Validate Title
            if (empty($_POST['randoTitle'])) {
                Session::addFlash('error',"Le titre est obligatoire.");
                header("Location: index.php?ctrl=home&action=newRando");
                exit;
            } else {
                $randoTitle = filter_input(INPUT_POST, "randoTitle", FILTER_SANITIZE_SPECIAL_CHARS);
                if(strlen($randoTitle) < 10 || strlen($randoTitle) > 255) {
                    Session::addFlash('error',"Le titre doit comporter entre 10 et 255 caractères.");
                    header("Location: index.php?ctrl=home&action=newRando");
                    exit;
                }
            } 
            // Validate subtitle
            if (empty($_POST['randoSubtitle'])) {
                Session::addFlash('error',"L'introduction est obligatoire.");
                header("Location: index.php?ctrl=home&action=newRando");
                exit;
            } else {
                $randoSubtitle = filter_input(INPUT_POST, "randoSubtitle", FILTER_SANITIZE_SPECIAL_CHARS);
                if (strlen($randoSubtitle) < 10 || strlen($randoSubtitle) > 255) {
                    Session::addFlash('error',"L'introduction doit comporter entre 10 et 255 caractères.");
                    header("Location: index.php?ctrl=home&action=newRando");
                    exit;
                } 
            }
            // Validate Date
            if (empty($_POST['dateRando'])) {
                Session::addFlash('error',"La date est obligatoire.");
                header("Location: index.php?ctrl=home&action=newRando");
                exit;
            } else {
                $dateRando = $_POST['dateRando'];
                $dateValid = \DateTime::createFromFormat('Y-m-d', $dateRando);
                if (!$dateValid || $dateValid->format('Y-m-d') !== $dateRando) {
                    Session::addFlash('error',"La date est invalide.");
                    header("Location: index.php?ctrl=home&action=newRando");
                    exit;
                } 
            }
            // Validate Time
            if (empty($_POST['timeRando'])) {
                Session::addFlash('error',"L'heure est obligatoire.");
                header("Location: index.php?ctrl=home&action=newRando");
                exit;
            } else {
                $timeRando = $_POST['timeRando'];
                if (!preg_match("/^(2[0-3]|[01][0-9]):([0-5][0-9])$/", $timeRando)) {
                    Session::addFlash('error',"L'heure est invalide.");
                    header("Location: index.php?ctrl=home&action=newRando");
                    exit;
                }
            }
            // Validate Duration (Days and Hours)
            if (empty($_POST['durationDays']) && empty($_POST['durationHours'])) {
                Session::addFlash('error',"La durée en jours ou en heures est obligatoire.");
                header("Location: index.php?ctrl=home&action=newRando");
                exit;
            } 
            if (!empty($_POST['durationDays'])) {
                // $durationDays = $_POST['durationDays'];
                
                if(!is_numeric($_POST['durationDays']) || $_POST['durationDays'] < 1) {
                    Session::addFlash('error',"La durée en jours est invalide.");
                    header("Location: index.php?ctrl=home&action=newRando");
                    exit;
                }  else {
                    $durationDays = $_POST['durationDays'];
                }
            } else {
                $durationDays = null;
            }
            if(!empty($_POST['durationHours'])) {
                // $durationHours = $_POST['durationHours'];
                
                if(!is_numeric($_POST['durationHours']) || $_POST['durationHours'] < 0 ) {
                    Session::addFlash('error',"La durée en heures est invalide.");
                    header("Location: index.php?ctrl=home&action=newRando");
                    exit;
                } else {
                    $durationHours = $_POST['durationHours'];
                }
            } else {
                $durationHours = null;
            }
            // Validate Distance
            if (empty($_POST['distance'])) {
                Session::addFlash('error',"La distance est obligatoire.");
                header("Location: index.php?ctrl=home&action=newRando");
                exit;
            } elseif(!is_numeric($_POST['distance']) || $_POST['distance'] < 0) {
                Session::addFlash('error',"La distance est invalide.");
                header("Location: index.php?ctrl=home&action=newRando");
                exit;
            } else {
                $distance = $_POST['distance'];
            }
            // Validate Departure
            if (empty($_POST['departure'])) {
                Session::addFlash('error',"Le point de départ est obligatoire.");
                header("Location: index.php?ctrl=home&action=newRando");
                exit;
            } else {
                $departure = filter_input(INPUT_POST, "departure", FILTER_SANITIZE_SPECIAL_CHARS);
                if (strlen($departure) < 5 || strlen($departure) > 255) {
                    Session::addFlash('error',"Le point de départ doit comporter entre 5 et 255 caractères.");
                    header("Location: index.php?ctrl=home&action=newRando");
                    exit;
                }
            }
            // Validate Destination
            if (empty($_POST['destination'])) {
                Session::addFlash('error',"Le point d'arrivée est obligatoire.");
                header("Location: index.php?ctrl=home&action=newRando");
                exit;
            } else {
                $destination = filter_input(INPUT_POST, "destination", FILTER_SANITIZE_SPECIAL_CHARS);
                if (strlen($destination) < 3 || strlen($destination) > 255) {
                    Session::addFlash('error',"Le point d'arrivée doit comporter entre 3 et 255 caractères.");
                    header("Location: index.php?ctrl=home&action=newRando");
                    exit;
                }
            }
            // Validate Description
            if (empty($_POST['description'])){
                Session::addFlash('error',"La description est obligatoire.");
                header("Location: index.php?ctrl=home&action=newRando");
                exit;
            } else {
                $description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_SPECIAL_CHARS);
                if (strlen($description) < 20 || strlen($description) > 1500) {
                    Session::addFlash('error',"La description doit comporter entre 20 et 1500 caractères.");
                    header("Location: index.php?ctrl=home&action=newRando");
                    exit;
                }
            }
            $userId = Session::getUser()->getId();

            if($randoTitle){
                $randoManager = new RandoManager();

                $data = [
                    'title' =>$randoTitle,
                    'subtitle'=>$randoSubtitle,
                    'dateRando'=>$dateRando,
                    'timeRando'=> $timeRando,
                    'durationDays'=>$durationDays,
                    'durationHours'=>$durationHours,
                    'distance'=> $distance,
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
        //   
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
                    "meta_description" => "Search results",
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
            "meta_description" => "Modifier la rando",
            "data" => [
                "rando" => $randoManager->getRandoById($id)
            ]
        ];
        }
    }

    public function modifyRando() {

        if(isset($_POST['updateRando'])) {

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
 
}

 

