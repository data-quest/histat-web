<div id="search_result">
    <div style="padding:2em">
    <?php if ($show): ?>
        <h1>
            Ihre Suche ergab <?= count($results) ?> Treffer
        </h1>
    <?php endif; ?>
    <?php if (count($results) > 0): ?>

        <ul class="result">

            <?php foreach ($results as $project) : ?>
                <li><?= $project->Projektname ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    </div>
</div>