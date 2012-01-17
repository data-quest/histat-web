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
        <ul><li class="key" id="<?= $key ?>"><?= $key ?></li>
            <?php foreach ($authors as $author): ?>
            <li><?= $author ?></li>
            <?php endforeach; ?>
            </ul>
        <?php endforeach; ?>
        <div class="clear"></div>
    </div>
</div>
