<?php 
session_start();
unset($_SESSION['errorPas']);
require('../connect/connect.php');
$users = $database->query("SELECT * FROM `users` WHERE `id` = " . $_GET['id'])->fetch(2);

$lastpassword = htmlspecialchars(trim($_POST['lastpassword']));
$newpassword = htmlspecialchars(trim($_POST['newpassword']));
$newHashPassword = $users['password'];


if(!empty($newpassword)){
    if(empty($lastpassword)){
        $_SESSION['errorPas'][] = "Для смены пароля необходим старый пароль";
    }
    else{
        if(password_verify($lastpassword, $users['password'])){
            $newHashPassword = password_hash($newpassword, PASSWORD_DEFAULT);
        }
        else{
            $_SESSION['errorPas'][] = "Указан неверный пароль";
            $newHashPassword = $users['password'];
        }
    }
}


$sql = "UPDATE `users` SET 
`password`='$newHashPassword'
WHERE `id` = " . $_GET['id'];
$state = $database->prepare($sql);
$state->execute();
header("Location: /?page=profile&id=".urldecode($_GET['id']));

?>