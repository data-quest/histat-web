<div id="table_details" >
    <h1>Tabellenansicht der Studie</h1>
    <?= $project ?>


    <div class="details">
        <div class="name" id="tabelle"><?= $keymask->Name ?></div>
        <?= Form::open('table/details/' . $keymask->ID_HS . '#thead') ?>


        <div class="scrollX">
            <table id="thead">
                <?php $i = 0; ?>

                <?php foreach ($details as $codeKurz => $detail) : ?>
                    <tr >

                        <td>
                            <?php
                            $k = array_keys($detail);
                            $beschreibung = $detail[$k[0]]->CodeBeschreibung;

                            $filters[$codeKurz]["all"] = $beschreibung . ' *';

                            $filters_reversed = array_reverse(Arr::get($filters, $codeKurz));
                            ?>
                            <?= Form::select('filter[]', $filters_reversed, Arr::get($post, $i, "all"), array('style' => 'width:100px')) ?>
                        </td>
                        <?php $i++ ?>
                        <?php foreach ($detail as $key => $value) : ?>
                            <td >
                                <?php $str = substr($detail[$key]->CodeBezeichnung, 0, 30); ?>
                                <?= (strlen($str) >= 30 ? '<div class="text" style="cursor:pointer">' . $str . '... <div class="tooltip"><span></span>' . $detail[$key]->CodeBezeichnung . '</div></div>' : '<div class="text">' . $str . '</div>') ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
                <?php if ($data): ?>
                    <?php if (count(Arr::get($tables, $keys[$k[0]], array())) > 0) : ?>
                        <tr>
                            <td class="grey"><div class="text" style="height:auto">Tabelle</div></td>   
                            <?php foreach ($keys as $key): ?>
                                <td class="grey"><div class="text" style="width:100%;text-align:center"><?= $tables[$key] ?></div></td>

                            <?php endforeach; ?>
                        </tr>
                    <?php endif; ?>
                    <?php if (count(Arr::get($sources, $keys[$k[0]], array())) > 0) : ?>
                        <tr>
                            <td class="grey"><div class="text" style="height:auto">Quelle</div></td>   
                            <?php foreach ($keys as $key): ?>

                                <td class="grey">
                                    <?php $str = substr($sources[$key], 0, 30); ?>
                                    <?= (strlen($str) >= 30 ? '<div class="text" style="cursor:pointer;">' . $str . '... <div class="tooltip" style="width:400px"><span></span>' . $sources[$key] . '</div></div>' : '<div class="text" style="width:100%">' . $str . '</div>') ?>


                                </td>

                            <?php endforeach; ?>
                        </tr>
                    <?php endif; ?>
                    <tr>
                        <td class="blue"><div class="text" style="height:auto">Grafik</div></td>
                        <?php foreach ($keys as $key): ?>
                            <td class="blue"><div class="text"  id="chart" style="height:24px;text-align:center;margin:auto;padding:0;"><?= Form::hidden('title', implode('<br/>', $titles[$key])) ?> <?= Form::hidden('chart', $keymask->ID_HS . '/' . $key) ?><?= HTML::image($assets['img'] . 'layout/button-grafik.png') ?></div></td>

                        <?php endforeach; ?>
                    </tr>
                <?php endif; ?>
            </table>
            <div class="scrollY">
                <?php if ($data): ?>
                    <table id="tdata">

                        <?php foreach ($data as $y => $data): ?>
                            <tr >
                                <td><div class="text" style="height:auto"><?= $y ?></div></td>
                                <?php foreach ($keys as $key): ?>
                                    <td ><div class="text" style="height:auto;text-align:center;margin:auto"><?= Arr::get($data, $key, '&nbsp;') ?></div></td>

                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach; ?> 

                    </table>
                <?php else: ?>
                    <div class="tooltip">
                        Die Studie <b><?= $keymask->Name ?></b> enthält <b><?= count($keys) ?></b> Zeitreihen. <br/>Bitte verwenden Sie die Filtermöglichkeit um die Anzahl der Zeitreihen zu beschränken
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?= Form::close() ?>
    </div>
</div>
<div class="dialog"></div>

<script type="text/javascript">


    var closeText = "Schließen";

</script>
