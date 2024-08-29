<div class="main__container">
    <h1>Proposer une rando</h1>

    <form action="index.php?ctrl=security&action=" method="POST">

        <label for="randoTitle">Titre :</label>
        <input type="text" name="randoTitle" id="randoTitle" required><br>

        <label for="subTitle">Introduction :</label><br>
        <textarea id="subTitle" name="subTitle" rows="2" cols="33" placeholder="Écrivez un paragraphe accrocheur.."
            required></textarea><br><br>

        <label for="randoDate">Date et heure de la Rando :</label><br>
        <input type="date" id="randoDate" name="randoDate" required><br>
        <!-- <label for="hikeTime">Time of Hike:</label><br> -->
        <input type="time" id="hikeTime" name="hikeTime"><br><br>

        <label for="duration">Durée :</label><br>
        <input type="number" id="durationDays" name="durationDays" min="0" placeholder="Days" style="width: 70px;">
        <input type="number" id="durationHours" name="durationHours" min="0" max="24" placeholder="Hours" style="width: 70px;"><br><br>

        <label for="distance">Distance (km) :</label><br>
        <input type="number" id="distance" name="distance" min="0" step="0.1" required><br>

        <label for="departure">Point de départ:</label><br>
        <input type="text" id="departure" name="departure" required><br><br>

        <label for="arrival">Point d'arrivée :</label><br>
        <input type="text" id="arrival" name="arrival" required><br><br>

        <label for="description">Description :</label><br>
        <textarea id="description" name="description" rows="15" cols="70" placeholder="Desription détaillée..."
            required></textarea><br><br>

        <label for="randoImages">Ajouter des images:</label><br>
        <input type="file" id="randoImages" name="randoImages[]" multiple accept="image/*"><br><br>

        <input type="submit" name="publishRando" value="Publier la rando">
    </form>
</div>