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
            "meta_description" => "Participer à la rando"
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
            $this->redirectTo("rando","index");
        }
        
    }

    public function cancelParticipationModal($id) {
        
        $userId = Session::getUser()->getId();

        $subscriptionManager = new SubscriptionManager();
        $isSubscribed = $subscriptionManager->checkUserSubscribed($userId, $id);

        if($isSubscribed) {
            header("Location: index.php?ctrl=subscription&action=cancelParticipation&id=".$id); 
            exit; 
        } else {
            Session::addFlash('error',"S'enregistrez pour participer");
            header("Location: index.php?ctrl=subscription&action=participateForm&id=".$id);
            exit;
        }
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

