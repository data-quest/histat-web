Hallo <?= $username ?>, <br/>
hier ist dein Aktivierungsschlüssel : <strong><?= $activation_key ?></strong><br/>
trage den Schlüssel und deinen Benutzername in dieses <?= HTML::anchor('activate','Formular',array(),'http') ?> ein um dein Account zu aktivieren <br/>
oder aktiviere deinen Account über den link <br/>
<?= HTML::anchor('activate/'.$username.'/'.$activation_key,'Jetzt aktivieren',array(),'http')?>