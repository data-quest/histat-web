<div id="admin_users">
    <h1>Liste der Benutzer</h1><br/>
    <?= $list ?>
</div>
<?php if(!empty($dialog)) : ?>
<div class="tooltip" id="admin_info" style="top:0px;width: 900px;margin:10px 20px;position: fixed;cursor: pointer">
    <?= __($dialog) ?>
</div>
<?php endif;
