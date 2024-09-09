<div class="main__container">
    <h1>Se connecter</h1>
    <form action="index.php?ctrl=security&action=login" method="POST" autocomplete="off">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required><br>

        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password" required><br><br>

        <button type="submit" name="submitLogin" value="login" style="width: 100%; height: 40px;">Se
            connecter</button><br><br>

        <!-- <a href="index.php?ctrl=security&action=forgottenPassword">Mot de passe oublié?</a> -->
        <button type="submit" name="forgottenPassword" onclick="location.href='index.php?ctrl=security&action=forgottenPassword'"
            style="width: 100%; height: 40px;">Mot de passe oublié?</button>
    </form>
</div>