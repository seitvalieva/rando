<div class="main__container">

    <div>

        <h1>Êtes-vous sûre de vouloir annuler votre participation à la rando?</h1>

        <form action="index.php?ctrl=subscription&action=cancelParticipation&id=<?= $_GET["id"] ?>" method="POST">

            <button type="submit" name="cancelParticipation">Oui, annuler</button>
            
            <a href="index.php?ctrl=rando&action=randoDetails&id=<?= $_GET["id"] ?>">Annuler</a>
            <button onclick="document.getElementById('deleteRando').style.display='none'" id="closeBtn" class="button close-button">&times;</button>
        </form>

    </div>

</div>