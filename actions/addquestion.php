<?php
require('../connect/connect.php');
$question = htmlspecialchars(trim($_POST['question']));
$balls = htmlspecialchars(trim($_POST['balls']));
$type = htmlspecialchars(trim($_POST['type']));

function IsChecked($chkname, $value)
{
    if (!empty($_POST[$chkname])) {
        foreach ($_POST[$chkname] as $chkval) {
            if ($chkval == $value) {
                return true;
            }
        }
    }
    return false;
}

if (!empty($question) && !empty($balls)) {
    $sql = "INSERT INTO `questions`(`question`, `balls`, `type`) VALUES ('$question','$balls','$type')";
    $state = $database->prepare($sql);
    $state->execute();
    $questId = $database->lastInsertId();


    $lesson_id = $_GET['Lessonid'];
    $sqlHomework = "INSERT INTO `homeworks`(`lessonId`, `questionid`) VALUES ('$lesson_id','$questId')";
    $send = $database->prepare($sqlHomework);
    $send->execute();

    if ($type == 'test') {

        for ($i = 0; $i < count($_POST['value']); $i++) {
            $value = $_POST['value'][$i];
            if (!empty($value)) {

                if (IsChecked('checkbox', $i + 1)) {
                    $right = 1;
                } else {
                    $right = 0;
                }

                $sql = "INSERT INTO `rightanswers`(`question_id`, `name`, `rightA`) VALUES ('$questId','$value','$right')";
                $state = $database->prepare($sql);
                $state->execute();
            }
        }
        header("Location: /?page=addHomework&Lessonid=" . urldecode($_GET['Lessonid']));

    }
    else if($type == 'string'){
        $valueString = htmlspecialchars(trim($_POST['valueString']));
        $right = 1;
        if(!empty($valueString)){
            $sql = "INSERT INTO `rightanswers`(`question_id`, `name`, `rightA`) VALUES ('$questId','$valueString','$right')";
            $state = $database->prepare($sql);
            $state->execute();
        }
        header("Location: /?page=addHomework&Lessonid=" . urldecode($_GET['Lessonid']));
    }
    else if($type == 'free'){
        header("Location: /?page=addHomework&Lessonid=" . urldecode($_GET['Lessonid']));
    }
}


?>