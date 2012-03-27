<div id="cart">
    <h1>Warenkorb</h1>
    <?php if ($message) : ?>
        <div class="tooltip" style="position: relative;margin:1em 0">
            <?php
            switch ($message) {
                case 'error': echo 'Filter Konnte nicht gelöscht werden';
                    break;
                case 'success': echo 'Filter Erfolgreich gelöscht';
                    break;
                default: echo 'Ubekannter Fehler';
                    break;
            }
            ?>
        </div>
    <?php endif; ?>
<?php if (count($filters) > 0): ?>
        <ul class="projects">
            <li class="header"><h3>Projekte</h3></li>
    <?php foreach ($projects as $projectID => $projectName): ?>
                <li><span class="more"></span><b><?= $projectName ?></b></li>
                <li class="tables"><ul> 
                        <li class="header"><h3>Tabellen</h3></li>
        <?php foreach ($tables[$projectID] as $tableID => $tableName) : ?>
                            <li><span class="more"></span><?= $tableName ?></li>
                            <li class="filters" ><ul>
                                    <li class="header"><h3>Filter</h3></li>
            <?php foreach ($filters[$projectID][$tableID] as $filter => $values) : ?>

                                        <li><ul class="values">
                                                <?php foreach ($values as $value) : ?>
                                                    <li><?= $value ?></li>
                <?php endforeach; ?>
                                            </ul>
                                        </li>
                                        <li><?= HTML::anchor('cart/delete/' . $tableID . '/' . $filter, __('Delete')) ?> | <?= HTML::anchor('table/details/' . $tableID . '/' . $filter, __('Show'), array('target' => 'blank')) ?> </li>
            <?php endforeach; ?>
                                </ul>
                            </li>
        <?php endforeach; ?>
                    </ul> 
                </li>
        <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <h3>Ihr Warenkorb ist leer</h3>
<?php endif; ?>


</div>