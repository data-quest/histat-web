<div id="table_details">
    <h1>Tabllenansicht der Studie</h1>
    <?= $project ?>


    <div class="details">
        <div class="name"><?= $keymask->Name ?></div>
        <div class="overflow">
            <table>
                <?php foreach ($details as $beschreibung => $details) : ?>
                    <tr>
                        <td><div class="text"><?= $beschreibung ?></div></td>
                        <?php foreach ($details as $detail) : ?>
                            <td><div class="text">
                                    <?php $str = substr($detail->CodeBezeichnung, 0, 30); ?>
                                    <?= (strlen($str) >= 30 ? $str . '...' : $str) ?>
                                </div>

                            </td>

                        <?php endforeach; ?>

                    </tr>
                <?php endforeach; ?>
                <?php foreach ($data as $years => $data): ?>
                    <tr>
                        <td> <?= $years ?></td>
                        <?php foreach ($keys as $key): ?>
                            <td><?= Arr::get($data, $key, '&nbsp;') ?></td>
                        <?php endforeach; ?>
                    <tr>
                    <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>

