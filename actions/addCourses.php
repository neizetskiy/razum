<?php 
require('../connect/connect.php');
$name = htmlspecialchars(trim($_POST['name']));
$deadline = $_POST['deadline'];

if(empty($name)){
    die('Заполните все поля');
}


$sql = "INSERT INTO `courses`(`name`, `deadline`) VALUES ('$name', '$deadline')";
$state = $database->prepare($sql);
$state->execute();


echo 'yes';
?>