<?php
require "app/SignInGoogle.php";
?>
<div class="fullscreen-container">
    <div class="login-container">
        <h3 class="login-title">Connexion</h3>

        <span style="color: red">
            <?= App\Session::getFlash("error") ?>
        </span>

        <div class="button-container">
            <button class="ggl-btn" onclick="location.href='<?= $url ?>'">Se connecter avec Google</button>
        </div>
        <div class="break-container">
            <div class="break-border-ou"></div>
                <span class="break-content-or">ou</span>
            <div class="break-border-ou"></div>
        </div>

        <form action="index.php?ctrl=security&action=login" method="POST" autocomplete="off">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">

            <div class="input-group">
                <label for="email">Email</label>
                <?php $email = isset($_POST['email']) ? $_POST['email']: ''?>
                <input type="email" name="email" id="email" placeholder="ex : utilisateur@gmail.com" 
                    value="<?= htmlspecialchars($email); ?>" required>
            </div>
            <div class="input-group">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="button-container">
                <button type="submit" name="submitLogin" value="login" class="login-btn">Se connecter</button>
            </div>
        </form>

        <div class="button-container">
            <a href="index.php?ctrl=security&action=sendForgottenPasswordReset">Mot de passe oublié?</a>
        </div>

        <div class="break-container">
            <div class="break-border-connexion"></div>
                <span class="break-content-connexion">Première connexion ?</span>
            <div class="break-border-connexion"></div>
        </div>

        <div class="button-container">
            <button type="submit" name="register" class="register-btn"
                onclick="location.href='index.php?ctrl=security&action=register'">Créer un compte
            </button>
        </div>      
    </div>
</div>