<div id="themes_overview">
    <p class="normal" style="padding: 15px;">
       $ Hier können Sie Studien über eine thematische Zuordnung auswählen. Alle Studien wurden (genau) einem Thema zugeordnet.$
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
