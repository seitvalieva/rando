    <div class="main__container">
        <h1>Créer un compte</h1>
        <form action="index.php?ctrl=security&action=register" method="POST" autocomplete="off">
            <label for="username">Pseudo <span class="required">*</span></label>
            <input type="text" name="username" id="username" minlength="3" maxlength="20" required><br>
    
            <label for="email">Mail <span class="required">*</span></label>
            <input type="email" name="email" id="email" required><br>
    
            <label for="password">Mot de passe <span class="required">*</span></label>
            <input type="password" name="password" id="password" required><br>
    
            <label for="confirmPassword">Confirmation du mot de passe <span class="required">*</span></label>
            <input type="password" name="confirmPassword" id="confirmPassword" required><br><br>

            <input type="checkbox" id="agree" name="agree" value="agree" required>
            <label for="agree">J'accepte les <a href="" style="color:blue;">Conditions générales d’utilisation <span class="required">*</span></a></label><br><br>
            
            <div class="g-recaptcha" data-sitekey="6Leyol0qAAAAAOeoQjkiHhvIolDmVTWJsdDZndyY"></div>
            
            <button type="submit" name="submitRegister" style="width: 100%; height: 40px;">S'enregistrer</button><br><br>
            <div class="popup"><span style="color: red"><?= App\Session::getFlash("error") ?></span></div>
        </form>
    </div>