<div id="login">
    <h1>Anmeldung</h1>
    <p>Bitte geben Sie Benutzernamen und Passwort ein! </p>
    <?php if (isset($incorrect)): ?>
        <span class="error"><?= __('Incorrect login or password') ?></span>
    <?php endif ?>
    <?= Form::open('auth/login') ?>
    <?= Form::label('username', __('Username') . ' :') ?> <br/>
    <?= Form::input('username', HTML::chars(Arr::get($_POST, 'username'))) ?><br/>
    <?= Form::label('password', __('Password') . ' :') ?> <br/>
    <?= Form::password('password', HTML::chars(Arr::get($_POST, 'password'))) ?><br/>
    <?= Form::label('remember', __('Remember me') . ' ?') ?> 
    <?= Form::checkbox('remember') ?><br/>
    <?= Form::submit('login', __('Login')) ?>
    <?= Form::close() ?>
</div>