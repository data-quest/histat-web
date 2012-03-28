<div id="project_details" style="display:none" >

    <h3>Beschreibung:</h3>

    <a href="#" style="visbility:hidden"></a>
    <span class="normal">
        <?= nl2br($project->Projektbeschreibung) ?>
    </span>

    <hr/>
    <?php if (!empty($project->datei_name)): ?>
        <h3>Download:</h3>
        <span>Download weiterer Texte zu dieser Studie im PDF Format (Forschungsberichte, Publikationen, Materialien zur Studie) 
            <?= HTML::anchor('project/download/' . $project->ID_Projekt, 'Download: .pdf', array('class' => 'button')) ?>
        </span>
        <div class="clear"></div>
        <hr/>
    <?php endif ?>
    <h3>Name der Studie:</h3>
    <span class="normal" ><?= $project->Projektname ?></span>
    <hr/>

    <h3>Leiter der Studie:</h3>
    <span class="normal" ><?= $project->Projektautor ?></span>
    <hr/>
    <h3>Zeitraum:</h3>
    <span class="normal"><?= $project->Zeitraum ?></span>
    <hr/>
    <h3>Anzahl der Zeitreihen:</h3>
    <span class="normal" ><?= $project->Anzahl_Zeitreihen ?></span>
    <hr/>
    <h3>Untersuchungsgebiet:</h3>
    <span class="normal" ><?= $project->Untersuchsungsgebiet ?></span>
    <hr/>
    <h3>Veröffentlichung:</h3>
    <span class="normal" ><?= $project->Veroeffentlichung ?></span>
    <hr/>

    <h3>Quellentypen:</h3>
    <div class="text">
        <span class="normal" ><?= nl2br($project->Quellen) ?></span>
    </div>




</div>
<script type="text/javascript">
    var more = "Mehr...";
    var less = "Weniger...";
    var title = "<?= $project->Projektname ?>"
    var closeText = "Schließen";

</script>