<?php
session_start();
$userId = $_SESSION['uid'];
$puch = $database->query("SELECT *, lessons.id AS lessid FROM `lessons` JOIN `Purchased` ON Purchased.courseId = lessons.courseId  WHERE `userId` = " . $userId)->fetchAll(2);

$peoplesanswers = $database->query("SELECT * FROM `peoplesanswers` JOIN `homeworks` ON peoplesanswers.question_id = homeworks.questionid  WHERE `user_id` = '$userId' ")->fetchAll(2);

if (!isAuth()) {
    die();
}
?>

<div class="container">
    <div class="profile">
        <?php if (!empty($puch)): ?>
            <h1>Домашние задания</h1>
            <div class="homeworks">
                <div class="work">
                    <h3>Нужно решить</h3>
                    <div class="need">
                        <?php foreach ($puch as $les): ?>
                            <?php $isSolved = false; ?>
                            <?php foreach ($peoplesanswers as $lessid): ?>
                                <?php if ($les['lessid'] == $lessid['lessonId']): ?>
                                    <?php $isSolved = true; ?>
                                    <?php break; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <?php if (!$isSolved): ?>
                                <a href="?page=homework-q&lessonId=<?= $les['lessid'] ?>" class="need-item">
                                    <div class="need-item-name">
                                        <img src="assets/images/header/profile.png" alt="">
                                        <p><?php
                                            $truncatedText = truncateText($les['name'], 20)
                                            ?>
                                            <?= $truncatedText ?>
                                        </p>
                                    </div>
                                    <?php if ($les['dateTo'] != null): ?>
                                        <div class="need-item-status blue">
                                            до
                                            <?= $les['dateTo'] ?>
                                        </div>
                                    <?php endif; ?>
                                </a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="work">
                    <h3>На проверке</h3>
                    <div class="need">
                        <?php 
                        foreach ($puch as $les): ?>
                            <?php $isChecked = false;
                            $sum = 0; 
                            $sumQ = 0;

                             foreach ($peoplesanswers as $balls) {
                                $lessid = $les['lessid'];
                                    $qball = $database->query("SELECT * FROM `homeworks` JOIN `questions` ON homeworks.questionid = questions.id WHERE `lessonid` = '$lessid' AND questions.id = " . $balls['questionid'])->fetch(2);
                                    if ($qball) {
                                        $sumQ += $qball['balls'];
                                        $sum += $balls['balls']; 
                                    }
                                  
                                } 
                                ?>
                            <?php foreach ($peoplesanswers as $lessid): ?>
                                
                                

                                <?php if ($les['lessid'] == $lessid['lessonId'] && $lessid['status'] == 'on_check'): ?>
                                    <a href="#" class="need-item">
                                        <div class="need-item-name">
                                            <img src="assets/images/header/profile.png" alt="">
                                            <p>
                                                <?php
                                                $truncatedText = truncateText($les['name'], 20)
                                                ?>
                                                <?= $truncatedText ?>
                                            </p>
                                        </div>
                                        <div class="need-item-status yellow">
                                            на проверке
                                        </div>
                                    </a>
                                    <?php $isChecked = true; ?>
                                    <?php break; ?>
                                <?php elseif ($les['lessid'] == $lessid['lessonId'] && $lessid['status'] == 'checked'): ?>

                                    <a href="?page=answers&lessid=<?= $lessid['lessonId'] ?>" class="need-item">
                                        <div class="need-item-name">
                                            <img src="assets/images/header/profile.png" alt="">
                                            <p>
                                                <?php
                                                $truncatedText = truncateText($les['name'], 20)
                                                ?>
                                                <?= $truncatedText ?>
                                            </p>
                                        </div>
                                        <div class="need-item-status green">
                                            <?= $sum ?>/ <?= $sumQ ?>
                                        </div>
                                    </a>
                                    <?php $isChecked = true; ?>
                                    <?php break; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>