<div id="auth" class="background">
    <div class="window ui-corner-all">
        <div class="logo"></div>
        <div class="header ui-widget-header ui-corner-top">
            <div class="icon ui-icon ui-icon-<?= $icon ?>"></div><span ><?= 'Stud.OS ' . $version ?></span> <span class="time"><?= strftime('%a, %d.%b.%Y %H:%M:%S'); ?></span> 
        </div>
        <div class="main">
            <div class="ui-widget-overlay"></div>  
            <?= $content ?>
        </div>
        <div class="footer ui-widget-header ui-corner-bottom">
            <ul>
                <li><span><?= __('Options') ?></span></li>
                <li><?= HTML::anchor('auth/language', __('Switch Language')) ?></li>
                <li><?= HTML::anchor('auth/reset', __('Reset Password')) ?></li>
                <li><?= HTML::anchor('activate', __('Activate Account')) ?></li>
            </ul>
            <?= HTML::anchor('auth/login', '<span>' . __('Login') . '</span>', array('class' => 'os-icon-48 go-next-view')) ?>
            <?= HTML::anchor('auth/create', '<span>' . __('Register') . '</span>', array('class' => 'os-icon-48 user-new')) ?>

        </div>
    </div>
    <div class="menu">
        <div class="ui-widget-overlay"></div> 
        <div class="links">
        <span><a href="http://blog.webos.de" target="_blank"><?= __('Blog')?></a></span>
        
        <span><a href="http://www.webos.de" target="_blank"><?= __('Web.OS')?></a>|</span>
        <span><?= HTML::anchor('page/impressum', __('Impressum')) ?>|</span>
        <span><?= HTML::anchor('page/help', __('Help')) ?>|</span> 
        <div class="clear"></div>
        </div>
    </div>
</div>