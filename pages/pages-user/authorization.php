<script src="assets/js/validation.js" defer></script>
    <div class="h100">
        <form id="auth" class="reg-auth" action="" method="POST">
            <img class="logo-form" src="assets/images/logo/logo.png" alt="">
            <div class="form-info">
                <h2 class="form-h2">Вход</h2>
                <input class="input-form" type="text" id="phone" name="phone" placeholder="Номер телефона">
                <input class="input-form" type="password" name="password" placeholder="Пароль">
                <input type="submit" value="Продолжить">
                <input type="hidden" name="page" value="etap">
                <span id="errorLabelauth" class="label">

                </span>
            </div>
            <p class="accept">Еще не зарегистрированы? <a href="?page=reg">Регистрация</a></p>
        </form>
    </div>
