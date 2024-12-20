<?php

    $randos = $result["data"]['randos']; //  we initialize a variable allowing us to retrieve what the
                                                //  controller returns to us at the "categories" index of the "data" array
?>
<div class="main__container">
    <section class="main__cards-container">
        <div class="main__cards-container-heading">
            <h1 class="main__cards-container-title">Les dernières randonnées</h1>
        </div>
        <div class="main__cards">
            <?php if($randos) {
            foreach($randos as $rando ){
                // var_dump($rando); ?>
                <div class="main__card">
                    <a href="index.php?ctrl=rando&action=randoDetails&id=<?= $rando->getId() ?>" target="_blank">
                        <?php if(!empty($rando->getImage())) {?>
                        <img class="main__card-img" src="uploads/<?= $rando->getImage() ?>" alt="<?= $rando->getTitle() ?>"
                            title="<?= $rando->getTitle() ?>">
                        <?php } else {?>
                            <img class="main__card-img" src="<?= PUBLIC_DIR ?>/assets/forest-340x200.webp" alt="<?= $rando->getTitle() ?>">
                        <?php } ?>
                    </a>
                    <div class="main__card-details">
                        <h3 class="main__card-title">
                            <a href="index.php?ctrl=rando&action=randoDetails&id=<?= $rando->getId() ?>" target="_blank">
                                <?= $rando->getTitle() ?>
                            </a>
                        </h3>
                        <p class="main__card-detail">
                            <img src="<?= PUBLIC_DIR ?>/assets/calendar.svg" alt="Calendrier" title="Calendrier">
                            <span><b>Date : </b>
                                <?= date('d-m-Y', strtotime($rando->getDateRando())) ?>
                            </span>
                        </p>
                        <p class="main__card-detail">
                            <img src="<?= PUBLIC_DIR ?>/assets/distance.svg" alt="Distance" title="Distance">
                            <span><b>Distance : </b>
                                <?= $rando->getDistance() ?>
                            </span>
                        </p>
                        <p class="main__card-detail">
                            <img src="<?= PUBLIC_DIR ?>/assets/map-pin-fill.svg" alt="Départ" title="Départ">
                            <span><b>Départ : </b>
                                <?= $rando->getDeparture() ?>
                            </span>
                        </p>
                        <p class="main__card-detail">
                            <img src="<?= PUBLIC_DIR ?>/assets/map-pin-line.svg" alt="Destination" title="Destination">
                            <span><b>Points d'intérêt : </b>
                                <?= $rando->getDestination() ?>
                            </span>
                        </p>
                    </div>
                </div>           
            <?php } ?>
            <?php } ?>
        </div>
    </section>
</div>
