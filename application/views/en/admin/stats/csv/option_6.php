<?php if (count($result) > 0): ?>
"Themen";"Anzahl Downloads insgesamt";"Anzahl der Studien aus denen Downloads erfolgten";"Anzahl verschiedener Studien,aus denen Downloads erfolgten"
<?php foreach ($result as $res): ?>"<?= empty($res->theme) ?'Thema gelöscht':$res->theme ?>";"<?=  $res->downloads ?>";"<?=  $res->download_projects ?>";"<?=  $res->download_different_projects ?>"
<?php endforeach; ?>
<?php else: ?>
    Leider keine Ergebnisse , bitte Zeitraum ändern.
<?php endif; ?>

