<?php
namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;

use Model\Managers\RandoManager;

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

        // $this->restrictTo("admin");

        if(isset($_POST['submit'])){

            
        }
         
    }
     //
}

 

