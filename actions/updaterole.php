<?php 
session_start();
require('../connect/connect.php');
$userid = $_POST['userid'];
$userrole = $_POST['newRole'];

$sql = "UPDATE `users` SET `role`='$userrole' WHERE `id` = '$userid' ";
$state = $database->prepare($sql);
$state->execute();




echo 'id='. $_POST['userid'] ;

?>