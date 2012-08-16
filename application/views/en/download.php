<div id="download">
    <div class="overlay transparent"></div>
    <div class="dialog tooltip">
        <p class="normal">
          $  Die Bedingungen für die Nutzung unseres Download-Datenservices sind in der aktuellen Benutzungsordnung des GESIS - Datenarchivs festgelegt. Auf der GESIS - Homepage können Sie sich unter "Dienstleistungen / Recherche & Datenzugang / Datenarchiv Service / Benutzungsordnung" über die aktuell geltenden Bedingungen zur Nutzung von Studien und Daten informieren. Für gewerbliche Zwecke sind die Vervielfältigungen und Verbreitung exportierter Daten aus Studien des GESIS - Datenarchivs grundsätzlich nicht gestattet.
        </p>
        <p class="normal">
          $  Die zugangsklasse A dieser Studie erfordert die Angabe eines Verwendungszweckes. Mit der Angabe des Verwendungszwekcs und dem anschließenden Download stimmen Sie den Nutzungsbediungen zu.
        </p>
        <?= Form::open('table/download/'.$action.'/'.$id_hs.'/'.$filter)?>
        <?= Form::select('uses', $options)?>
        <?= Form::input('custom')?>
        <?= Form::submit('download', __('Start Download'),array('class'=>'button'))?>
        <?= Form::close()?>
    </div>
</div>