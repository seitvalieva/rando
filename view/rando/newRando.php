<div class="main__container">
    <h1>Créer une randonnée</h1>

    <?= isset($_SESSION['errors']['csrf']) ? "<div style='color: red'>{$_SESSION['errors']['csrf']}</div>" : '' ?>    

    <form action="index.php?ctrl=rando&action=addNewRando" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
        
        <label for="randoTitle">Titre
            <span class="tooltip-container"> *
                <span class="tooltip-text">Les champs obligatoires</span>
            </span>
        </label>
        <?php $title = isset($_POST['randoTitle']) ? $_POST['randoTitle']: ''?>
        <input type="text" name="randoTitle" id="randoTitle" value="<?= htmlspecialchars($title); ?>" 
                        minlength="10" maxlength="255" required><br>
        <?= isset($_SESSION['errors']['randoTitle']) ? "<span style='color: red'>{$_SESSION['errors']['randoTitle']}</span>" : '' ?>    

        <label for="randoSubtitle">Introduction
            <span class="tooltip-container"> *
                <span class="tooltip-text">Les champs obligatoires</span>
            </span>
        </label><br>
        <textarea id="randoSubtitle" name="randoSubtitle" rows="2" cols="70"
            placeholder="Écrivez un paragraphe accrocheur..(max 255 charactères)" minlength="10" maxlength="255"
            required><?= htmlspecialchars($_POST['randoSubtitle'] ?? '') ?></textarea><br>
        <?= isset($_SESSION['errors']['randoSubtitle']) ? "<span style='color: red'>{$_SESSION['errors']['randosubtitle']}</span>" : '' ?>

        <label for="dateRando">Date et heure de la Rando
            <span class="tooltip-container"> *
                <span class="tooltip-text">Les champs obligatoires</span>
            </span>
        </label><br>
        <input type="date" id="dateRando" name="dateRando" min="<?= date('Y-m-d'); ?>" required>
        <input type="time" id="timeRando" name="timeRando" min="<?= date('H:i'); ?>" required><br><br>
        <?= isset($_SESSION['errors']['dateRando']) ? "<span style='color: red'>{$_SESSION['errors']['dateRando']}</span>" : '' ?>

        <label for="durationDays">Durée</label><br>
        <input type="number" id="durationDays" name="durationDays" min="1" step="1" placeholder="1" style="width: 70px;">
        <span>jours</span>
        <input type="number" id="durationHours" name="durationHours" min="0" step="0.5" placeholder="1"
            style="width: 70px;"><br><br>
        <?= isset($_SESSION['errors']['durationDays']) ? "<span style='color: red'>{$_SESSION['errors']['durationDays']}</span>" : '' ?>
        <?= isset($_SESSION['errors']['durationHours']) ? "<span style='color: red'>{$_SESSION['errors']['durationHours']}</span>" : '' ?>
        
        <label for="distance">Distance (km)
            <span class="tooltip-container"> *
                <span class="tooltip-text">Les champs obligatoires</span>
            </span>
        </label><br>
        <input type="number" id="distance" name="distance" min="1" step="0.5" value="<?= htmlspecialchars($_POST['distance'] ?? '') ?>" required><br>
        <?= isset($_SESSION['errors']['distance']) ? "<span style='color: red'>{$_SESSION['errors']['distance']}</span>" : '' ?>
        
        <label for="departure">Point de départ
            <span class="tooltip-container"> *
                <span class="tooltip-text">Les champs obligatoires</span>
            </span>
        </label><br>
        <?php $departure = isset($_POST['departure']) ? $_POST['departure']: ''?>
        <input type="text" id="departure" name="departure" value="<?= htmlspecialchars($departure); ?>" placeholder="Gare de Strasbourg.." minlength="5"
        maxlength="255" required><br><br>
        <?= isset($_SESSION['errors']['departure']) ? "<span style='color: red'>{$_SESSION['errors']['departure']}</span>" : '' ?>
        
        <label for="destination">Point(s) d'intérêt
            <span class="tooltip-container"> *
                <span class="tooltip-text">Les champs obligatoires</span>
            </span>            
        </label><br>
        <?php $destination = isset($_POST['destination']) ? $_POST['destination']: ''?>
        <input type="text" id="destination" name="destination" placeholder="Lac Blanc, Col de la Schlucht, .." value="<?= htmlspecialchars($destination); ?>"
        minlength="3" maxlength="255" required><br><br>
        <?= isset($_SESSION['errors']['destination']) ? "<span style='color: red'>{$_SESSION['errors']['destination']}</span>" : '' ?>
        
        <label for="description">Description
            <span class="tooltip-container"> *
                <span class="tooltip-text">Les champs obligatoires</span>
            </span>
        </label><br>
        <textarea id="description" name="description" rows="15" cols="70"
        placeholder="Desription détaillée...(max 1500 charactères)" minlength="20" maxlength="1500"
        required><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea><br><br>
        <?= isset($_SESSION['errors']['description']) ? "<span style='color: red'>{$_SESSION['errors']['description']}</span>" : '' ?>
        
        <label for="randoImages">Ajouter des images</label><br><br>
        <input type="file" id="randoImages" name="image[]" multiple accept="image/*"><br><br>
        <?= isset($_SESSION['errors']['images']) ? "<span style='color: red'>{$_SESSION['errors']['images']}</span>" : '' ?>

        <input type="submit" name="submitRando" value="Publier la randonnée" 
            onclick="return confirm('Veuillez confirmer la publication de la randonnée')">
        <?php unset($_SESSION['errors']); // Clear errors after displaying ?>   
         <!-- Return back button -->
        <button onclick="history.back()" style="padding: 10px 20px; font-size: 16px; cursor: pointer;">Annuler</button>
    </form>
    <?php unset($_SESSION['errors']); // Clear errors after displaying ?>
</div>