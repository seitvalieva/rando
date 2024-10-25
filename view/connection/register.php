<?php
// require "app/SignInGoogle.php";

?>
    <div class="main__container">
        <h1>Créer un compte</h1>
        <?php if (isset($_SESSION['errors'])): ?>
        <div class="msg">
        <?php foreach ($_SESSION['errors'] as $error): ?>
            <span style="color: red">
            <?= htmlspecialchars($error) ?>
            </span>
        <?php endforeach; ?>
        </div>
        <?php unset($_SESSION['errors']); // Clear errors after displaying ?>
        <?php endif; ?>

        <button onclick="location.href='<?= $url ?>'" style="width: 25%; height: 40px;">Se connecter avec Google</button>
        
        <form action="index.php?ctrl=security&action=register" method="POST" autocomplete="off">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">

            <label for="username">Pseudo</label>
            <span class="tooltip-container"> *
                <span class="tooltip-text">Le nom d'utilisateur ne peut contenir que des lettres, des chiffres et le tiret du bas.</span>
            </span>
            <?php $usernameValue = isset($_POST['username']) ? $_POST['username']: ''?>
            <input type="text" name="username" id="username" minlength="3" maxlength="20" value="<?= htmlspecialchars($usernameValue); ?>" placeholder="Votre pseudo publique" required><br>
    
            <label for="email">Email</label>
            <span class="tooltip-container"> *
                <span class="tooltip-text">Les champs obligatoires</span>
            </span>
            <?php $emailValue = isset($_POST['email']) ? $_POST['email']: ''?>
            <input type="email" name="email" value="<?= htmlspecialchars($emailValue); ?>" placeholder="utilisateur@gmail.com" id="email" required><br>
    
            <label for="password">Mot de passe</label>
            <span class="tooltip-container"> *
                <span class="tooltip-text">Le mot de passe doit contenir au moins une lettre, un chiffre, un caractère spécial et comporter au moins 12 caractères</span>
            </span>
            <input type="password" name="password" id="password" required><br>
    
            <label for="confirmPassword">Confirmer le mot de passe </label>
            <span class="tooltip-container"> *
                <span class="tooltip-text">Les mots de passe doivent être identiques.</span>
            </span>
            <input type="password" name="confirmPassword" id="confirmPassword" required><br><br>

            <input type="checkbox" id="agree" name="agree" value="agree" required>
            <label for="agree">J'accepte les <a href="" style="color:blue;">Conditions générales d’utilisation</a></label>
            <span class="tooltip-container"> *
                <span class="tooltip-text">Les champs obligatoires.</span>
            </span><br><br>
            
            <div class="g-recaptcha" data-sitekey="6Leyol0qAAAAAOeoQjkiHhvIolDmVTWJsdDZndyY"></div><br>
            
            <button type="submit" name="submitRegister" style="width: 100%; height: 40px;">S'enregistrer</button><br><br>
        </form>
    </div>