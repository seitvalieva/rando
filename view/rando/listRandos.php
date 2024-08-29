<?php

    $randos = $result["data"]['randos']; // * we initialize a variable allowing us to retrieve what the
                                                // * controller returns to us at the "categories" index of the "data" array
?>
<div class="main__container">
    <section class="main__cards-container">
        <div class="main__cards-container-heading">
            <h1 class="main__cards-container-title">Les dernières randonnées</h1>
        </div>
        <div class="main__cards">
            <?php
            foreach($randos as $rando ){
                // var_dump($rando); ?>
                <div class="main__card">
                    <a href="" target="_blank">
                        <img class="main__card-img" src="<?= PUBLIC_DIR ?>/assets/forest-340x200.png" alt="Les deux Donons"
                            title="Les deux Donons">
                    </a>
                    <div class="main__card-details">
                        <h3 class="main__card-title">
                            <a href="index.php?ctrl=rando&action=randoDetails&id=<?= $rando->getId() ?>" target="_blank">
                                <?= $rando->getTitle() ?>
                            </a>
                        </h3>
                        <p class="main__card-detail">
                            <img src="<?= PUBLIC_DIR ?>/assets/calendar.svg" alt="Calendrier" title="Calendrier">
                            <span>
                                <?= $rando->getDateRando() ?>
                            </span>
                        </p>
                        <p class="main__card-detail">
                            <img src="<?= PUBLIC_DIR ?>/assets/distance.svg" alt="Distance" title="Distance">
                            <span>
                                <?= $rando->getDistance() ?>
                            </span>
                        </p>
                        <p class="main__card-detail">
                            <img src="<?= PUBLIC_DIR ?>/assets/map-pin-fill.svg" alt="Départ" title="Départ">
                            <span>
                                <?= $rando->getDeparture() ?>
                            </span>
                        </p>
                        <p class="main__card-detail">
                            <img src="<?= PUBLIC_DIR ?>/assets/map-pin-line.svg" alt="Destination" title="Destination">
                            <span>
                                <?= $rando->getDestination() ?>
                            </span>
                        </p>
                    </div>
                </div>
            
            <?php } ?>
        </div>
    </section>
</div>
