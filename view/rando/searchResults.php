<?php
$randos = $result["data"]['randos'];
?>

<div class="main__container">
    <h1>Les randonnées autour de
        <?php echo htmlspecialchars($_POST['keyword']); ?>
    </h1>

    <?php if (!empty($randos)): ?>
        <div class="main__cards">
            <?php foreach ($randos as $rando): ?>
                <div class="main__card">
                    <a href="index.php?ctrl=rando&action=randoDetails&id=<?= $rando->getId() ?>" target="_blank">
                        <?php if(!empty($rando->getImage())) {?>
                        <img class="main__card-img" src="uploads/<?= $rando->getImage() ?>" alt="Les deux Donons"
                            title="Les deux Donons">
                        <?php } else {?>
                            <img class="main__card-img" src="<?= PUBLIC_DIR ?>/assets/forest-340x200.png" alt="">
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
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>No results found.</p>
    <?php endif; ?>

</div>