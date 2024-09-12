<?php
namespace App;

define('DS', DIRECTORY_SEPARATOR);      // the folder separator character (/ or \), the best  portability across different systems.

define('BASE_DIR', dirname(__FILE__).DS);
define('VIEW_DIR', BASE_DIR."view/");   // the path to  the views
define('PUBLIC_DIR', "public/");        // the path where public files (CSS, JS, IMG) are located

define('DEFAULT_CTRL', 'Home');         // default controller name
define('ADMIN_MAIL', "admin@gmail.com"); // admin's email

require("app/Autoloader.php");
Autoloader::register();

session_start();                        // starts a session or retrieves the current session
use App\Session as Session;             // we integrate the Session class which takes control of the messages in session

//---------HTTP REQUEST INTERCEPTED
$ctrlname = DEFAULT_CTRL;               // we take the default controller example: index.php?ctrl=home
if(isset($_GET['ctrl'])){
    $ctrlname = $_GET['ctrl'];
}
$ctrlNS = "controller\\".ucfirst($ctrlname)."Controller"; // we build the namespace of the Controller class to call

//we check that the namespace points to a class that exists
if(!class_exists($ctrlNS)){
    //if this is not the case, we choose the namespace of the default Controller
    $ctrlNS = "controller\\".DEFAULT_CTRL."Controller";
}
$ctrl = new $ctrlNS();

$action = "index";                      // default action of any Controller

//if the action is present in the url AND the corresponding method exists in the ctrl
if(isset($_GET['action']) && method_exists($ctrl, $_GET['action'])){
    //the method to call will be the one in the url
    $action = $_GET['action'];
}
if(isset($_GET['id'])){
    $id = $_GET['id'];
}
else $id = null;            
$result = $ctrl->$action($id);             // example: HomeController->users(null)
// ==============token========================//
if(isset($_GET['token'])){
    $token = $_GET['token'];
}
else $token = null;            
$result = $ctrl->$action($token);


/*--------LOADING PAGE--------*/
if($action == "ajax"){                     //if the action was ajax
    // we directly display the return of the controller (i.e. the HTTP response will only be this one)
    echo $result;
}
else{
    ob_start();                             //opens a buffer in which all output is stored.(tampon de sortie = output buffer)
    $meta_description = $result['meta_description'];

    include($result['view']);           // the view is inserted into the buffer which must be emptied in the middle of the layout
     
    $page = ob_get_contents();              // we place this display in a variable 
    
    ob_end_clean();                         // we clear the buffer */
    
    include VIEW_DIR."layout.php";          // we display the main template (layout)
}