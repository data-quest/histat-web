<div class="content create ui-widget ui-widget-content ui-corner-all">
    <?php
    $username = Arr::path($errors, 'username');
    $email = Arr::path($errors, 'email');
    $password = Arr::path($errors, '_external.password');
    $password_confirm = Arr::path($errors, '_external.password_confirm');
    $terms = Arr::path($errors, '_external.terms');
    ?>
    <?php if ($username != NULL): ?>
        <?= Message::error($username) ?>
    <?php endif ?>
    <?php if ($email != NULL): ?>
        <?= Message::error($email) ?>
    <?php endif ?>
    <?php if ($password != NULL): ?>
        <?= Message::error($password) ?>
    <?php endif ?>
    <?php if ($password_confirm != NULL): ?>
        <?= Message::error($password_confirm) ?>
    <?php endif ?>
    <?php if ($terms != NULL): ?>
        <?= Message::error($terms) ?>
    <?php endif ?>
    <?= Form::open('auth/create') ?>
    <?= Form::label('username', __('Username') . ' :') ?>
    <?= Form::input('username', HTML::chars(Arr::get($_POST, 'username'))) ?>
    <div class="clear"></div>
    <?= Form::label('password', __('Password') . ' :') ?>
    <?= Form::password('password', HTML::chars(Arr::get($_POST, 'password'))) ?>
    <div class="clear"></div>
    <?= Form::label('password_confirm', __('Password Confirm') . ' :') ?>
    <?= Form::password('password_confirm', HTML::chars(Arr::get($_POST, 'password_confirm'))) ?>
    <div class="clear"></div>
    <?= Form::label('email', __('E-Mail') . ' :') ?>
    <?= Form::input('email', HTML::chars(Arr::get($_POST, 'email'))) ?>
    <div class="clear"></div>
    <?= Form::label('terms', HTML::anchor('page/terms_an_conditions', __('Accept terms and conditions') . '?')) ?>
    <?= Form::checkbox('terms') ?>
    <div class="clear"></div>
    <?= Form::button('register', __('Register'),array('type'=>'submit')) ?>
    <?= Form::close() ?>
</div>
