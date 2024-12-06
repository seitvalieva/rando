<div class="deleteRando__container">

    <h1>Êtes-vous sûre de vouloir supprimer la randonnée?</h1>
    <p>Cette action supprimera également les images de la randonnée et votre inscription</p>

    <form action="index.php?ctrl=rando&action=deleteRando&id=<?= $_GET["id"] ?>" method="POST">

        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
            
        <button type="submit" name="deleteConfirmation" id="deleteBtn" class="delete-button">Supprimer</button>
            
        <button onclick="document.getElementById('deleteRando').style.display='none'" class="cancel-button">Annuler</button>
        <!-- <button onclick="document.getElementById('deleteRando').style.display='none'" class="close-button">&times;</button> -->
    </form>
</div>