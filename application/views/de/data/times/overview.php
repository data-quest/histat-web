<div id="themes_overview">
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
