<?php
session_start();
require('../connect/connect.php');
$user_id = $_SESSION['uid'];
foreach ($_POST['qid'] as $key) {
    $database->query("DELETE FROM `peoplesanswers` WHERE `user_id` = '$user_id' AND `question_id` = '$key'");
    $answer = $_POST[$key];
    $sql = "INSERT INTO `peoplesanswers`(`user_id`, `question_id`, `answer`) VALUES ('$user_id','$key','$answer')";
    $state = $database->prepare($sql);
    $state->execute();

}
header("Location: /?page=homework");
?>



