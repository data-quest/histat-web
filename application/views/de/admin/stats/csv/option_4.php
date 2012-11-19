<?php if (count($result) > 0): ?>
"Angegebener Verwendungszweck";"Anzahl der Downloads";"Anzahl verschiedener Studien"
            <?php foreach ($result as $res): ?>"<?= empty($res->intended_use)? 'ohne Angabe':$res->intended_use ?>";"<?=  $res->downloads ?>";"<?= $res->projects ?>"
            <?php endforeach; ?>
<?php else: ?>
    Leider keine Ergebnisse , bitte Zeitraum ändern.
<?php endif; ?>

