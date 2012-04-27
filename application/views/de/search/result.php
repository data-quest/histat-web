<div id="search_result">
    <div style="padding:2em">
        <?php if ($show): ?>

            <h1>
                Suchergebnisse
            </h1>
            <p> <?= count($results) ?> Studien(n) mit Suchergebnissen: </p>
        <?php endif; ?>
        <?php if (count($results) > 0): ?>
            <table class="result">

                <?php foreach ($results as $id => $project) : ?>
               
                    <?php $hasTables = Arr::get($project, "data", false); ?>
                    <?php $hasDescription = Arr::get($project, "description", false); ?>
                    <tr>
                        <td width="10%">ZA <?= $project['za']; ?></td>
                        <td class="even"><?= "";//roject->theme->Thema ?></td>
                        <td width="40%"><?= $project['name'] ?></td>
                        <?php if ($hasTables): ?>
                            <td width="23%" class="even found show"><input type="hidden" name="id" value="<?= $id ?>" />Gefundene Tabellen anzeigen</td>
                            <td style="display:none" width="23%" class="even found hide"><input type="hidden" name="id" value="<?= $id ?>" />Gefundene Tabellen schließen</td>
                        <?php else: ?>
                            <td width="23%" class="even notfound">keine Tabellen gefunden</td>
                        <?php endif; ?>
                        <?php if ($hasDescription): ?>
                            <td width="100" class="details found show">Details...</td>  
                            <td style="display:none" width="100" class="details found hide">Details...</td>  
                        <?php else: ?>
                            <td width="100" class="details notfound">keine Details</td>
                        <?php endif; ?>
                    </tr>
                    <?php if ($hasTables): ?>
                        <tr class="empty" id="<?=$id ?>" style="display:none">
                            <td width="10%" style="border:0px"></td>
                            <td class="nopadding values tables" colspan="4"></td>
                            
                        </tr>
                    <?php endif; ?>

                    <?php if ($hasDescription): ?>
                        <tr class="empty" id="<?= $id ?>" style="display:none">
                            <td class="values details" colspan="5"></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
</div>