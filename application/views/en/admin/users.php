<div id="admin_users">
    <h1>Liste der Benutzer</h1><br/>
    <table id="users">

        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user->id ?></td>
                    <td class="even"><?= $user->username ?></td>
                    <td><?= $user->surname ?>, <?= $user->name ?></td>
                    <td class="details">
                        <span>
                            <?= HTML::anchor('user/view/'.$user->id,'Beschreibung...')?>
                        </span>
                        
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>