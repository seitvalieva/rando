<?php
namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;

use Model\Managers\RandoManager;
use Model\Managers\UserManager;
use Model\Managers\SubscriptionManager;

class SubscriptionController extends AbstractController implements ControllerInterface {

    public function participationCheck($id) {

        $userId = Session::getUser()->getId();

        $subscriptionManager = new SubscriptionManager();
        $isSubscribed = $subscriptionManager->checkUserSubscribed($userId, $id);

        if($isSubscribed) {
            die("Already subscribed!");
        } else {
            header("Location: index.php?ctrl=subscription&action=participateForm&id=".$id); 
            exit;
        }
    }

    public function participateForm() {
        
        return [
            "view" => VIEW_DIR."rando/participation.php",
            "meta_description" => "Participation à la rando",
            "title" => "Formulaire de participation à la rando"
        ];
    }
    public function participate($id) {

        if(isset($_POST['submitParticipation']) && isset($_POST["agreeToRules"])) {

            $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = Session::getUser()->getEmail();
            $userId = Session::getUser()->getId();

            $subscriptionManager = new SubscriptionManager();
            
            $isSubscribed = $subscriptionManager->checkUserSubscribed($userId, $id);
            // var_dump($user); die();

            if($isSubscribed) {
                die("Already subscribed!");
            }

            if($username && $email) {

                $data = [
                    'user_id' => $userId,
                    'rando_id' => $id
                ];
                $subscriptionManager->add($data);
            }
            $this->redirectTo("subscription","participationConfirmation");
        }
        
    }
    public function participationConfirmation() {
        return [
            "view" => VIEW_DIR."rando/participationConfirmation.php",
            "meta_description" => "Confirmation de participation à la rando",
            "title" => "Confirmation de participation à la rando"
        ];
    }
    public function cancelParticipationModal($id) {
        
        return [
            "view" => VIEW_DIR."rando/cancelParticipation.php",
            "meta_description" => "Annulation de participation à la rando",
            "title" => "Annulation de participation à la rando"
        ];
    }

    public function cancelParticipation($id) {

        if(isset($_POST['cancelParticipation'])) {
            
            $userId = Session::getUser()->getId();

            $subscriptionManager = new SubscriptionManager();
            $isSubscribed = $subscriptionManager->checkUserSubscribed($userId, $id);
            // var_dump($user);die();
            if($isSubscribed) {
                $subscriptionManager->deleteParticipation($userId, $id);

                header("Location: index.php?ctrl=rando&action=randoDetails&id=".$id);
                exit;
            }
        }
    }

}

