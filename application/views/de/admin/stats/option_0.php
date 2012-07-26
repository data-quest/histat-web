<?php if (count($result) > 0): ?>
    <h3><b><?= count($result) ?></b> Ergebnisse wurden gefunden</h3>
    <table>
        <thead>
            <tr>
                <th>Nutzer ID</th>
                <th>Nutzername.</th>
                <th>Name</th>
                <th>Anschrift</th>
                <th>Kontakt</th>
                <th>Registriert am</th>  
            </tr>
        </thead>
        <tbody>
            <?php foreach ($result as $res): ?>
                <tr>
                    <td><?= $res->id ?></td>
                    <td class="even"> <?= $res->username ?></td>
                    <td> <?= sprintf('%s %s %s',$res->title,$res->surname,$res->name)?></td>

                    <td class="even"> <?= sprintf('Institut: %s<br/>Abteilung: %s<br/>Strasse: %s<br/>%s %s %s',
                            $res->institution,
                            $res->department,
                            $res->street,
                            $res->country,
                            $res->zip,
                            $res->location
                            ) ?></td>
                    <td> <?= sprintf('Telefon: %s<br/>E-Mail: %s',
                            $res->phone,
                            $res->email) ?></td>
                    <td class="even"> <?= date("d.m.Y H:i:s", $res->mkdate) ?></td>
              
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    Leider keine Ergebnisse , bitte Zeitraum ändern.
<?php endif; ?>

