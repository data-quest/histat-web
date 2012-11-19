<?php if (count($result) > 0): ?>
"ZA Nr.";"Studientitel";"Datum des Downloads";"Klasse";"Anzahl der Downloads";"Nutzer ID";"Name, Vorname";"Institution";"Abteilung";"Strasse";"Land";"PLZ";"Stadt";"E-Mail"
    <?php foreach ($result as $res): ?>"ZA <?= $res->za ?>";"<?= $res->Studientitel ?>";"<?= date("d.m.Y", $res->download_date) ?>";"<?= $res->klasse ?>";"<?= $res->downloads ?>";"<?= $res->user_id ?>";"<?= $res->Name ?>";"<?= $res->institution?>";"<?= $res->department?>";"<?= $res->street?>";"<?= $res->country?>";"<?= $res->zip?>";"<?= $res->location?>";"<?=$res->email ?>"
    <?php endforeach; ?>
<?php else: ?>
    Leider keine Ergebnisse , bitte Zeitraum ändern.
<?php endif; ?>

