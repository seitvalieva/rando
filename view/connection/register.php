    <div class="main__container">
        <h1>Créer un compte</h1>
        <form action="index.php?ctrl=security&action=register" method="POST" autocomplete="off">
            <label for="username">Pseudo</label>
            <input type="text" name="username" id="username" required><br>
    
            <label for="email">Mail</label>
            <input type="email" name="email" id="email" required><br>
    
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" required><br>
    
            <label for="confirmPassword">Confirmation du mot de passe</label>
            <input type="password" name="confirmPassword" id="confirmPassword" required><br><br>
            
            <!-- <input type="submit" name="submitRegister" value="S'enregistrer"> -->
            <button type="submit" name="submitRegister" style="width: 100%; height: 40px;">S'enregistrer</button><br><br>
        </form>
    </div>