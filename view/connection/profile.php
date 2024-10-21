<?php
    $user = $result["data"]['user']; 

    $created_randos = $result["data"]['created_randos'];
?>
<div class="main__container">
    <h1>Mon compte</h1>

    <section>
        <h2>Mes infos</h2>
        <form action="">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">

        <label for="username">Pseudo</label>
        <input type="text" name="username" id="username" minlength="3" maxlength="20" value="<?= htmlspecialchars($user->getUsername()) ?>" required><br>

        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?= htmlspecialchars($user->getEmail()) ?>" readonly required><br><br>
        <div>
            <a href="index.php?ctrl=security&action=sendForgottenPasswordReset">Changer mot de passe</a><br><br>
        </div>
        <div>
            <a href="" style="color: red">Supprimer mon compte</a>
        </div>
        </form>
    </section>
    <section>
        <h2>Mes randos</h2>
        <div class="main__cards">
            <?php foreach($created_randos as $rando ){ ?>
                <div class="main__card">
                    <a href="index.php?ctrl=rando&action=randoDetails&id=<?= $rando->getId() ?>" target="_blank">
                        <?php if(!empty($rando->getImage())) {?>
                        <img class="main__card-img" src="uploads/<?= $rando->getImage() ?>" alt="Les deux Donons"
                            title="Les deux Donons">
                        <?php } else {?>
                            <img class="main__card-img" src="<?= PUBLIC_DIR ?>/assets/forest-340x200.png" alt="Forêt">
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
            <?php } ?>
        </div>
    </section>
    <section>
        <h2>Mes participations</h2>
        <?php
            foreach($randos as $rando ){
                // var_dump($rando); ?>
                <div class="main__card">
                    <a href="index.php?ctrl=rando&action=randoDetails&id=<?= $rando->getId() ?>" target="_blank">
                        <?php if(!empty($rando->getImage())) {?>
                        <img class="main__card-img" src="uploads/<?= $rando->getImage() ?>" alt="Les deux Donons"
                            title="Les deux Donons">
                        <?php } else {?>
                            <img class="main__card-img" src="<?= PUBLIC_DIR ?>/assets/forest-340x200.png" alt="Forêt">
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
            <?php } ?>
    </section>
</div>