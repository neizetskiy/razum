<?php 
require('../connect/connect.php');
$cour = $database->query("SELECT * FROM `courses` WHERE `id` = " . $_GET['id'])->fetch(2);
$teacher = htmlspecialchars(trim($_POST['teacher']));
$curator = htmlspecialchars(trim($_POST['curator']));
$about = htmlspecialchars(trim($_POST['about']));
$price = htmlspecialchars(trim($_POST['price']));
$public = htmlspecialchars(trim($_POST['public']));
$dateFrom = htmlspecialchars(trim($_POST['dateFrom']));
$dateTo = htmlspecialchars(trim($_POST['dateTo']));

if(empty($dateFrom)){
 $dateFrom = null;
}

if(empty($dateTo)){
    $dateTo = null;
}

if($_FILES['image']['size'] == 0){
    $root = $cour['img'];
}
else{
    $imageName = uniqid() .  '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    move_uploaded_file($_FILES['image']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/public/' . $imageName);
    $root =  '/public/' . $imageName;
}



$sql = "UPDATE `courses` SET 
`teacher`='$teacher',
`curator`='$curator',
`about`='$about',
`img`='$root',
`price`= '$price',
`public`='$public',
`dateFrom`= '$dateFrom',
`dateTo`= '$dateTo' 
WHERE `id` = " . $_GET['id'];
$state = $database->prepare($sql);
$state->execute();
header("Location: /?page=updateCourse&id=".urldecode($_GET['id']));
?>