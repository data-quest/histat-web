
<div id="themes_overview">
         <p  class="normal" style="padding: 15px;">
    Hier können Sie Studien über eine Zeitspanne auswählen. Alle Studien wurden (genau) einer Zeitspanne zugeordnet. Das ist keine leichte Aufgabe. Wir wollten die mittlerweile mehrere hundert Studien umfassende Sammlung nicht mehr als 20 Epochen/Zeitspannen zuordnen, die jeweils nicht mehr als 20-30 Studien umfassen sollten. Nur so können wir Ihnen handhabbare Auswahlen präsentieren. Als pragmatisch beste Lösung ergab sich eine Zuordnung der meisten Studien zum Anfangsjahrzehnt ihres Untersuchungszeitraums. Eine weitaus genauere Auswahl ist über die erweiterte Suche möglich, bei der Sie die Studien mit einem Zeitfilter auf Zeitreihenebene auswählen können.
</p>
<hr/>
    <ul>
        <?php
        foreach ($time_list as $time)
            echo '<li>' . HTML::anchor('data/times/' . $time->ID_Zeit, $time->Zeit) . '</li>';
        ?>
    </ul>
    <div class="clear"></div>
    <hr/>
  
    <div class="project_list">
     
        <?= $list ?>
    </div>
</div>
<?= $dialog ?>
