<?php
require "app/SignInGoogle.php";
?>

<div class="fullscreen-container">
    <div class="registration-container">
        <h3 class="registration-title">Créer un compte</h3>
        <?= isset($_SESSION['errors']['csrf']) ? "<div style='color: red'>{$_SESSION['errors']['csrf']}</div>" : '' ?>

        <div class="button-container">
            <button class="ggl-btn" onclick="location.href='<?= $url ?>'">Se connecter avec Google</button>
        </div>
        <div class="break">
        </div>
        <form action="index.php?ctrl=security&action=register" method="POST" autocomplete="off">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">

            <div class="input-group">
                <label for="username">Nom d'utilisateur publique
                    <span class="tooltip-container"> *
                        <span class="tooltip-text">Le nom d'utilisateur ne peut contenir que des lettres, des chiffres et le tiret du bas.</span>
                    </span>
                </label>
                <?php $usernameValue = isset($_POST['username']) ? $_POST['username']: ''?>
                <input type="text" name="username" id="username" minlength="3" maxlength="20"
                    value="<?= htmlspecialchars($usernameValue); ?>" placeholder="ex : pseudo" required>
                <?= isset($_SESSION['errors']['username']) ? "<div style='color: red'>{$_SESSION['errors']['username']}</div>" : '' ?>
            </div>
            <div class="input-group">
                <label for="email">Email
                    <span class="tooltip-container"> *
                        <span class="tooltip-text">Le champ obligatoire</span>
                    </span>
                </label>
                <?php $emailValue = isset($_POST['email']) ? $_POST['email']: ''?>
                <input type="email" name="email" value="<?= htmlspecialchars($emailValue); ?>" placeholder="ex : utilisateur@gmail.com"
                    id="email" required>
                <?= isset($_SESSION['errors']['email']) ? "<div style='color: red'>{$_SESSION['errors']['email']}</div>" : '' ?>
            </div>
            <div class="input-group">
                <label for="password">Mot de passe
                    <span class="tooltip-container"> *
                        <span class="tooltip-text">Le mot de passe doit contenir au moins une lettre, un chiffre, un caractère spécial et
                            comporter au moins 12 caractères</span>
                    </span>
                </label>
                <input type="password" name="password" id="password" required>
                <?= isset($_SESSION['errors']['password']) ? "<div style='color: red'>{$_SESSION['errors']['password']}</div>" : '' ?>
            </div>
            <div class="input-group">
                <label for="confirmPassword">Confirmer le mot de passe 
                    <span class="tooltip-container"> *
                        <span class="tooltip-text">Les mots de passe doivent être identiques.</span>
                    </span>
                </label>
                <input type="password" name="confirmPassword" id="confirmPassword" required>
                <?= isset($_SESSION['errors']['confirmPassword']) ? "<span style='color: red'>{$_SESSION['errors']['confirmPassword']}</span>" : '' ?>
            </div>
            <div class="checkbox-container">
                <input type="checkbox" id="agree" name="agree" value="agree" required>
                <label for="agree">J'accepte les 
                    <a href="" style="color:blue;">Conditions générales d’utilisation</a>
                    <span class="tooltip-container"> *
                        <span class="tooltip-text">Le champ obligatoire.</span>
                    </span>
                </label>
                <?= isset($_SESSION['errors']['agree']) ? "<div style='color: red'>{$_SESSION['errors']['agree']}</div>" : '' ?>
            </div>
            <div class="g-recaptcha" data-sitekey="6Leyol0qAAAAAOeoQjkiHhvIolDmVTWJsdDZndyY"></div>
            <?= isset($_SESSION['errors']['recaptcha']) ? "<div style='color: red'>{$_SESSION['errors']['recaptcha']}</div>" : '' ?>

            <div class="button-container">
                <button type="submit" name="submitRegister" class="register-btn">S'enregistrer</button>
            </div>
        </form>
        <?php unset($_SESSION['errors']); // Clear errors after displaying ?>
    </div>
</div>