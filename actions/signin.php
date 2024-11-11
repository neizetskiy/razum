<?php
session_start();
require('../connect/connect.php');

$phone = trim(htmlspecialchars($_POST['phone']));
$password = trim(htmlspecialchars($_POST['password']));

if(empty($phone) || empty($password)){
    die('Заполните все поля');
}

if (!preg_match('/^\+7\d{10}$/', $phone)) {
    die('Неправильный формат номера телефона. Используйте формат +79999999999');
}

$phoneCheck = $database->query("SELECT * FROM `users` WHERE `phone` = '$phone'")->fetch(2);
if(!$phoneCheck){
    die("Неверный номер телефона или пароль");
}


if(!password_verify($password, $phoneCheck['password'])){
    die("Неверный номер телефона или пароль");
}

$_SESSION['uid'] = $phoneCheck['id'];
echo"yes";