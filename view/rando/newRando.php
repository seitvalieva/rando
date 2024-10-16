<div class="main__container">
    <h1>Proposer une rando</h1>
    <div><span style="color: red">
        <?= App\Session::getFlash("error") ?></span>
    </div>
        
    <form action="index.php?ctrl=rando&action=addNewRando" method="POST" enctype="multipart/form-data">

        <label for="randoTitle">Titre</label>
        <span class="tooltip-container"> *
            <span class="tooltip-text">Les champs obligatoires</span>
        </span>
        <input type="text" name="randoTitle" id="randoTitle" minlength="10" maxlength="255" required><br>

        <label for="randoSubtitle">Introduction</label>
        <span class="tooltip-container"> *
            <span class="tooltip-text">Les champs obligatoires</span>
        </span><br>
        <textarea id="randoSubtitle" name="randoSubtitle" rows="2" cols="70"
            placeholder="Écrivez un paragraphe accrocheur..(max 255 charactères)" minlength="10" maxlength="255"
            required><?= $_POST['randoSubtitle'] ?? '' ?></textarea><br><br>

        <label for="dateRando">Date et heure de la Rando</label>
        <span class="tooltip-container"> *
            <span class="tooltip-text">Les champs obligatoires</span>
        </span><br>
        <input type="date" id="dateRando" name="dateRando" required>
        <input type="time" id="timeRando" name="timeRando" required><br><br>

        <label for="durationDays">Durée</label><br>
        <input type="number" id="durationDays" name="durationDays" step="1" placeholder="1" style="width: 70px;">
        <span>jours</span>
        <input type="number" id="durationHours" name="durationHours" step="0.5" placeholder="1"
            style="width: 70px;">
            <span>heures</span><br><br>

        <label for="distance">Distance (km)</label>
        <span class="tooltip-container"> *
            <span class="tooltip-text">Les champs obligatoires</span>
        </span><br>
        <input type="number" id="distance" name="distance" min="0" step="0.1" required><br>

        <label for="departure">Point de départ</label>
        <span class="tooltip-container"> *
            <span class="tooltip-text">Les champs obligatoires</span>
        </span><br>
        <input type="text" id="departure" name="departure" placeholder="Gare de Strasbourg.." minlength="5"
            maxlength="255" required><br><br>

        <label for="destination">Point(s) d'arrivée</label>
        <span class="tooltip-container"> *
            <span class="tooltip-text">Les champs obligatoires</span>
        </span><br>
        <input type="text" id="destination" name="destination" placeholder="Lac Blanc, Col de la Schlucht, .."
            minlength="3" maxlength="255" required><br><br>

        <label for="description">Description</label>
        <span class="tooltip-container"> *
            <span class="tooltip-text">Les champs obligatoires</span>
        </span><br>
        <textarea id="description" name="description" rows="15" cols="70"
            placeholder="Desription détaillée...(max 1500 charactères)" minlength="20" maxlength="1500"
            required><?= $_POST['description'] ?? '' ?></textarea><br><br>

        <label for="randoImages">Ajouter des images</label><br><br>
        <input type="file" id="randoImages" name="image[]" multiple accept="image/*"><br><br>

        <input type="submit" name="submitRando" value="Publier la rando">
    </form>
</div>