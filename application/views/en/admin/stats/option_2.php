<?php if (count($result) > 0): ?>
    <h3><b><?= count($result) ?></b> Ergebnisse wurden gefunden</h3>
    <table>
        <thead>
            <tr>
                <th>ZA Nr.</th>
                <th>Studientitel</th>
                <th>Anzahl der Downloads</th>
                <th>Anzahl der Zeitreihen</th>
                <th>Anzahl Aufrufe mit Downloads</th>
  
            </tr>
        </thead>
        <tbody>
            <?php foreach ($result as $res): ?>
                <tr>
                    <td> ZA <?= $res->za ?></td>
                    <td class="even"> <?= $res->Studientitel ?></td>
                    <td> <?= $res->downloads ?></td>

                    <td class="even"> <?= $res->timelines ?></td>
                    <td> <?= $res->call_downloads ?></td>

                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    Leider keine Ergebnisse , bitte Zeitraum ändern.
<?php endif; ?>

