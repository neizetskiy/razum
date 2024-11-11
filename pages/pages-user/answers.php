<?php
$lesson = $database->query("SELECT * FROM `lessons` WHERE `id` = " . $_GET['lessid'])->fetch(2);
$homeworks = $database->query("SELECT * FROM `homeworks` WHERE `lessonId` = " . $_GET['lessid'])->fetchAll(2);
$itogoGet = 0;
$itogoCan = 0;
?>

<div class="container">
    <div class="profile">
        <h1>
            <?= $lesson['name'] ?>
        </h1>
        <div class="answers-page">
            <div class="answers-grid">
                <div class="answers-item answers-header">
                    Задание
                </div>
                <div class="answers-item answers-header">
                    Ваш ответ
                </div>
                <div class="answers-item answers-header">
                    Правильный ответ
                </div>
                <div class="answers-item answers-header">
                    Результат
                </div>

                <?php
                $sum = 0;
                foreach ($homeworks as $work):
                    $sum += 1;
                    $userid = $_SESSION['uid'];
                    $question = $database->query("SELECT * FROM `questions` WHERE `id` = " . $work['questionid'])->fetch(2);
                    $rightanswer = $database->query("SELECT * FROM `rightanswers` WHERE `rightA` = '1' AND `question_id` = " . $question['id'])->fetch(2);
                    $useranswer = $database->query("SELECT * FROM `peoplesanswers` WHERE `user_id` = '$userid' AND `question_id` = " . $question['id'])->fetch(2);
                    if ($useranswer['balls'] >= ($question['balls'] / 2)) {
                        $okay = true;
                    } else {
                        $okay = false;
                    }

                    ?>

                    <div class="answers-item <?php if($okay): ?> bg-gray <?php endif; ?>">
                        <div class="num">
                            <?= $sum ?>
                        </div>
                        <p>
                            <?= $question['question'] ?>
                        </p>

                    </div>
                    <div class="answers-item <?php if($okay): ?> bg-gray <?php endif; ?>">
                        <img src="assets/images/answers/<?php if($okay): ?>correct<?php else: ?>uncorrect<?php endif;?>.png" alt="">
                        <p>

                            <?php

                            if ($question['type'] == 'test') {
                                $answer = $database->query("SELECT * FROM `rightanswers` WHERE `id` = " . $useranswer['answer'])->fetch(2);
                                echo $answer['name'];
                            } else {
                                echo $useranswer['answer'];
                            }

                            ?>

                        </p>
                    </div>
                    <div class="answers-item <?php if($okay): ?> bg-gray <?php endif; ?>">
                        <p>
                            <?if($rightanswer):?>
                            <?= $rightanswer['name'] ?>
                            <?endif;?>
                        </p>
                    </div>
                    <div class="answers-item <?php if($okay): ?> bg-gray <?php endif; ?>">
                        <div class="lazure">
                            <?= $useranswer['balls'] ?> /
                            <?= $question['balls'] ?>
                            <?php 
                            $itogoGet += $useranswer['balls'];
                            $itogoCan += $question['balls'];
                            ?>
                        </div>
                    </div>
                <?php endforeach; ?>
               
            </div>
            <div class="itog">
                <div class="itog-left">
                    <img src="assets/images/answers/spellcheck.png" alt="">
                    <p>Итого:</p>
                    <span><?=$itogoGet ?>/<?=$itogoCan ?></span>
                </div>
                <a href="?page=homework-q&lessonId=<?=$_GET['lessid']?>" class="go-to">Решить заново →</a>
            </div>
        </div>
    </div>
</div>