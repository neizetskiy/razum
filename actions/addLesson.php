<?php 
require('../connect/connect.php');
$name = htmlspecialchars(trim($_POST['name']));
$courseId = $_POST['courseId'];

if(empty($name)){
    die("Заполните все поля");
}

$sql = "INSERT INTO `lessons`(`name`, `courseId`) VALUES ('$name','$courseId')";
$state = $database->prepare($sql);
$state->execute();
echo 'yes';
?>
