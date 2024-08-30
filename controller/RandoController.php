<?php
namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;

use Model\Managers\RandoManager;
use Model\Managers\UserManager;

class RandoController extends AbstractController implements ControllerInterface {

    // liste des randos 
    public function index() {
        
        $randoManager = new RandoManager();                 // new instance of RandoManager
                            // retrieves the list of all rando using the findAll method of Manager.php (sorted by name)
        $randos = $randoManager->findAll(["title", "ASC"]);

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
     public function randoDetails() {

        $id = (isset($_GET["id"])) ? $_GET["id"] : null;

        $randoManager = new RandoManager();

        return [
            "view" => VIEW_DIR . "rando/randoDetails.php",
            "meta_description" => "Rando Details",
            "data" => [
                "rando" => $randoManager->getRandoById($id),
                
            ]
        ];
     }

     // create une rando
     public function addNewRando() {
        
        $randoManager = new RandoManager();
        
        if(isset($_POST['submitRando'])){

            $randoTitle = filter_input(INPUT_POST, "randoTitle", FILTER_SANITIZE_SPECIAL_CHARS);
            $randoSubtitle = filter_input(INPUT_POST, "randoSubtitle", FILTER_SANITIZE_SPECIAL_CHARS);
            $departure = filter_input(INPUT_POST, "departure", FILTER_SANITIZE_SPECIAL_CHARS);
            $destination = filter_input(INPUT_POST, "arrival", FILTER_SANITIZE_SPECIAL_CHARS);
            $description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_SPECIAL_CHARS);
            $userId = Session::getUser()->getId();

            if($randoTitle){
                $randoManager->add([
                    "title" => $randoTitle,
                    "subtitle" => $randoSubtitle,
                    "dateRando" => $_POST['dateRando'],
                    "timeRando" =>  $_POST['timeRando'],
                    "durationDays" =>  $_POST['durationDays'],
                    "durationHours" =>  $_POST['durationHours'],
                    "distance" =>  $_POST['distance'],
                    "departure" => $departure,
                    "destination" => $destination,
                    "description" => $description,
                    "user_id" => $userId,
                ]);
            }
        }    
        $this->redirectTo("rando","index");
    }
    
     //
}

 

