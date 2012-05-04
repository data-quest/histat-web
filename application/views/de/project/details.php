
<div id="project_details" style="display:none" >
    <table border="0" cellpadding="0" cellspacing="0">
        <tr >
            <td width="10%">ZA <?= $project->ZA_Studiennummer ?></td>
            <td class="even" width="13%"><?= $project->theme->Thema ?></td>
            <td  width="50%"><?= $project->Projektautor ?>, <?= $project->Projektname ?></td>
            <td class="timelines" width="22%">
                <?php $tabellen = $project->getUsedTables(); ?>
                <?php count($tabellen) > 0 ? $tabellen = '<br/>' . count($tabellen) . ' Tabellen' : $tabellen = '' ?> 
                <?= HTML::anchor('project/tables/' . $project->ID_Projekt, $project->Anzahl_Zeitreihen . ' Zeitreihen<br/>(' . $project->Zeitraum . ')' . $tabellen) ?>
            </td>
            <td class="details hide"><span style="width:100%;display:block;text-align: right;"> Detailansicht schließen</span></div></td>

        </tr>
    </table>

    <h1>Studiendetails:</h1>
    <a href="#" style="visbility:hidden"></a>

    <?php $publication = nl2br($project->Veroeffentlichung); ?>
    <h4>Gedruckte Publikation</h4>
    <div class="content">
        <div class="right"><?= strlen($publication) > 300 ? '<span class="more">Mehr</span>' : '' ?></div>
        <div class="normal left short"><?= $publication ?></div>
        <div class="clear"></div>
    </div>



    <?php $description = nl2br($project->Projektbeschreibung); ?>
    <h4>Studienbeschreibung </h4>
    <div class="content">
        <div class="right"><?= strlen($description) > 300 ? '<span class="more">Mehr</span>' : '' ?></div>
        <div class="normal left short"><?= $description ?></div>
        <div class="clear"></div>
    </div>


    <?php if (!empty($project->datei_name)): ?>
        <h4>Download:</h4>
        <div class="content">
            <div class="right"> <?= HTML::anchor('project/download/' . $project->ID_Projekt, 'Download: .pdf', array('class' => 'button')) ?></div>
            <div class="normal left short">Download weiterer Texte zu dieser Studie im PDF Format (Forschungsberichte, Publikationen, Materialien zur Studie) </div>
            <div class="clear"></div>
        </div>
    <?php endif ?>
    <?php $sources = nl2br($project->Quellen) ?>
    <h4>Verwendete Quellen:</h4>
    <div class="content">
        <div class="right"><?= strlen($sources) > 300 ? '<span class="more">Mehr</span>' : '' ?></div>
        <div class="normal left short"><?= $sources ?></div>
        <div class="clear"></div>
    </div>
    <?php $fundort = nl2br($project->Fundort) ?>
    <h4>Untersuchungsgebiet:</h4>
    <div class="content">
        <div class="right"><?= strlen($fundort) > 300 ? '<span class="more">Mehr</span>' : '' ?></div>
        <div class="normal left short"><?= $fundort ?></div>
        <div class="clear"></div>
    </div>

    <?php $quellenverzeichnis = nl2br($project->Fundort) ?>
    <h4>Quellenverzeichnis:</h4>
    <div class="content">
        <div class="right"><?= strlen($quellenverzeichnis) > 300 ? '<span class="more">Mehr</span>' : '' ?></div>
        <div class="normal left short"><?= $quellenverzeichnis ?></div>
        <div class="clear"></div>
    </div>
</div>
<script type="text/javascript">
    var more = "Mehr...";
    var less = "Weniger...";
    var title = "<?= $project->Projektname ?>"
    var closeText = "Schließen";
</script>