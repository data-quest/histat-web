<?php if (count($result) > 0): ?>
"ZA Nr.";"Download Nr.";"Studientitel";"Zugangs- klasse";"Verwendungszweck";"Zeitpunkt";"Name"
    <?php foreach ($result as $res): ?>"ZA <?= $res->za ?>";"<?= $res->dl ?>";"<?= $res->Studientitel ?>";"<?= $res->klasse ?>";"<?= $res->Verwendungszweck ?>";"<?= date("d.m.Y H:i:s", $res->Zeitpunkt) ?>";"<?= $res->Name ?>"
    <?php endforeach; ?>
<?php else: ?>
    Leider keine Ergebnisse , bitte Zeitraum ändern.
<?php endif; ?>

