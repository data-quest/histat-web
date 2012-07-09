
<table id="users">

    <tbody>
        <?php foreach ($users as $user): ?>
            <tr id="<?= $user->id ?>">
                <td><?= $user->id ?></td>
                <td class="even"><?= $user->username ?></td>
                <td><?= $user->surname ?>, <?= $user->name ?></td>
            
                <td class="even">
                    <?php if($user->locked == 1):?>
                   <?= HTML::anchor('user/unlock/'.$user->id,HTML::image('assets/img/layout/lock-locked.png', array('title'=>'Benutzer entsperren')),array('class'=>'icon left'))?>
                    <?php else:?>
     <?= HTML::anchor('user/lock/'.$user->id,HTML::image('assets/img/layout/lock-unlocked.png', array('title'=>'Benutzer sperren')),array('class'=>'icon left'))?>
                    <?php endif;?>
     <?= HTML::anchor('user/resend_password/'.$user->id,HTML::image('assets/img/layout/mail.png', array('title'=>'Neues Passwort versenden')),array('class'=>'icon left'))?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>