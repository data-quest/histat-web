<!DOCTYPE html>
<html>
    <head lang="<?= I18n::$lang ?>">
        <?php
        foreach ($styles as $file)
            echo HTML::style($assets['css'] . $file) . "\n";
        foreach ($scripts as $file)
            echo HTML::script($assets['js'] . $file) . "\n";
        ?>
        <title><?= $title ?></title>
    </head>
    <body>
        
        <div id="top"></div>
        <div id="layout">
            <div id="header">
            </div>
            <div id="main_navi">
                <?php
                foreach ($main_navi as $item)
                    echo HTML::anchor($item['uri'], $item['active'] == 1 ? $item['title'] . '<span></span>' : $item['title'], $item['active'] == 1 ? array('class' => 'active') : null);
                ?>
            </div>
            <div id="sub_navi">
                <ul>
                    <?php
                    foreach ($sub_navi as $item)
                        echo '<li '.($item['active'] == 1 ? 'class="active"' : '').'>'.HTML::anchor($item['uri'], $item['title']).'</li>';
                    ?>
                </ul>
                <div class="clear"></div>
            </div>
            <div id="content" class="ui-corner-bottom">
                <?= $content ?>
                <div id="gotop" ><a href="#top" alt="<?= __('go top')?>"><?= __('go top')?></a></div>
                <div class="clear"></div>
            </div>
            <div id="footer">
                © GESIS <?= HTML::anchor('pages/impressum', __('Impressum')) ?> | <?= HTML::anchor('pages/sitemap', __('Sitemap')) ?> | <?= __('Last Updates from :date',array(':date'=>$date)) ?>
            </div>
            <div id="dialog"></div>
            <script type="text/javascript">
            var xsrf = "<?= $xsrf ?>";
            var base_url = "<?= URL::base()?>";
            </script>
        </div>

    </body>
</html>