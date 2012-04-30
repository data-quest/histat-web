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
                        <td class="even"><?= $project['theme']  ?></td>
                        <td width="40%"><?= $project['name'] ?></td>
                        <?php if ($hasTables): ?>
                            <td width="23%" class="even found show"><input type="hidden" name="id" value="<?= $id ?>" />Gefundene Tabellen anzeigen</td>
                            <td style="display:none" width="23%" class="even found hide"><input type="hidden" name="id" value="<?= $id ?>" />Gefundene Tabellen schließen</td>
                        <?php else: ?>
                            <td width="23%" class="even notfound">keine Tabellen gefunden</td>
                        <?php endif; ?>
                        <?php if ($hasDescription): ?>
                            <td width="100" class="details found show"><input type="hidden" name="id" value="<?= $id ?>" />Details...</td>  
                            <td style="display:none" width="100" class="details found hide"><input type="hidden" name="id" value="<?= $id ?>" />Detailansicht schließen</td>  
                        <?php else: ?>
                            <td width="100" class="details notfound">keine Details</td>
                        <?php endif; ?>
                    </tr>
                    <?php if ($hasTables): ?>
                        <tr class="empty tables <?= $id ?>" style="display:none">
                            <td width="10%" style="border:0px"></td>
                            <td class="nopadding tables" style="border:0px" colspan="4"></td>

                        </tr>
                    <?php endif; ?>

                    <?php if ($hasDescription): ?>
                        <tr class="empty data <?= $id ?>" style="display:none">
                            <td class="values" colspan="5">
                                <h1>Studiendetails</h1>

                                <div class="normal data">
                                    <h4>Datensatz (in empfohlener Zitierweise)</h4>
                                    <p></p>
                                </div>

                                <div class="normal publication">
                                    <h4>Gedruckte Publikation</h4>
                                    <p></p>
                                </div>

                                <div class="normal description"> <h4>Studienbeschreibung</h4><p></p></div>

                                <div class="normal sources">   <h4>Quellenverzeichnis</h4><p></p></div>
                                  <div class="normal reintegration">   <h4>Untergliederung</h4><p></p></div>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
</div>