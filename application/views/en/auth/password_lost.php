<div id="login">
    <h1>Send new password</h1>
    <p>Please insert your E-Mail address!</p>
    <?php if (isset($message)): ?>
        <span class="error"><?= $message?></span>
    <?php endif ?>
    <?= Form::open('auth/password_lost') ?>
    <?= Form::label('email','E-Mail address:') ?> <br/>
    <?= Form::input('email', HTML::chars(Arr::get($_POST, 'email'))) ?><br/>
    <?= Form::submit('new_password','Send new password') ?><br/>
    <?= Form::close() ?>
</div>