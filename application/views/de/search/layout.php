<div id="search">
    <div class="extended">
        <?= Form::open('search/extended') ?>
        <h1>Erweiterte Suche</h1>
        <div class="left">
            <p>Suche beschränken auf ein Thema: <?= Form::select('theme', $themes, HTML::chars(Arr::get($_POST, 'theme', 'all')), array('style' => 'width:205px')) ?></p>
            <p> Suchzeitraum eingrenzen: von <span class="start"></span> - bis <span class="end"></span></p>
            <div id="slider"></div>
            <?= Form::hidden('min', HTML::chars(Arr::get($_POST, 'min', 1200))) ?>
            <?= Form::hidden('max', HTML::chars(Arr::get($_POST, 'max', 2200))) ?>
            <p>Suchbergriff(e):    <?= Form::input('text', Arr::get($_POST, 'text', __('Searchtext'))) ?></p>
            <p>Thesaurus aktivieren :<?= Form::checkbox('thesaurus', NULL, (bool) Arr::get($_POST, 'thesaurus', FALSE)) ?></p>
        </div>
        <div class="left">
            <p>Suchbereich:</p>
            <p><?= Form::checkbox('title', NULL, (bool) Arr::get($_POST, 'title', $checked)) ?> In den Tabellentiteln und den Variablenbezeichnungen der Datentabellen</p>
            <p><?= Form::checkbox('source', NULL, (bool) Arr::get($_POST, 'source', $checked)) ?> In dem Quellenteil der Datentabellen (z.B. Primärforscher, Institutionen, etc.)</p>
            <p><?= Form::checkbox('description', NULL, (bool) Arr::get($_POST, 'description', $checked)) ?> In den Studienbeschreibungen</p>
            <div style="float:left;"> <?= Form::submit('search', __('search'), array('class' => 'button', 'style' => 'width:150px;float:left;margin: 0px 5px;')) ?>
                <?= HTML::anchor('search/extended', __('reset'), array('class' => 'button', 'style' => 'width:130px;display:block;text-align:center;float:left;margin: 0px 5px;')) ?>
            </div>
        </div>
        <?= Form::close() ?>
    </div>
    <div class="clear"></div>
    <hr/>
    <?= $results ?>
</div>