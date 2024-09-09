        <br><h1>Se connecter</h1><br><br>
        <form action="index.php?ctrl=security&action=login"method="post" autocomplete="off"><!--STRUCTURE DE L'URL POUR DECLENCHER UNE ACTION: INDEX.PHP?CTRL ACTION= METHOD= ID= -->
            <label for="email">Email</label>
            <input type="email" name="email" id="email"><br>

            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password"><br><br>

            <!-- <input type="submit" name="submitLogin" value="Se connecter"> -->
            <button type="submit" name="submitLogin" style="width: 100%; height: 40px;">Se connecter</button><br><br>
            <button type="button" name="submitLogin" style="width: 100%; height: 40px;">Mot de passe oublié?</button><br><br>
        </form>