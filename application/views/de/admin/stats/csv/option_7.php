<?php if (count($result) > 0): ?>
"Thema";"ZA-Nr.";"Studientitel";"Autor"
<?php foreach ($result as $res): ?>"<?=$res->thema?>";"ZA <?= $res->za ?>";"<?= $res->title ?>";"<?= $res->author ?>"
<?php endforeach; ?>
<?php else: ?>
    Leider keine Ergebnisse , bitte Zeitraum ändern.
<?php endif; ?>

