<h1>Benutzerdaten ändern:</h1>

<div id="edit">
    <?php foreach ($errors as $key => $error): ?>
        <span class="error"> <?= $error ?></span>
    <?php endforeach; ?>
    <?php if (isset($success)): ?>
        <span class="info">Benutzerdaten wurden geändert</span>
    <?php endif; ?>
    <?= Form::open('profile') ?>
    <?= Form::label('title',  'Titel:') ?>
    <?= Form::input('title', HTML::chars(Arr::get($_POST, 'title', $user->title))) ?><br/>
    <span class="star">*</span><?= Form::label('name', 'Vorname:') ?>
    <?= Form::input('name', HTML::chars(Arr::get($_POST, 'name', $user->name))) ?><br/>
    <span class="star">*</span><?= Form::label('surname', 'Nachname:') ?>
    <?= Form::input('surname', HTML::chars(Arr::get($_POST, 'surname', $user->surname))) ?><br/>
    <?= Form::label('institution', 'Institution:') ?>
    <?= Form::input('institution', HTML::chars(Arr::get($_POST, 'institution', $user->institution))) ?><br/>
    <?= Form::label('department', 'Abteilung:') ?>
    <?= Form::input('department', HTML::chars(Arr::get($_POST, 'department', $user->department))) ?><br/>
    <span class="star">*</span><?= Form::label('street',  'Straße, Nr. / Postfach:') ?>
    <?= Form::input('street', HTML::chars(Arr::get($_POST, 'street', $user->street))) ?><br/>
    <span class="star">*</span><?= Form::label('zip', 'Postleitzahl:') ?>
    <?= Form::input('zip', HTML::chars(Arr::get($_POST, 'zip', $user->zip))) ?><br/>
    <span class="star">*</span><?= Form::label('location', 'Ort:') ?>
    <?= Form::input('location', HTML::chars(Arr::get($_POST, 'location', $user->location))) ?><br/>
    <span class="star">*</span><?= Form::label('country', 'Land:') ?>
    <?= Form::input('country', HTML::chars(Arr::get($_POST, 'country', $user->country))) ?><br/>
    <span class="star">*</span><?= Form::label('email', 'E-mail:') ?>
    <?= Form::input('email', HTML::chars(Arr::get($_POST, 'email', $user->email))) ?><br/>
    <?= Form::label('phone', 'Telefon :') ?>
    <?= Form::input('phone', HTML::chars(Arr::get($_POST, 'phone', $user->phone))) ?><br/>
    <?= Form::submit('edit', 'Bearbeiten') ?>
    <?= Form::close() ?>
    <div class="clear"></div>
    <span class="star">*</span> markierte Felder müssen ausgefüllt werden
</div>

