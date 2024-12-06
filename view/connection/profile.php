<?php
    $user = $result["data"]['user']; 

?>
<div class="profile__container">
    <h1>Mon compte</h1>
    <section>
        <form action="">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">

        <label for="username">Pseudo</label>
        <input type="text" name="username" id="username" minlength="3" maxlength="20" value="<?= htmlspecialchars($user->getUsername()) ?>" required><br>

        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?= htmlspecialchars($user->getEmail()) ?>" readonly required><br><br>
        
        </form>
        <div>
            <a href="index.php?ctrl=security&action=sendForgottenPasswordReset">Changer mot de passe</a><br><br>
        </div>
        <div>
            <a href="index.php?ctrl=security&action=deleteProfile" style="color: red">Supprimer mon compte</a><br><br>
        </div>
        <div>
            <a href="index.php?ctrl=rando&action=myRandosList">Mes randos publiées</a><br><br>
        </div>
        <div>
            <a href="index.php?ctrl=rando&action=myParticipationsList">Mes participations aux randos</a>
        </div>
    </section>
    
</div>