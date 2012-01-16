<div id="data_new">
    <h1>Liste der neuen Studien</h1><br/>
    <table border="0" cellpadding="0" cellspacing="0">
        <?php foreach ($projects->find_all() as $project): ?>
            <tr >
                <td width="10%">ZA <?=  $project->Studiennummer ?></td>
                 <td class="even" width="13%"><?= $project->theme->Thema ?></td>
                <td  width="50%"><?= $project->Studientitel ?></td>
                <td class="even" width="22%">
                    <?= $project->Anzahl_Zeitreihen; ?> Zeitreihen (<?= $project->Zeitraum?>)
                    <?php $tabellen = $project->getUsedTables();?>
                    <?= count($tabellen) > 0 ?'<br/>'.count($tabellen).' Tabellen':'' ?> 
                </td>
                <td width="90" class="details">Details...<?= Form::hidden('project_id',$project->ID_Projekt)?></td>
             
            </tr>
            
        <?php endforeach ?>
    </table>
    <script type="text/javascript">
    var closeText = "Schließen";
    </script>
</div>