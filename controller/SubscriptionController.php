<?php
namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;

use Model\Managers\RandoManager;
use Model\Managers\UserManager;

class SubscriptionController extends AbstractController implements ControllerInterface {



public function participate() {

    if(isset($_POST['submitParticipation']) && isset($_POST["agreeToRules"])) {

        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
        $userId = Session::getUser()->getId();

        if($username && $email) {

            $subscriptionManager = new SubscriptionManager();

        }
        return [
            "view" => VIEW_DIR."rando/participation.php",
            "meta_description" => "Participer à la rando"
        ];
    }
}
}