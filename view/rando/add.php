<?= $_POST['randoSubtitle'] ?? '' ?>
<?= $_POST['description'] ?? '' ?>
public function addNewRando() {
        // $errors = [];
        if(isset($_POST['submitRando'])){
            // Validate Title
            if (empty($_POST['randoTitle'])) {
                Session::addFlash('error',"Le titre est obligatoire.");
                header("Location: index.php?ctrl=rando&action=addNewRando");
                exit;
            } else {
                $randoTitle = filter_input(INPUT_POST, "randoTitle", FILTER_SANITIZE_SPECIAL_CHARS);
                if(strlen($randoTitle) < 10 || strlen($randoTitle) > 255) {
                    Session::addFlash('error',"Le titre doit comporter entre 10 et 255 caractères.");
                    header("Location: index.php?ctrl=rando&action=addNewRando");
                    exit;
                }
            } 
            // Validate subtitle
            if (empty($_POST['randoSubtitle'])) {
                Session::addFlash('error',"L'introduction est obligatoire.");
                header("Location: index.php?ctrl=rando&action=addNewRando");
                exit;
            } else {
                $randoSubtitle = filter_input(INPUT_POST, "randoSubtitle", FILTER_SANITIZE_SPECIAL_CHARS);
                if (strlen($randoSubtitle) < 10 || strlen($randoSubtitle) > 255) {
                    Session::addFlash('error',"L'introduction doit comporter entre 10 et 255 caractères.");
                    header("Location: index.php?ctrl=rando&action=addNewRando");
                    exit;
                } 
            }
             // Validate Date
            if (empty($_POST['dateRando'])) {
                Session::addFlash('error',"La date est obligatoire.");
                header("Location: index.php?ctrl=rando&action=addNewRando");
                exit;
            } else {
                $dateRando = $_POST['dateRando'];
                $dateValid = \DateTime::createFromFormat('Y-m-d', $dateRando);
                if (!$dateValid || $dateValid->format('Y-m-d') !== $dateRando) {
                    Session::addFlash('error',"La date est invalide.");
                    header("Location: index.php?ctrl=rando&action=addNewRando");
                    exit;
                } 
            }
            // Validate Time
            if (!empty($_POST['timeRando'])) {
                $timeRando = $_POST['timeRando'];
                if (!preg_match("/^(2[0-3]|[01][0-9]):([0-5][0-9])$/", $timeRando)) {
                    Session::addFlash('error',"L'heure est invalide.");
                    header("Location: index.php?ctrl=rando&action=addNewRando");
                    exit;
                }
            }
            // Validate Duration (Days and Hours)
            if (!empty($_POST['durationDays']) && (!is_numeric($_POST['durationDays']) || $_POST['durationDays'] < 1)) {
                Session::addFlash('error',"La durée en jours est invalide.");
                header("Location: index.php?ctrl=rando&action=addNewRando");
                exit;
            } else {
                $durationDays = $_POST['durationDays'];
            }
            if (!empty($_POST['durationHours']) && (!is_numeric($_POST['durationHours']) || $_POST['durationHours'] < 0 )) {
                Session::addFlash('error',"La durée en heures est invalide.");
                header("Location: index.php?ctrl=rando&action=addNewRando");
                exit;
            }else {
                $durationHours = $_POST['durationHours'];
            }
            // Validate Distance
            if (empty($_POST['distance'])) {
                Session::addFlash('error',"La distance est obligatoire.");
                header("Location: index.php?ctrl=rando&action=addNewRando");
                exit;
            } elseif(!is_numeric($_POST['distance']) || $_POST['distance'] < 0) {
                Session::addFlash('error',"La distance est invalide.");
                header("Location: index.php?ctrl=rando&action=addNewRando");
                exit;
            } else {
                $distance = $_POST['distance'];
            }
            // Validate Departure
            if (empty($_POST['departure'])) {
                Session::addFlash('error',"Le point de départ est obligatoire.");
                header("Location: index.php?ctrl=rando&action=addNewRando");
                exit;
            } else {
                $departure = filter_input(INPUT_POST, "departure", FILTER_SANITIZE_SPECIAL_CHARS);
                if (strlen($departure) < 5 || strlen($departure) > 255) {
                    Session::addFlash('error',"Le point de départ doit comporter entre 5 et 255 caractères.");
                    header("Location: index.php?ctrl=rando&action=addNewRando");
                    exit;
                }
            }
            // Validate Destination
            if (empty($_POST['destination'])) {
                Session::addFlash('error',"Le point d'arrivée est obligatoire.");
                header("Location: index.php?ctrl=rando&action=addNewRando");
                exit;
            } else {
                $destination = filter_input(INPUT_POST, "destination", FILTER_SANITIZE_SPECIAL_CHARS);
                if (strlen($destination) < 3 || strlen($destination) > 255) {
                    Session::addFlash('error',"Le point d'arrivée doit comporter entre 3 et 255 caractères.");
                    header("Location: index.php?ctrl=rando&action=addNewRando");
                    exit;
                }
            }
            // Validate Description
            if (empty($_POST['description'])){
                Session::addFlash('error',"La description est obligatoire.");
                header("Location: index.php?ctrl=rando&action=addNewRando");
                exit;
            } else {
                $description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_SPECIAL_CHARS);
                if (strlen($description) < 20 || strlen($description) > 1500) {
                    Session::addFlash('error',"La description doit comporter entre 20 et 1500 caractères.");
                    header("Location: index.php?ctrl=rando&action=addNewRando");
                    exit;
                }
            }
            
            $userId = Session::getUser()->getId();

            if($randoTitle){
                $randoManager = new RandoManager();

                $data = [
                    'title' =>$randoTitle,
                    'subtitle'=>$randoSubtitle,
                    'dateRando'=>$dateRando,
                    'timeRando'=> $timeRando,
                    'durationDays'=>$durationDays,
                    'durationHours'=>$durationHours,
                    'distance'=> $distance,
                    'departure'=>$departure,
                    'destination'=>$destination,
                    'description'=>$description,
                    // 'image' => NULL,
                    'user_id' => $userId
                ];
                // var_dump($data); die();
                $lastInsertRandoId = $randoManager->add($data);

                $subscriptionManager = new SubscriptionManager();
                $data = [
                    'user_id' => $userId,
                    'rando_id' => $lastInsertRandoId
                ];
                $subscriptionManager->add($data);

                if (!empty($_FILES['image']['name'][0])) {
                    // echo "Last Inserted ID: " . $lastInsertRandoId; die();  // For debugging or logging
                    $extensionAllowed = array('jpeg', 'jpg', 'png', 'gif', 'webp');     // array of allowed extensions for images

                    foreach($_FILES['image']['tmp_name'] as $key => $value)  {
                        $fileSize = $_FILES['image']['size'][$key];

                        if ($fileSize > 1048576) {
                            exit('Error: File too large (max 1MB)');
                        }
                        $filename = $_FILES['image']['name'][$key];
                        $filename_tmp = $_FILES['image']['tmp_name'][$key];

                        $extension = pathinfo($filename, PATHINFO_EXTENSION);       // get the extension of the file
                        $fileName = '';
                        if(in_array($extension, $extensionAllowed)) {

                            if(!file_exists('uploads/'.$filename)) {
                                move_uploaded_file($filename_tmp, 'uploads/'.$filename);
                                $fileName = $filename;
                            } else {                                      // if a file with the same name is already exists in the uploads folder
                                $filename = str_replace('.','-', basename($filename, $extension));
                                //add current date and time to make the file name unique and protect personal info
                                $newFilename = $filename.time().".".$extension;
                                move_uploaded_file($filename_tmp, 'uploads/'.$newFilename);
                                $fileName = $newFilename;
                            }

                            // add images info to the database 
                            $imageManager = new ImageManager();
                            $data = [
                                'fileName' =>$fileName,
                                'rando_id' => $lastInsertRandoId
                            ];
                            $imageManager->add($data);
                            //update image name in the rando table
                            $randoManager->addImage($fileName, $lastInsertRandoId);
                        } else {
                            //display error
                        } 
                    } // end foreach

                }
                $this->redirectTo("rando","index");
            }
        }  
        //   
    }