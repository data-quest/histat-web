<h3>Änderung an der Datentabelle</h3><br/>
<p>
    Die Zeitreihe <b>"<?= $tablename ?>"</b> der Studie <b/>"<?= $projectname ?>"</b> wurde von <b>"<?= $username ?>"</b> am <?= $chdate ?> verändert. 
    Der Wert des Filters  <b>"<?= $filter ?>"</b> im Jahr <b>"<?= $year ?>"</b> wurde von <b>"<?= $old_value ?>"</b> auf <b>"<?= $new_value ?>"</b> geändert.
</p>
<?= HTML::anchor('table/details/'.$id_hs.'/'.$filter_key.'#'.$year,'Details..',NULL,'http')?>