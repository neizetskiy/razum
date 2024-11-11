<script src="assets/js/validation.js" defer></script>
<div class="h100">
    <form id="reg" method="post" class="reg-auth">
        <img class="logo-form" src="assets/images/logo/logo.png" alt="">
        <div class="form-info">
            <h2 class="form-h2">Регистрация</h2>
            <input class="input-form" type="text" name="surname" placeholder="Фамилия">
            <input class="input-form" type="text" name="name" placeholder="Имя">
            <input class="input-form" id="phone" type="text" name="phone" placeholder="Номер телефона">
            <input class="input-form" type="password" name="password" placeholder="Пароль">
            <div class="accept">
                <input id="policy" name="accept" type="checkbox">
                <label for="policy">Я согласен с <a href="">политикой конфиденциальности</a></label>
            </div>
            <input type="submit" value="Продолжить">
            <span id="errorLabel" class="label"></span>
        </div>
        <p class="accept">Уже есть аккаунт? <a href="?page=auth">Войти</a></p>
    </form>
</div>