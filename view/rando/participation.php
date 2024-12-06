<div class="participation-container">
    <div class="newParticipation-container">
        <h1>Participer a une rando</h1>
        <form action="index.php?ctrl=subscription&action=participate&id=<?= $_GET["id"] ?>" method="POST">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
            <div class="input-group">
                <label for="username">Nom et prénom <span class="required">*</span></label>
                <input type="text" name="username" id="username" minlength="3" maxlength="64" required>
            </div>
            <div class="input-group">
                <label for="email">Mail <span class="required">*</span></label>
                <input type="email" name="email" id="email" value="<?= App\Session::getUser()->getEmail() ?>" readonly required>
            </div>
            <input type="checkbox" id="agreeToRules" name="agreeToRules" value="agree" required>
            <label for="agreeToRules">J'accepte de respecter les <a href="" style="color:blue;">consignes de rando *</a></label><br><br>
            <div class="btn-group">
                <button type="submit" name="submitParticipation" class="participate-btn">S'enregistrer</button>
            </div>
            <div class="button-container">
                <a href="index.php?ctrl=rando&action=randoDetails&id=<?= $_GET["id"] ?>" style="font-weight:bold;">Annuler</a>
            </div>
            
        </form>
    </div>
</div>