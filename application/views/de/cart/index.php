<div id="cart">
    <h1>Warenkorb</h1>
    <?php if ($message) : ?>
        <div class="tooltip" style="position: relative;margin:1em 0">
            <?php
            switch ($message) {
                case 'error': echo 'Filter Konnte nicht gelöscht werden';
                    break;
                case 'success': echo 'Filter Erfolgreich gelöscht';
                    break;
                default: echo 'Ubekannter Fehler';
                    break;
            }
            ?>
        </div>
    <?php endif; ?>
    <?php if (count($filters) > 0): ?>


        <table class="result">

            <?php foreach ($projects as $projectID => $project): ?>


                <tr>
                    <td width="10%">ZA <?= $project['za'] ?></td>
                    <td width="15%" class="even"><?= $project['theme'] ?></td>
                    <td width="55%"><?= $project['name'] ?></td>
                    <td width="23%" class="even found show"><input type="hidden" name="id" value="<?= $projectID ?>" />Tabellen anzeigen</td>
                    <td style="display:none" width="23%" class="even found hide"><input type="hidden" name="id" value="<?= $projectID ?>" />Tabellen schließen</td>

                </tr>

                <tr class="empty tables <?= $projectID ?>" style="display: display">
                    <td width="10%" style="border:0px"></td>
                    <td class="nopadding tabes" style="border:0px" colspan="3" >
                        <?php foreach ($tables[$projectID] as $tableID => $tableName) : ?>
                         <div class="normal" style="margin:5px"><?= $tableName ?> <a href="#" class="more" style="float:right">mehr</a>
                            <?php foreach ($filters[$projectID][$tableID] as $filter => $values) : ?>
                             <ul style="display:none">
                                                <?php foreach ($values as $value) : ?>
                                                    <li><?= $value ?></li>
                                                <?php endforeach; ?>
                                     
                                <?= HTML::anchor('table/details/' . $tableID . '/' . $filter . '#tabelle', __('Show'), array('target' => 'blank')) ?>
                                    </ul>                       
                         <?php endforeach; ?>
                        </div>
                        <?php endforeach; ?>
                    </td>

                </tr>



            <?php endforeach; ?>
        </table>



    <?php else : ?>
        <h3>Ihr Warenkorb ist leer</h3>
    <?php endif; ?>


</div>