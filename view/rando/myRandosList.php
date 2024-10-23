<?php
    $created_randos = $result["data"]['created_randos'];
?>
<div class="main__container">
<h2><a href="">Mes randos publiées</a></h2>
        <div class="main__cards">
            <?php if($created_randos) {
            foreach($created_randos as $created_rando ){ ?>
                <div class="main__card">
                    <a href="index.php?ctrl=rando&action=randoDetails&id=<?= $created_rando->getId() ?>" target="_blank">
                        <?php if(!empty($created_rando->getImage())) {?>
                        <img class="main__card-img" src="uploads/<?= $created_rando->getImage() ?>" alt="<?= $created_rando->getTitle() ?>"
                            title="<?= $created_rando->getTitle() ?>">
                        <?php } else {?>
                            <img class="main__card-img" src="<?= PUBLIC_DIR ?>/assets/forest-340x200.png" alt="Forêt">
                        <?php } ?>
                    </a>
                    <div class="main__card-details">
                        <h3 class="main__card-title">
                            <a href="index.php?ctrl=rando&action=randoDetails&id=<?= $created_rando->getId() ?>" target="_blank">
                                <?= $created_rando->getTitle() ?>
                            </a>
                        </h3>
                        <p class="main__card-detail">
                            <img src="<?= PUBLIC_DIR ?>/assets/calendar.svg" alt="Calendrier" title="Calendrier">
                            <span>
                                <?= date('d-m-Y', strtotime($created_rando->getDateRando())) ?>
                            </span>
                        </p>
                        <p class="main__card-detail">
                            <img src="<?= PUBLIC_DIR ?>/assets/distance.svg" alt="Distance" title="Distance">
                            <span>
                                <?= $created_rando->getDistance() ?>
                            </span>
                        </p>
                        <p class="main__card-detail">
                            <img src="<?= PUBLIC_DIR ?>/assets/map-pin-fill.svg" alt="Départ" title="Départ">
                            <span>
                                <?= $created_rando->getDeparture() ?>
                            </span>
                        </p>
                        <p class="main__card-detail">
                            <img src="<?= PUBLIC_DIR ?>/assets/map-pin-line.svg" alt="Destination" title="Destination">
                            <span>
                                <?= $created_rando->getDestination() ?>
                            </span>
                        </p>
                    </div>
                </div>           
            <?php } ?>
            <?php } else {?>
                <p>Vous n'avez aucune randonée publiée</p>
            <?php } ?>
        </div>
</div>