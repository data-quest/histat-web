<div id="table_details" >
    <h1>Tabellenansicht der Studie</h1>
    <?= $project ?>


    <div class="details">
        <div style="margin:auto;padding:15px 0;text-align: center">
            <?php $data ? $class = 'button' : $class = 'button disabled' ?>
            <?php $data ? $id = array('class' => $class, 'id' => 'cart') : $id = array('class' => $class) ?>
            <?= HTML::anchor($data ? 'download/xls/' . $keymask->ID_HS . '/' . $filter : 'table/details/' . $keymask->ID_HS, 'Download: .XLS', array('class' => $class)) ?>

            <?= HTML::anchor($data ? 'download/xlsx/' . $keymask->ID_HS . '/' . $filter : 'table/details/' . $keymask->ID_HS, 'Download: .XLSX', array('class' => $class)) ?>
            <?= HTML::anchor($data ? 'download/csv/' . $keymask->ID_HS . '/' . $filter : 'table/details/' . $keymask->ID_HS, 'Download: .CSV', array('class' => $class)) ?>
            <?= HTML::anchor('table/details/' . $keymask->ID_HS . '/' . $filter.'#', 'In den Warenkorb', $id) ?>

            <div class="clear"></div>
        </div>
        <div class="name" id="tabelle"><?= $keymask->Name ?> (Gefundene Zeitreihen: <b><?= $data ? count($keys) : '<span style="color:#FE8F00">' . count($keys) . '</span>' ?></b>)</div>
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
                             $selected = Arr::get($post, $i, "all");
                            echo Form::hidden('filter_text[]', $beschreibung . ' : ' . Arr::get($filters[$codeKurz], $selected, __('All')));
                            echo Form::hidden('id', $keymask->ID_HS);
                            echo Form::hidden('filter_string', $filter);
                            $filters[$codeKurz]["all"] = $beschreibung . ' *';

                            $filters_reversed = array_reverse(Arr::get($filters, $codeKurz));
                           
                            ?>
                            <?= Form::select('filter[]', $filters_reversed, $selected, array('style' => 'width:100px')) ?>
                        </td>
                        <?php $i++ ?>
                        <?php foreach ($detail as $key => $value) : ?>
                            <td >
                                <?php $str = mb_substr($detail[$key]->CodeBezeichnung, 0, 30); ?>
                                <?= (strlen($str) >= 30 ? '<div class="text" style="cursor:pointer">' . $str . '... <div class="tooltip"><span></span>' . $detail[$key]->CodeBezeichnung . '</div></div>' : '<div class="text">' . $str . '</div>') ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
                <?php if ($data): ?>
                    <?php if (count(array_filter($tables)) > 0) : ?>
                        <tr>
                            <td class="grey"><div class="text" style="height:auto">Tabelle</div></td>   
                            <?php foreach ($keys as $key): ?>
                                <td class="grey"><div class="text" style="width:100%;text-align:center"><?= $tables[$key] ?></div></td>

                            <?php endforeach; ?>
                        </tr>
                    <?php endif; ?>
                    <?php if (count(array_filter($sources)) > 0) : ?>
                        <tr>
                            <td class="grey"><div class="text" style="height:auto">Quellen</div></td>   
                            <?php foreach ($keys as $key): ?>

                                <td class="grey">
                                    <?php $str = mb_substr($sources[$key], 0, 30); ?>
                                    <?= (strlen($str) >= 30 ? '<div class="text" style="cursor:pointer;">' . $str . '... <div class="tooltip" style="width:400px"><span></span>' . $sources[$key] . '</div></div>' : '<div class="text" style="width:100%">' . $str . '</div>') ?>


                                </td>

                            <?php endforeach; ?>
                        </tr>
                    <?php endif; ?>
                    <?php if (count(array_filter($notes)) > 0) : ?>
                        <tr>
                            <td class="grey"><div class="text" style="height:auto">Anmerkungen</div></td>   
                            <?php foreach ($keys as $key): ?>

                                <td class="grey">
                                    <?php $str = mb_substr($notes[$key], 0, 30); ?>
                                    <?= (strlen($str) >= 30 ? '<div class="text" style="cursor:pointer;">' . $str . '... <div class="tooltip" style="width:400px"><span></span>' . $notes[$key] . '</div></div>' : '<div class="text" style="width:100%">' . $str . '</div>') ?>


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
                                    <?php $d = Arr::get($data, $key, array('data' => '&nbsp;', 'note' => NULL)); ?>
                                    <td >
                                        <?php if ($d['note']) : ?>
                                            <div class="text" style="height:auto;text-align:center;margin:auto;text-decoration: underline;cursor: pointer;font-weight: bold"> <?= $d['data'] ?> 
                                                <div class="tooltip" style="display:none;margin-left:20px"><span></span><?= $d['note'] ?></div>
                                            </div>
                                        <?php else: ?>
                                            <div class="text" style="height:auto;text-align:center;margin:auto"> <?= $d['data'] ?> </div>
                                        <?php endif; ?>


                                    </td>

                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach; ?> 

                    </table>
                <?php else: ?>
                    <div class="tooltip" id="info">
                        Die Tabelle <b><?= $keymask->Name ?></b> enthält <b><?= count($keys) ?></b> Zeitreihen. <br/>Bitte verwenden Sie die Filtermöglichkeit um die Anzahl der Zeitreihen zu beschränken
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
