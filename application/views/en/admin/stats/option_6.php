<?php if (count($result) > 0): ?>
    <h3><b><?= count($result) ?></b> Ergebnisse wurden gefunden</h3>
    <table>
        <thead>
            <tr>
                  <th>Themen</th>
                  <th>Anzahl Downloads insgesamt</th>
                  <th>Anzahl der Studien aus denen Downloads erfolgten</th>
                  <th>Anzahl verschiedener Studien,aus denen Downloads erfolgten</th>
              
  
            </tr>
        </thead>
        <tbody>
            <?php foreach ($result as $res): ?>
                <tr>
            
                    <td> <?= empty($res->theme) ?'Thema gelöscht':$res->theme ?></td>
                    <td class="even"> <?=  $res->downloads ?></td>
                    
                       <td> <?=  $res->download_projects ?></td>
                          <td class="even"> <?=  $res->download_different_projects ?></td>
             
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    Leider keine Ergebnisse , bitte Zeitraum ändern.
<?php endif; ?>

