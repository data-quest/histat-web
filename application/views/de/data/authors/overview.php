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
        <h1>Autorenliste</h1><br/>
        <?php foreach ($author_list as $key => $authors): ?>
        <div class="key" id="<?= $key ?>"><span><?= $key ?></span>
            <?php foreach ($authors as $author): ?>
            <div class="author"><?= HTML::anchor('data/authors/'.urlencode($author),$author) ?></div><?= ($name === $author)? '<div class="project">'.$projects.'</div>':'' ?>
            <?php endforeach; ?>
        </div>
        <?php endforeach; ?>
        <div class="clear"></div>
    </div>
</div>

<?= $dialog ?>