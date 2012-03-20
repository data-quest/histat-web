<div id="themes_cloud" class="ui-corner-bottom" style="width:100%; height:500px; background-color:#F9F7EE;">
    <ul>
        <?php 
        foreach($times as $name => $time)
            echo '<li '.(Arr::get($time,'top')!= NULL?'class="top"':'').'>'.HTML::anchor('data/times/'.Arr::get($time,'id',$name),$name,array('style'=>'font-size:'.Arr::get($time,'count',10).'px')).'</li>';
        ?>
    </ul>
</div>