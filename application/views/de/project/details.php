<div id="project_details" >
    <h1>Details zur Studie: <br/><?= $project->Projektname ?></h1>
    <hr/>
    <h3>Beschreibung:</h3>
    <p>
        <?= nl2br($project->Projektbeschreibung) ?>

    </p>
    <span class="more">Mehr...</span>
    <hr/>
    <h3>Quellentypen:</h3>
    <p>
        <?= nl2br($project->Quellen) ?>
    </p>
    <span class="more">Mehr...</span>
    <hr/>
    <h3>Tabellenverzeichnis:</h3>
    <p>
       <?php foreach($project->getUsedTables() as $table): ?>
        <?= $table->Tabelle?>
        <?php endforeach; ?>
    </p>
    <span class="more">Mehr...</span>

</div>