<?php
$homework = $database->query("SELECT *, questions.id AS Qid FROM `homeworks` JOIN `questions` ON homeworks.questionid = questions.id WHERE homeworks.lessonId = " . $_GET['lessonId'])->fetchAll(2);
$lessonName = $database->query("SELECT `name` FROM `lessons` WHERE `id` = " . $_GET['lessonId'])->fetch(2);
$sum = 0;
?>
<div class="container">
    <div class="profile">
        <h1>
            <?= $lessonName['name'] ?>
        </h1>
        <div class="homeworks">
            <form action="actions/homeqSend.php" method="POST" class="work">
                <h3>Решение домашнего задания</h3>
                <div class="work-space">
                    <?php foreach ($homework as $item): ?>
                        <?php if ($item['type'] == 'test'): ?>
                            <?php $answers = $database->query("SELECT * FROM `rightanswers` WHERE `question_id` = " . $item['id'])->fetchAll(2); ?>
                            <?php $sum += 1; ?>
                            <div class="question">
                                <div class="quest">
                                    <div class="quest-name">
                                        <div class="num">
                                            <?= $sum ?>
                                        </div>
                                        <p>
                                            <?= $item['question'] ?>
                                        </p>
                                    </div>
                                    <div class="need-item-status">
                                    <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M0.292893 0.292893C0.683417 -0.0976311 1.31658 -0.0976311 1.70711 0.292893L7.70711 6.29289C8.09763 6.68342 8.09763 7.31658 7.70711 7.70711L1.70711 13.7071C1.31658 14.0976 0.683417 14.0976 0.292893 13.7071C-0.0976311 13.3166 -0.0976311 12.6834 0.292893 12.2929L5.58579 7L0.292893 1.70711C-0.0976311 1.31658 -0.0976311 0.683417 0.292893 0.292893Z" fill="#00B0AD"/>
</svg>
                                    </div>
                                </div>
                                <div class="answers">
                                    <?php foreach ($answers as $answer): ?>
                                        <div class="radio">
                                            <input name="<?= $item['questionid'] ?>" value="<?= $answer['id'] ?>" type="radio">
                                            <label for="">
                                                <?= $answer['name']; ?>
                                            </label>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <input type="hidden" value="<?= $item['type'] ?>" name="type[]">
                            <input type="hidden" value="<?= $item['Qid'] ?>" name="qid[]">
                        <?php else: ?>
                            <?php $sum += 1; ?>
                            <div class="question">
                                <div class="quest">
                                    <div class="quest-name">
                                        <div class="num">
                                            <?= $sum ?>
                                        </div>
                                        <p>
                                            <?= $item['question'] ?>
                                        </p>
                                    </div>
                                    <div class="need-item-status">
                                  
                                    </div>
                                </div>
                                <textarea placeholder="Введите ответ..." name="<?= $item['questionid'] ?>" id=""></textarea>
                            </div>

                            <input type="hidden" value="<?= $item['type'] ?>" name="type[]">
                            <input type="hidden" value="<?= $item['Qid'] ?>" name="qid[]">
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <div class="send-answer-box">
                    <input class="send-answer" type="submit" value="Отправить на проверку →">
                </div>
                <input type="hidden" name="lessonId" value="<?= $_GET['lessonId'] ?>">
            </form>

        </div>
    </div>
</div>