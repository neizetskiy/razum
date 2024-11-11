<?php 
require('../connect/connect.php');
require('functions.php');
if(isRole()){
    $sql = "DELETE FROM `courses` WHERE `id` = " . $_GET['id'];
    $state = $database->prepare($sql);
    $state->execute();
    header('Location: /?page=adminCourses');
    die();
}
?>