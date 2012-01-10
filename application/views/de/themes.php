<div id="themes" class="ui-corner-bottom" style="width:100%; height:500px; background-color:#F9F7EE;">
    <ul>
        <?php 
        foreach($themes as $name => $theme)
            echo '<li '.(Arr::get($theme,'top')!= NULL?'class="top"':'').'>'.HTML::anchor('#'.$name,$name,array('rel'=>Arr::get($theme,'count',10))).'</li>';
        ?>
    </ul>
</div>