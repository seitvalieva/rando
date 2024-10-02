<?php
$rando = $result["data"]['rando'];

$imagesNames = $result["data"]['imagesNames']

?>
<div class="main__container">
            <!-- ================== SEARCH FIELD section ================== -->
            <section class="main__search-form-container">
                <form class="main__search-form" action="index.php?ctrl=rando&action=searchRando" method="POST">
                    <input type="search"  name="keyword" placeholder="Rechercher une ville où lieu à visiter" minlength="3" maxlength="20">
                    <button type="submit" name="submitSearch"><img src="<?= PUBLIC_DIR ?>/assets/search.svg" alt="Recherche"></button>
                </form>
            </section>
            <!-- ================== RANDO DETAILS section ================== -->
            <section class="main__rando-info-container">
                <h1 class="main__rando-title"><?= $rando->getTitle() ?></h1>
                <p class="main__rando-subtitle"><?= $rando->getSubtitle() ?></p>
                
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
                                    <img src="<?= PUBLIC_DIR ?>/assets/forest-340x200.png" alt="" style="width: 100%;">
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
                                    <span><b>Date : </b><?= $rando->getDateRando() ?></span>
                                </p>
                                <p class="main__card-detail">
                                    <img src="<?= PUBLIC_DIR ?>/assets/duration.svg" alt="Calendrier" title="Calendrier">
                                    <span><b>Durée estimée : </b> jours&thinsp;h&nbsp; </span>
                                </p>
                                <p class="main__card-detail">
                                    <img src="<?= PUBLIC_DIR ?>/assets/distance.svg" alt="Distance" title="Distance">
                                    <span><b>Distance : </b><?= $rando->getDistance() ?> km</span>
                                </p>
                                <p class="main__card-detail">
                                    <img src="<?= PUBLIC_DIR ?>/assets/map-pin-fill.svg" alt="Départ" title="Départ">
                                    <span><b>Départ : </b><?= $rando->getDeparture() ?></span>
                                </p>
                                <p class="main__card-detail">
                                    <img src="<?= PUBLIC_DIR ?>/assets/map-pin-line.svg" alt="Destination" title="Destination">
                                    <span><b>Arrivée : </b><?= $rando->getDestination() ?></span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- ================== RANDO AUTHOR INFO and MAP section ================== -->
                    <aside class="main__rando-info-aside">
                        <div class="main__rando-author-info">
                            <div class="main__rando-author-info-img"><img src="<?= PUBLIC_DIR ?>/assets/person-hiking.svg" alt=""></div>
                            <a ><?= $rando->getUser() ?></a>
                        </div>
                        <div class="main__rando-info-aside-btn">
                        <?php if(App\Session::getUser() != $rando->getUser()){ ?>
                            <a href="index.php?ctrl=subscription&action=participateForm&id=<?= $rando->getId() ?>" class="nav__menu-link nav__menu-link-cta">Participer à la rando</a>
                            
                        <?php } else {?>
                            <a href="index.php?ctrl=subscription&action=modifyRando&id=<?= $rando->getId() ?>" class="nav__menu-link nav__menu-link-cta">Modifier la rando</a>
                            <a href="index.php?ctrl=security&action=deleteModal&id=<?= $rando->getId() ?>" class="nav__menu-link nav__menu-link-cta">Supprimer la rando</a>
                            <?php } ?>
                        </div>
                        <!-- ================== RANDO MAP ================== -->
                        <div class="main_rando-map-card">
                            <h2 class="main_rando-map-card-title">Carte de la randonnée</h2>
                            <img src="<?= PUBLIC_DIR ?>/assets/map_tracking_ballon_d'Alsace.jpg" alt="Carte"
                                style="width: 456px; height: 270px;">
                        </div>
                    </aside>
                </div>
                <!-- ================== RANDO DESCRIPTION section ================== -->
                <article class="main__rando-description">
                    <h2 class="main__rando-description-title">Description de la randonnée</h2>
                    <div class="main__rando-description-text">
                        <p><?= $rando->getDescription() ?></p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sodales eu turpis ac vulputate.
                            Vivamus quis risus sit amet neque pellentesque tristique. Nulla rhoncus nulla iaculis tortor
                            convallis, ac auctor arcu aliquet. Fusce commodo sapien eget risus euismod, tempus dignissim
                            risus hendrerit. </p><br>
                        <p>Sed vehicula enim est, eu tristique ligula malesuada non. Sed tempus, lorem ut tempor bibendum,
                            lacus velit dictum dui, et sodales ipsum tortor ut lectus. Morbi vitae purus risus. Nulla
                            dignissim faucibus egestas. Aliquam sagittis efficitur lorem. Integer lectus urna, ultrices sed
                            eros sit amet, vestibulum mollis est.</p><br>
                        <p>Vestibulum eget turpis dolor. Sed rhoncus tristique risus eget egestas. Quisque nec orci arcu.
                            Pellentesque condimentum eleifend urna accumsan rutrum. Sed fermentum placerat diam, at porta
                            lorem pulvinar quis. Nulla ullamcorper imperdiet tristique. </p><br>
                        <p>Pellentesque dignissim urna a eleifend porttitor. Donec consequat orci eget semper malesuada. In
                            eget leo nisl. Quisque id nulla vel dui viverra congue. Donec nisi magna, semper vel mattis sed,
                            accumsan vel metus. Praesent velit ex, aliquet nec nulla eu, convallis blandit turpis. </p><br>
                        <p>
                            Duis sit amet nulla non libero pellentesque mattis hendrerit id velit. Morbi sit amet nisi
                            cursus, tempor magna eu, pharetra ligula. Curabitur ullamcorper mauris a nulla tincidunt congue.
                            Duis et eleifend velit, efficitur hendrerit nisi. Maecenas ut molestie metus.</p>
                    </div>
                </article>
                <!-- <img src="uploads/logo-compass.jpg" alt="">  -->
                
            </section>

            <!-- ================== LES DERNIERES RANDOS section ================== -->
            <section class="main__cards-container">
                <div class="main__cards-container-heading">
                    <h1 class="main__cards-container-title">Les dernières randonnées</h1>
                    <p class="main__cards-container-arrow"><a href="index.php?ctrl=rando&action=index">Voir tous ➔</a></p>
                </div>
                <div class="main__cards">
                    <div class="main__card">
                        <a href="" target="_blank">
                            <img class="main__card-img" src="<?= PUBLIC_DIR ?>/assets/forest-340x200.png" alt="Les deux Donons"
                                title="Les deux Donons">
                        </a>
                        <div class="main__card-details">
                            <h3 class="main__card-title"><a href="" target="_blank">Les deux Donons</a></h3>
                            <p class="main__card-detail">
                                <img src="<?= PUBLIC_DIR ?>/assets/calendar.svg" alt="Calendrier" title="Calendrier">
                                <span>13 juin 2024</span>
                            </p>
                            <p class="main__card-detail">
                                <img src="<?= PUBLIC_DIR ?>/assets/distance.svg" alt="Distance" title="Distance">
                                <span>11.25 km</span>
                            </p>
                            <p class="main__card-detail">
                                <img src="<?= PUBLIC_DIR ?>/assets/map-pin-fill.svg" alt="Départ" title="Départ">
                                <span>Schirmek</span>
                            </p>
                            <p class="main__card-detail">
                                <img src="<?= PUBLIC_DIR ?>/assets/map-pin-line.svg" alt="Destination" title="Destination">
                                <span>Temple Donon</span>
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        </div>