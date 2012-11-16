<h1>Registrierung</h1>
<p>
<h3>Hinweis zur Registrierung</h3>
Um Zugang zur Datenbank zu erhalten, müssen Sie sich als Nutzer unter Verwendung des Anmeldeformulars registrieren. Nach abschicken des Anmeldeformulars erhalten Sie per E-mail Ihr Passwort. Mit Hilfe dieses Passworts können Sie die Datenbank HISTAT öffnen.

Bitten nehmen Sie zur Kenntnis, dass Sie als Nutzer die <?= HTML::anchor('http://www.gesis.org/unser-angebot/daten-analysieren/daten-historische-studien/db-historische-statistik/','Nutzungsbedingungen der Datenbank',array('target'=>'blank'))?> sowie die Nutzungsordnung des ZA akzeptieren. 
</p>
<div id="create">
    <?php foreach ($errors as $key => $error): ?>
        <span class="error"> <?= $error ?></span>
    <?php endforeach; ?>


    <?= Form::open('auth/create') ?>
    <span class="star">*</span><?= Form::label('username', 'Benutzername:') ?>
    <?= Form::input('username', HTML::chars(Arr::get($_POST, 'username'))) ?><br/>
    <?= Form::label('title', ' Titel:') ?>
    <?= Form::input('title', HTML::chars(Arr::get($_POST, 'title'))) ?><br/>
    <span class="star">*</span><?= Form::label('name', 'Vorname:') ?>
    <?= Form::input('name', HTML::chars(Arr::get($_POST, 'name'))) ?><br/>
    <span class="star">*</span><?= Form::label('surname', 'Nachname:') ?>
    <?= Form::input('surname', HTML::chars(Arr::get($_POST, 'surname'))) ?><br/>
    <?= Form::label('institution', 'Institution:') ?>
    <?= Form::input('institution', HTML::chars(Arr::get($_POST, 'institution'))) ?><br/>
    <?= Form::label('department', 'Abteilung:') ?>
    <?= Form::input('department', HTML::chars(Arr::get($_POST, 'department'))) ?><br/>
    <span class="star">*</span><?= Form::label('street', 'Straße, Nr. / Postfach:') ?>
    <?= Form::input('street', HTML::chars(Arr::get($_POST, 'street'))) ?><br/>
    <span class="star">*</span><?= Form::label('zip', 'Postleitzahl:') ?>
    <?= Form::input('zip', HTML::chars(Arr::get($_POST, 'zip'))) ?><br/>
    <span class="star">*</span><?= Form::label('location', 'Ort:') ?>
    <?= Form::input('location', HTML::chars(Arr::get($_POST, 'location'))) ?><br/>
    <span class="star">*</span><?= Form::label('country', 'Land:') ?>
    <?= Form::input('country', HTML::chars(Arr::get($_POST, 'country'))) ?><br/>
    <span class="star">*</span><?= Form::label('email', 'E-Mail:') ?>
    <?= Form::input('email', HTML::chars(Arr::get($_POST, 'email'))) ?><br/>
    <?= Form::label('phone', 'Telefon:') ?>
    <?= Form::input('phone', HTML::chars(Arr::get($_POST, 'phone'))) ?><br/>
    <?= Form::submit('register', 'Registrieren') ?>
    <?= Form::close() ?>
    <div class="clear"></div>
</div>
<span class="star">*</span> markierte Felder müssen ausgefüllt werden
