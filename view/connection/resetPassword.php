<div class="main__container">

        <h1>Créer votre nouveau mot de passe</h1>

        <form action="index.php?ctrl=security&action=newPassword" method="POST" autocomplete="off">

            <label for="email">Email</label>
            <input type="email" name="email" id="email" required><br><br>

            <label for="newPassword">Nouveau mot de passe</label>
            <input type="password" name="newPassword" id="newPassword" required><br>
    
            <label for="confirmNewPassword">Confirmation du nouveau mot de passe</label>
            <input type="password" name="confirmNewPassword" id="confirmNewPassword" required><br><br>

            <button type="submit" name="submitNewPassword" style="width: 100%; height: 40px;">Sauvegarder</button><br><br>
            
        </form>
    </div>    

