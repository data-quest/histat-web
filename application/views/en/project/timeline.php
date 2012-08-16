<div id="timeline">


    <?php
    $options = array();
    foreach ($names as $name):
        $options[$name->ID_HS] = $name->Name;
    endforeach;
    ?>
    <?= Form::select('table', $options, NULL, array('type' => 'checkbox', 'style' => 'width:500px')) ?>



</div>
<script type="text/javascript">
    var more = "Mehr...";
    var less = "Weniger...";
    var title = "<?= $project->Projektname ?>";
    var showText = "Ergebnis Anzeigen";
    var resetText = "Auswahl zurücksetzen";
    var closeText = "Schließen";
</script>