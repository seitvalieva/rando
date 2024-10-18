    <div class="main__container">
        <h1>Créer un compte</h1>
        <div class="msg"><span style="color: red"><?= App\Session::getFlash("error") ?></span></div>
        <form action="index.php?ctrl=security&action=register" method="POST" autocomplete="off">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">

            <label for="username">Pseudo</label>
            <span class="tooltip-container"> *
                <span class="tooltip-text">Le nom d'utilisateur ne peut contenir que des lettres, des chiffres et le tiret du bas.</span>
            </span>
            <input type="text" name="username" id="username" minlength="3" maxlength="20" placeholder="Pseudo" required><br>
    
            <label for="email">Email</label>
            <span class="tooltip-container"> *
                <span class="tooltip-text">Les champs obligatoires</span>
            </span>
            <input type="email" name="email" placeholder="utilisateur@gmail.com" id="email" required><br>
    
            <label for="password">Mot de passe</label>
            <span class="tooltip-container"> *
                <span class="tooltip-text">Le mot de passe doit contenir au moins une lettre, un chiffre, un caractère spécial et comporter au moins 8 caractères</span>
            </span>
            <input type="password" name="password" id="password" required><br>
    
            <label for="confirmPassword">Confirmation du mot de passe </label>
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