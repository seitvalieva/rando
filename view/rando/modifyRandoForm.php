<?php
$rando = $result["data"]['rando'];

?>
<div class="main__container">
    <h1>Modifier la randonnée</h1>
    <div><span style="color: red"><?= App\Session::getFlash("error") ?></span></div>

    <form action="index.php?ctrl=rando&action=modifyRando&id=<?= $_GET["id"] ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">

        <label for="randoTitle">Titre
            <span class="tooltip-container"> *
                <span class="tooltip-text">Les champs obligatoires</span>
            </span>
        </label>
        <input type="text" name="randoTitle" id="randoTitle" value="<?= $rando->getTitle() ?>" minlength="10" maxlength="255" required><br>

        <label for="randoSubtitle">Introduction
            <span class="tooltip-container"> *
                <span class="tooltip-text">Les champs obligatoires</span>
            </span>
        </label><br>
        <textarea id="randoSubtitle" name="randoSubtitle" rows="2" cols="70" minlength="10"
            maxlength="255" required><?= $rando->getSubtitle() ?></textarea><br><br>

        <label for="dateRando">Date et heure de la randonnée
            <span class="tooltip-container"> *
                <span class="tooltip-text">Les champs obligatoires</span>
            </span>
        </label><br>
        <input type="date" id="dateRando" name="dateRando" value="<?= $rando->getDateRando() ?>" required>
        <!-- <label for="hikeTime">Time of Hike:</label><br> -->
        <input type="time" id="timeRando" name="timeRando" value="<?= $rando->getTimeRando() ?>"><br><br>

        <label for="durationDays">Durée</label><br>
        <input type="number" id="durationDays" name="durationDays" min="0" value="<?= $rando->getDurationDays() ?>" style="width: 70px;">
        <input type="number" id="durationHours" name="durationHours" min="0" max="24" value="<?= $rando->getDurationHours() ?>" style="width: 70px;"><br><br>

        <label for="distance">Distance (km)
            <span class="tooltip-container"> *
                <span class="tooltip-text">Les champs obligatoires</span>
            </span>
        </label><br>
        <input type="number" id="distance" name="distance" value="<?= $rando->getDistance() ?>" min="0" step="0.1" required><br>

        <label for="departure">Point de départ
            <span class="tooltip-container"> *
                <span class="tooltip-text">Les champs obligatoires</span>
            </span>
        </label><br>
        <input type="text" id="departure" name="departure" value="<?= $rando->getDeparture() ?>"  minlength="5" maxlength="255" required><br><br>

        <label for="destination">Point(s) d'intérêt
            <span class="tooltip-container"> *
                <span class="tooltip-text">Les champs obligatoires</span>
            </span>
        </label><br>
        <input type="text" id="destination" name="destination" value="<?= $rando->getDestination() ?>" minlength="3" maxlength="255" required><br><br>

        <label for="description">Description
            <span class="tooltip-container"> *
                <span class="tooltip-text">Les champs obligatoires</span>
            </span>
        </label><br>
        <textarea id="description" name="description" rows="15" cols="70"  minlength="20" maxlength="1500"
            required><?= $rando->getDescription() ?></textarea><br><br>

        <label for="randoImages">Ajouter des images</label><br><br>
        <input type="file" id="randoImages" name="image[]" multiple accept="image/*"><br><br>

        <input type="submit" name="updateRando" value="Enregistrer"
            onclick="return confirm('Enregistrer les modifications ?')">
    </form>
    <!-- Return back button -->
    <button onclick="history.back()" style="padding: 10px 20px; font-size: 16px; cursor: pointer;">Annuler</button>
    
</div>