<?php
$rando = $result["data"]['rando'];

?>
<div class="main__container">
    <h1>Modifier la rando</h1>

    <form action="index.php?ctrl=connection&action=modifyRando&id=<?= $_GET["id"] ?></form>" method="POST" enctype="multipart/form-data">

        <label for="randoTitle">Titre:<span class="required">*</span></label>
        <input type="text" name="randoTitle" id="randoTitle" value="<?= $rando->getTitle() ?>" minlength="10" maxlength="255" required><br>

        <label for="randoSubtitle">Introduction <span class="required">*</span></label><br>
        <textarea id="randoSubtitle" name="randoSubtitle" value="<?= $rando->getSubtitle() ?>" rows="2" cols="70" minlength="10"
            maxlength="255" required></textarea><br><br>

        <label for="dateRando">Date et heure de la Rando <span class="required">*</span></label><br>
        <input type="date" id="dateRando" name="dateRando" value="<?= $rando->getDateRando() ?>" required>
        <!-- <label for="hikeTime">Time of Hike:</label><br> -->
        <input type="time" id="timeRando" name="timeRando" value="<?= $rando->getTimeRando() ?>"><br><br>

        <label for="durationDays">Durée :</label><br>
        <input type="number" id="durationDays" name="durationDays" min="0" placeholder="jours" style="width: 70px;">
        <input type="number" id="durationHours" name="durationHours" min="0" max="24" placeholder="heures" style="width: 70px;"><br><br>

        <label for="distance">Distance (km) <span class="required">*</span></label><br>
        <input type="number" id="distance" name="distance" value="<?= $rando->getDistance() ?>" min="0" step="0.1" required><br>

        <label for="departure">Point de départ <span class="required">*</span></label><br>
        <input type="text" id="departure" name="departure" value="<?= $rando->getDeparture() ?>"  minlength="5" maxlength="255" required><br><br>

        <label for="destination">Point(s) d'arrivée <span class="required">*</span></label><br>
        <input type="text" id="destination" name="destination" value="<?= $rando->getDestination() ?>" minlength="3" maxlength="255" required><br><br>

        <label for="description">Description <span class="required">*</span></label><br>
        <textarea id="description" name="description" value="<?= $rando->getDescription() ?>" rows="15" cols="70"  minlength="20" maxlength="1500"
            required></textarea><br><br>

        <label for="randoImages">Ajouter des images:</label><br><br>
        <input type="file" id="randoImages" name="image[]" multiple accept="image/*"><br><br>

        <input type="submit" name="submitRando" value="Publier la rando">
    </form>
</div>