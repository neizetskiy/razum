<?php
session_start();
require('../connect/connect.php');
require('functions.php');
if(isRole() == false){
    header("Location: /?page=main");
    die();
}
else{
    $balls = $_POST['ball'];
    $qid = $_POST['qid'];
    $userid = $_POST['userid'];
    for ($i=0; $i < count($balls); $i++) { 
        $ball = $balls[$i];
        $update = "UPDATE `peoplesanswers` 
        SET 
        `status`='checked',
        `balls`='$ball'
         WHERE `user_id` = '$userid' AND `question_id` = " . $qid[$i];
        $state = $database->prepare($update);
        $state->execute();
    }
    header("Location: /?page=adminExercises");
    die();
}


?>