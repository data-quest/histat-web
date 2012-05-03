<div id="searchbar">
    <?= Form::open('search') ?>
    <?= HTML::anchor('search/extended','')?>
    <?= Form::input('text',Arr::get($_POST,'text',Session::instance()->get('searchtext',__('Searchtext'))))?>
    <?= Form::submit('search', '')?>
    <?= Form::close()?>
</div>