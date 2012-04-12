<div id="search">
    <div>
        <?= Form::open('search') ?>
        <h1>Erweiterte Suche</h1>
        <div class="left">
            <p>Suche beschränken auf ein Thema: <?= Form::select('theme', $themes,HTML::chars(Arr::get($_POST,'theme','all')),array('style'=>'width:205px')) ?></p>
            <p> Suchzeitraum eingrenzen: von <span class="start"></span> - bis <span class="end"></span></p>
            <div id="slider"></div>
            <?= Form::hidden('min', HTML::chars(Arr::get($_POST,'min',1200))) ?>
            <?= Form::hidden('max',  HTML::chars(Arr::get($_POST,'max',2200))) ?>
            <p>Suchbergriff(e):    <?= Form::input('text', HTML::chars(Arr::get($_POST, 'text', __('Searchtext')))) ?></p>
            <p>Thesaurus aktivieren :<?= Form::checkbox('thesaurus',NULL,(bool)Arr::get($_POST,'thesaurus',FALSE)) ?></p>
        </div>
        <div class="left">
            <p>Suchbereich:</p>
            <p><?= Form::checkbox('title',NULL,(bool)Arr::get($_POST,'title',TRUE)) ?> In den Tabellentiteln und den Variablenbezeichnungen der Datentabellen</p>
            <p><?= Form::checkbox('source',NULL,(bool)Arr::get($_POST,'source',TRUE)) ?> In dem Quellenteil der Datentabellen (z.B. Primärforscher, Institutionen, etc.)</p>
            <p><?= Form::checkbox('description',NULL,(bool)Arr::get($_POST,'description',TRUE)) ?> In den Studienbeschreibungen</p>
            <?= Form::submit('search', __('search'), array('class' => 'button','style'=>'width:150px')) ?>
            <?= Form::reset('reset', __('reset'), array('class' => 'button','style'=>'width:150px')) ?>

        </div>
        <?= Form::close() ?>
    </div>
    <div class="clear"></div>
    <hr/>
    <?= $results?>
</div>