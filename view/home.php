<?php

    $randos = $result["data"]['lastRandos']; // * we initialize a variable allowing us to retrieve what the
                                                // * controller returns to us at the "categories" index of the "data" array
?>
<div class="main__container">
    <!-- ============= FEATURES section ============= -->
    <section class="main__features-container">
        <div class="main__feature-subscription">
            <h2 class="main__feature-subscription-title">Inscrivez-vous gratuitement <br>
                et rejoignez des randos</h2>
            <a href="index.php?ctrl=rando&action=index" class="main__feature-subscription-btn">Consulter nos randos</a>
        </div>
        <!-- ============= SEARCH form ============= -->
        <div class="main__feature-search">
            <form action="index.php?ctrl=rando&action=searchRando" method="POST">
                <h2 class="main__feature-search-label">Rechercher une rando</h2>
                <div class="main__feature-search-container">
                    <input type="search" id="search" name="keyword" placeholder="Rechercher une ville où lieu à visiter" minlength="3" maxlength="20">
                    <input type="submit" name="submitSearch" value="Search" id="main__feature-search-btn">
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
            <?php
                foreach($randos as $rando ){?>
            <div class="main__card">
                <a href="index.php?ctrl=rando&action=randoDetails&id=<?= $rando->getId() ?>" target="_blank">
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