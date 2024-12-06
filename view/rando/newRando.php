<div class="container">
    <div class="rando-container"> 
        <h1 class="form-title">Créer une randonnée</h1>
        <?= isset($_SESSION['errors']['csrf']) ? "<div style='color: red'>{$_SESSION['errors']['csrf']}</div>" : '' ?>  
        <small style="color:grey;">* les champs obligatoires</small>
        <form action="index.php?ctrl=rando&action=addNewRando" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
            <div class="input-group">
                <label for="randoTitle">Titre
                    <span class="tooltip-container"> *
                        <span class="tooltip-text">Le titre doit contenir entre 10 et 255 caractères</span>
                    </span>
                </label>
                <?php $title = isset($_POST['randoTitle']) ? $_POST['randoTitle']: ''?>
                <input type="text" name="randoTitle" id="randoTitle" value="<?= htmlspecialchars($title); ?>" 
                                minlength="10" maxlength="255" required>
                <?= isset($_SESSION['errors']['randoTitle']) ? "<span style='color: red'>{$_SESSION['errors']['randoTitle']}</span>" : '' ?>    
            </div>
            <div class="input-group">
                <label for="randoSubtitle">Introduction
                    <span class="tooltip-container"> *
                        <span class="tooltip-text">Le titre doit contenir entre 10 et 255 caractères</span>
                    </span>
                </label>
                <textarea id="randoSubtitle" name="randoSubtitle" rows="2" cols="70"
                    placeholder="Écrivez un paragraphe accrocheur..(max 255 charactères)" minlength="10" maxlength="255"
                    ><?= htmlspecialchars($_POST['randoSubtitle'] ?? '') ?></textarea>
                <?= isset($_SESSION['errors']['randoSubtitle']) ? "<span style='color: red'>{$_SESSION['errors']['randoSubtitle']}</span>" : '' ?>
            </div>
            <div class="datetime-group">
                <label for="dateRando">Date et heure de la Rando
                    <span class="tooltip-container"> *
                        <span class="tooltip-text">Le champ obligatoire</span>
                    </span>
                </label>
                <div>
                    <input type="date" id="dateRando" name="dateRando" min="<?= date('Y-m-d'); ?>" required>
                    <input type="time" id="timeRando" name="timeRando" required>
                </div>
                <?= isset($_SESSION['errors']['dateRando']) ? "<span style='color: red'>{$_SESSION['errors']['dateRando']}</span>" : '' ?>
            </div>
            <div class="duration-group">
                <label for="durationDays">Durée en jours ou en heures</label>
                <div>
                    <input type="number" id="durationDays" name="durationDays" min="1" step="1" placeholder="1">
                    <span>jours</span>
                    <input type="number" id="durationHours" name="durationHours" min="0" step="0.5" placeholder="1">
                    <span>heures</span>
                </div>
                <?= isset($_SESSION['errors']['durationDays']) ? "<span style='color: red'>{$_SESSION['errors']['durationDays']}</span>" : '' ?>
                <?= isset($_SESSION['errors']['durationHours']) ? "<span style='color: red'>{$_SESSION['errors']['durationHours']}</span>" : '' ?>
            </div>
            <div class="input-group">
                <label for="distance">Distance (km)
                    <span class="tooltip-container"> *
                        <span class="tooltip-text">Le champ obligatoire, minimum 1 km</span>
                    </span>
                </label>
                <input type="number" id="distance" name="distance" min="1" step="0.5" value="<?= htmlspecialchars($_POST['distance'] ?? '') ?>" required>
                <?= isset($_SESSION['errors']['distance']) ? "<span style='color: red'>{$_SESSION['errors']['distance']}</span>" : '' ?>
            </div>
            <div class="input-group">
                <label for="departure">Point de départ
                    <span class="tooltip-container"> *
                        <span class="tooltip-text">Le champ doit contenir entre 10 et 255 caractères</span>
                    </span>
                </label>
                <?php $departure = isset($_POST['departure']) ? $_POST['departure']: ''?>
                <input type="text" id="departure" name="departure" value="<?= htmlspecialchars($departure); ?>" placeholder="Strasbourg" minlength="5"
                    maxlength="255" required>
                <?= isset($_SESSION['errors']['departure']) ? "<span style='color: red'>{$_SESSION['errors']['departure']}</span>" : '' ?>
            </div>
            <div class="input-group">
                <label for="destination">Point(s) d'intérêt
                    <span class="tooltip-container"> *
                        <span class="tooltip-text">Le champ doit contenir entre 3 et 255 caractères</span>
                    </span>            
                </label>
                <?php $destination = isset($_POST['destination']) ? $_POST['destination']: ''?>
                <input type="text" id="destination" name="destination" placeholder="Lac Blanc, Col de la Schlucht, .." value="<?= htmlspecialchars($destination); ?>"
                    minlength="3" maxlength="255" required>
                <?= isset($_SESSION['errors']['destination']) ? "<span style='color: red'>{$_SESSION['errors']['destination']}</span>" : '' ?>
            </div>
            <div class="input-group">
                <label for="description">Description
                    <span class="tooltip-container"> *
                        <span class="tooltip-text">Le champ doit contenir entre 20 et 1500 caractères</span>
                    </span>
                </label>
                <textarea id="description" name="description" rows="15" cols="70"
                    placeholder="Desription détaillée...(max 1500 charactères)" minlength="20" maxlength="1500"
                    required><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>
                <?= isset($_SESSION['errors']['description']) ? "<span style='color: red'>{$_SESSION['errors']['description']}</span>" : '' ?>
            </div>
            <div class="image-group">
                <label for="randoImages">Ajouter des images
                    <span class="tooltip-container" style="color:blue;"> &#9432;
                        <span class="tooltip-text">La taille maximale d'une image 1Mo</span>
                    </span>
                </label>
                <input type="file" id="randoImages" name="image[]" multiple accept="image/*">
                <?= isset($_SESSION['errors']['images']) ? "<span style='color: red'>{$_SESSION['errors']['images']}</span>" : '' ?>
            </div>
            <div class="btn-group">
                <button type="submit" name="submitRando" value="Publier la randonnée" class="publish-btn"
                    onclick="return confirm('Veuillez confirmer la publication de la randonnée')">Publier la randonnée
                </button> 
                <?php unset($_SESSION['errors']); // Clear errors after displaying ?>   
                 <!-- Return back button -->
                <button class="cancel-btn" onclick="history.back()">Annuler</button>
            </div>
            <?php unset($_SESSION['errors']); // Clear errors after displaying ?>
        </form>
    </div>
</div>