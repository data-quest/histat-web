
<div class="content login ui-widget ui-widget-content ui-corner-all">
    <?php if (isset($incorrect)): ?>
        <?= Message::error(__('Incorrect login or password')) ?>
    <?php endif ?>
    <?= Form::open('auth/login') ?>
    <?= __('Username') ?>:<?= Form::input('username', HTML::chars(Arr::get($_POST, 'username')), array('class' => 'right')) ?>
    <div class="clear"></div>
    <?= __('Password') ?>:<?= Form::password('password', HTML::chars(Arr::get($_POST, 'password')), array('class' => 'right')) ?>
    <div class="clear"></div>
    <?= __('Remember me') ?>? &nbsp;<?= Form::checkbox('remember') ?>
    <div class="clear"></div>
    <?= Form::submit('login', __('Login')) ?>
    <?= Form::close() ?>
</div>