<h3>Änderung an der Datentabelle</h3><br/>
<p>
    Die der Zeitreihe <b>"<?= $tablename ?>"</b> der Studie <b/>"<?= $projectname ?>"</b> wurde von <b>"<?= $username ?>"</b> am <?= $chdate ?> verändert. 
    Der Wert der <b>"<?= $head ?>"</b> im Filter  <b>"<?= $filter ?>"</b> wurde von <b>"<?= $old_value ?>"</b> auf <b>"<?= $new_value ?>"</b> geändert.
</p>
<?= HTML::anchor('table/details/'.$id_hs.'/'.$filter_key,'Details..',NULL,'http')?>