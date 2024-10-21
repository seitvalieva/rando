
<div class="main__container">
    <h1>Participer a une rando</h1>
    <form action="index.php?ctrl=subscription&action=participate&id=<?= $_GET["id"] ?>" method="POST">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
        
        <label for="username">Nom et prénom <span class="required">*</span></label>
        <input type="text" name="username" id="username" minlength="3" maxlength="64" required><br><br>

        <label for="email">Mail <span class="required">*</span></label>
        <input type="email" name="email" id="email" value="<?= App\Session::getUser()->getEmail() ?>" readonly required><br><br>

        <input type="checkbox" id="agreeToRules" name="agreeToRules" value="agree" required>
        <label for="agreeToRules">J'accepte de respecter les <a href="" style="color:blue;">consignes de rando <span class="required">*</span></a></label><br><br>
        
        <button type="submit" name="submitParticipation" style="width: 100%; height: 40px;">S'enregistrer</button><br><br>
        <a href="index.php?ctrl=rando&action=randoDetails&id=<?= $_GET["id"] ?>">Annuler</a>
    </form>
</div>