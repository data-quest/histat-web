<div id="admin_users">
    <h1>Statistiken</h1><br/>
    <h3>
        Zeitraum
    </h3>
    <?= Form::open('stats/display') ?>
    <div style="float:left">
        <span style="float:left"> Von </span><div id="from" style="float:left" ></div><span style="float:left"> bis</span> <div  style="float:left"  id="to" ></div>
    </div>
    <div class="clear"></div>
    <br/>
    <?= Form::hidden('from', Arr::get($_POST, 'from', date("d.m.Y", strtotime("-3 weeks")))); ?>
    <?= Form::hidden('to', Arr::get($_POST, 'to', date("d.m.Y"))); ?>

    <?php
    $options = array('Übersicht der registrierten Nutzer',
        'Übersicht der einzelnen Downloads (Datentabellen)',
        'Übersicht zur Anzahl der Downloads (Datentabellen) nach Studien',
        'Anzahl der Downloads (Datentabellen) nach Studien und Nutzern',
        'Verwendungszweck der Downloads',
        'Studien ohne Downloads',
        'Übersicht der Downloads nach Themen',
        'Liste der Studien'
            );
    ?>
    <?= Form::select('option', $options, Arr::get($_POST, 'option', 0), array('style' => 'margin:10px 0px')) ?>


    <br/>
    <?= Form::submit('display', __('Display'), array('class' => 'button')) ?>

    <?= Form::close(); ?>
</div>
<hr/>
<div id="admin_users">
    <?= $content ?>
</div>