<?php
$rando = $result["data"]['rando'];

$imagesNames = $result["data"]['imagesNames'];

if(App\Session::getUser()) {
    $isSubscribed = $result["data"]['subscription'];
}
$lastRandos = $result["data"]['lastRandos'];

$participants = $result["data"]['participants'];

?>
<div class="main__container">
    <!-- ================== SEARCH FIELD section ================== -->
    <section class="main__search-form-container">
        <form class="main__search-form" action="index.php?ctrl=rando&action=searchRando" method="POST">
            <input type="search" name="keyword" placeholder="Recherchez par une ville où un lieu à visiter"
                minlength="3" maxlength="20">
            <button type="submit" name="submitSearch"><img src="<?= PUBLIC_DIR ?>/assets/search.svg"
                    alt="Recherche"></button>
        </form>
    </section>
    <!-- ================== RANDO DETAILS section ================== -->
    <section class="main__rando-info-container">
        <h1 class="main__rando-title">
            <?= $rando->getTitle() ?>
        </h1>
        <p class="main__rando-subtitle">
            <?= $rando->getSubtitle() ?>
        </p>

        <div class="main__rando-info">
            <div>
                <!-- SLIDESHOW container -->
                <div class="slideshow-container">
                    <!--3 Images with next/previous buttons -->
                    <?php if(!empty($imagesNames)) {
                             foreach ($imagesNames as $key=> $imageName): ?>

                    <div class="slide fade">
                        <img src="uploads/<?= $imageName->getFileName() ?>" alt="">
                    </div>

                    <?php endforeach ?>
                    <?php } else {?>
                    <div class="slide fade">
                        <img src="<?= PUBLIC_DIR ?>/assets/forest-340x200.png" alt="Forêt" style="width: 100%;">
                    </div>
                    <?php } ?>
                    <!-- Next and previous buttons -->
                    <a class="prev" onclick="changeSlide(-1)">&#10094;</a>
                    <a class="next" onclick="changeSlide(1)">&#10095;</a>
                </div>
                <br>

                <!-- ================== RANDO DETAILS card ================== -->
                <div class="main__rando-info-card">
                    <h2 class="main__rando-info-card-title">Détails de la randonnée</h2>
                    <div class="main__card-details">
                        <p class="main__card-detail">
                            <img src="<?= PUBLIC_DIR ?>/assets/calendar.svg" alt="Calendrier" title="Calendrier">
                            <span><b>Date : </b>
                                <?= date('d-m-Y', strtotime($rando->getDateRando())) ?>
                            </span>
                        </p>
                        <p class="main__card-detail">
                            <img src="<?= PUBLIC_DIR ?>/assets/duration.svg" alt="Calendrier" title="Calendrier">
                            <span><b>Durée estimée : </b><?=$rando->getDurationDays()?> jours&thinsp;
                                <?=$rando->getDurationHours()?>h&nbsp; </span>
                        </p>
                        <p class="main__card-detail">
                            <img src="<?= PUBLIC_DIR ?>/assets/distance.svg" alt="Distance" title="Distance">
                            <span><b>Distance : </b>
                                <?= $rando->getDistance() ?> km
                            </span>
                        </p>
                        <p class="main__card-detail" id="departure">
                            <img src="<?= PUBLIC_DIR ?>/assets/map-pin-fill.svg" alt="Départ" title="Départ">
                            <span><b>Départ : </b>
                                <?= $rando->getDeparture() ?>
                            </span>
                        </p>
                        <p class="main__card-detail" id="destination">
                            <img src="<?= PUBLIC_DIR ?>/assets/map-pin-line.svg" alt="Destination" title="Destination">
                            <span><b>Point(s) d'intérêt : </b>
                                <?= $rando->getDestination() ?>
                            </span>
                        </p>
                    </div>
                </div>
            </div>
            <!-- ================== RANDO AUTHOR INFO and MAP section ================== -->
            <aside class="main__rando-info-aside">
                <div class="main__rando-author-info">
                    <div class="main__rando-author-info-img"><img src="<?= PUBLIC_DIR ?>/assets/person-hiking.svg"
                            alt=""></div>
                    <?php if($rando->getUser()) { ?>
                    <a>
                        <?= $rando->getUser() ?>
                    </a>
                    <?php } else {?>
                    <p>utilisateur supprimé</p>
                    <?php } ?>
                </div>
                <div class="main__rando-info-aside-btn">
                    <?php if(App\Session::getUser()) {
                            if(App\Session::isAdmin()) { ?>
                    <a href="index.php?ctrl=rando&action=modifyRandoForm&id=<?= $rando->getId() ?>"
                        class="nav__menu-link nav__menu-link-cta">Modifier la rando</a>
                    <a href="index.php?ctrl=rando&action=deleteRandoConfirmation&id=<?= $rando->getId() ?>"
                        class="nav__menu-link nav__menu-link-cta">Supprimer la rando</a>
                    <?php } 
                            // if connected user is not the one who created the rando, he can participate
                            elseif(App\Session::getUser() != $rando->getUser()) { ?>
                    <!-- the Paprticipate btn is displayed if rando hasn't passed yet /current date less or = than rando date -->
                    <?php if(strtotime(date('Y-m-d')) <= strtotime($rando->getDateRando())) {?>
                    <?php if(!$isSubscribed){ ?>
                    <a href="index.php?ctrl=subscription&action=participationCheck&id=<?= $rando->getId() ?>"
                        class="nav__menu-link nav__menu-link-cta">Participer à la rando</a>
                    <?php } else {?>
                    <a href="index.php?ctrl=subscription&action=cancelParticipationModal&id=<?= $rando->getId() ?>"
                        class="nav__menu-link nav__menu-link-cta">Ne plus y participer</a>
                    <?php } ?>
                    <?php } else {?>
                    <p>Rando est déjà passée</p>
                    <?php } ?>
                    <?php } elseif(App\Session::isAdmin()) {?>
                    <?php } else {?>
                    <!-- user who created the rando can modify/delete it  -->
                    <a href="index.php?ctrl=rando&action=modifyRandoForm&id=<?= $rando->getId() ?>"
                        class="nav__menu-link nav__menu-link-cta">Modifier la rando</a>
                    <a href="index.php?ctrl=rando&action=deleteRandoConfirmation&id=<?= $rando->getId() ?>"
                        class="nav__menu-link nav__menu-link-cta">Supprimer la rando</a>
                    <?php } ?>
                    <?php } else {?>
                    <!-- if user is not logged in -->
                    <?php if(strtotime(date('Y-m-d')) <= strtotime($rando->getDateRando())) {?>
                    <a href="index.php?ctrl=security&action=login" class="nav__menu-link nav__menu-link-cta">Participer
                        à la rando</a>
                    <?php } else {?>
                    <p>Rando est déjà passée</p>
                    <?php } ?>
                    <?php } ?>
                </div>
                <!-- ================== RANDO MAP and WEATHER================== -->
                <div class="main_rando-map-card">
                    <h2 class="main_rando-map-card-title">Carte de la randonnée</h2>
                    <img src="<?= PUBLIC_DIR ?>/assets/map_tracking_ballon_d'Alsace.jpg" alt="Carte"
                        style="width: 456px; height: 270px;">
                </div>
                <!-- weather info section for depart point -->
                <div id="weather-info"></div>
                <!-- List of participnts section displayed for the author of the randonnee -->
                <?php if(App\Session::getUser() == $rando->getUser()) { ?>
                <div>
                    <h2>Liste des participants</h2>
                    <?php if($participants) { ?>
                    <ul>
                        <?php foreach($participants as $participant) ?>
                        <li>
                            <?= $participant->getUser()->getUsername() ?>
                        </li>
                    </ul>
                    <?php } ?>
                </div>
                <?php } ?>
            </aside>
        </div>
        <!-- ================== RANDO DESCRIPTION section ================== -->
        <article class="main__rando-description">
            <h2 class="main__rando-description-title">Description de la randonnée</h2>
            <div class="main__rando-description-text">
                <p>
                    <?= $rando->getDescription() ?>
                </p>
            </div>
        </article>
    </section>

    <!-- ================== LES DERNIERES RANDOS section ================== -->
    <section class="main__cards-container">
        <div class="main__cards-container-heading">
            <h1 class="main__cards-container-title">Les dernières randonnées</h1>
            <p class="main__cards-container-arrow"><a href="index.php?ctrl=rando&action=index">Voir tous ➔</a></p>
        </div>
        <div class="main__cards">
            <?php foreach($lastRandos as $lastRando ){?>
            <div class="main__card">
                <a href="index.php?ctrl=rando&action=randoDetails&id=<?= $rando->getId() ?>" target="_blank">
                    <?php if(!empty($lastRando->getImage())) {?>
                    <img class="main__card-img" src="uploads/<?= $lastRando->getImage() ?>" alt="Les deux Donons"
                        title="Les deux Donons">
                    <?php } else {?>
                    <img class="main__card-img" src="<?= PUBLIC_DIR ?>/assets/forest-340x200.png" alt="Forêt">
                    <?php } ?>
                </a>
                <div class="main__card-details">
                    <h3 class="main__card-title">
                        <a href="index.php?ctrl=rando&action=randoDetails&id=<?= $lastRando->getId() ?>"
                            target="_blank">
                            <?= $lastRando->getTitle() ?>
                        </a>
                    </h3>
                    <p class="main__card-detail">
                        <img src="<?= PUBLIC_DIR ?>/assets/calendar.svg" alt="Calendrier" title="Calendrier">
                        <span><b>Date : </b>
                            <?= date('d-m-Y', strtotime($lastRando->getDateRando())) ?>
                        </span>
                    </p>
                    <p class="main__card-detail">
                        <img src="<?= PUBLIC_DIR ?>/assets/distance.svg" alt="Distance" title="Distance">
                        <span><b>Distance : </b>
                            <?= $lastRando->getDistance() ?> km
                        </span>
                    </p>
                    <p class="main__card-detail">
                        <img src="<?= PUBLIC_DIR ?>/assets/map-pin-fill.svg" alt="Départ" title="Départ">
                        <span><b>Départ : </b>
                            <?= $lastRando->getDeparture() ?>
                        </span>
                    </p>
                    <p class="main__card-detail">
                        <img src="<?= PUBLIC_DIR ?>/assets/map-pin-line.svg" alt="Destination" title="Destination">
                        <span><b>Points d'intérêt : </b>
                            <?= $lastRando->getDestination() ?>
                        </span>
                    </p>
                </div>
            </div>
            <?php } ?>
        </div>
    </section>
</div>

<script src="<?= PUBLIC_DIR ?>/js/main.js"></script>