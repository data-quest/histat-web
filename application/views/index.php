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
        <!-- Copyright (c) 2000-2016 etracker GmbH. All rights reserved. -->
        <!-- This material may not be reproduced, displayed, modified or distributed -->
        <!-- without the express prior written permission of the copyright holder. -->
        <!-- etracker tracklet 4.0 -->
        <script type="text/javascript">

            var et_pagename = "<?= $pagename ?>";
            var et_areas = "<?= $area ?>";

        </script>

        <script id="_etLoader" type="text/javascript" charset="UTF-8" data-secure-code="qPKGYV" src="//static.etracker.com/code/e.js"></script>

        <noscript><link rel="stylesheet" media="all" href="//www.etracker.de/cnt_css.php?et=qPKGYV&amp;v=4.0&amp;java=n&amp;et_easy=0&amp;et_pagename=<?= $pagename ?>&amp;et_areas=<?= $area ?>&amp;et_ilevel=0&amp;et_target=,0,0,0&amp;et_lpage=0&amp;et_trig=0&amp;et_se=0&amp;et_cust=0&amp;et_basket=&amp;et_url=&amp;et_tag=&amp;et_sub=&amp;et_organisation=&amp;et_demographic=" /></noscript>

             <!-- HR@GESIS Microsite styles -->
    <style type="text/css">
/* HR@GESIS zusätzlich zu styles.css hinzufügen */
#microsite {
	background-color: #EEE9D2;
	background-image: url("https://www.gesis.org/fileadmin/img/header/microsite/gs_ms_neutral_header.png");
	background-repeat: no-repeat;
	border-bottom: 1px solid #FFFFFF;
	height: 50px;
}
#microsite #micrositeClaim {
	color: #66645A;
	font-size: 18px;
	font-weight: bold;
	left: 20px;
	position: relative;
	top: 22px;
}

/* HR@GESIS folgende Zeilen ersetzen: 330 - 375 (#header .infos bis #header .infos .timelines) */
/* HR@GESIS Die Andordnung den Info-Elemnte innerhalb des microsite divs kann beliebig gändert werden, dient hier nur als Besispiel */

#microsite .infos{
	position: relative;
    width:100%;
    top:0px;
    left:0px;
	display:block;
}
#microsite .infos .histat{
    float:left;
	padding: 0 0 0 20px;
    color: #58748f;
    font-size: 1.4em;
}
#microsite .infos .histat .description{
    margin-left: 15px;
    color: #58748f;
    font-size: 1em;
}
#microsite .infos .orange{
    font-size:1.6em;
    color: #ff6100;
    padding: 0px;
}
#microsite .infos .values{
    float:left;
	padding: 5px 0 0 20px;
    color:#000;
    font-size: 1.3em;
}
#microsite .infos .timelines{
    float:left;
	padding: 20px 0 0 20px;
    font-size: 1.3em;
    color:#000;
}

/* HR@GESIS Zeile ersetzen in Zeile 319 */
#header{
	height: 50px;
}

/* HR@GESIS Zeile ersetzen in Zeile 331 */
#header .logo {
    margin: 0;
}
</style>
<!-- HR@GESIS Microsite header -->
        <title><?= $title ?></title>
    </head>
    <body>

        <div id="top"></div>
        <div id="layout">
            <div id="header">
                <a href="https://www.gesis.org"><?= HTML::image($assets['img'] . '/layout/gs_logo_microsite.jpg', array('class' => 'logo')) ?></a>

            </div>
            <div id="microsite">
                    <div class="infos">
                    <div class="histat">
                        <span class="orange">histat:</span> <br/> <span class="description"><?= __('Historical statistics')?></span>
                    </div>
                    <div class="values">
                        <span class="orange"><?= $studies ?></span> <?= __('Studies'); ?>
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
                 <div class="clear"></div>
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

                © GESIS <?= HTML::anchor('https://www.gesis.org/das-institut/impressum/', __('Impressum')) ?> | <?= HTML::anchor('https://www.gesis.org/institut/datenschutz', __('Data protection')) ?> | <?= HTML::anchor('pages/sitemap', __('Sitemap')) ?> | <?= __('Last update at :date', array(':date' => $date)) ?>
            </div>
            <script type="text/javascript">
                var xsrf = "<?= $xsrf ?>";
                var base_url = "<?= URL::base()?>";
            </script>
        </div>

    </body>
</html>
