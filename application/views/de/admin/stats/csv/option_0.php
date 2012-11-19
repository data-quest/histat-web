<?php if (count($result) > 0): ?>
"Nutzer ID";"Nutzername";"Name";"Institution";"Abteilung";"Strasse";"Land";"PLZ";"Stadt";"Telefon";"E-Mail";"Registriert am"
<?php foreach ($result as $res): ?>
"<?= $res->id ?>";"<?= $res->username ?>";"<?= sprintf("%s %s %s",$res->title,$res->surname,$res->name)?>";"<?= $res->institution?>";"<?= $res->department?>";"<?= $res->street?>";"<?= $res->country?>";"<?= $res->zip?>";"<?= $res->location?>";"<?= $res->phone?>";"<?=$res->email ?>";"<?= date("d.m.Y H:i:s", $res->mkdate) ?>"
<?php endforeach; ?>
<?php else: ?>
    Leider keine Ergebnisse , bitte Zeitraum ändern.
<?php endif; ?>

