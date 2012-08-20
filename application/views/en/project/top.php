<table border="0" cellpadding="0" cellspacing="0">
    
        <?php foreach ($projects as $project): ?>

            <tr >
                <td width="10%">ZA <?= $project->Studiennummer ?></td>
                <td class="even" width="13%"><?= $project->Thema ?></td>
                    <?php 
                $bearbeitung = '';
                $datum = substr($project->Datum_der_Bearbeitung,-4);
                if(!empty($datum)){
                    $bearbeitung = '['.$datum.']';
                }
                ?>
            <td  width="50%"><?= $project->Autor ?> (<?= $project->Publikationsjahr ?> <?= $bearbeitung ?>), <?= $project->Studientitel ?></td>
          
           
                <td class="timelines" width="22%">
    
                    <?php $tabellen = ORM::factory('Project',$project->ID_Projekt)->getUsedTables(); ?>
                    <?php count($tabellen) > 0 ? $tabellen = '<br/>' . count($tabellen) .' '. __('Tables'): $tabellen ='' ?> 
                         <?= HTML::anchor('project/tables/' . $project->ID_Projekt, $project->Anzahl_Zeitreihen . ' '.__('Time series').'<br/>(' . $project->Zeitraum . ')' . $tabellen) ?>
          
                </td>
                <td width="150" class="details"><span><?= HTML::anchor('project/details/' . $project->ID_Projekt, __('Details...')) ?></span></div></td>

            </tr>

        <?php endforeach ?>

</table>
<script type="text/javascript">
    var uri = "<?= $uri ?>";
</script>