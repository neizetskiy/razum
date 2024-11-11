<?php
session_start();
require('../connect/connect.php');

$surname = trim(htmlspecialchars($_POST['surname']));
$name = trim(htmlspecialchars($_POST['name']));
$phone = trim(htmlspecialchars($_POST['phone']));
$password = trim(htmlspecialchars($_POST['password']));

if(empty($surname) || empty($name) || empty($phone) || empty($password)){
    die('Заполните все поля');
}

if (!preg_match('/^\+7\d{10}$/', $phone)) {
    die('Неправильный формат номера телефона. Используйте формат +79999999999');
}

$phoneCheck = $database->query("SELECT * FROM `users` WHERE `phone` = '$phone'")->fetch(2);
if($phoneCheck){
    die("Пользователь уже существует");
}

if(!isset($_POST['accept'])){
    die("Согласитесь с правилами");
}

$_SESSION['name'] = $name;
$_SESSION['surname'] = $surname;
$_SESSION['phone'] = $phone;
$_SESSION['password'] = $password;

echo "yes";