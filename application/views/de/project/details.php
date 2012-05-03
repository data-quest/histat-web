<div id="project_details" style="display:none" >

    <h1>Studiendetails:</h1>

    <a href="#" style="visbility:hidden"></a>
    <span class="normal">
        <?= nl2br($project->Projektbeschreibung) ?>
    </span>

    <hr/>
    <?php if (!empty($project->datei_name)): ?>
        <h4>Download:</h4>
        <span>Download weiterer Texte zu dieser Studie im PDF Format (Forschungsberichte, Publikationen, Materialien zur Studie) 
            <?= HTML::anchor('project/download/' . $project->ID_Projekt, 'Download: .pdf', array('class' => 'button')) ?>
        </span>
        <div class="clear"></div>
        <hr/>
    <?php endif ?>
    <h4>Name der Studie:</h4>
    <span class="normal" ><?= $project->Projektname ?></span>
    <hr/>

    <h4>Leiter der Studie:</h4>
    <span class="normal" ><?= $project->Projektautor ?></span>
    <hr/>
    <h4>Zeitraum:</h4>
    <span class="normal"><?= $project->Zeitraum ?></span>
    <hr/>
    <h4>Anzahl der Zeitreihen:</h4>
    <span class="normal" ><?= $project->Anzahl_Zeitreihen ?></span>
    <hr/>
    <h4>Untersuchungsgebiet:</h4>
    <span class="normal" ><?= $project->Untersuchsungsgebiet ?></span>
    <hr/>
    <h4>Veröffentlichung:</h4>
    <span class="normal" ><?= $project->Veroeffentlichung ?></span>
    <hr/>

    <h4>Quellentypen:</h4>
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