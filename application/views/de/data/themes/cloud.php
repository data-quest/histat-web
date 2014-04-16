<div id="themes_cloud" class="ui-corner-bottom" style="width:100%; height:500px; background-color:#FFF;">
    <ul>
        <?php 
        foreach($themes as $name => $theme)
               echo '<li >' . HTML::anchor('data/themes/' . Arr::get($theme, 'id', $name), $name, array('style' => 'font-size:' . Arr::get($theme, 'count', 10) . 'px')) . '</li>';
          //  echo '<li '.(Arr::get($theme,'top')!= NULL?'class="top"':'').'>'.HTML::anchor('data/themes/'.Arr::get($theme,'id',$name),$name,array('style'=>'font-size:'.Arr::get($theme,'count',10).'px')).'</li>';
        ?>
    </ul>
</div>