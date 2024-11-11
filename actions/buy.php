<?php
session_start();
require('../connect/connect.php');

if(isset($_POST['buy'])){

    $userId = $_SESSION['uid'];
    $courseId = $_POST['idCourse'];
    $sql = "INSERT INTO `Purchased`(`userId`, `courseId`) VALUES ('$userId','$courseId')";
    $state = $database->prepare($sql);
    $state->execute();
    header("Location: /?page=learning");
}

?>