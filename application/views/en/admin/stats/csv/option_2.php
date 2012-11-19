<?php if (count($result) > 0): ?>
"ZA Nr.";"Studientitel";"Anzahl der Downloads";"Anzahl der Zeitreihen";"Anzahl Aufrufe mit Downloads"
            <?php foreach ($result as $res): ?>"ZA <?= $res->za ?>";"<?= $res->Studientitel ?>";"<?= $res->downloads ?>";"<?= $res->timelines ?>";"<?= $res->call_downloads ?>"
            <?php endforeach; ?>
<?php else: ?>
    Leider keine Ergebnisse , bitte Zeitraum ändern.
<?php endif; ?>

