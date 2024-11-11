<?php 
session_start();
unset($_SESSION['error']);
require('../connect/connect.php');
$users = $database->query("SELECT * FROM `users` WHERE `id` = " . $_GET['id'])->fetch(2);

$name = htmlspecialchars(trim($_POST['name']));
$surname = htmlspecialchars(trim($_POST['surname']));
$phone = htmlspecialchars(trim($_POST['phone']));



if(empty($name)){
    $_SESSION['error'][] = "Поле с именем не может быть пустым";
    $name = $users['name'];
}
if(empty($surname)){
    $_SESSION['error'][] = "Поле с фамилией не может быть пустым";
    $surname = $users['surname'];
}
if(empty($phone)){
    $_SESSION['error'][] = "Поле с номером не может быть пустым";
    $phone = $users['phone'];
}



if($_FILES['ava']['size'] == 0){
    $root = $users['image'];
}
else{
    $imageName = uniqid() .  '.' . pathinfo($_FILES['ava']['name'], PATHINFO_EXTENSION);
    move_uploaded_file($_FILES['ava']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/public/' . $imageName);
    $root =  '/public/' . $imageName;
}



$sql = "UPDATE `users` SET 
`name`='$name',
`surname`='$surname',
`phone`='$phone',
`image`='$root'
WHERE `id` = " . $_GET['id'];
$state = $database->prepare($sql);
$state->execute();
header("Location: /?page=profile&id=".urldecode($_GET['id']));
?>