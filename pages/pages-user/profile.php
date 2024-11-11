<?php
session_start();

if (!isAuth()) {
    die();
}
?>
<div class="container">
    <div class="profile">
        <h1>Мой профиль</h1>
        <form class="profile-info" enctype="multipart/form-data"
            action="actions/updateProfile.php?id=<?= $user['id'] ?>" method="POST">
            <div class="profile-ava">
                <img id="avatar-image" src="<?= $user['image'] ?>" alt="">
                <input id="ava" name="ava" type="file">
                <label for="ava">Обновить фото</label>
            </div>

            <div class="profile-dates">
                <div class="profile-grid">
                    <div class="profile-input">
                        <label for="">ИМЯ</label>
                        <input type="text" name="name" value="<?= $user['name'] ?>">
                    </div>
                    <div class="profile-input">
                        <label for="">ФАМИЛИЯ</label>
                        <input type="text" name="surname" value="<?= $user['surname'] ?>">
                    </div>
                    <div class="profile-input">
                        <label for="">НОМЕР ТЕЛЕФОНА</label>
                        <input type="text" id="phone" name="phone" value="<?= $user['phone'] ?>">
                    </div>
                    <!-- <div class="profile-input">
                        <label for="">ТЕКУЩИЙ ПАРОЛЬ</label>
                        <input type="password" name="lastpassword">
                    </div>
                    <div class="profile-input">
                        <label for="">НОВЫЙ ПАРОЛЬ</label>
                        <input type="password" name="newpassword">
                    </div> -->
                </div>
                <?php if (isset ($_SESSION['error'])) {
                    foreach ($_SESSION['error'] as $error) {
                        echo '<p class="label">' . $error . '</p>';
                        unset($_SESSION['error']);
                        break;
                    }
                } ?>

                <input type="submit" value="Сохранить изменения">
            </div>

        </form>
        <form action="actions/updatePassword.php?id=<?= $user['id'] ?>" method="POST" class="profile-info">
            <div class="profile-title">
                <h2> Изменение пароля</h2>
            </div>
            <div class="profile-dates">

                <div class="profile-grid">
                    <div class="profile-input">
                        <label for="">ТЕКУЩИЙ ПАРОЛЬ</label>
                        <input type="password" name="lastpassword">
                    </div>
                    <div class="profile-input">
                        <label for="">НОВЫЙ ПАРОЛЬ</label>
                        <input type="password" name="newpassword">
                    </div>
                </div>
                <?php if (isset ($_SESSION['errorPas'])) {
                    foreach ($_SESSION['errorPas'] as $error) {
                        echo '<p class="label">' . $error . '</p>';
                        unset($_SESSION['errorPas']);
                        break;
                    }
                } ?>

                <input type="submit" value="Сохранить">
            </div>
        </form>
    </div>
</div>
<script>
    const sum = document.getElementById('phone');
    sum.addEventListener('input', function () {
        let inputValue = sum.value;
        inputValue = inputValue.replace(/\D/g, '')
        sum.value = inputValue;
    });
</script>

<script src="../../assets/js/image.js"></script>