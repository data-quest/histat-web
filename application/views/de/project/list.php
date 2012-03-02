<table border="0" cellpadding="0" cellspacing="0">
    <?php if(!$projects->loaded()) : ?>
    <?php foreach ($projects->find_all() as $project): ?>

        <tr >
            <td width="10%">ZA <?= $project->ZA_Studiennummer ?></td>
            <td class="even" width="13%"><?= $project->theme->Thema ?></td>
            <td  width="50%"><?= $project->Projektautor ?>, <?= $project->Projektname ?></td>
            <td class="even" width="22%">
                <?= $project->Anzahl_Zeitreihen; ?> Zeitreihen <br/>(<?= $project->Zeitraum ?>)
                <?php $tabellen = $project->getUsedTables(); ?>
                <?= count($tabellen) > 0 ? '<br/>' . count($tabellen) . ' Tabellen' : '' ?> 
            </td>
            <td width="90" class="details"><span><?= HTML::anchor('project/details/'.$project->ID_Projekt, 'Details...')?></span></div></td>

        </tr>

    <?php endforeach ?>
        <?php else: ?>
            <tr >
            <td width="10%">ZA <?= $projects->ZA_Studiennummer ?></td>
            <td class="even" width="13%"><?= $projects->theme->Thema ?></td>
            <td  width="50%"><?= $projects->Projektautor ?>, <?= $projects->Projektname ?></td>
            <td class="even" width="22%">
                <?= $projects->Anzahl_Zeitreihen; ?> Zeitreihen (<?= $projects->Zeitraum ?>)
                <?php $tabellen = $projects->getUsedTables(); ?>
                <?= count($tabellen) > 0 ? '<br/>' . count($tabellen) . ' Tabellen' : '' ?> 
            </td>
            <td width="90" class="details"><span><?= HTML::anchor('project/details/'.$projects->ID_Projekt, 'Details...')?></span></div></td>

        </tr>
        <?php endif; ?>
</table>
<script type="text/javascript">
    var uri = "<?= $uri ?>";
</script>