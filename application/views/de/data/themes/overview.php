<div id="themes_overview">
    <ul>
        <?php
        foreach ($theme_list as $theme)
            echo '<li>' . HTML::anchor('data/themes/' . $theme->ID_Thema, $theme->Thema) . '</li>';
        ?>
    </ul>
    <div class="clear"></div>
    <hr/>
    <div class="project_list">
        <?= $list ?>
    </div>
</div>
