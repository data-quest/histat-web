<div id="data_new">
    <h1><?= __('List of new studies')?></h1><br/>
    <table border="0"  style="width:100%" cellpadding="2" cellspacing="2">
        <tr>
            <th><?= __('Studiennummer') ?></th>
            <th><?= __('Studientitel') ?></th>
            <th><?= __('Autor') ?></th>
        </tr>
        <?php $i = 0; ?>
        <?php foreach ($projects->find_all() as $project): ?>

            <tr class="<?= ($i % 2 == 0) ? 'odd' : 'even' ?>">
                <td><?= HTML::anchor('project/details/'.$project->ID_Projekt,$project->Studiennummer) ?></td>
                <td><?= HTML::anchor('project/details/'.$project->ID_Projekt,$project->Studientitel) ?></td>
                <td><?= HTML::anchor('project/details/'.$project->ID_Projekt,$project->Autor) ?></td>
            </tr>
            <?php $i++; ?>
        <?php endforeach ?>
    </table>
</div>