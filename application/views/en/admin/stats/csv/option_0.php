<?php if (count($result) > 0): ?>
"Nutzer ID";"Nutzername";"Name";"Anschrift";"Kontakt";"Registriert am"
<?php foreach ($result as $res): ?>
"<?= $res->id ?>";"<?= $res->username ?>";"<?= sprintf("%s %s %s",$res->title,$res->surname,$res->name)?>"; "<?= sprintf("Institut: %s\nAbteilung: %s\nStrasse: %s\n%s %s %s",
                            $res->institution,
                            $res->department,
                            $res->street,
                            $res->country,
                            $res->zip,
                            $res->location
                            ) ?>"; "<?= sprintf("Telefon: %s\nE-Mail: %s",
                            $res->phone,
                            $res->email) ?>";"<?= date("d.m.Y H:i:s", $res->mkdate) ?>"
            <?php endforeach; ?>
<?php else: ?>
    Leider keine Ergebnisse , bitte Zeitraum ändern.
<?php endif; ?>

