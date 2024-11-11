<?php
if (isset($_GET['id'])) {
    $item = $database->query("SELECT * FROM `courses` WHERE `id` =  " . $_GET['id'])->fetch(2);
    $teacher = $database->query("SELECT * FROM `users` WHERE `id` = " . $item['teacher'])->fetch(2);
    $lessons = $database->query("SELECT * FROM `lessons` WHERE `courseId` = " . $item['id'])->fetchAll(2);
    $userId = $_SESSION['uid'];
    $courseId = $_GET['id'];
    $Purchased = $database->query("SELECT * FROM `Purchased` WHERE `userId` = '$userId' AND `courseId` = '$courseId'")->fetch(2);
} else {
    header("Location: /?page=catalog");
    die();
}



?>

<div class="container">
    <div class="profile">
        <h1><?= $item['name'] ?></h1>

        <div class="course-info">
            <div class="course-info-text">
                <img class="course-baner" src="<?= $item['img'] ?>" alt="">

                <p>Описание</p>
                <span><?= $item['about'] ?> </span>
                <?php if(!empty($Purchased)): ?>
                <div class="course-works">
                    <h3>Уроки</h3>
                    <?php foreach($lessons as $lesson): ?>
                    <div class="course-work">
                        <div class="course-work-info">
                            <img src="assets/images/header/profile.png" alt="">
                            <div class="course-work-info-text">
                                <?php
                                $truncatedText = truncateText($lesson['name'], 20)
                                ?>
                                <div class="work-name"><?= $truncatedText ?></div>
                                <div class="work-about"><?= $lesson['about'] ?></div>
                            </div>
                        </div>

                        <a href="?page=lesson&id=<?= $lesson['id'] ?>" class="go">
                            Перейти
                        </a>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="course-info-right">
                <div class="course-info-teacher">
                    <img src="<?= $teacher['image'] ?>" alt="">
                    <h3><?= $teacher['surname']?><br>
                        <?= $teacher['name']?></h3>
                    <p class="lazure">Преподаватель</p>
                </div>
                <?php if(empty($Purchased)): ?>
                <form action="actions/buy.php" class="promo" method="POST">
                    <h3>Активируйте промокод</h3>
                    <div class="promo-price">Стоимость: <span><?= $item['price'] ?>₽</span></div>
                    <input type="hidden" name="idCourse" value="<?= $item['id'] ?>">
                    <input type="text" class="promo-input" name="" placeholder="Введите промокод">
                    <input type="submit" class="buy" name="buy" value="Купить">
                </form>
                <?php endif; ?>
            </div>

        </div>



    </div>
</div>
</div>