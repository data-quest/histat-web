<div id="table_details">
    <h1>Tabellenansicht der Studie</h1>
    <?= $project ?>


    <div class="details">
        <div class="name"><?= $keymask->Name ?></div>
        <?= Form::open('table/details/' . $keymask->ID_HS); ?>

        <div id="scrollX" style="height:auto;overflow-y:hidden;overflow-x: auto;">
             <?= Form::open('table/details/'.$keymask->ID_HS) ?>
            <table style="width:100%;" id="headline">
                <thead>
                  <?php $i = 0; ?>
                    <?php foreach ($details as $beschreibung => $details) : ?>
                        <tr >
                           
                            <td><div class="text">
                                    <?php
                                    $filters[$beschreibung][$beschreibung] = $beschreibung . ' *';
                                    $filters_reversed = array_reverse(Arr::get($filters, $beschreibung));
                                    
                                    ?>
                                    <?= Form::select('filter[]', $filters_reversed, Arr::get($post,$i,$beschreibung), array('style' => 'width:100px')) ?></div></td>
                           <?php $i++?>
                            <?php foreach ($keys as $key) : ?>
                                <td ><div class="text">


                                        <?php $str = substr($details[$key]->CodeBezeichnung, 0, 30); ?>
                                        <?= (strlen($str) >= 30 ? $str . '... <div class="tooltip"><span></span>' . $details[$key]->CodeBezeichnung . '</div>' : $str) ?>

                                    </div>
                                </td>


                            <?php endforeach; ?>
                           
                        </tr>
                        <?php endforeach; ?>
                    <tr>
                        <td class="blue"><div class="text" style="height:auto">Grafik</div></td>
                        <?php foreach ($keys as $key): ?>
                            <td class="blue"><div class="text"  id="chart" style="height:24px;text-align:center;margin:auto;padding:0;"><?= Form::hidden('title', implode(' - ', Arr::get($titles, $key))) ?> <?= Form::hidden('chart', $keymask->ID_HS . '/' . $key) ?><?= HTML::image($assets['img'] . 'layout/button-grafik.png') ?></div></td>

                        <?php endforeach; ?>
                    </tr>
                    <tr>
                        <td class="blue"> <div class="text" style="height:auto">Warenkorb</div></td>
                        <?php foreach ($keys as $key): ?>
                            <td class="blue" ><div class="text" style="height:24px;text-align:center;margin:auto;padding:0;"><?= HTML::anchor('cart/add/' . $keymask->ID_HS . '/' . $key, HTML::image($assets['img'] . 'layout/button-warenkorb.png')) ?></div></td>

                        <?php endforeach; ?>
                    </tr>
                </thead>

            </table>
                <?= Form::close();?>
            <div id="scrollY" style="overflow:hidden;overflow-y:scroll;height:100px">
                <table>
                    <tbody>

                        <?php foreach ($data as $y => $data): ?>
                            <tr >

                                <?php $i = 0; ?>
                                <td><div class="text" style="height:auto"><?= $y ?></div></td>
                                <?php foreach ($keys as $key): ?>
                                    <td class="col<?= $i ?>"><div class="text" style="height:auto;text-align:center;margin:auto"><?= Arr::get($data, $key, '&nbsp;') ?></div></td>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach; ?> 
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="dialog"></div>
<script type="text/javascript">


    var closeText = "Schließen";

</script>
