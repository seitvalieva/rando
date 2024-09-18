<?php
$results = $result["data"]['results'];
?>

<div class="main__container">
    <h1>Les randonnées autour de</h1>

    <?php if (!empty($results)): ?>
        <ul>
            <?php foreach ($results as $result): ?>
                <li>
                    
                    <h2><?php echo htmlspecialchars($result->getTitle()); ?></h2>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No results found.</p>
    <?php endif; ?>
    
</div>
