<div id="login">
    <h1>Login</h1>
    <p>Please insert your login informations</p>
    <?php if (isset($incorrect)): ?>
        <span class="error">Login informations are wrong</span>
    <?php endif ?>
    <?= Form::open('auth/login') ?>
    <?= Form::label('username',__('Username:')) ?> <br/>
    <?= Form::input('username', HTML::chars(Arr::get($_POST, 'username'))) ?><br/>
    <?= Form::label('password', __('Password:')) ?> <br/>
    <?= Form::password('password', HTML::chars(Arr::get($_POST, 'password'))) ?><br/>
    <?= Form::label('remember', __('Remember me?')) ?> 
    <?= Form::checkbox('remember') ?><br/>
    <?= Form::submit('login',__('Login')) ?>
    <?= Form::close() ?>
</div>