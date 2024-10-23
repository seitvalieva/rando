<?php
  
    $participations = $result["data"]['participations'];
?>
<div class="main__container">

        <h2>Mes participations aux randos</h2>
        <div class="main__cards">
            <?php if($participations) {
            foreach($participations as $participation ){ ?>
                <div class="main__card">
                    <a href="index.php?ctrl=rando&action=randoDetails&id=<?= $participation->getRando()->getId() ?>" target="_blank">
                        <?php if(!empty($participation->getRando()->getImage())) {?>
                        <img class="main__card-img" src="uploads/<?= $participation->getRando()->getImage() ?>" alt="<?= $participation->getRando()->getTitle() ?>"
                            title="<?= $participation->getRando()->getTitle() ?>">
                        <?php } else {?>
                            <img class="main__card-img" src="<?= PUBLIC_DIR ?>/assets/forest-340x200.png" alt="Forêt">
                        <?php } ?>
                    </a>
                    <div class="main__card-details">
                        <h3 class="main__card-title">
                            <a href="index.php?ctrl=rando&action=randoDetails&id=<?= $participation->getRando()->getId() ?>" target="_blank">
                                <?= $participation->getRando()->getTitle() ?>
                            </a>
                        </h3>
                        <p class="main__card-detail">
                            <img src="<?= PUBLIC_DIR ?>/assets/calendar.svg" alt="Calendrier" title="Calendrier">
                            <span>
                                <?= date('d-m-Y', strtotime($participation->getRando()->getDateRando())) ?>
                            </span>
                        </p>
                        <p class="main__card-detail">
                            <img src="<?= PUBLIC_DIR ?>/assets/distance.svg" alt="Distance" title="Distance">
                            <span>
                                <?= $participation->getRando()->getDistance() ?>
                            </span>
                        </p>
                        <p class="main__card-detail">
                            <img src="<?= PUBLIC_DIR ?>/assets/map-pin-fill.svg" alt="Départ" title="Départ">
                            <span>
                                <?= $participation->getRando()->getDeparture() ?>
                            </span>
                        </p>
                        <p class="main__card-detail">
                            <img src="<?= PUBLIC_DIR ?>/assets/map-pin-line.svg" alt="Destination" title="Destination">
                            <span>
                                <?= $participation->getRando()->getDestination() ?>
                            </span>
                        </p>
                    </div>
                </div>           
            <?php } ?>
            <?php } else {?>
                <p>Vous ne vous êtes pas encore inscrit.e aux randos</p>
            <?php } ?>
        </div>
    
</div>