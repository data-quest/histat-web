<!DOCTYPE html>
<html>
    <head lang="<?= I18n::$lang ?>">
        <meta charset="UTF-8" />
        <?php
        foreach ($styles as $file)
            echo HTML::style($assets['css'] . $file) . "\n";
        foreach ($scripts as $file)
            echo HTML::script($assets['js'] . $file) . "\n";
        ?>
        <!-- Copyright (c) 2000-2009 etracker GmbH. All rights reserved. -->
        <!-- This material may not be reproduced, displayed, modified or distributed -->
        <!-- without the express prior written permission of the copyright holder. -->
        <!-- BEGIN etracker code ETRC 3.0 -->
        <script type="text/javascript">document.write(String.fromCharCode(60)+"script type=\"text/javascript\" src=\"http"+("https:"==document.location.protocol?"s":"")+"://web.gesis.org/t.js?et=qPKGYV\">"+String.fromCharCode(60)+"/script>");</script>

        <title><?= $title ?></title>
    </head>
    <body>
        <noscript><p><a href="http://www.etracker.com"><img class="trackimage" style="border:0px;" alt="" src="http://www.etracker.com/nscnt.php?et=qPKGYV" /></a></p></noscript>
        <div id="top"></div>
        <div id="layout">
            <div id="header">
                <a href=""><?= HTML::image($assets['img'] . '/layout/logo.png', array('class' => 'logo')) ?></a>
                <div class="infos">
                    <div class="histat">
                        <span class="orange">histat:</span> <br/> <span class="description"><?= __('Historical statistics')?></span>
                    </div>
                    <div class="values">
                        <span class="orange"><?= $values ?></span> <?= __('Values'); ?>
                    </div>
                    <div class="timelines">
                        <span class="orange"><?= $times ?></span> <?= __('Time series');?>
                    </div>
                </div>
            </div>

            <div id="main_navi">
                <?php
                foreach ($main_navi as $item)
                    echo HTML::anchor($item['uri'], $item['active'] == 1 ? $item['title'] . '<span></span>' : $item['title'], $item['active'] == 1 ? array('class' => 'active') : null);
                ?>
                <?php
                  $lang_img = I18n::$lang === 'de'?'en':'de';
                  $url = Request::current()->uri();
                  
                  if($url === '/'){
                      $url = I18n::$lang.'/index';
                  }
                  
                ?>
                <a href="<?= str_replace('/'.I18n::$lang.'/', '/'.$lang_img.'/',URL::site($url));?>"><?= HTML::image('assets/img/layout/lang_'.$lang_img.'.gif') ?></a>
             
                <?= $searchbar ?>
            </div>
            <div id="sub_navi">
                <?php if (count($sub_navi) > 0): ?>
                    <ul>
                        <?php
                        foreach ($sub_navi as $item)
                            echo '<li ' . ($item['active'] == 1 ? 'class="active"' : '') . '>' . HTML::anchor($item['uri'], $item['title']) . '</li>';
                        ?>
                    </ul>
                <?php endif; ?>
                <?php if (Arr::get($user->has_roles(), 'login')): ?>
                    <div class="userinfo">
                        <?= HTML::anchor('profile', __('Logged in: :name :surname', array(':name' => $user->name, ':surname' => $user->surname))) ?>
                        <ul>
                            <li><?= HTML::anchor('auth/logout', __('Logout')) ?></li>
                           

                            <li><?= HTML::anchor('cart', __('Cart [:value]', array(':value' => '<span id="cart_items">' . $user->cart_items->find_all()->count() . '</span>'))) ?></li>

                        </ul>
                    </div>

                <?php endif; ?>
                <div class="clear"></div>
            </div>
            <div id="content" class="ui-corner-bottom">
                <?= $content ?>
                <div id="gotop" ><a href="#top" alt="<?= __('go top') ?>"><?= __('go top') ?></a></div>
                <div class="clear"></div>
            </div>
            <div id="footer">
                © GESIS <?= HTML::anchor('http://www.gesis.org/das-institut/impressum/', __('Impressum')) ?> | <?= HTML::anchor('pages/sitemap', __('Sitemap')) ?> | <?= __('Last update at :date', array(':date' => $date)) ?>
            </div>
            <!-- etracker PARAMETER 3.0 -->
            <script type="text/javascript">
                var xsrf = "<?= $xsrf ?>";
                var base_url = "<?= URL::base() ?>";
                var et_pagename     = "<?= $pagename ?>";
            </script>
            <!-- etracker PARAMETER END -->
            <script type="text/javascript">_etc();</script>
            <!-- etracker CODE END -->
        </div>

    </body>
</html>