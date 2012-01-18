<table border="0" cellpadding="0" cellspacing="0">
    <?php foreach ($projects->find_all() as $project): ?>
        <tr >
            <td width="10%">ZA <?= $project->ZA_Studiennummer ?></td>
            <td class="even" width="13%"><?= $project->theme->Thema ?></td>
            <td  width="50%"><?= $project->Projektautor ?>, <?= $project->Projektname ?></td>
            <td class="even" width="22%">
                <?= $project->Anzahl_Zeitreihen; ?> Zeitreihen (<?= $project->Zeitraum ?>)
                <?php $tabellen = $project->getUsedTables(); ?>
                <?= count($tabellen) > 0 ? '<br/>' . count($tabellen) . ' Tabellen' : '' ?> 
            </td>
            <td width="90" class="details"><span>Details...<?= Form::hidden('project_id', $project->ID_Projekt) ?></span><div class="tooltip" style="display:none"><span></span><a href="#" class="timeline">Zeitreiehenauswahl</a><br/><a href="#" class="project_details">Studiendetails</a></div></td>

        </tr>

    <?php endforeach ?>
</table>
<script type="text/javascript">
    var closeText = "Schließen";
</script>