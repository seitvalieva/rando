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
     public function getRandoDetails($id) {

        $randoManager = new RandoManager();
        $rando = $randoManager->findOneById($id);

        return [
            "view" => VIEW_DIR."rando/randoDetails.php",
            "meta_description" => "Details de la rando ".$rando,
            "data" => [
                "rando" => $rando,
            ]
        ];

     }





     // create une rando
    
     //
}

 

