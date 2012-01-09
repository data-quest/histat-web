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
        <div id="layout">
            <div id="header">

            </div>
            <div id="main_navi">
                <?php
                foreach ($main_navi as $item)
                    echo HTML::anchor ($item['uri'],$item['title'],$item['active']==1?array('class'=>'active'):null);
                ?>
            </div>
            <div id="sub_navi">
                <?php
                foreach ($sub_navi as $item)
                    echo HTML::anchor ($item['uri'],$item['title'],$item['active']==1?array('class'=>'active'):null);
                ?>
            </div>
            <div id="content">
                <?= $content ?>
            </div>
            <div id="footer">

            </div>
        </div>

    </body>
</html>