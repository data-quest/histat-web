<div id="search_result">
    <div style="padding:2em">
    <?php if ($show): ?>
       
        <h1>
            Suchergebnisse
        </h1>
        <p> <?= count($results["results"]) ?> Studien(n) mit Suchergebnissen: </p>
    <?php endif; ?>
    <?php if (count($results) > 0): ?>

        <ul class="result">

            <?php foreach ($results["data"] as $project) : ?>
                <li>
                    <hr/>
                    <?= $project->ZA_Studiennummer ?> | <?= $project->Projektname ?>
                    <hr/>
                    Datentabelle : <?= Arr::get($results["results"][$project->ID_Projekt],"data",false)?><br/>
                    Studienbeschreibung : <?= Arr::get($results["results"][$project->ID_Projekt],"description",false)?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    </div>
</div>