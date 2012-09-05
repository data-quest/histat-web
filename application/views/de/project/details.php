
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
            <td class="details hide"><span style="width:100%;display:block;">Beschreibungsansicht schließen</span></div></td>

        </tr>
    </table>

    <h1>Studienbeschreibung:</h1>
    <h4>DDI Export</h4>
     <div class="content">
           <?php
                      $text = HTML::image('assets/img/layout/download.png',array('class'=>'pdficon')).__('Download');  
            ?>
            <div class="right"> <?= HTML::anchor('project/export/' . $project->ID_Projekt, $text, array('class' => 'button')) ?></div>
       
            <div class="normal left"></div>
            <div class="clear"></div>
        </div>
    <a href="#" style="visbility:hidden"></a>
    <?php
    $bearbeitung = '';
    $datum = substr($project->Datum_der_Bearbeitung, -4);
    if (!empty($datum)) {
        $bearbeitung = '[' . $datum . ']';
    }
    ?>
    <?php
    $quote = __(':author, (:pub_year :edit_year) :project GESIS Köln, Deutschland ZA:za Datenfile :file', array(':author' => $project->Projektautor,
        ':pub_year' => $project->Publikationsjahr,
        ':edit_year' => $bearbeitung,
        ':project' => $project->Projektname,
        ':za' => $project->ZA_Studiennummer,
        ':file' => $project->Bemerkungen));
    ?>
    <?php $len = strlen($quote); ?>
    <?php if ($len > 0) : ?>
        <h4>Datensatz (in empfohlener Zitierweise)</h4>
        <div class="content">
            <div class="right"><?= $len > 300 ? '<span class="more">Mehr</span>' : '' ?></div>
            <div class="normal left <?= $len > 300 ? 'short' : '' ?>"><?= $quote ?></div>
            <div class="clear"></div>
        </div>
    <?php endif; ?>
    <?php $notes = nl2br($project->Anmerkungsteil); ?>
    <?php $len = strlen($notes); ?>
    <?php if ($len > 0) : ?>
        <h4>Anmerkungen </h4>
        <div class="content">
            <div class="right"><?= $len > 300 ? '<span class="more">Mehr</span>' : '' ?></div>
            <div class="normal left <?= $len > 300 ? 'short' : '' ?>"><?= $notes ?></div>
            <div class="clear"></div>
        </div>
    <?php endif; ?>
    <?php $publication = nl2br($project->Veroeffentlichung); ?>

    <?php $len = strlen($publication); ?>
    <?php if ($len > 0) : ?>
        <h4>Gedruckte Publikation</h4>
        <div class="content">
            <div class="right"><?= $len > 300 ? '<span class="more">Mehr</span>' : '' ?></div>
            <div class="normal left <?= $len > 300 ? 'short' : '' ?>"><?= $publication ?></div>
            <div class="clear"></div>
        </div>
    <?php endif; ?>



    <?php $description = nl2br($project->Projektbeschreibung); ?>
    <?php $len = strlen($description); ?>
    <?php if ($len > 0) : ?>
        <h4>Studienbeschreibung </h4>
        <div class="content">
            <div class="right"><?= $len > 300 ? '<span class="more">Mehr</span>' : '' ?></div>
            <div class="normal left <?= $len > 300 ? 'short' : '' ?>"><?= $description ?></div>
            <div class="clear"></div>
        </div>
    <?php endif; ?>

    <?php if (!empty($project->datei_name)): ?>
        <h4>Download:</h4>
        <div class="content">
            <?php $kb = strlen($project->datei_inhalt)/1024;
            $mb = $kb/1024;
                    $text = round($kb,2).' KB';
                    if($kb > 1024) $text = round($mb,2). ' MB';
                      $text = HTML::image('assets/img/layout/pdficon_small.png',array('class'=>'pdficon')).$text;  
            ?>
            <div class="right"> <?= HTML::anchor('project/download/' . $project->ID_Projekt, $text, array('class' => 'button')) ?></div>
            <div class="normal left short">Download weiterer Texte zu dieser Studie im PDF Format (Forschungsberichte, Publikationen, Materialien zur Studie) </div>
            <div class="clear"></div>
        </div>
    <?php endif ?>
    <?php $sources = nl2br($project->Quellen) ?>
    <?php $len = strlen($sources); ?>
    <?php if ($len > 0) : ?>
        <h4>Verwendete Quellen:</h4>
        <div class="content">
            <div class="right"><?= $len > 300 ? '<span class="more">Mehr</span>' : '' ?></div>
            <div class="normal left <?= $len > 300 ? 'short' : '' ?>"><?= $sources ?></div>
            <div class="clear"></div>
        </div>
    <?php endif; ?>
    <?php $fundort = nl2br($project->Untersuchungsgebiet); ?>
    <?php $len = strlen($fundort); ?>
    <?php if ($len > 0) : ?>
        <h4>Untersuchungsgebiet:</h4>
        <div class="content">
            <div class="right"><?= $len > 300 ? '<span class="more">Mehr</span>' : '' ?></div>
            <div class="normal left <?= $len > 300 ? 'short' : '' ?>"><?= $fundort ?></div>
            <div class="clear"></div>
        </div>
    <?php endif; ?>
    <?php $quellenverzeichnis = nl2br($project->Fundort) ?>
    <?php $len = strlen($quellenverzeichnis); ?>
    <?php if ($len > 0) : ?>
        <h4>Quellenverzeichnis:</h4>
        <div class="content">
            <div class="right"><?= $len > 300 ? '<span class="more">Mehr</span>' : '' ?></div>
            <div class="normal left <?= $len > 300 ? 'short' : '' ?>"><?= $quellenverzeichnis ?></div>
            <div class="clear"></div>
        </div>
    <?php endif; ?>
</div>
<script type="text/javascript">
    var more = "Mehr...";
    var less = "Weniger...";
    var title = "<?= $project->Projektname ?>"
    var closeText = "Schließen";
</script>