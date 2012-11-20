<?php if (count($result) > 0): ?>
"ZA Nr.";"Studientitel"
<?php foreach ($result as $res): ?>"ZA <?= $res->za ?>";"<?=  $res->title ?>"
<?php endforeach; ?>
<?php else: ?>
    Leider keine Ergebnisse , bitte Zeitraum ändern.
<?php endif; ?>

