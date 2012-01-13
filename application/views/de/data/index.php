<div id="data_new">
    <h1>Liste der neuen Studien</h1><br/>
    <table border="0" cellpadding="0" cellspacing="0">
        <?php foreach ($projects->find_all() as $project): ?>
            <tr >
                <td width="10%">ZA <?=  $project->Studiennummer ?></td>
                <td class="even" width="60%"><?= $project->Studientitel ?></td>
                <td width="25%">
                    <?= $project->Anzahl_Zeitreihen; ?> Zeitreihen (<?= $project->Zeitraum?>)
                    <?php $tabellen = $project->getUsedTables();?>
                    <?= count($tabellen) > 0 ?'<br/>'.count($tabellen).' Tabellen':'' ?> 
                </td>
                <td width="8%" class="details"><span><?= HTML::anchor('project/details/'.$project->ID_Projekt,'Details...') ?></span></td>
                <td width="2%" ></td>
            </tr>
            
        <?php endforeach ?>
    </table>

</div>