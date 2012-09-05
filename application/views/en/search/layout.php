<div id="search">
    <div class="extended">
        <?= Form::open('search/extended', array('id' => 'search_form')) ?>
         <?php $search = Session::instance()->get('search');  ?>
        <h1>Expanded Search</h1>
        <div class="left">
            <p>Limit the search to a subject: <?= Form::select('theme', $themes, HTML::chars(Arr::get($search, 'theme', 'all')), array('style' => 'width:205px')) ?></p>
            <p>Specify the search period: von <span class="start"></span> - bis <span class="end"></span></p>
            <div id="slider">

            </div>
            <div class="skala"></div>
            <?= Form::hidden('min', HTML::chars(Arr::get($search, 'min', 1200))) ?>
            <?= Form::hidden('max', HTML::chars(Arr::get($search, 'max', date('Y',time())))) ?>
            <p>Search term(s):    <?= Form::input('text', Arr::get($search, 'text', __('Searchtext')), array('style' => 'width:310px')) ?></p>

            <p>Activate thesaurus: <?= Form::checkbox('thesaurus', NULL, (bool) Arr::get($_POST, 'thesaurus', FALSE)) ?></p>
        </div>
        <div class="left">
            <p>Search scope:
     
            </p>
            <p><?= Form::checkbox('title', NULL, (bool) Arr::get($search, 'title', $checked)) ?> -in the table titles and variable names of the data</p>
            <p><?= Form::checkbox('source', NULL, (bool) Arr::get($search, 'source', $checked)) ?> -in the data tables’ source section</p>
            <p><?= Form::checkbox('description', NULL, (bool) Arr::get($search, 'description', $checked)) ?> -in the study descriptions</p>
            <div style="float:left;"> <?= Form::submit('search', __('search'), array('class' => 'button', 'style' => 'width:150px;float:left;margin: 0px 5px;')) ?>
                <?= HTML::anchor('search/clear', __('reset'), array('class' => 'button', 'style' => 'width:130px;display:block;text-align:center;float:left;margin: 0px 5px;')) ?>
            </div>
        </div>
        <?= Form::close() ?>
    </div>
    <div class="clear"></div>
    <hr/>
  
    <?= $results ?>

</div>