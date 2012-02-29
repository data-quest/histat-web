<div id="table_details">
    <h1>Tabllenansicht der Studie</h1>
    <?= $project ?>


    <div class="details">
        <div class="name"><?= $keymask->Name ?></div>


        <div id="scrollX" style="height:auto;overflow-y:hidden;overflow-x: auto;">
            <table style="width:100%;" id="headline">
                <thead>

                    <?php foreach ($details as $beschreibung => $details) : ?>


                        <tr >
                            <?php $i = 0; ?>
                            <td><div class="text"><?= $beschreibung ?></div></td>

                            <?php foreach ($keys as $key) : ?>
                                <td class="col<?= $i ?>"><div class="text">
                                            
                               
                                        <?php $str = substr($details[$key]->CodeBezeichnung, 0, 30); ?>
                                        <?= (strlen($str) >= 30 ? $str . '... <div class="tooltip"><span></span>'.$details[$key]->CodeBezeichnung.'</div>' : $str) ?>
                                        
                                    </div>
                                </td>
                                <?php $i++; ?>

                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </tr>





                    <tr>
                        <td class="blue"><div class="text" style="height:auto">Grafik</div></td>
                        <?php foreach ($keys as $key): ?>
                            <td class="blue"><div class="text"  id="chart" style="height:24px;text-align:center;margin:auto;padding:0;"><?= Form::hidden('title',implode(' - ',Arr::get($titles,$key))) ?> <?= Form::hidden('chart', $keymask->ID_HS . '/' . $key) ?><?= HTML::image($assets['img'] . 'layout/button-grafik.png') ?></div></td>

                        <?php endforeach; ?>
                    </tr>
                    <tr>
                        <td class="blue"> <div class="text" style="height:auto">Warenkorb</div></td>
                        <?php foreach ($keys as $key): ?>
                            <td class="blue" ><div class="text" style="height:24px;text-align:center;margin:auto;padding:0;"><?= HTML::anchor('cart/add/' .$keymask->ID_HS.'/'. $key, HTML::image($assets['img'] . 'layout/button-warenkorb.png')) ?></div></td>

                        <?php endforeach; ?>
                    </tr>
                </thead>

            </table>
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
