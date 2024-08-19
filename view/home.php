<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/style.css">
    <link rel="shortcut icon" href="../public/assets/favicon.png" type="image/x-icon">
    <title>Accueil</title>
</head>

<body>
    <header class="header">
        <nav class="nav">
            <a href="index.php?ctrl=forum&action=index" class="nav__logo">
                <img src="../public/assets/logo-hiking-100x100.png" alt="logo" title="Logo" class="nav__logo-img">
                <h3 class="nav__logo-title">Ran<span class="nav__logo-title nav__logo-title-do">do</span></h3>
            </a>
            <ul class="nav__menu">
                <li><a class="nav__menu-link nav__menu-link-cta" href="#">Publier une rando</a></li>
                <li><a class="nav__menu-link nav__menu-link-login" href="index.php?ctrl=security&action=login">Connexion</a></li>
                <li><a class="nav__menu-link nav__menu-link-registration" href="index.php?ctrl=security&action=register">Inscription</a></li>
            </ul>
            <!-- ============= BURGER btn ============= -->
            <div class="nav__burger-menu" id="navBurgerMenu">
                <img src="../public/assets/burger-menu.svg" alt="Mobile Menu" title="Mobile Menu">
            </div>
        </nav>
    </header>
    <!-- ============= MOBILE MENU ============= -->
    <div class="mobile-menu" id="mobileMenu">
        <button class="mobile-menu__close" id="mobileMenuClose">&times;</button>
        <nav class="mobile-menu__nav">
            <a href="#" class="">Publier une rando</a>
            <a href="index.php?ctrl=security&action=login" class="">Connexion</a>
            <a href="index.php?ctrl=security&action=register" class="">Inscription</a>
        </nav>
    </div>
    <!-- ============= MAIN section ============= -->
    <main class="main">
        <div class="main__container">
            <!-- ============= FEATURES section ============= -->
            <section class="main__features-container">
                <div class="main__feature-subscription">
                    <h2 class="main__feature-subscription-title">Inscrivez-vous gratuitement <br>
                        et rejoignez des randos</h2>
                    <a href="#" class="main__feature-subscription-btn">Consulter nos randos</a>
                </div>
                <!-- ============= SEARCH form ============= -->
                <div class="main__feature-search">
                    <form action="">
                        <h2 class="main__feature-search-label">Rechercher une rando</h2>
                        <div class="main__feature-search-container">
                            <input type="search" id="search" name="search" placeholder="  Ville où lieu à visiter">
                            <input type="submit" value="Search" id="main__feature-search-btn">
                        </div>
                    </form>
                </div>
            </section>
            <!-- ============= LES DERNIERES RANDOS section ============= -->
            <section class="main__cards-container">
                <div class="main__cards-container-heading">
                    <h1 class="main__cards-container-title">Les dernières randonnées</h1>
                    <p class="main__cards-container-arrow"><a href="#">Voir tous ➔</a></p>
                </div>
                <div class="main__cards">
                    <div class="main__card">
                        <a href="" target="_blank">
                            <img class="main__card-img" src="../public/assets/forest-340x200.png" alt="Les deux Donons"
                                title="Les deux Donons">
                        </a>
                        <div class="main__card-details">
                            <h3 class="main__card-title"><a href="" target="_blank">Les deux Donons</a></h3>
                            <p class="main__card-detail">
                                <img src="../public/assets/calendar.svg" alt="Calendrier" title="Calendrier">
                                <span>13 juin 2024</span>
                            </p>
                            <p class="main__card-detail">
                                <img src="../public/assets/distance.svg" alt="Distance" title="Distance">
                                <span>11.25 km</span>
                            </p>
                            <p class="main__card-detail">
                                <img src="../public/assets/map-pin-fill.svg" alt="Départ" title="Départ">
                                <span>Schirmek</span>
                            </p>
                            <p class="main__card-detail">
                                <img src="../public/assets/map-pin-line.svg" alt="Destination" title="Destination">
                                <span>Temple Donon</span>
                            </p>
                        </div>
                    </div>
                    <div class="main__card">
                        <a href="" target="_blank">
                            <img class="main__card-img" src="../public/assets/forest-340x200.png" alt="Les deux Donons"
                                title="Les deux Donons">
                        </a>
                        <div class="main__card-details">
                            <h3 class="main__card-title"><a href="" target="_blank">Les deux Donons</a></h3>
                            <p class="main__card-detail">
                                <img src="../public/assets/calendar.svg" alt="Calendrier" title="Calendrier">
                                <span>13 juin 2024</span>
                            </p>
                            <p class="main__card-detail">
                                <img src="../public/assets/distance.svg" alt="Distance" title="Distance">
                                <span>11.25 km</span>
                            </p>
                            <p class="main__card-detail">
                                <img src="../public/assets/map-pin-fill.svg" alt="Départ" title="Départ">
                                <span>Schirmek</span>
                            </p>
                            <p class="main__card-detail">
                                <img src="../public/assets/map-pin-line.svg" alt="Destination" title="Destination">
                                <span>Temple Donon</span>
                            </p>
                        </div>
                    </div>
                    <div class="main__card">
                        <a href="" target="_blank">
                            <img class="main__card-img" src="../public/assets/forest-340x200.png" alt="Les deux Donons"
                                title="Les deux Donons">
                        </a>
                        <div class="main__card-details">
                            <h3 class="main__card-title"><a href="" target="_blank">Les deux Donons</a></h3>
                            <p class="main__card-detail">
                                <img src="../public/assets/calendar.svg" alt="Calendrier" title="Calendrier">
                                <span>13 juin 2024</span>
                            </p>
                            <p class="main__card-detail">
                                <img src="../public/assets/distance.svg" alt="Distance" title="Distance">
                                <span>11.25 km</span>
                            </p>
                            <p class="main__card-detail">
                                <img src="../public/assets/map-pin-fill.svg" alt="Départ" title="Départ">
                                <span>Schirmek</span>
                            </p>
                            <p class="main__card-detail">
                                <img src="../public/assets/map-pin-line.svg" alt="Destination" title="Destination">
                                <span>Temple Donon</span>
                            </p>
                        </div>
                    </div>
                    <div class="main__card">
                        <a href="" target="_blank">
                            <img class="main__card-img" src="../public/assets/forest-340x200.png" alt="Les deux Donons"
                                title="Les deux Donons">
                        </a>
                        <div class="main__card-details">
                            <h3 class="main__card-title"><a href="" target="_blank">Les deux Donons</a></h3>
                            <p class="main__card-detail">
                                <img src="../public/assets/calendar.svg" alt="Calendrier" title="Calendrier">
                                <span>13 juin 2024</span>
                            </p>
                            <p class="main__card-detail">
                                <img src="../public/assets/distance.svg" alt="Distance" title="Distance">
                                <span>11.25 km</span>
                            </p>
                            <p class="main__card-detail">
                                <img src="../public/assets/map-pin-fill.svg" alt="Départ" title="Départ">
                                <span>Schirmek</span>
                            </p>
                            <p class="main__card-detail">
                                <img src="../public/assets/map-pin-line.svg" alt="Destination" title="Destination">
                                <span>Temple Donon</span>
                            </p>
                        </div>
                    </div>
                    <div class="main__card">
                        <a href="" target="_blank">
                            <img class="main__card-img" src="../public/assets/forest-340x200.png" alt="Les deux Donons"
                                title="Les deux Donons">
                        </a>
                        <div class="main__card-details">
                            <h3 class="main__card-title"><a href="" target="_blank">Les deux Donons</a></h3>
                            <p class="main__card-detail">
                                <img src="../public/assets/calendar.svg" alt="Calendrier" title="Calendrier">
                                <span>13 juin 2024</span>
                            </p>
                            <p class="main__card-detail">
                                <img src="../public/assets/distance.svg" alt="Distance" title="Distance">
                                <span>11.25 km</span>
                            </p>
                            <p class="main__card-detail">
                                <img src="../public/assets/map-pin-fill.svg" alt="Départ" title="Départ">
                                <span>Schirmek</span>
                            </p>
                            <p class="main__card-detail">
                                <img src="../public/assets/map-pin-line.svg" alt="Destination" title="Destination">
                                <span>Temple Donon</span>
                            </p>
                        </div>
                    </div>
                    <div class="main__card">
                        <a href="" target="_blank">
                            <img class="main__card-img" src="../public/assets/forest-340x200.png" alt="Les deux Donons"
                                title="Les deux Donons">
                        </a>
                        <div class="main__card-details">
                            <h3 class="main__card-title"><a href="" target="_blank">Les deux Donons</a></h3>
                            <p class="main__card-detail">
                                <img src="../public/assets/calendar.svg" alt="Calendrier" title="Calendrier">
                                <span>13 juin 2024</span>
                            </p>
                            <p class="main__card-detail">
                                <img src="../public/assets/distance.svg" alt="Distance" title="Distance">
                                <span>11.25 km</span>
                            </p>
                            <p class="main__card-detail">
                                <img src="../public/assets/map-pin-fill.svg" alt="Départ" title="Départ">
                                <span>Schirmek</span>
                            </p>
                            <p class="main__card-detail">
                                <img src="../public/assets/map-pin-line.svg" alt="Destination" title="Destination">
                                <span>Temple Donon</span>
                            </p>
                        </div>
                    </div>

                </div>
            </section>
        </div>
    </main>
    
    <script src="../public/js/script.js"></script>
</body>

</html>