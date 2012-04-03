<div id="search">
    <div>
        <?= Form::open('search') ?>
        <h1>Erweiterte Suche</h1>
        <div class="left">
            <p>Suche beschränken auf ein Thema: <?= Form::select('theme', array()) ?></p>
            <p> Suchzeitraum eingrenzen:</p>
            <div id="slider"></div>
            <?= Form::hidden('min', '0') ?>
            <?= Form::hidden('max', '0') ?>
            <p>Suchbergriff(e):    <?= Form::input('text', HTML::chars(Arr::get($_POST, 'text', __('Searchtext')))) ?></p>
            <p>Thesaurus aktivieren :<?= Form::checkbox('all') ?></p>
        </div>
        <div class="left">
            <p>Suchbereich:</p>
            <p><?= Form::checkbox('title') ?> In den Tabellentiteln und den Variablenbezeichnungen der Datentabellen</p>
            <p><?= Form::checkbox('source') ?> In dem Quellenteil der Datentabellen (z.B. Primärforscher, Institutionen, etc.)</p>
            <p><?= Form::checkbox('description') ?> In den Studienbeschreibungen</p>
            <p><?= Form::checkbox('all') ?> Überall suchen</p>


            <?= Form::submit('search', __('search'), array('class' => 'button')) ?>
            <?= Form::reset('reset', __('reset'), array('class' => 'button')) ?>

        </div>
        <?= Form::close() ?>
    </div>
    <div class="clear"></div>
    <hr/>
</div>