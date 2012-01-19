<h1>Registrierung</h1>
<p>
<h3>Hinweis zur Registrierung</h3>
Um Zugang zur Datenbank zu erhalten, müssen Sie sich als Nutzer unter Verwendung des Anmeldeformulars registrieren. Nach abschicken des Anmeldeformulars erhalten Sie per E-mail Ihr Passwort. Mit Hilfe dieses Passworts können Sie die Datenbank HISTAT öffnen.

Bitten nehmen Sie zur Kenntnis, dass Sie als Nutzer die Nutzungsbedingungen der Datenbank sowie die Nutzungsordnung des ZA akzeptieren. 
</p>
<div id="create">
    <?php foreach ($errors as $key => $error): ?>
        <span class="error"> <?= $error ?></span>
    <?php endforeach; ?>


    <?= Form::open('auth/create') ?>
    <span class="star">*</span><?= Form::label('username', __('Username') . ' :') ?>
    <?= Form::input('username', HTML::chars(Arr::get($_POST, 'username'))) ?><br/>
    <?= Form::label('title', __('Title') . ' :') ?>
    <?= Form::input('title', HTML::chars(Arr::get($_POST, 'title'))) ?><br/>
    <span class="star">*</span><?= Form::label('name', __('Name') . ' :') ?>
    <?= Form::input('name', HTML::chars(Arr::get($_POST, 'name'))) ?><br/>
    <span class="star">*</span><?= Form::label('surname', __('Surname') . ' :') ?>
    <?= Form::input('surname', HTML::chars(Arr::get($_POST, 'surname'))) ?><br/>
    <?= Form::label('institution', __('Institution') . ' :') ?>
    <?= Form::input('institution', HTML::chars(Arr::get($_POST, 'institution'))) ?><br/>
    <?= Form::label('department', __('Department') . ' :') ?>
    <?= Form::input('department', HTML::chars(Arr::get($_POST, 'department'))) ?><br/>
    <span class="star">*</span><?= Form::label('street', __('Street. Nr / PO Box') . ' :') ?>
    <?= Form::input('street', HTML::chars(Arr::get($_POST, 'street'))) ?><br/>
    <span class="star">*</span><?= Form::label('zip', __('Zip Code') . ' :') ?>
    <?= Form::input('zip', HTML::chars(Arr::get($_POST, 'zip'))) ?><br/>
    <span class="star">*</span><?= Form::label('location', __('Location') . ' :') ?>
    <?= Form::input('location', HTML::chars(Arr::get($_POST, 'location'))) ?><br/>
    <span class="star">*</span><?= Form::label('country', __('Country') . ' :') ?>
    <?= Form::input('country', HTML::chars(Arr::get($_POST, 'country'))) ?><br/>
    <span class="star">*</span><?= Form::label('email', __('E-Mail') . ' :') ?>
    <?= Form::input('email', HTML::chars(Arr::get($_POST, 'email'))) ?><br/>
    <?= Form::label('phone', __('Phone') . ' :') ?>
    <?= Form::input('phone', HTML::chars(Arr::get($_POST, 'phone'))) ?><br/>
    <?= Form::submit('register', __('Register')) ?>
    <?= Form::close() ?>
    <div class="clear"></div>
</div>
<span class="star">*</span> markierte Felder müssen ausgefüllt werden
