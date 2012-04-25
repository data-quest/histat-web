<div id="search_result">
    <div style="padding:2em">
        <?php if ($show): ?>

            <h1>
                Suchergebnisse
            </h1>
            <p> <?= count($results["results"]) ?> Studien(n) mit Suchergebnissen: </p>
        <?php endif; ?>
        <?php if (count($results) > 0): ?>
            <table class="result">

                <?php foreach ($results["data"] as $project) : ?>
                    <?php $hasTables = Arr::get($results["results"][$project->ID_Projekt], "data", false); ?>
                    <?php $hasDescription = Arr::get($results["results"][$project->ID_Projekt], "description", false); ?>
                    <tr>
                        <td width="10%">ZA <?= $project->ZA_Studiennummer ?></td>
                        <td class="even"><?= $project->theme->Thema ?></td>
                        <td width="50%"><?= $project->Projektname ?></td>
                        <?php if ($hasTables): ?>
                            <td width="22%" class="even found">Gefundene Tabellen anzeigen</td>
                           
                        <?php else: ?>
                            <td width="22%" class="even">keine Tabellen gefunden</td>
                        <?php endif; ?>
                        <td width="100" class="details">Details...</td>  


                    </tr>
                     <?php if ($hasTables): ?>
                    <tr>
                        <td width="10%" style="border:0px"></td>
                        <td class="tables" colspan="4">asd</td>
                    </tr>
                       <?php endif; ?>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
</div>