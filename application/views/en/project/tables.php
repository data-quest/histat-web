<?php
$public = $project->Zugangsklasse == "-1";
?>
<div id="project_details" style="display:none" <?= $public?'class="public"':''?>>
    <table border="0" cellpadding="0" cellspacing="0">
        <tr >
            <td width="10%">ZA <?= $project->ZA_Studiennummer ?></td>
            <td class="even" width="13%"><?= $project->theme->Thema ?></td>
            <td  width="50%"><?= $project->Projektautor ?>, <?= $project->Projektname ?></td>
            <td class="timelines hide" width="22%"><?=__('close table view') ?></td>
            <td class="details"><span style="width:100%;display:block;"><?= HTML::anchor('project/details/' . $project->ID_Projekt, __('details...')) ?></span></div></td>

        </tr>
    </table>


  

    <?php
    $keymasks = $project->getKeymasks();
   
    $max = 10;
    $countTables = ceil(count($keymasks) / $max);

    if ($page <= 1) {
        $page = 1;
    } elseif ($page >= $countTables) {
        $page = $countTables;
    }
    $index = 0;
    for ($table = 0; $table < $countTables; $table++):
        ?>
        <table class="border-all" style="<?= $table + 1 != $page ? 'display:none;' : '' ?>margin:10px auto;width:98%">
            
            <?php for ($row = 0; $row < $max; $row++): ?>
                <?php if(isset($keymasks[$index])): ?>
                <tr >
                    <td style="border:0px" width ="10%"></td>
                    <td style="border:0px" valign="top" >
                      
                        <?= isset($keymasks[$index]->Name) ? HTML::anchor('table/details/' . $keymasks[$index]->ID_HS . '#tabelle', $keymasks[$index]->Name) : ''; ?>
                    </td>
                    <td style="border:0px"  valign="top" width ="20%">
                        <div class="link">
                            <?php 
                            $count =$project->getTimelines($keymasks[$index]->ID_HS);
                       
                            ?>
                            <?= isset($keymasks[$index]->Name) ? HTML::anchor('table/details/' . $keymasks[$index]->ID_HS . '#tabelle', __(':timelines Zeitreihen',array(':timelines'=>$count[0]->timelines)))  : ''; ?>
                        </div>
                    </td>
                </tr>
                <?php endif;?>
                <?php $index++ ?>
            <?php endfor; ?>
          
        </table>
    <?php endfor; ?>
    <div class="clear"></div>

    <?php if ($countTables > 1) : ?>
        <div class="pages">


            <?= HTML::anchor('project/tables/' . $project->ID_Projekt . '/' . ($page - 1), "zurück", array('class' => 'prev')) ?>

            <div class="list">
                <?php
                $start = max(0, $page - 7);
                $end   = min($countTables, $page + 7);
                if ($page > $countTables - 7) {
                    $start-= $page + 7 - $countTables;
                }
                if ($page < 7) {
                    $end += 7 - $page;
                }
                ?>
                <div style="width:<?= 15 * 50 ?>px">
                    <?php
                    for ($i = $start; $i < $end; $i++):
                        ?>
                        <?php
                        $attr = array();
                        if ($page == $i + 1) {
                            $attr['class'] = 'current';
                        }
                        ?>
                        <?= HTML::anchor('project/tables/' . $project->ID_Projekt . '/' . ($i + 1), ($i + 1), $attr) ?>
                    <?php endfor; ?>
                </div>
            </div>
            <?= HTML::anchor('project/tables/' . $project->ID_Projekt . '/' . ($page + 1), "vor", array('class' => 'next')) ?>

            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    <?php endif; ?>

</div>
<script type="text/javascript">
    var more = "more...";
    var less = "less...";
    var title = "<?= $project->Projektname ?>"
    var closeText = "close";

</script>