<div id="project_details" style="display:none" >


    <h3>Tabellen:</h3>

    <?php
    $keymasks = $project->keymasks->order_by('Name')->find_all();
    $maxRows = 6;
    $maxCols = 3;
    $countTables = ceil(count($keymasks) / ($maxRows * $maxCols));

    if ($page <= 1) {
        $page = 1;
    } elseif ($page >= $countTables) {
        $page = $countTables;
    }
    $index = 0;
    for ($table = 0; $table < $countTables; $table++):
        ?>
        <table border="0" style="<?= $table + 1 != $page ? 'display:none;' : '' ?>border:0px">

            <?php for ($row = 0; $row < $maxRows; $row++): ?>
                <?php $index = $row + $maxRows * $maxCols * $table; ?>
                <tr >
                    <?php for ($col = 0; $col < $maxCols; $col++): ?>
                        <td valign="top" style="width:30%;border:0px"><?= isset($keymasks[$index]->Name) ? HTML::anchor('table/details/' . $keymasks[$index]->ID_HS . '#thead', $keymasks[$index]->Name) : ''; ?></td>
                        <?php $index +=$maxRows; ?>
                    <?php endfor; ?>

                </tr>
            <?php endfor; ?>
        </table>
    <?php endfor; ?>
    <div class="clear"></div>

    <?php if ($countTables > 1) : ?>
        <div class="pages">


            <?= HTML::anchor('project/tables/' . $project->ID_Projekt . '/' . ($page - 1), "zurück", array('class' => 'prev')) ?>

            <div class="list">
                <?php for ($i = 0; $i < $countTables; $i++): ?>
                    <?php
                    $attr = array('style' => 'left:' . ($i * 50) . 'px');
                    if ($page == $i + 1) {
                        $attr['class'] = 'current';
                    }
                    ?>
                    <?= HTML::anchor('project/tables/' . $project->ID_Projekt . '/' . ($i + 1), ($i + 1), $attr) ?>
                <?php endfor; ?>
            </div>
            <?= HTML::anchor('project/tables/' . $project->ID_Projekt . '/' . ($page + 1), "vor", array('class' => 'next')) ?>

            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    <?php endif; ?>


</div>
<script type="text/javascript">
    var more = "Mehr...";
    var less = "Weniger...";
    var title = "<?= $project->Projektname ?>"
    var closeText = "Schließen";

</script>