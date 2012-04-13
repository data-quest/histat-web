<div id="search_result">
    <h1>
        Ihre Suche ergab <?= count($results) ?> Treffer
    </h1>
    <?php if (count($results) > 0): ?>
        <ul>
            
            <?php foreach ($results as $project) : ?>
                <li><?= $project->Projektname ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>