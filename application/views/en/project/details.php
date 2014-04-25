<?php
$public      = $project->Zugangsklasse == "-1";
?>

<?php $fundort     = nl2br($project->Untersuchungsgebiet); ?>
<?php $publication = nl2br($project->Veroeffentlichung); ?>
<?php
$bearbeitung = '';
$datum       = substr($project->Datum_der_Bearbeitung, -4);
if (!empty($datum)) {
    $bearbeitung = '[' . $datum . ']';
}
?>
<?php
$quote       = __(':author, (:pub_year :edit_year) :project GESIS Köln, Deutschland ZA:za Datenfile :file', array(':author'    => $project->Projektautor,
    ':pub_year'  => $project->Publikationsjahr,
    ':edit_year' => $bearbeitung,
    ':project'   => $project->Projektname,
    ':za'        => $project->ZA_Studiennummer,
    ':file'      => $project->Bemerkungen));
?>
<div id="project_details" style="display:none" <?= $public ? 'class="public"' : '' ?>>
    <table border="0" cellpadding="0" cellspacing="0">
        <tr >
            <td width="10%">ZA <?= $project->ZA_Studiennummer ?></td>
            <td class="even" width="13%"><?= $project->theme->Thema ?></td>
            <td  width="50%"><?= $project->Projektautor ?>, <?= $project->Projektname ?></td>
            <td class="timelines" width="22%">
                <?php $tabellen    = $project->getUsedTables(); ?>
                <?php count($tabellen) > 0 ? $tabellen    = '<br/>' . count($tabellen) . ' Tabellen' : $tabellen    = '' ?>
                <?= HTML::anchor('project/tables/' . $project->ID_Projekt, $project->Anzahl_Zeitreihen . ' Zeitreihen<br/>(' . $project->Zeitraum . ')' . $tabellen) ?>
            </td>
            <td class="details hide"><span style="width:100%;display:block;">Beschreibungsansicht schließen</span></div></td>

        </tr>
    </table>




    <a href="#" style="visbility:hidden"></a>
    <h1>Bibiographische Angaben</h1>

    <div class="content">
        <div class="right"></div>
        <div class="normal left">
            <b>Studiennummer:</b> ZA <?= $project->ZA_Studiennummer ?><br/>
            <b>Studientitel:</b> <?= $project->Projektname ?><br/>
            <b>Erhebungs- bzw. Untersuchungszeitraum:</b> <?= $project->Zeitraum ?><br/>
            <b>Pirmärforscher:</b> <?= $project->Projektautor ?><br/>
            <b>Veröffentlichung (gedruckte Veröffentlichung):</b> <?= $publication ?><br/>
            <b>Empfohlene Zitation (Datensatz):</b> <?= $quote ?><br/>
        </div>
        <div class="clear"></div>
    </div>

    <h1>Inhalt der Studie</h1>

    <?php $description = nl2br($project->Projektbeschreibung); ?>
    <?php $len         = strlen($description); ?>
    <?php if ($len > 0) : ?>
        <h4>Studienbeschreibung </h4>
        <div class="content">
            <div class="right"><?= $len > 300 ? '<span class="more">Mehr</span>' : '' ?></div>
            <div class="normal left <?= $len > 300 ? 'short' : '' ?>"><?= $description ?></div>
            <div class="clear"></div>
        </div>
    <?php endif; ?>


    <h1>Methodologie</h1>

    <?php $len = strlen($fundort); ?>
    <?php if ($len > 0) : ?>
        <h4>Untersuchungsgebiet</h4>
        <div class="content">
            <div class="right"><?= $len > 300 ? '<span class="more">Mehr</span>' : '' ?></div>
            <div class="normal left <?= $len > 300 ? 'short' : '' ?>"><?= $fundort ?></div>
            <div class="clear"></div>
        </div>
    <?php endif; ?>

    <?php $quellenverzeichnis = nl2br($project->Fundort) ?>
    <?php $len                = strlen($quellenverzeichnis); ?>
    <?php if ($len > 0) : ?>
        <h4>Quellentypen</h4>
        <div class="content">
            <div class="right"><?= $len > 300 ? '<span class="more">Mehr</span>' : '' ?></div>
            <div class="normal left <?= $len > 300 ? 'short' : '' ?>"><?= $quellenverzeichnis ?></div>
            <div class="clear"></div>
        </div>
    <?php endif; ?>
    <?php $sources = nl2br($project->Quellen) ?>
    <?php $len     = strlen($sources); ?>
    <?php if ($len > 0) : ?>
        <h4>Verwendete Quellen (ausführliches Verzeichnis)</h4>
        <div class="content">
            <div class="right"><?= $len > 300 ? '<span class="more">Mehr</span>' : '' ?></div>
            <div class="normal left <?= $len > 300 ? 'short' : '' ?>"><?= $sources ?></div>
            <div class="clear"></div>
        </div>
    <?php endif; ?>
    <?php $notes = nl2br($project->Anmerkungsteil); ?>
    <?php $len   = strlen($notes); ?>
    <?php if ($len > 0) : ?>
        <h4>Anmerkungen</h4>
        <div class="content">
            <div class="right"><?= $len > 300 ? '<span class="more">Mehr</span>' : '' ?></div>
            <div class="normal left <?= $len > 300 ? 'short' : '' ?>"><?= $notes ?></div>
            <div class="clear"></div>
        </div>
    <?php endif; ?>
    <h1>Bearbeitungshinweise</h1>
    <h4>Datum der Archivierung</h4>
    <div class="content">
        <div class="right"></div>
        <div class="normal left"><?= $project->Datum_der_Archivierung ?></div>
        <div class="clear"></div>
    </div>
    <h4>Jahr der Online-Publikation</h4>
    <div class="content">
        <div class="right"></div>
        <div class="normal left"><?= $project->Publikationsjahr ?></div>
        <div class="clear"></div>
    </div>
    <h4>Bearbeiter in GESIS</h4>
    <div class="content">
        <div class="right"></div>
        <div class="normal left"><?= $project->Bearbeiter_im_ZA ?></div>
        <div class="clear"></div>
    </div>
    <h4>Version</h4>
    <div class="content">
        <div class="right"></div>
        <div class="normal left"><?= $project->Bemerkungen ?></div>
        <div class="clear"></div>
    </div>
    <h4>Zugangsklasse</h4>
    <div class="content">
        <div class="right"></div>
        <div class="normal left"><?= $project->Zugangsklasse ?></div>
        <div class="clear"></div>
    </div>
    <h1>Materialien zur Studie</h1>


    <h4>Download:</h4>
    <div class="content">
        <?php
        $text = HTML::image('assets/img/layout/download.png', array('class' => 'pdficon')) . __('DDI-XML');
        ?>
        <div class="right"> <?= HTML::anchor('project/export/' . $project->ID_Projekt, $text, array('class' => 'button')) ?></div>

        <div class="normal left">Diese Studienbeschreibung als DDI-XML.</div>
        <div class="clear"></div>
    </div>
    <?php if (!empty($project->datei_name)): ?>
        <div class="content">
            <?php
            $kb   = strlen($project->datei_inhalt) / 1024;
            $mb   = $kb / 1024;
            $text = round($kb, 2) . ' KB';
            if ($kb > 1024) $text = round($mb, 2) . ' MB';
            $text = HTML::image('assets/img/layout/pdficon_small.png', array('class' => 'pdficon')) . $text;
            ?>
            <div class="right"> <?= HTML::anchor('project/download/' . $project->ID_Projekt, $text, array('class' => 'button')) ?></div>
            <div class="normal left short">Download weiterer Texte zu dieser Studie im PDF Format (Forschungsberichte, Publikationen, Materialien zur Studie) </div>
            <div class="clear"></div>
        </div>
    <?php endif ?>


</div>
<script type="text/javascript">
    var more = "more...";
    var less = "less...";
    var title = "<?= $project->Projektname ?>"
    var closeText = "close";
</script>