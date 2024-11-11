<?php 
require('../connect/connect.php');
$name = htmlspecialchars(trim($_POST['name']));
$type = htmlspecialchars(trim($_POST['type']));
$num = htmlspecialchars(trim($_POST['num']));


if(empty($name) || empty($num)){
    die('Заполните все поля');
}


$sql = "INSERT INTO `promo`(`name`, `type`, `sum`) VALUES ('$name','$type','$num')";
$state = $database->prepare($sql);
$state->execute();


echo 'yes';
?>