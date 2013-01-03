<div id="table_details" >
    <h1 class="left">Tabellenansicht der Studie</h1>
    <?php if (Session::instance()->get('search', false)) : ?>
        <span class="back right"><?= HTML::anchor('search/extended', __('Zurück zur Suche...')) ?></span>

    <?php endif; ?>
    <div class="clear"></div>
    <?= $project ?>

    <?php $data ? $download = 'download enabled' : $download = 'download disabled' ?>
    <?php $id_hs = $keymask->ID_HS; ?>
    <?php $id_projekt = $keymask->project->ID_Projekt; ?>
    <div class="tooltip loading">
        <?= HTML::image('assets/img/layout/loader.gif') ?> Wird geladen...
    </div>
    <div class="details" style="display:none">
        <div class="name" id="tabelle"><div ><?= $keymask->Name ?> (Gefundene Zeitreihen: <b><?= $data ? count($keys) : '<span style="color:#FE8F00">' . count($keys) . '</span>' ?></b>)</div> 
            <div class="download_icons">
                <div class="<?= $download ?>"><?= __('Download') ?></div>
                <div class="buttons" style="position: absolute" >
                    <?php $data ? $class = 'button' : $class = 'button disabled' ?>
                    <?php $data ? $id = array('class' => $class, 'id' => 'cart', 'onclick' => 'return false;') : $id = array('class' => $class, 'onclick' => 'return false;') ?>   <?= HTML::anchor($data ? 'download/xls/' . $id_hs . '/' . $filter : 'table/details/' . $id_hs, '.XLS', array('class' => $class)) ?>
                    <?= HTML::anchor($data ? 'download/xlsx/' . $id_hs . '/' . $filter : 'table/details/' . $id_hs, '.XLSX', array('class' => $class)) ?>
                    <?= HTML::anchor($data ? 'download/csv/' . $id_hs . '/' . $filter : 'table/details/' . $id_hs, '.CSV', array('class' => $class)) ?>
                    <?= HTML::anchor('table/details/' . $id_hs . '/' . $filter . '#tabelle', HTML::image('/assets/img/layout/icon-warenkorb.png'), $id) ?>
                </div> 

            </div>
            <div class="clear"></div>
        </div>

        <?= Form::open('table/details/' . $id_hs . '#tabelle') ?>


        <div class="scrollX">
            <table id="thead" <?= $is_admin ? 'class="admin"' : '' ?> >
                <?php $i = 0; ?>

                <?php foreach ($details as $codeKurz => $detail) : ?>
                    <tr >

                        <td width="150">
                            <?php
                            $k = array_keys($detail);
                            $beschreibung = $detail[$k[0]]->CodeBeschreibung;
                            $selected = Arr::get($post, $i, "all");
                            echo Form::hidden('filter_text[]', $beschreibung . ' : ' . Arr::get($filters[$codeKurz], $selected, __('All')));
                            echo Form::hidden('id', $id_hs);
                            echo Form::hidden('filter_string', $filter);
                            $filters[$codeKurz]["all"] = $beschreibung . ' *';

                            $filters_reversed = array_reverse(Arr::get($filters, $codeKurz));
                            ?>
                            <?= Form::select('filter[]', $filters_reversed, $selected, array('style' => 'width:150px')) ?>
                        </td>
                        <?php $i++ ?>
                        <?php foreach ($detail as $key => $value) : ?>
                            <td  width="150" >
                                <?php $str = mb_substr($detail[$key]->CodeBezeichnung, 0, 20); ?>
                                <?= (strlen($str) >= 20 ? $str . '... <div class="tooltip"><span></span>' . $detail[$key]->CodeBezeichnung . '</div>' : $str) ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
                <?php if ($data): ?>
                    <?php if (count(array_filter($tables)) > 0) : ?>
                        <tr>
                            <td class="grey"  width="150">Tabelle</td>   
                            <?php foreach ($keys as $key): ?>
                                <td class="grey"  width="150" style="text-align: center">
                                    <div class="button edit"></div>
                                    <?= Form::textarea('new_data', $tables[$key]) ?>
                                    <?= Form::hidden('hidden_key', $key) ?>
                                    <?= Form::hidden('hidden_type', 'table') ?>
                                    <?= Form::hidden('hidden_id_hs', $id_hs) ?>
                                    <?= Form::hidden('hidden_id_projekt', $id_projekt) ?>
                                    <span class="text"><?= $tables[$key] ?></span></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endif; ?>
                    <?php if (count(array_filter($sources)) > 0) : ?>
                        <tr>
                            <td class="grey"  width="150"><div class="text" style="height:auto">Quellen</div></td>   
                            <?php foreach ($keys as $key): ?>

                                <td class="grey"  width="150">
                                    <?php if ($is_admin): ?>
                                        <div class="button edit"></div>
                                        <?= Form::textarea('new_data', $sources[$key]) ?>
                                        <?= Form::hidden('hidden_key', $key) ?>
                                        <?= Form::hidden('hidden_type', 'source') ?>
                                        <?= Form::hidden('hidden_id_hs', $id_hs) ?>

                                        <?= Form::hidden('hidden_id_projekt', $id_projekt) ?>
                                    <?php endif; ?>

                                    <?php $str = mb_substr($sources[$key], 0, 30); ?>
                                    <?= (strlen($str) >= 30 ? '<div class="text" style="cursor:pointer;">' . $str . '... <div class="tooltip" style="width:400px"><span></span>' . $sources[$key] . '</div></div>' : '<div class="text" style="width:100%">' . $str . '</div>') ?>

                                </td>

                            <?php endforeach; ?>
                        </tr>
                    <?php endif; ?>
                    <?php if (count(array_filter($notes)) > 0) : ?>
                        <tr>
                            <td class="grey" width="150"><div class="text" style="height:auto">Anmerkungen</div></td>   
                            <?php foreach ($keys as $key): ?>

                                <td class="grey" width="150">
                                    <?php if ($is_admin): ?>
                                        <div class="button edit"></div>
                                        <?= Form::textarea('new_data', $notes[$key]) ?>
                                        <?= Form::hidden('hidden_key', $key) ?>
                                        <?= Form::hidden('hidden_type', 'note') ?>
                                        <?= Form::hidden('hidden_id_hs', $id_hs) ?>

                                        <?= Form::hidden('hidden_id_projekt', $id_projekt) ?>
                                    <?php endif; ?>
                                    <?php $str = mb_substr($notes[$key], 0, 20); ?>
                                    <?= (strlen($str) >= 20 ? '<span style="cursor:pointer;">' . $str . '... <div class="tooltip" style="width:400px"><span></span>' . $notes[$key] . '</div></span>' : $str ) ?>


                                </td>

                            <?php endforeach; ?>
                        </tr>
                    <?php endif; ?>
                    <tr>
                        <td class="blue" width="150"><div class="text" style="height:auto">Grafik</div></td>
                        <?php foreach ($keys as $key): ?>
                            <td class="blue" width="150"><div class="text"  id="chart" style="height:24px;text-align:center;margin:auto;padding:0;"><?= Form::hidden('title', implode('<br/>', $titles[$key])) ?> <?= Form::hidden('chart', $id_hs . '/' . $key) ?><?= HTML::image($assets['img'] . 'layout/button-grafik.png') ?></div></td>

                        <?php endforeach; ?>
                    </tr>
                <?php endif; ?>
            </table>
            <div class="scrollY">

                <?php if ($data): ?>

                    <table id="tdata" <?= $is_admin ? 'class="admin"' : '' ?> >
                        <?php $i = 0; ?>
                        <?php foreach ($data as $y => $data): ?>
                            <tr id="<?= $y ?>">
                                <td width="150"><?= $y ?></td>
                                <?php foreach ($keys as $key): ?>
                                    <?php $d = Arr::get($data, $key, array('data' => '&nbsp;', 'note' => NULL)); ?>
                                    <td  width="150">
                                        <?php if ($d['note']) : ?>
                                            <div class="tooltip"><span></span><?= $d['note'] ?></div><span style="cursor:pointer;text-decoration: underline;font-weight: bold"><?= $d['data'] ?></span> 
                                        <?php else: ?>
                                            <?= $d['data'] ?>
                                        <?php endif; ?>
                                        <?php if (1 == 2): ?>
                                            <div class="button edit" style="display:none"></div>
                                            <input type="text" style="display:none" name="new_data" value="<?= is_numeric($d['data']) ? $d['data'] : NULL ?>" />
                                            <input type="hidden" name="hidden_key" value="<?= $key ?>" />
                                            <input type="hidden" name="hidden_year" value="<?= $y ?>" />
                                            <input type="hidden" name="hidden_id_hs" value="<?= $id_hs ?>" />
                                            <input type="hidden" name="hidden_id_projekt" value="<?= $id_projekt ?>" />
                                        <?php endif; ?>
                                    </td>

                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach; ?> 
                    </table>
                <?php else: ?>
                    <div class="tooltip" id="info">
                        <?php
                        $f = strlen(str_replace("_", "", $filter));
                        if ($f > 0) :
                            ?>
                            Ihre Filtereinstellungen enthält <b><?= count($keys) ?></b> Zeitreihen. <br/> Bitte schränken Sie Ihre Auswahl weiter ein.
                        <?php else : ?>
                            Die Tabelle <b><?= $keymask->Name ?></b>  enthält <b><?= count($keys) ?></b> Zeitreihen. <br/>Bitte verwenden Sie die Filtermöglichkeit um die Anzahl der Zeitreihen zu beschränken. 
                        <?php endif; ?>
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
