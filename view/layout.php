<!-- le fichier "template.php" qui servira de base / squelette à l'ensemble des vues -->

<!-- pour  déclarer le doctype, les links css / js etc qu'une seule fois dans ce fichier.

On exploitera ce qu'on appelle "la temporisation de sortie" en PHP  -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/<?=$lienCss?>.css">
    <title><?= $titre ?></title>
</head>
<body>
    <header>
        <nav>

        </nav>
    </header>

    <main>
        <?= $page ?>
    </main>

    <footer>

    <p>
        <a href="#">Conditions générales d’utilisation</a>  
        <a href="#">Mentions légales</a>
        <a href="#">Politique de confidentialité</a>
        &copy; <?= date_create("now")->format("Y") ?>Rando LLC Tous droits réservés. 
    </p>

    </footer>
    <script src ="./public/js/main.js"></script> 
</body>
</html>