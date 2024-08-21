<?php

    $randos = $result["data"]['randos']; // * we initialize a variable allowing us to retrieve what the
                                                // * controller returns to us at the "categories" index of the "data" array
?>
<br>
<h1>Liste des randos</h1>
<br>
<?php
foreach($randos as $rando ){

    var_dump($rando); ?>

    <!-- <p><a href="index.php?ctrl=rando&action=randoDetails&id=<?= $rando->getId() ?>"><?= $rando->getTitle() ?></a></p> -->
    
    <p>
        <!-- <a href=""></a> -->
    </p>
<?php } ?>