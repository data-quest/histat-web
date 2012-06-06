<div id="authors">
        <p  class="normal" style="padding: 15px;">
Auswahl von Studien über die Autorinnen und Autoren.</p>
<hr/>
    <div class="keys">
        <ul>
            <?php foreach ($key_list as $key): ?>
                <li><a href="#<?= $key ?>"><?= $key ?></a></li>
            <?php endforeach; ?>

        </ul>
        <div class="clear"></div>
    </div>
    <hr/>
    <div class="list">
        <h1>Liste aller Autorinnen und Autoren</h1><br/>
        <?php foreach ($author_list as $key => $authors): ?>
        <div class="key"><span  id="<?= $key ?>"><?= $key ?></span>
            <?php foreach ($authors as $id => $author): ?>
            <div class="author" id="<?=$id ?>"><?= HTML::anchor('data/names/'.urlencode($author).'#'.$id,$author) ?></div><?= ($name === $author)? '<div class="project">'.$projects.'</div>':'' ?>
            <?php endforeach; ?>
        </div>
        <?php endforeach; ?>
        <div class="clear"></div>
    </div>
</div>

<?= $dialog ?>