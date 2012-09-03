<h1>$Registrierung$</h1>
<p>
<h3>$Hinweis zur Registrierung$</h3>
$Um Zugang zur Datenbank zu erhalten, müssen Sie sich als Nutzer unter Verwendung des Anmeldeformulars registrieren. Nach abschicken des Anmeldeformulars erhalten Sie per E-mail Ihr Passwort. Mit Hilfe dieses Passworts können Sie die Datenbank HISTAT öffnen.

Bitten nehmen Sie zur Kenntnis, dass Sie als Nutzer die Nutzungsbedingungen der Datenbank sowie die Nutzungsordnung des ZA akzeptieren. 
$
</p>
<div id="create">
    <?php foreach ($errors as $key => $error): ?>
        <span class="error"> <?= $error ?></span>
    <?php endforeach; ?>


    <?= Form::open('auth/create') ?>
    <span class="star">*</span><?= Form::label('username',__('Username:')) ?>
    <?= Form::input('username', HTML::chars(Arr::get($_POST, 'username'))) ?><br/>
    <?= Form::label('title', 'Title:') ?>
    <?= Form::input('title', HTML::chars(Arr::get($_POST, 'title'))) ?><br/>
    <span class="star">*</span><?= Form::label('name', 'First name:') ?>
    <?= Form::input('name', HTML::chars(Arr::get($_POST, 'name'))) ?><br/>
    <span class="star">*</span><?= Form::label('surname', 'Second name:') ?>
    <?= Form::input('surname', HTML::chars(Arr::get($_POST, 'surname'))) ?><br/>
    <?= Form::label('institution', 'Institution:') ?>
    <?= Form::input('institution', HTML::chars(Arr::get($_POST, 'institution'))) ?><br/>
    <?= Form::label('department', 'Abteilung:') ?>
    <?= Form::input('department', HTML::chars(Arr::get($_POST, 'department'))) ?><br/>
    <span class="star">*</span><?= Form::label('street', 'Street, House Nr., or Post Box:') ?>
    <?= Form::input('street', HTML::chars(Arr::get($_POST, 'street'))) ?><br/>
    <span class="star">*</span><?= Form::label('zip', 'Postal code:') ?>
    <?= Form::input('zip', HTML::chars(Arr::get($_POST, 'zip'))) ?><br/>
    <span class="star">*</span><?= Form::label('location', 'City:') ?>
    <?= Form::input('location', HTML::chars(Arr::get($_POST, 'location'))) ?><br/>
    <span class="star">*</span><?= Form::label('country', 'Country:') ?>
    <?= Form::input('country', HTML::chars(Arr::get($_POST, 'country'))) ?><br/>
    <span class="star">*</span><?= Form::label('email', 'E-Mail adress:') ?>
    <?= Form::input('email', HTML::chars(Arr::get($_POST, 'email'))) ?><br/>
    <?= Form::label('phone', 'Phone number:') ?>
    <?= Form::input('phone', HTML::chars(Arr::get($_POST, 'phone'))) ?><br/>
    <?= Form::submit('register', 'Create new account') ?>
    <?= Form::close() ?>
    <div class="clear"></div>
</div>
<span class="star">*</span> markierte Felder müssen ausgefüllt werden