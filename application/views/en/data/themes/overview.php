<div id="themes_overview">
    <p class="normal" style="padding: 15px;">
  On this page you get the opportunity to select studies via their thematic allocation. All studies have been assigned exactly on this subject, which is the focus of the study. 
    </p>
    <hr/>
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
<?= $dialog ?>
