<div class="main__container">
    <h1>Créer votre nouveau mot de passe</h1>
    <form action="index.php?ctrl=security&action=setNewPassword" method="POST" autocomplete="off">
        <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">

        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">

        <label for="newPassword">Nouveau mot de passe <span class="required">*</span></label>
        <input type="password" name="newPassword" id="newPassword" required><br>
    
        <label for="confirmNewPassword">Confirmation du nouveau mot de passe <span class="required">*</span></label>
        <input type="password" name="confirmNewPassword" id="confirmNewPassword" required><br><br>

        <button type="submit" name="submitNewPassword" style="width: 100%; height: 40px;">Sauvegarder</button><br><br>   
    </form>
    <div><span style="color: red"><?= App\Session::getFlash("error") ?></span></div>
</div>