<div class="art-postcontent art-postcontent-0 clearfix">
    <div class="art-postmetadataheader">
        <h2 class="art-postheader">Регистрация</h2>
    </div>
    <div class="art-content-layout">
        <form action="/def/get_registr" method="POST">
            <div class="auth"><label>Ваше имя:<br/><input type="text" name="nickname" required/></label></div>
            <div class="auth"><label>Электронная почта:<br/><input type="email" name="email" required/></label></div>
            <div class="auth"><label>Пароль:<br/><input type="password" name="password" required/></label></div>
            <div class="auth"><label>Повторите пароль:<br/><input type="password" name="password2" required/></label>
            </div>
            <div class="auth"><label>Введите текст с картинки:<br/> <input type="text" name="captcha" required/></label>
            </div>
            <div><img src="/def/captcha"/></div>
            <div class="auth_submit" style=""><input type="submit" name="go_register" value="Регистрация"/></div>
            <div style='float:left;margin:0.5em 0;'><a href="/login">Войти</a></div>
        </form>
    </div>
</div>
<?php echo $ulogin; ?>