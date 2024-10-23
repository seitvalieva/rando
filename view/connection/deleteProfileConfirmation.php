<div class="main__container">

    <div>

        <h1>Êtes-vous sûre de vouloir supprimer votre compte?</h1>
        <!-- <p>Cela supprimera également les images de cette rando et votre inscription</p> -->
        <span style="color: red"><?= App\Session::getFlash("error") ?></span>

        <form action="index.php?ctrl=security&action=deleteProfile" method="POST">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">

            <button type="submit" name="deleteConfirmation" id="deleteBtn" class="button delete-button" 
                        style="width: 100%; height: 40px;">Supprimer</button>
        </form>
        <a href="index.php?ctrl=security&action=profile">Annuler</a>

    </div>

</div>