<div class="main__container">
        <h1>Proposer une rando</h1>

        <form action="index.php?ctrl=security&action=newRando" method="POST">

            <label for="randoTitle">Titre</label>
            <input type="text" name="randoTitle" id="randoTitle"><br>

            <label for="randoSubtitle">SubTitre</label>
            <input type="text" name="randoSubtitle" id="randoSubtitle"><br>

            <label for="distance">Distance (km):</label><br>
            <input type="number" id="distance" name="distance" min="0" step="0.1" required><br>
    
            <label for="description">Trail Description:</label><br>
            <textarea id="description" name="description" rows="5" cols="33" placeholder="Describe the trail..." required></textarea><br><br>

           
            
            <input type="submit" name="publishRando" value="Publier la rando">
        </form>
    </div>