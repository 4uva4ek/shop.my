<div class="art-postcontent art-postcontent-0 clearfix">
    <div class="art-postmetadataheader">
        <h2 class="art-postheader">Авторизация</h2>         
    </div>
    <div class="art-content-layout">
        <form action="/def/goauth" method="POST">
            <div class="auth"><label>Электронная почта:<br/><input type="text" name="login" required /></label></div>
            <div class="auth"><label>Пароль:<br/><input type="password" name="password"  required/></label></div>
            <div class="auth_submit" style=""><input type="submit" name="go_auth" value="Войти" /></div><div style='float:left;margin:0.5em 0;'><a href="/register">Регистрация</a></div>
        </form>
    </div>
</div>
<?php echo $ulogin;?>

