<?php

    $randos = $result["data"]['lastRandos']; // * we initialize a variable allowing us to retrieve what the
                                                // * controller returns to us at the "categories" index of the "data" array
?>
<div class="main__container">
    <!-- ============= FEATURES section ============= -->
    <section class="main__features-container">
        <div class="main__feature-subscription">
            <h2 class="main__feature-subscription-title">Découvrez et rejoignez<br>nos randonnées</h2> 
            <a href="index.php?ctrl=rando&action=index" class="main__feature-subscription-btn">Consulter nos randonnées</a>
        </div>
        <!-- ============= SEARCH form ============= -->
        <div class="main__feature-search">
            <form action="index.php?ctrl=rando&action=searchRando" method="POST">
                <h2 class="main__feature-search-label">Rechercher une randonnée</h2>
                <div class="main__feature-search-container">
                    <input type="search" id="search" name="keyword" placeholder="Rechercher une ville où lieu à visiter" minlength="3" maxlength="20">
                </div>
            </form>
        </div>
    </section>
    <!-- ============= LES DERNIERES RANDOS section ============= -->
    <section class="main__cards-container">
        <div class="main__cards-container-heading">
            <h1 class="main__cards-container-title">Les dernières randonnées</h1>
            <p class="main__cards-container-arrow"><a href="index.php?ctrl=rando&action=index">Voir tous ➔</a></p>
        </div>
        <div class="main__cards">
        <?php if($randos) { 
            foreach($randos as $rando ){?>
            <div class="main__card">
                <!-- target="_blank" -->
                <a href="index.php?ctrl=rando&action=randoDetails&id=<?= $rando->getId() ?>" >
                    <?php if(!empty($rando->getImage())) {?>
                    <img class="main__card-img" src="uploads/<?= $rando->getImage() ?>" alt="<?= $rando->getTitle() ?>"
                        title="Les deux Donons">
                    <?php } else {?>
                        <img class="main__card-img" src="<?= PUBLIC_DIR ?>/assets/forest-340x200.png" alt="Forêt">
                    <?php } ?>
                </a>
                <div class="main__card-details">
                    <h3 class="main__card-title">
                        <a href="index.php?ctrl=rando&action=randoDetails&id=<?= $rando->getId() ?>">
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
                            <?= $rando->getDistance() ?> km
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
    
    <!-- COOKIE -->
    <div class="cookieBox">
        <div class="cookie-header">
            <i class="bx bx-cookie"></i>
            <h2>Vos paramètres de cookies</h2>
        </div>
        <div class="cookie-data">
            <p>Nous utilisons des cookies, y compris des cookies de nos partenaires, afin d’améliorer votre expérience
                utilisateur, d’analyser le trafic de notre site, vous proposer des publicités personnalisées sur des
                sites tiers et vous proposer des fonctionnalités disponibles sur les réseaux sociaux. Vous pouvez gérer
                à tout moment vos préférences dans les paramétrages des cookies. Pour en savoir plus sur la manière dont
                nos partenaires et nous-mêmes utilisons vos données personnelles consultez notre <a href="#">Politique
                    de confidentialité</a></p>
        </div>
        <div class="cookie-btns">
            <button class="cookie-btn" id="acceptBtn">Accepter</button>
            <button class="cookie-btn" id="declineBtn">Refuser</button>
        </div>
    </div>

</div>