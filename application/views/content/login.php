<div class="art-postcontent art-postcontent-0 clearfix">
    <div class="art-postmetadataheader">
        <h2 class="art-postheader">Авторизация</h2>         
    </div>
    <div class="art-content-layout">
        <form action="/def/get_auth" method="POST">
            <div class="auth"><label>Электронная почта:<br/><input type="email" name="email" required/></label></div>
            <div class="auth"><label>Пароль:<br/><input type="password" name="password"  required/></label></div>
            <div class="auth"><label>Введите текст с картинки:<br/> <input type="text" name="captcha" required/></label>
            </div>
            <div><img src="/def/captcha"/></div>
            <div class="auth_submit" style=""><input type="submit" name="go_auth" value="Войти"/></div>
            <div style='float:left;margin:0.5em 0;'><a href="/registration">Регистрация</a></div>
        </form>
    </div>
</div>
<?php echo $ulogin;?>

