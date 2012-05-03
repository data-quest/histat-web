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

            <?php foreach ($projects as $projectID => $projectName): ?>


                <tr>
                    <td width="10%">ZA asd</td>
                    <td width="15%" class="even"></td>
                    <td width="55%"><?= $projectName ?></td>
                    <td width="23%" class="even found show"><input type="hidden" name="id" value="<?= $projectID ?>" />Tabellen anzeigen</td>
                    <td style="display:none" width="23%" class="even found hide"><input type="hidden" name="id" value="<?= $projectID ?>" />Tabellen schließen</td>

                </tr>

                <tr class="empty tables <?= $projectID ?>" style="display: display">
                    <td width="10%" style="border:0px"></td>
                    <td class="nopadding tabes" style="border:0px" colspan="3" >
                        <?php foreach ($tables[$projectID] as $tableID => $tableName) : ?>
                         <div><?= $tableName ?> <a href="#" class="more">mehr</a>
                            <?php foreach ($filters[$projectID][$tableID] as $filter => $values) : ?>
                             <ul>
                                                <?php foreach ($values as $value) : ?>
                                                    <li><?= $value ?></li>
                                                <?php endforeach; ?>
                                         </ul> 
                                <?= HTML::anchor('table/details/' . $tableID . '/' . $filter . '#tabelle', __('Show'), array('target' => 'blank')) ?>
                                                      
                         <?php endforeach; ?>
                        </div>
                        <?php endforeach; ?>
                    </td>

                </tr>



            <?php endforeach; ?>
        </table>


        <ul class="projects">
            <li class="header"><h3>Projekte</h3></li>
            <?php foreach ($projects as $projectID => $projectName): ?>
                <li><span class="more"></span><b><?= $projectName ?></b></li>
                <li class="tables"><ul> 
                        <li class="header"><h3>Tabellen</h3></li>
                        <?php foreach ($tables[$projectID] as $tableID => $tableName) : ?>
                            <li><span class="more"></span><?= $tableName ?></li>
                            <li class="filters" ><ul>
                                    <li class="header"><h3>Filter</h3></li>
                                    <?php foreach ($filters[$projectID][$tableID] as $filter => $values) : ?>

                                        <li><ul class="values">
                                                <?php foreach ($values as $value) : ?>
                                                    <li><?= $value ?></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </li>
                                        <li><?= HTML::anchor('cart/delete/' . $tableID . '/' . $filter, __('Delete')) ?> | <?= HTML::anchor('table/details/' . $tableID . '/' . $filter . '#tabelle', __('Show'), array('target' => 'blank')) ?> </li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                        <?php endforeach; ?>
                    </ul> 
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <h3>Ihr Warenkorb ist leer</h3>
    <?php endif; ?>


</div>