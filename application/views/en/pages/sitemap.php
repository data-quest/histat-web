<div id="content" class="ui-corner-bottom">
    <div id="sitemap">

        <div class="left" style="border:0px">
            <div id="welcome" style="border:0px"><h1>Sitemap</h1><br/>
                <h3>Übersicht der Seiten</h3>
                <div class="normal">
                <ul class="sitemap">
                    <li><?= HTML::anchor('index', __('Home')) ?></li>
                    <li><?= HTML::anchor('data', __('Data')) ?>
                        <ul>
                            <li><?= HTML::anchor('data/index', __('New')) ?></li>
                            <li><?= HTML::anchor('data/top', __('Top')) ?></li>
                            <li><?= HTML::anchor('data/times', __('Times')) ?></li>
                            <li><?= HTML::anchor('data/themes', __('Themes')) ?></li>
                            <li><?= HTML::anchor('data/names', __('Names')) ?></li>
                        </ul>
                    </li>
                    <li><?= HTML::anchor('about', __('About')) ?></li>
                    <li><?= HTML::anchor('galery', __('Galery')) ?></li>
                </ul>
                </div>
            </div>
        </div>

    </div>
</div>
<script type="text/javascript">
    $(function(){
        $('#gotop').remove(); 
    })
</script>