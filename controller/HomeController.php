<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\UserManager;
use Model\Managers\RandoManager;

class HomeController extends AbstractController implements ControllerInterface {

    public function index(){

        $randoManager = new RandoManager();
        $lastRandos = $randoManager->findAll(["dateRando", "DESC"], 9);
      
        return [
            "view" => VIEW_DIR."home.php",
            "meta_description" => "Randonnées guidées et programmées en Alsace",
            "title" => "Accueil",
            "data" => [
                "lastRandos" => $lastRandos
            ]
        ];
    }
    
}