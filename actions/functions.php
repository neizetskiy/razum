<?php
session_start();

function isAuth()
{
    return isset($_SESSION['uid']) ? intval($_SESSION['uid']) : false;
}

function isRole()
{
    global $database;
    if (isset($_SESSION['uid'])) {
        $role = $database->query("SELECT `role` FROM `users` WHERE `id` = " . $_SESSION['uid'])->fetch(2);
        if($role['role'] == '2'){
            return 'admin';
        }
        elseif ($role['role'] == '3') {
            return 'teacher';
        }
        elseif ($role['role'] == '4') {
            return 'curator';
        }
        else{
            return false;
        }
    }
}
?>