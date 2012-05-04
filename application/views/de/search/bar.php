<div id="searchbar">
    <?= Form::open('search') ?>
    <?php $search = Session::instance()->get('search');  ?>
    <?= HTML::anchor('search/extended', '') ?>
    <?= Form::input('text', Arr::get($search, 'text', __('Searchtext'))) ?>
    <?= Form::hidden('theme', HTML::chars(Arr::get($search, 'theme', '-1'))) ?>
    <?= Form::hidden('min', HTML::chars(Arr::get($search, 'min', 1200))) ?>
    <?= Form::hidden('max', HTML::chars(Arr::get($search, 'max', 2200))) ?>


    <?= Form::hidden('title',  Arr::get($search, 'title')) ?> 
    <?= Form::hidden('source', Arr::get($search, 'source')) ?> 
    <?= Form::hidden('description', Arr::get($search, 'description')) ?> 

    <?= Form::submit('search', '') ?>
    <?= Form::close() ?>
</div>