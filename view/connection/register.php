    <div class="main__container">
        <h1>Créer un compte</h1>
        <form action="index.php?ctrl=security&action=register" method="POST" autocomplete="off"><!--URL structure to trigger an action: index.php?ctrl= &action= &id= -->
            <label for="username">Pseudo</label>
            <input type="text" name="username" id="username"><br>
    
            <label for="email">Mail</label>
            <input type="email" name="email" id="email"><br>
    
            <label for="pass1">Mot de passe</label>
            <input type="password" name="pass1" id="pass1"><br>
    
            <label for="pass2">Confirmation du mot de passe</label>
            <input type="password" name="pass2" id="pass2"><br>
            
            <input type="submit" name="submitRegister" value="S'enregistrer">
        </form>
    </div>