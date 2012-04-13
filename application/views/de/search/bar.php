<div id="searchbar">
    <?= Form::open('search') ?>
    <?= HTML::anchor('search/extended','')?>
    <?= Form::input('text',Arr::get($_POST,'text',__('Searchtext')))?>
    <?= Form::submit('search', '')?>
    <?= Form::close()?>
</div>