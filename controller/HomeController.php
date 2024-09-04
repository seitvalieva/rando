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
            "meta_description" => "Page d'accueil",
            "data" => [
                "lastRandos" => $lastRandos
            ]
        ];
    }

    // new Rando
    public function newRando() {

        return [
            "view" => VIEW_DIR."rando/newRando.html",
            "meta_description" => "Nouvelle Rando"
        ];
    }
        
    // public function users(){
    //     $this->restrictTo("ROLE_USER");

    //     $manager = new UtilisateurManager();
    //     $users = $manager->findAll(['register_date', 'DESC']);

    //     return [
    //         "view" => VIEW_DIR."security/users.php",
    //         "meta_description" => "Liste des utilisateurs du forum",
    //         "data" => [ 
    //             "utilisateurs" => $users 
    //         ]
    //     ];
    // }
}