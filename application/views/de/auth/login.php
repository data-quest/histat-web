<div id="login">
    <h1>Anmeldung</h1>
    <p>Bitte geben Sie Benutzernamen und Passwort ein! </p>
    <?php if (isset($incorrect)): ?>
        <span class="error">Ungültiger Benutzername oder Passwort</span>
    <?php endif ?>
    <?= Form::open('auth/login') ?>
    <?= Form::label('username','Benutzername:') ?> <br/>
    <?= Form::input('username', HTML::chars(Arr::get($_POST, 'username'))) ?><br/>
    <?= Form::label('password', 'Passwort:') ?> <br/>
    <?= Form::password('password', HTML::chars(Arr::get($_POST, 'password'))) ?><br/>
    <?= Form::label('remember', 'Angemeldet bleiben?') ?> 
    <?= Form::checkbox('remember') ?><br/>
    <?= Form::submit('login','Anmelden') ?><br/>
    <?= HTML::anchor('auth/password_lost','Passwort vergessen',array('class'=>'btn')) ?>
    <?= Form::close() ?>
</div>