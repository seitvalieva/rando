<!-- файл "layout.php", который будет служить основой/скелетом для всех представлений -->

<!-- чтобы объявить тип документа, ссылки css/js и т. д. в этом файле только один раз.

Мы будем использовать то, что мы называем «задержкой на выход» в PHP -->
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="<?= $meta_description ?>">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <script src="https://cdn.tiny.cloud/1/zg3mwraazn1b2ezih16je1tc6z7gwp5yd4pod06ae5uai8pa/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
        <link rel="stylesheet" href="<?= PUBLIC_DIR ?>/css/style.css">
        <link rel="shortcut icon" href="<?= PUBLIC_DIR ?>/assets/favicon.png" type="image/x-icon">
        <title> Title </title>
    </head>
    <body>
        <div id="wrapper"> 
            <div id="mainpage">
                <!-- this is where messages (error or success) are displayed-->
                <h3 class="message" style="color: red"><?= App\Session::getFlash("error") ?></h3>
                <h3 class="message" style="color: green"><?= App\Session::getFlash("success") ?></h3>
                <header class="header">
                    <nav class="nav">
                    <a href="index.php?ctrl=forum&action=index" class="nav__logo">
                        <img src="<?= PUBLIC_DIR ?>/assets/logo-hiking-100x100.png" alt="logo" title="Logo" class="nav__logo-img">
                        <h3 class="nav__logo-title">Ran<span class="nav__logo-title nav__logo-title-do">do</span></h3>
                    </a>
                        <div id="nav-right">
                        <?php
                            // if the user is logged in
                            if(App\Session::getUser()){
                                ?>
                                <a href="index.php?ctrl=security&action=profile"><span class="fas fa-user"></span>&nbsp;<?= App\Session::getUser()?></a>
                                <a href="index.php?ctrl=forum&action=index">Liste des catégories</a>
                                <a href="index.php?ctrl=security&action=logout">Déconnexion</a>
                                <?php
                            }
                            else{
                                ?>
                                <ul class="nav__menu">
                                    <li><a class="nav__menu-link nav__menu-link-cta" href="#">Publier une rando</a></li>
                                    <li><a class="nav__menu-link nav__menu-link-login" href="index.php?ctrl=security&action=login">Connexion</a></li>
                                    <li><a class="nav__menu-link nav__menu-link-registration" href="index.php?ctrl=security&action=register">Inscription</a></li>
                                </ul>
                                <!-- ============= BURGER btn ============= -->
                                <div class="nav__burger-menu" id="navBurgerMenu">
                                    <img src="<?= PUBLIC_DIR ?>/assets/burger-menu.svg" alt="Mobile Menu" title="Mobile Menu">
                                </div>
                                <!-- ============= MOBILE MENU ============= -->
                                <div class="mobile-menu" id="mobileMenu">
                                    <button class="mobile-menu__close" id="mobileMenuClose">&times;</button>
                                    <nav class="mobile-menu__nav">
                                        <a href="#" class="">Publier une rando</a>
                                        <a href="index.php?ctrl=security&action=login" class="">Connexion</a>
                                        <a href="index.php?ctrl=security&action=register" class="">Inscription</a>
                                    </nav>
                                </div>
                                
                            <?php
                            }
                        ?>
                        </div>
                    </nav>
                </header>
                
                <main class="main">
                    <?= $page ?>
                </main>
            </div>
            <!-- ============= FOOTER ============= -->
            <footer class="footer">
                <div class="footer__container">
                    <div class="footer__top">
                        <div class="footer__top-left">
                            <div class="footer__logo">
                                <a href="#">
                                    <img src="<?= PUBLIC_DIR ?>/assets/logo-hiking-100x100.png" alt="logo" class="footer__logo-img">
                                </a>
                                <h3><a href="" class="footer__logo-title">Rando</a></h3>
                            </div>
                            <!-- <p>Votre plateforme de choix des randonnées</p> -->
                            <div class="footer__socials-container">
                                <p class="footer__socials-title">Retrouvez-nous sur</p>
                                <div class="footer__socials">
                                    <a href="https://www.linkedin.com/">
                                        <img src="<?= PUBLIC_DIR ?>/assets/linkedin.svg" alt="Linkedin" class="footer__social-icon">
                                    </a>
                                    <a href="https://www.facebook.com/">
                                        <img src="<?= PUBLIC_DIR ?>/assets/facebook.svg" alt="Facebook" class="footer__social-icon">
                                    </a>
                                    <a href="https://www.instagram.com/">
                                        <img src="<?= PUBLIC_DIR ?>/assets/instagram.svg" alt="Instagram" class="footer__social-icon">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="footer__top-middle">
                            <a href="#" class="footer__link">À propos</a>
                            <p>Logo generated by <a href="https://www.freepik.com/" class="footer__link">Freepik</a></p>
                        </div>
                        <address class="footer__top-right">
                            <p class="footer__top-right-title">Contact</p>
                            <div class="footer__top-contacts">
                                <div class="footer__email">
                                    <img src="<?= PUBLIC_DIR ?>/assets/email.svg" alt="Email" class="footer__social-icon">
                                    <p>rando@example.com</p>
                                </div>
                                <div class="footer__telephone">
                                    <img src="<?= PUBLIC_DIR ?>/assets/phone.svg" alt="Phone" class="footer__social-icon">
                                    <p>+33 1 23 45 67 89</p>
                                </div>
                                <div class="footer__address">
                                    <img src="<?= PUBLIC_DIR ?>/assets/map-pin.svg" alt="Location" class="footer__social-icon">
                                    <p>1 rue de la Gare, <br> 67000 Alsace <br> France</p>
                                </div>
                            </div>
                        </address>
                    </div>
                </div>
                <div class="footer__bottom">
                    <p>
                        &copy;
                        <?= date_create("now")->format("Y") ?>
                        Rando LLC Tous droits réservés
                    </p>
                    <p><a href="" class="footer__link">Conditions générales d’utilisation</a></p>
                    <p><a href="" class="footer__link">Mentions légales</a> </p>
                    <p><a href="" class="footer__link">Politique de confidentialité</a></p>
                </div>
            </footer>
        </div>
        <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous">
        </script>
        <script>
            $(document).ready(function(){
                $(".message").each(function(){
                    if($(this).text().length > 0){
                        $(this).slideDown(500, function(){
                            $(this).delay(3000).slideUp(500)
                        })
                    }
                })
                $(".delete-btn").on("click", function(){
                    return confirm("Etes-vous sûr de vouloir supprimer?")
                })
                tinymce.init({
                    selector: '.post',
                    menubar: false,
                    plugins: [
                        'advlist autolink lists link image charmap print preview anchor',
                        'searchreplace visualblocks code fullscreen',
                        'insertdatetime media table paste code help wordcount'
                    ],
                    toolbar: 'undo redo | formatselect | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                    content_css: '//www.tiny.cloud/css/codepen.min.css'
                });
            })
        </script>
        <script src="<?= PUBLIC_DIR ?>/js/script.js"></script>
        <!-- <script src="../public/js/script.js"></script> -->
    </body>
</html>