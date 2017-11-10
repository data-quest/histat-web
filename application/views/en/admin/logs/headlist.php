<div id="admin_users">
       <h1>Liste der veränderten Daten im Tabellenkopf</h1><br/>
<table id="users">
    <thead>
        <tr>
            <td>Projektname</td>
            <td>Geändert von</td>
            <td>Gänderte Filter</td>
            <td>Gänderter Bereich</td>
            <td>Wert davor</td>
            <td>Wert danach</td>
            <td>Änderungsdatum</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($logs as $log): ?>
            <tr>
                <td><?= $log->project->Projektname ?></td>
                <td class="even"><?= $log->username?></td>
                <td><?php $keymask = ORM::factory('Keymask', $log->ID_HS);
                 $details = $keymask->getDetails($log->Schluessel);
                $filter_text = implode(',',Arr::get($details['titles'],$log->Schluessel,array())); 
                echo $filter_text;
                ?></td>
                <td class="even"><?= $log->head ?></td>
                <td><?= $log->old_value ?></td>
                <td class="even"><?= $log->new_value ?></td>
                <td><?= date('Y.m.d H:i',strtotime($log->chdate)); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>