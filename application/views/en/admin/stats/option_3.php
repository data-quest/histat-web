<?php if (count($result) > 0): ?>
    <h3><b><?= count($result) ?></b> Ergebnisse wurden gefunden</h3>
    <table>
        <thead>
            <tr>
                <th>ZA Nr.</th>
                <th>Studientitel</th>
                <th>Datum des Downloads</th>
                <th>Klasse</th>
                <th>Anzahl der Downloads</th>
                <th>Nutzer ID</th>
                <th>Name, Vorname</th>
                <th>Anschrift</th>
                <th>E-Mail</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($result as $res): ?>
                <tr>
                    <td> ZA <?= $res->za ?></td>
                    <td class="even"> <?= $res->Studientitel ?></td>
                    <td> <?= date("d.m.Y", $res->download_date) ?></td>

                    <td class="even"> <?= $res->klasse ?></td>
                    <td> <?= $res->downloads ?></td>
                    <td class="even"> <?= $res->user_id ?></td>
                     <td> <?= $res->Name ?></td>
                      <td class="even"> <?= sprintf('Institut: %s<br/>Abteilung: %s<br/>Strasse: %s<br/>%s %s %s',
                            $res->institution,
                            $res->department,
                            $res->street,
                            $res->country,
                            $res->zip,
                            $res->location
                            ) ?></td>
                        <td> <?= $res->email ?></td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    Leider keine Ergebnisse , bitte Zeitraum ändern.
<?php endif; ?>

