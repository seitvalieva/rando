<?php
namespace Controller;

use App\AbstractController;
use App\Session;

use Model\Managers\UserManager;
use Model\Managers\RandoManager;
use Model\Managers\ImageManager;
use Model\Managers\SubscriptionManager;

class AdminController extends AbstractController {

    public function index() {

        return [
            "view" => VIEW_DIR."admin/dashboard.php",
            "meta_description" => "Panel d'administrateur",
            "title" => "Panel d'administrateur"
        ];
    }

    public function listUsers() {

        $userManager = new UserManager();
        $users = $userManager->findAll(["id_user", "ASC"]);

        return [
            "view" => VIEW_DIR."admin/listUsers.php",
            "meta_description" => "Liste des utilisateurs",
            "title" => "Liste des utilisateurs",

            "data" => [

                "users" => $users
            ]
        ];
    }

    public function allRandos() {

        $randoManager = new RandoManager(); 
        $randos = $randoManager->findAll(["dateRando", "DESC"]);

        return [
            "view" => VIEW_DIR."admin/allRandos.php",
            "meta_description" => "Liste des randonnées",
            "title" => "Liste des randonnées",
            "data" => [
                "randos" => $randos
            ]
        ];
    }
    public function deleteUser() {

        
        $uid = intval($_GET["id"]);
        $user = Session::getUser();
        // echo $uid; die();
        if($user && $user->hasRole("ROLE_ADMIN")) {
           
            $userManager = new UserManager();
            $userManager->delete($uid);

            header("Location: index.php");
            exit;
        }
        


    }
}


