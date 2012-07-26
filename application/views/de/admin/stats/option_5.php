<?php if (count($result) > 0): ?>
    <h3><b><?= count($result) ?></b> Ergebnisse wurden gefunden</h3>
    <table>
        <thead>
            <tr>
                  <th>ZA Nr.</th>
                  <th>Studientitel</th>
     
                
              
  
            </tr>
        </thead>
        <tbody>
            <?php foreach ($result as $res): ?>
                <tr>
            
                    <td> <?= $res->za ?></td>
                    <td class="even"> <?=  $res->title ?></td>
                    
       
             
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    Leider keine Ergebnisse , bitte Zeitraum ändern.
<?php endif; ?>

