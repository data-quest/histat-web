<div class="content create ui-widget ui-widget-content ui-corner-all">
<?php if (isset($error)): ?>
   <?= Message::error($error)?>
<?php endif ?>

    <?= Form::open('activate') ?>
    <?= Form::label('username', __('Username') . ' :') ?>
    <?= Form::input('username', HTML::chars(Arr::get($_POST, 'username'))) ?>
    <div class="clear"></div>
    <?= Form::label('key', __('Activation key') . ' :') ?>
    <?= Form::input('key', HTML::chars(Arr::get($_POST, 'key'))) ?>
    <?= Form::button('activate', __('Activate'), array('type'=>'submit')) ?>
    <?= Form::close() ?>
    <hr/>
    <div class="title"><?= __("I didn't receive an account activation e-mail.") ?></div>
    <?= Form::open('auth/send_again') ?>
    <?= Form::label('email', __('E-Mail') . ' :') ?>
    <?= Form::input('email', HTML::chars(Arr::get($_POST, 'email'))) ?>
    <?= Form::button('send_again', __('Send Again'), array('type' => 'submit')) ?>
    <?= Form::close() ?>
</div>