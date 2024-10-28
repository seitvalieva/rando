<?php

    $users = $result["data"]['users']; 

?>
<div class="main__container">
    <h1>Liste des utilisateurs</h1>
    <section>
    <?php if($users) {
        foreach($users as $user ) { ?>
            <br><p><span class="fas fa-user">&nbsp;<?= $user->getUsername() ?></p>
            <ul>
                <li><?= $user->getEmail() ?></li>
                <li><?= $user->getRole() ?></li>
                <li><?= $user->getRegistrationDate() ?></li>
                <a href="index.php?ctrl=admin&action=deleteUser&id=<?= $user->getId() ?>" style="color: red">Supprimer l'utilisateur</a>
            </ul>
        <?php } ?>
    <?php } ?>
    </section>
    
</div>