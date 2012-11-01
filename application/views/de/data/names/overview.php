<div id="authors">
     
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
        <h1>Liste aller Autorinnen und Autoren</h1>
           <p  class="normal" >
Auswahl von Studien über die Autorinnen und Autoren.</p>
<br/>
        <?php foreach ($author_list as $key => $authors): ?>
        <div class="key"><span  id="<?= $key ?>"><?= $key ?></span>
            <?php foreach ($authors as $id => $author): ?>
            <div class="author" id="<?=$id ?>"><?= HTML::anchor('data/names/'.  strtolower(urlencode($author)).'#'.$id,$author) ?></div><?= (strtolower($name) === strtolower($author))? '<div class="project">'.$projects.'</div>':'' ?>
            <?php endforeach; ?>
        </div>
        <?php endforeach; ?>
        <div class="clear"></div>
    </div>
</div>

<?= $dialog ?>