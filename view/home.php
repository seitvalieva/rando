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
                <img src="../public/assets/logo-hiking-100x100.png" alt="logo" class="nav__logo-img">
                 <h3 class="nav__logo-title">Ran<span class="nav__logo-title nav__logo-title-do">do</span></h3>
            </div>
            <div class="nav__links">
                <a class="nav__link nav__link-cta" href="#">Publier une rando</a>
                <a class="nav__link nav__link-login" href="#">Connexion</a>
                <a class="nav__link nav__link-registration" href="#">Inscription</a>
            </div>
        </nav>
    </header>
    <main>
        <div class="features container">
            <div class="subscription-container">
                <h3>Inscrivez-vous gratuitement <br>
                et rejoignez des randos</h3>
                <a href="">Consulter nos randos</a>
            </div>
            <div class="search-container">
                <form action="">
                    <label for="search">Rechercher une rando</label>
                    <div>
                        <input type="search" id="search" name="search" placeholder="Ville où lieu à visiter">
                        <input type="submit" value="Search">
                    </div>
                </form>
            </div>
        </div>
        <div class="cards container">
            <h3>Les dernières randonnées </h3>
            <div>
                <div class="card">
                    <img src="..//public/assets/forest-340x200.png" alt="Forest">
                    <div class="container">
                        <h4>Les deux Donons</h4>
                        <p>
                            <img src="..//public/assets/calendar.svg" alt="Calendar">
                            13 juin 2024
                        </p>
                        <p>
                            <img src="..//public/assets/distance.svg" alt="Distance">
                            11.25 km
                        </p>
                        <p>
                        <img src="..//public/assets/map-pin-black.svg" alt="Location">
                            Schirmek
                        </p>
                        <p>
                        <img src="..//public/assets/map-pin-white.svg" alt="Location">
                            Temple Donon
                        </p>
                    </div>                   

                </div>
                <div class="card">
                    <img src="..//public/assets/forest-340x200.png" alt="Forest">
                    <div class="container">
                        <h4>Les deux Donons</h4>
                        <p>
                            <img src="..//public/assets/calendar.svg" alt="Calendar">
                            13 juin 2024
                        </p>
                        <p>
                            <img src="..//public/assets/distance.svg" alt="Distance">
                            11.25 km
                        </p>
                        <p>
                        <img src="..//public/assets/map-pin-black.svg" alt="Location">
                            Schirmek
                        </p>
                        <p>
                        <img src="..//public/assets/map-pin-white.svg" alt="Location">
                            Temple Donon
                        </p>
                    </div>                   

                </div>
                <div class="card">
                    <img src="..//public/assets/forest-340x200.png" alt="Forest">
                    <div class="container">
                        <h4>Les deux Donons</h4>
                        <p>
                            <img src="..//public/assets/calendar.svg" alt="Calendar">
                            13 juin 2024
                        </p>
                        <p>
                            <img src="..//public/assets/distance.svg" alt="Distance">
                            11.25 km
                        </p>
                        <p>
                        <img src="..//public/assets/map-pin-black.svg" alt="Location">
                            Schirmek
                        </p>
                        <p>
                        <img src="..//public/assets/map-pin-white.svg" alt="Location">
                            Temple Donon
                        </p>
                    </div>                   

                </div>
            </div>
        </div>
    </main>
    <footer>
        <div>
            <div class="footer-top">
                <div class="footer-left">
                    <div>
                        <a href="#home">
                            <img src="../public/assets/logo-hiking-100x100.png" alt="logo">
                            <h3>Rando</h3>
                        </a>
                    </div>
                    <p>Votre plateforme de choix des randonnées</p>
                    <div>
                        <p>Retrouvez-nous sur</p>
                        <div>
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
                <div class="footer-middle">
                    <a href="#">À propos</a>
                    <p>Logo generated by <a href="https://www.freepik.com/">Freepik</a></p>
                </div>
                <div class="footer-right">
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
            <div class="footer-bottom">
                <p>
                    &copy; 
                    <?= date_create("now")->format("Y") ?> 
                    Rando LLC Tous droits réservés
                </p>
                <p>Conditions générales d’utilisation</p>
                <p>Mentions légales </p>
                <p>Politique de confidentialité</p>
            </div>
        </div>
    </footer>
    
</body>
</html>