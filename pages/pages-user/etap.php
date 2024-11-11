<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


    if (!isset($_SESSION['code'])) {
        $phone = $_SESSION['phone'];
        $body = file_get_contents("https://sms.ru/code/call?phone=" . $phone . "&ip=" . $_SERVER["REMOTE_ADDR"] . "&api_id=C9A0D51A-0410-4248-27A2-EC185D1698B2");
        $json = json_decode($body);

        if (isset($json->code)) {
            $_SESSION['code'] = $json->code;
            
        } else {
            $_SESSION['errors'][] =  $json->status_text;
        }
    }



unset($_SESSION['errors']);
if (isset($_POST['codeauth'])) {
    $check = '';


    foreach ($_POST['num'] as $key) {
        $check .= $key;
    }
    if(trim($check) != ''){
        if ($check == $_SESSION['code']) {
            $name = $_SESSION['name'];
            $surname = $_SESSION['surname'];
            $password = $_SESSION['password'];
            $phone = $_SESSION['phone'];
            $pass_hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users`(`name`, `surname`, `phone`, `password`) VALUES ('$name','$surname','$phone','$pass_hash')";
            $state = $database->prepare($sql);
            $state->execute();
            $_SESSION['uid'] = $database->lastInsertId();
            unset($_SESSION['code']);
            header('Location: /?page=profile');
    
        } else {
            $_SESSION['errors'][] = "Неверный код";
        }
    }else{
        $_SESSION['errors'][] = "Введите код";
    }
    
    // var_dump($check);
} 


// var_dump($_SESSION['code'])


?>



   <div class="h100">
        <form class="reg-auth" method="POST"  name="codeauth">
            <img class="logo-form" src="assets/images/logo/logo.png" alt="">
            <div class="form-info etap">
                <h2 class="form-h2">Подтверждение</h2>
                <p>Введите послдение 4 цифры со сброс-звонка</p>
                <span class="phone"><?= $phone; ?></span>
                <p class="gray-text">Введите свой 4-значный код безопасности</p>
                <div class="code">
                    <input class="code-input" name="num[]" id="numberInput1" type="text">
                    <input class="code-input" name="num[]" id="numberInput2" type="text">
                    <input class="code-input" name="num[]" id="numberInput3" type="text">
                    <input class="code-input" name="num[]" id="numberInput4" type="text">
                </div>
                <input type="submit" name="codeauth" class="for_etap" value="Продолжить">
                <p class="accept">Не пришел звонок? <a href="/">Отправить заново</a></p>
                <span class="phone">
                    <?php if (isset($_SESSION['errors'])) {
                        echo $_SESSION['errors'][0];
                        unset($_SESSION['errors']);
                    } ?>
                </span>
            </div>

        </form>
    </div>
    <script>
        const numberInput1 = document.getElementById('numberInput1');
        const numberInput2 = document.getElementById('numberInput2');
        const numberInput3 = document.getElementById('numberInput3');
        const numberInput4 = document.getElementById('numberInput4');

        numberInput1.addEventListener('input', function () {
            let inputValue = numberInput1.value;
            inputValue = inputValue.replace(/\D/g, '');
            if (inputValue.length > 1) {
                inputValue = inputValue.slice(0, 1);

            }
            if (inputValue.length > 0) {
                numberInput2.focus();
            }
            numberInput1.value = inputValue;
        });

        numberInput2.addEventListener('input', function () {
            let inputValue = numberInput2.value;
            inputValue = inputValue.replace(/\D/g, '');
            if (inputValue.length > 1) {
                inputValue = inputValue.slice(0, 1);
            }
            if (inputValue.length > 0) {
                numberInput3.focus();
            }
            numberInput2.value = inputValue;
        });

        numberInput3.addEventListener('input', function () {
            let inputValue = numberInput3.value;
            inputValue = inputValue.replace(/\D/g, '');
            if (inputValue.length > 1) {
                inputValue = inputValue.slice(0, 1);

            }
            if (inputValue.length > 0) {
                numberInput4.focus();
            }
            numberInput3.value = inputValue;
        });

        numberInput4.addEventListener('input', function () {
            let inputValue = numberInput4.value;
            inputValue = inputValue.replace(/\D/g, '');
            if (inputValue.length > 1) {
                inputValue = inputValue.slice(0, 1);
            }
            numberInput4.value = inputValue;
        });




    </script>