<div id="project_details" style="display:none" >

    <h3>Kurzportrait:</h3>
    <div>

    </div>
    <hr/>
    <h3>Beschreibung</h3>
    <div>
        <h1>Details zur Studie</h1>
        <?php if (!empty($project->datei_name)): ?>
            <h3>Download:</h3>
            <span>Download weiterer Texte zu dieser Studie im PDF Format (Forschungsberichte, Publikationen, Materialien zur Studie) 
                <?= HTML::anchor('project/download/' . $project->ID_Projekt, 'Download: .pdf', array('class' => 'button')) ?>
                <div class="clear"></div>
            </span>
            <hr/>
        <?php endif ?>
            <span>
                <?= nl2br($project->Projektbeschreibung) ?>
            </span>
    </div>
    <hr/>
    <h3>Quellentypen:</h3>
    <div>

    </div>
    <hr/>

    <br/>


    <h3>Name der Studie</h3>
    <span><?= $project->Projektname ?></span>
    <hr/>
    <h3>Leiter der Studie:</h3>
    <span><?= $project->Projektautor ?></span>
    <hr/>
   
   
    <h3>Zeitraum:</h3>
    <span><?= $project->Zeitraum ?></span>
    <hr/>
    <h3>Anzahl der Zeitreihen:</h3>
    <span><?= $project->Anzahl_Zeitreihen ?></span>
    <hr/>
    <h3>Untersuchungsgebiet:</h3>
    <span><?= $project->Untersuchsungsgebiet ?></span>
    <hr/>
    <h3>Veröffentlichung:</h3>
    <span><?= $project->Veroeffentlichung ?></span>
    <hr/>
    <h3>Quellentypen:</h3>
    <?php if (strlen($project->Quellen) > 200): ?>
        <span class="short">
            <?= nl2br(mb_substr($project->Quellen, 0, 200) . '...') ?>
        </span>
        <span class="full" style="display:none">
            <?= nl2br($project->Quellen) ?>
        </span>
        <span class="more">Mehr...</span>
    <?php else: ?>
        <span><?= nl2br($project->Quellen) ?></span>
    <?php endif ?>
    <hr/>

    <h3>Sachliche Untergliederung der Datentabellen:</h3>
    <?php if (strlen($project->Untergliederung) > 200): ?>
        <span class="short">
            <?= nl2br(mb_substr($project->Untergliederung, 0, 200) . '...') ?>
        </span>
        <span class="full" style="display:none">
            <?= nl2br($project->Untergliederung) ?>
        </span>
        <span class="more">Mehr...</span>
    <?php else: ?>
        <span><?= nl2br($project->Untergliederung) ?></span>
    <?php endif ?>
    <hr/>

    <h3>Tabellenverzeichnis:</h3>
    <?php
    $tabellenverzeichnis = '';
    foreach ($project->getUsedTables() as $table):
        $tabellenverzeichnis .= $table->Tabelle . ' ';
    endforeach;
    ?>

    <?php if (strlen($tabellenverzeichnis) > 200): ?>
        <span class="short">
            <?= nl2br(mb_substr($tabellenverzeichnis, 0, 200) . '...') ?>
        </span>
        <span class="full" style="display:none">
            <?= nl2br($tabellenverzeichnis) ?>
        </span>
        <span class="more">Mehr...</span>
    <?php else: ?>
        <span><?= nl2br($tabellenverzeichnis) ?></span>
    <?php endif ?>
    <hr/>
    <h3>Schlüsselmasken</h3>

    <?php foreach ($project->keymasks->find_all() as $keymask): ?>
        <span style="float:left;width:30%"><?= $keymask->Name ?></span>
    <?php endforeach; ?>
    <div class="clear"></div>
</div>
<script type="text/javascript">
    var more = "Mehr...";
    var less = "Weniger...";
    var title = "<?= $project->Projektname ?>"
    var closeText = "Schließen";

</script>