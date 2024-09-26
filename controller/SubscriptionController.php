<?php
namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;

use Model\Managers\RandoManager;
use Model\Managers\UserManager;
use Model\Managers\SubscriptionManager;

class SubscriptionController extends AbstractController implements ControllerInterface {



public function participateForm() {
    
    return [
        "view" => VIEW_DIR."rando/participation.php",
        "meta_description" => "Participer à la rando"
    ];
}
public function participate($id) {

    if(isset($_POST['submitParticipation']) && isset($_POST["agreeToRules"])) {

        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
        $userId = Session::getUser()->getId();

        $subscriptionManager = new SubscriptionManager();
        
        $user = $subscriptionManager->checkUserSubscribed($userId, $id);
        // var_dump($user); die();

        if($user) {
            die("Already subscribed!");
        }

        if($username && $email) {

            $data = [
                'user_id' => $userId,
                'rando_id' => $id
            ];
            $subscriptionManager->add($data);
        }
        $this->redirectTo("rando","index");
    }
    
}
}

