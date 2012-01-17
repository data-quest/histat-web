<div id="themes_overview">
    <ul>
        <?php
        foreach ($theme_list as $theme)
            echo '<li>' . HTML::anchor('data/themes/' . $theme->ID_Thema, $theme->Thema) . '</li>';
        ?>
    </ul>
    <div class="clear"></div>
    <hr/>
    <div class="project_list">
        <table border="0" cellpadding="0" cellspacing="0">
            <?php foreach ($projects as $project): ?>
                <tr >
                    <td width="10%">ZA <?= $project->ZA_Studiennummer ?></td>
                    <td class="even" width="13%"><?= $project->theme->Thema ?></td>
                    <td  width="50%"><?= $project->Projektname ?></td>
                    <td class="even" width="22%">
                        <?= $project->Anzahl_Zeitreihen; ?> Zeitreihen (<?= $project->Zeitraum ?>)
                        <?php $tabellen = $project->getUsedTables(); ?>
                        <?= count($tabellen) > 0 ? '<br/>' . count($tabellen) . ' Tabellen' : '' ?> 
                    </td>
                    <td width="90" class="details"><span>Details...<?= Form::hidden('project_id', $project->ID_Projekt) ?></span></td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</div>
<script type="text/javascript">
    var closeText = "Schließen";
</script>