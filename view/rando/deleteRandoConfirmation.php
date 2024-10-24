<div class="main__container">

    <div id="deleteRando" class="">

        <h1>Êtes-vous sûre de vouloir supprimer la rando?</h1>
        <p>Cela supprimera également les images de cette rando et votre inscription</p>

        <form action="index.php?ctrl=rando&action=deleteRando&id=<?= $_GET["id"] ?>" method="POST">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
            <button type="submit" name="deleteConfirmation" id="deleteBtn" class="button delete-button" style="width: 100%; height: 40px;">Supprimer</button>
            
            <button onclick="document.getElementById('deleteRando').style.display='none'" id="cancelBtn" class="button cancel-button" style="width: 100%; height: 40px;">Annuler</button>
            <button onclick="document.getElementById('deleteRando').style.display='none'" id="closeBtn" class="button close-button">&times;</button>
        </form>

    </div>

</div>