        <h1>Se connecter</h1>
        <form action="index.php?ctrl=security&action=login"method="post" autocomplete="off"><!--STRUCTURE DE L'URL POUR DECLENCHER UNE ACTION: INDEX.PHP?CTRL ACTION= METHOD= ID= -->
            <label for="email">Email</label>
            <input type="email" name="email" id="email"><br>

            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password"><br>

            <input type="submit" name="submitLogin" value="Se connecter">
        </form>