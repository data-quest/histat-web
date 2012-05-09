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


        <table class="result" style="margin:10px 0px">

            <?php foreach ($projects as $projectID => $project): ?>


                <tr>
                    <td width="10%">ZA <?= $project['za'] ?></td>
                    <td width="15%" class="even"><?= $project['theme'] ?></td>
                    <td width="55%"><?= $project['name'] ?></td>
                    <td width="23%" class="even found show"><span class="id" style="display:none"><?= $projectID ?></span>Tabellen anzeigen</td>
                    <td style="display:none" width="23%" class="even found hide"><span class="id" style="display:none"><?= $projectID ?></span>Tabellen schließen</td>

                </tr>

                <tr class="empty tables <?= $projectID ?>" style="display: none">
                   
                    <td class="nopadding tabes" style="border:0px" colspan="4" >
                        <?php foreach ($tables[$projectID] as $tableID => $tableName) : ?>
                            <div style="padding:5px">
                                <?php foreach ($filters[$projectID][$tableID] as $filter => $values) : ?>
                                    <div class="left" style="width:10%;text-align: center"><?= Form::checkbox('selected[]', $tableID.'/'.$filter); ?></div>
                                    <div class="normal left"><h4><?= $tableName ?></h4></div>
                                    <div class="right">
                                        <span class="more"><?= HTML::anchor('table/details/' . $tableID . '/' . $filter . '#tabelle', __(':timelines Zeitreihen', array(':timelines' => $values['timelines']))) ?></span>
                                        <span class="delete"> <?= HTML::anchor('cart/delete/' . $tableID . '/' . $filter, '') ?></span>
                                    </div>
                                    <div class="clear"></div>

                                    <?php foreach ($values['text'] as $value) : ?>

                                        <?php if (!stristr($value, __('All'))) : ?>
                                            <p class="filter"><?= $value ?><p>
                                            <?php endif ?>
                                        <?php endforeach; ?>

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