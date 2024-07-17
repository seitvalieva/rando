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
            <div class="nav__logo">
                <!-- <img src="../public/assets/logo-hiking-100x100.png" alt="logo" class="nav__logo-img"> -->
                 <a href="#"><img src="../public/assets/logo-hiking-100x100.png" alt="logo" class="nav__logo-img"></a>
                 <!-- <h3 class="nav__logo-title">Ran<span class="nav__logo-title nav__logo-title-do">do</span></h3> -->
                 <h3><a href="#" class="nav__logo-title">Ran<span class="nav__logo-title nav__logo-title-do">do</span></a></h3>
            </div>
            <!-- <div class="nav__links">
                <a class="nav__link nav__link-cta" href="#">Publier une rando</a>
                <a class="nav__link nav__link-login" href="#">Connexion</a>
                <a class="nav__link nav__link-registration" href="#">Inscription</a>
            </div> -->
            <ul class="nav__menu">
                <li><a class="nav__menu-link nav__menu-link-cta" href="#">Publier une rando</a></li>
                <li><a class="nav__menu-link nav__menu-link-login" href="#">Connexion</a></li>
                <li><a class="nav__menu-link nav__menu-link-registration" href="#">Inscription</a></li>
            </ul>
        </nav>
    </header>
    <main class="main">
        <div class="main__container">
            <section class="main__features-container">
                <div class="main__feature-subscription">
                    <h3 class="main__feature-subscription-title">Inscrivez-vous gratuitement <br>
                    et rejoignez des randos</h3>
                    <a href="#" class="main__feature-subscription-btn">Consulter nos randos</a>
                </div>
                <div class="main__feature-search">
                    <form action="">
                        <label for="search"><h3 class="main__feature-search-label">Rechercher une rando</h3></label>
                        <div class="main__feature-search-container">
                            <input type="search" id="search" name="search" placeholder="  Ville où lieu à visiter">
                            <input type="submit" value="Search" id="main__feature-search-btn">
                        </div>
                    </form>
                </div>
            </section>
            <section class="main__cards-container">
                <div class="main__cards-container-heading" >
                    <h3 class="main__cards-container-title">Les dernières randonnées</h3>
                    <a href="#"><span class="main__cards-container-arrow"> Voir tous ➔</span></a>
                </div>
                <div class="main__cards">
                    <div class="main__card">
                        <img src="../public/assets/forest-340x200.png" alt="Forest">
                        <div class="main__card-details">
                            <h4><a href="">Les deux Donons</a></h4>
                            <p>
                                <img src="../public/assets/calendar.svg" alt="Calendar">
                                13 juin 2024
                            </p>
                            <p>
                                <img src="../public/assets/distance.svg" alt="Distance">
                                11.25 km
                            </p>
                            <p>
                            <img src="../public/assets/map-pin-black.svg" alt="Location">
                                Schirmek
                            </p>
                            <p>
                            <img src="../public/assets/map-pin-white.svg" alt="Location">
                                Temple Donon
                            </p>
                        </div>                   
    
                    </div>
                    <div class="main__card">
                        <img src="../public/assets/forest-340x200.png" alt="Forest">
                        <div class="main__card-details">
                        <h4><a href="">Les deux Donons</a></h4>
                            <p>
                                <img src="../public/assets/calendar.svg" alt="Calendar">
                                13 juin 2024
                            </p>
                            <p>
                                <img src="../public/assets/distance.svg" alt="Distance">
                                11.25 km
                            </p>
                            <p>
                            <img src="../public/assets/map-pin-black.svg" alt="Location">
                                Schirmek
                            </p>
                            <p>
                            <img src="../public/assets/map-pin-white.svg" alt="Location">
                                Temple Donon
                            </p>
                        </div>                   
    
                    </div>
                    <div class="main__card">
                        <img src="../public/assets/forest-340x200.png" alt="Forest">
                        <div class="main__card-details">
                            <h4><a href="">Les deux Donons</a></h4>
                            <p>
                                <img src="../public/assets/calendar.svg" alt="Calendar">
                                13 juin 2024
                            </p>
                            <p>
                                <img src="../public/assets/distance.svg" alt="Distance">
                                11.25 km
                            </p>
                            <p>
                            <img src="../public/assets/map-pin-black.svg" alt="Location">
                                Schirmek
                            </p>
                            <p>
                            <img src="../public/assets/map-pin-white.svg" alt="Location">
                                Temple Donon
                            </p>
                        </div>                   
    
                    </div>
                </div>
            </section>
        </div>
    </main>
    <footer class="footer">
        <div class="footer__container">
            <div class="footer-top">
                <div class="footer__top-left">
                    <div class="footer__logo">
                        <a href="#">
                            <img src="../public/assets/logo-hiking-100x100.png" alt="logo">
                        </a>
                        <h3><a href="">Rando</a></h3>
                    </div>
                    <p>Votre plateforme de choix des randonnées</p>
                    <div class="footer__socials-container">
                        <p class="footer__socials-title">Retrouvez-nous sur</p>
                        <div class="footer__socials">
                            <a href="https://www.linkedin.com/">
                                <img src="../public/assets/linkedin.svg" alt="Linkedin">
                            </a>
                            <a href="https://www.facebook.com/">
                                <img src="../public/assets/facebook.svg" alt="Facebook">
                            </a>
                            <a href="https://www.instagram.com/">
                                <img src="../public/assets/instagram.svg" alt="Instagram">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="footer__top-middle">
                    <a href="#">À propos</a>
                    <p>Logo generated by <a href="https://www.freepik.com/">Freepik</a></p>
                </div>
                <div class="footer__top-right">
                    <p>Contact</p>
                    <p>
                        <img src="../public/assets/email.svg" alt="Email">
                        rando@example.com
                    </p>
                    <p>
                        <img src="../public/assets/phone.svg" alt="Phone">
                        +33 1 23 45 67 89
                    </p>
                    <p>
                        <img src="../public/assets/map-pin.svg" alt="Location">
                        1 rue de la Gare, <br> 67000 Alsace <br> France
                    </p>
                </div>
            </div>
            <div class="footer__bottom">
                <p>
                    &copy; 
                    <?= date_create("now")->format("Y") ?> 
                    Rando LLC Tous droits réservés
                </p>
                <p><a href="">Conditions générales d’utilisation</a></p>
                <p><a href="">Mentions légales</a> </p>
                <p><a href="">Politique de confidentialité</a></p>
            </div>
        </div>
    </footer>
    
</body>
</html>