<?php if (count($result) > 0): ?>
    <h3><b><?= count($result) ?></b> Ergebnisse wurden gefunden</h3>
    <table>
        <thead>
            <tr>
                <th>Angegebener Verwendungszweck</th>
                <th>Anzahl der Downloads</th>
                <th>Anzahl verschiedener Studien</th>
  
            </tr>
        </thead>
        <tbody>
            <?php foreach ($result as $res): ?>
                <tr>
            
                    <td> <?= empty($res->intended_use)? 'ohne Angabe':$res->intended_use ?></td>
                    <td class="even"> <?=  $res->downloads ?></td>
                    
                    <td> <?= $res->projects ?></td>
             
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    Leider keine Ergebnisse , bitte Zeitraum ändern.
<?php endif; ?>

