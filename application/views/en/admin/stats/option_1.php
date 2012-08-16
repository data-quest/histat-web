<?php if (count($result) > 0): ?>
    <h3><b><?= count($result) ?></b> Ergebnisse wurden gefunden</h3>
    <table>
        <thead>
            <tr>
                <th> ZA Nr.</th>
                <th>Download Nr.</th>
                <th>Studientitel</th>
                <th>Zugangs- klasse</th>
                <th> Verwendungszweck</th>
                <th > Zeitpunkt</th>
                <th> Name</th>  
            </tr>
        </thead>
        <tbody>
            <?php foreach ($result as $res): ?>
                <tr>
                    <td> ZA <?= $res->za ?></td>
                    <td class="even"> <?= $res->dl ?></td>
                    <td> <?= $res->Studientitel ?></td>

                    <td class="even"> <?= $res->klasse ?></td>
                    <td> <?= $res->Verwendungszweck ?></td>
                    <td class="even"> <?= date("d.m.Y H:i:s", $res->Zeitpunkt) ?></td>
                    <td> <?= $res->Name ?></td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    Leider keine Ergebnisse , bitte Zeitraum ändern.
<?php endif; ?>

