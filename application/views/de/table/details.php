<div id="table_details">
    <h1>Tabllenansicht der Studie</h1>
    <?= $project ?>


    <div class="details">
        <div class="name"><?= $keymask->Name ?></div>


        <div id="scrollX" style="height:auto;overflow-y:hidden;overflow-x: auto;">
            <table style="width:100%;" id="headline">
                <thead >
                    <?php foreach ($details as $beschreibung => $details) : ?>
                        <tr >
                            <?php $i = 0; ?>
                            <td><div class="text"><?= $beschreibung ?></div></td>
                            <?php foreach ($details as $detail) : ?>
                                <td class="col<?= $i ?>"><div class="text">
                                        <?php $str = substr($detail->CodeBezeichnung, 0, 30); ?>
                                        <?= (strlen($str) >= 30 ? $str . '...' : $str) ?>
                                    </div>

                                </td>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </thead>
            </table>
            <div id="scrollY" style="overflow:hidden;overflow-y:auto;height:100px">
                <table>
                    <tbody>
                      
                        <?php foreach ($data as $years => $data): ?>
                            <tr >
                               
                                <?php $i = 0; ?>
                                <td><div class="text" style="height:auto"><?= $years ?></div></td>
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

