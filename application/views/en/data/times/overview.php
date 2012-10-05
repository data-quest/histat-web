
<div id="themes_overview">
         <p  class="normal" style="padding: 15px;">
This menu offers you the selection on the basis of time periods. All studies were assigned to a time period. This was certainly not always an easy task. The aim was the offer of not more than 20 time periods, to which each study of the in the meanwhile several hundred studies comprising study stock should be assigned to. Only in this way we could presenting you a manageable selection menu. In pragmatic respect the best solution of this task was the classification of the most studies according to the opening decade of their investigation period. A much more precise selection can be made by using the advanced selection menu. The advanced selection menu offers you the possibility to choose the time series of the studies by using a time-filter. 
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
