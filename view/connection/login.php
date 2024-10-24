<?php
require "app/GoogleSignIn.php";

?>
<div class="main__container">

        <h1>Connexion</h1>

        <span style="color: red"><?= App\Session::getFlash("error") ?></span>

        <button
                onclick="location.href='<?= $url ?>'"
                style="width: 25%; height: 40px;">Se connecter avec Google</button>
        <!-- <a href="">Se connecter avec Google</a> -->
        <div class="break-container">
                <div class="break-border-ou"></div>
                <span class="break-content">ou</span>
                <div class="break-border-ou"></div>
        </div>


        <form action="index.php?ctrl=security&action=login" method="POST" autocomplete="off">
                
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">

                <label for="email">Email</label>
                <span class="tooltip-container"> *
                        <span class="tooltip-text">Les champs obligatoires</span>
                </span>
                <?php $email = isset($_POST['email']) ? $_POST['email']: ''?>
                <input type="email" name="email" id="email" placeholder="Entrez votre email" value="<?= htmlspecialchars($email); ?>" required><br>

                <label for="password">Mot de passe</label>
                <span class="tooltip-container"> *
                        <span class="tooltip-text">Les champs obligatoires</span>
                </span>
                <input type="password" name="password" id="password" placeholder="Entrez votre mot de passe" required><br><br>

                <button type="submit" name="submitLogin" value="login" style="width: 100%; height: 40px;">Se
                        connecter</button><br>

        </form>
        <!-- <a href="">Mot de passe oublié?</a> -->
        <button type="submit" name="forgottenPassword"
                onclick="location.href='index.php?ctrl=security&action=sendForgottenPasswordReset'"
                style="width: 25%; height: 40px;">Mot de passe oublié?</button>
        <div class="break-container">
                <div class="break-border-connexion"></div>
                <span class="break-content">Première connexion ?</span>
                <div class="break-border-connexion"></div>
        </div>        
        <button type="submit" name="register"
                onclick="location.href='index.php?ctrl=security&action=register'"
                style="width: 25%; height: 40px;">Créer un compte</button>

</div>