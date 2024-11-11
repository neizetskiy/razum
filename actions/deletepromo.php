<?php 
require('../connect/connect.php');
require('functions.php');
if(isRole()){
    $sql = "DELETE FROM `promo` WHERE `id` = " . $_GET['id'];
    $state = $database->prepare($sql);
    $state->execute();
    header('Location: /?page=settings');
    die();
}
?>