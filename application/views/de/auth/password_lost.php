<div id="login">
    <h1>Send new password</h1>
    <p>Bitte geben Sie Ihre E-Mail Adresse ein! </p>
    <?php if (isset($message)): ?>
        <span class="error"><?= $message?></span>
    <?php endif ?>
    <?= Form::open('auth/password_lost') ?>
    <?= Form::label('email','E-Mail Adresse:') ?> <br/>
    <?= Form::input('email', HTML::chars(Arr::get($_POST, 'email'))) ?><br/>
    <?= Form::submit('new_password','Passwort versenden') ?><br/>
    <?= Form::close() ?>
</div>