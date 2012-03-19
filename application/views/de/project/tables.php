<div id="project_details" style="display:none" >


    <h3>Tabellen:</h3>

    <?php
    $keymasks = $project->keymasks->order_by('Name')->find_all();
    $maxRows = 6;
    $maxCols = 3;
    $countTables = ceil(count($keymasks) / ($maxRows * $maxCols));
    $i = 0;

    for ($table = 0; $table < $countTables; $table++):
        ?>
        <table border="0" style="<?= $table > 0 ? 'display:none;' : '' ?>border:0px">
            <?php for ($row = 0; $row < $maxRows; $row++): ?>
                <tr >
                    <?php for ($col = 0; $col < $maxCols; $col++): ?>
                        <?php $index = ceil((($i + 1) / $maxCols) + ($col * ($maxRows))) - 1; ?>
                        <td valign="top" style="width:30%;border:0px"><?= isset($keymasks[$index]->Name) ? HTML::anchor('table/details/' . $keymasks[$index]->ID_HS.'#thead', $keymasks[$index]->Name) : ''; ?></td>
                        <?php $i++; ?>
                    <?php endfor; ?>
                </tr>
            <?php endfor; ?>
        </table>
    <?php endfor; ?>
    <div class="clear"></div>
    
   <?php if($countTables > 1) : ?>
        <div class="pages">
            <a href="prev" class="prev">zurück</a>
            <div class="list">
                <?php for ($i = 0; $i < $countTables; $i++): ?>
                    <a href="#<?= $i + 1 ?>" style="left:<?= $i*50 ?>px"><?= $i + 1 ?></a>
                <?php endfor; ?>
            </div>
            <a href="next" class="next">vor</a>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
   <?php endif;?>


</div>
<script type="text/javascript">
    var more = "Mehr...";
    var less = "Weniger...";
    var title = "<?= $project->Projektname ?>"
    var closeText = "Schließen";

</script>