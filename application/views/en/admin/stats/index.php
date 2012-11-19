<div id="admin_users">
    <h1>Statistics</h1><br/>
    <h3>
        Period of time
    </h3>
    <?= Form::open('stats/display') ?>
    <div style="float:left">
        <div style="float:left">
            <span style="text-align: center;width:100%;display:block">From:</span>
        <div id="from"></div>
        </div>
              <div style="float:left">
            <span style="text-align: center;width:100%;display:block">Until:</span>
        <div id="to"></div>
        </div>

    </div>
    <div class="clear"></div>
    <br/>
    <?php 
    $from = Arr::get($_POST, 'from', date("d.m.Y", strtotime("-3 weeks")));
    $to = Arr::get($_POST, 'to', date("d.m.Y"));
    ?>
    <?= Form::hidden('from',$from ); ?>
    <?= Form::hidden('to',$to ); ?>
    <script>
    var from = "<?= $from?>";
    var to = "<?= $to?>";
    </script>

    <?php 
    $translated_opts = array();
    foreach ($options as $o){
        $translated_opts[]= __($o);
    }
    ?>
    <?= Form::select('option', $translated_opts, Arr::get($_POST, 'option', 0), array('style' => 'margin:10px 0px')) ?>


    <br/>
    <?= Form::submit('display', __('Display'), array('class' => 'button')) ?>
       <?= Form::submit('download', __('Download .CSV'), array('class' => 'button')) ?>
    <?= Form::close(); ?>
</div>
<hr/>
<div id="admin_users">
    <?= $content ?>
</div>