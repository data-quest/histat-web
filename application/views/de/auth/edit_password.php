<h1>Passwort ändern:</h1>

<div id="edit_password">
    <?php foreach ($errors as $key => $error): ?>
        <span class="error"> <?= $error ?></span>
    <?php endforeach; ?>
    <?php if (isset($success)): ?>
        <span class="info">Benutzerdaten wurden geändert</span>
    <?php endif; ?>
    <?= Form::open('profile/edit_password') ?>
    <span class="star">*</span><?= Form::label('password_current', 'Passwort :') ?>
    <?= Form::input('password_current', HTML::chars(Arr::get($_POST, 'password_current'))) ?><br/>
    <span class="star">*</span><?= Form::label('password', 'Neues Passwort :') ?>
    <?= Form::input('password', HTML::chars(Arr::get($_POST, 'password'))) ?><br/>
    <span class="star">*</span><?= Form::label('password_confirm', 'Neues Passwort wiederholen:') ?>
    <?= Form::input('password_confirm', HTML::chars(Arr::get($_POST, 'password_confirm'))) ?><br/>
    <?= Form::submit('edit', 'Speichern') ?>
    <?= Form::close() ?>
    <div class="clear"></div>
    <span class="star">*</span> markierte Felder müssen ausgefüllt werden
</div>

