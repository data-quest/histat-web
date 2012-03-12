<div id="project_details" style="display:none" >

    <h3>Kurzportrait:</h3>
    <div class="text">
        <span> Lorem Ipsum usw</span>
    </div>
    <span class="more">Mehr...</span>
    <hr/>
    <h3>Beschreibung:</h3>
    <div class="text" style="height:80px;">
        <a href="#" style="visbility:hidden"></a>
        <span>
            <?= nl2br($project->Projektbeschreibung) ?>
        </span>

        <hr/>
        <?php if (!empty($project->datei_name)): ?>
            <h3>Download:</h3>
            <span>Download weiterer Texte zu dieser Studie im PDF Format (Forschungsberichte, Publikationen, Materialien zur Studie) 
                <?= HTML::anchor('project/download/' . $project->ID_Projekt, 'Download: .pdf', array('class' => 'button')) ?>
            </span>
            <div class="clear"></div>
            <hr/>
        <?php endif ?>
        <h3>Name der Studie:</h3>
        <span><?= $project->Projektname ?></span>
        <hr/>

        <h3>Leiter der Studie:</h3>
        <span><?= $project->Projektautor ?></span>
        <hr/>
        <h3>Zeitraum:</h3>
        <span><?= $project->Zeitraum ?></span>
        <hr/>
        <h3>Anzahl der Zeitreihen:</h3>
        <span><?= $project->Anzahl_Zeitreihen ?></span>
        <hr/>
        <h3>Untersuchungsgebiet:</h3>
        <span><?= $project->Untersuchsungsgebiet ?></span>
        <hr/>
        <h3>Veröffentlichung:</h3>
        <span><?= $project->Veroeffentlichung ?></span>
        <hr/>

        <h3>Quellentypen:</h3>
        <div class="text">
            <span><?= nl2br($project->Quellen) ?></span>
        </div>

    </div>

    <span class="more">Mehr...</span>
    <hr/>
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
                            <td valign="top" style="width:30%;border:0px"><?= isset($keymasks[$index]->Name) ? HTML::anchor('table/details/' . $keymasks[$index]->ID_HS, $keymasks[$index]->Name) : ''; ?></td>
                            <?php $i++; ?>
                        <?php endfor; ?>
                    </tr>
                <?php endfor; ?>
            </table>
        <?php endfor; ?>
        <div class="clear"></div>
        <?php if (1 == 2): ?>
            <div class="pages">
                <a href="prev" class="prev">zurück</a>
                <div>
                    <?php for ($i = 0; $i < 100; $i++): ?>
                        <a href="#<?= $i + 1 ?>"><?= $i + 1 ?></a>
                    <?php endfor; ?>
                </div>
                <a href="next" class="next">vor</a>
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