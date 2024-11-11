<?php
$courses = $database->query("SELECT * FROM `courses` WHERE `public` = 'да'")->fetchAll(2);

if (!isAuth()) {

    die();
} ?>

<div class="container">
    <div class="profile">
        <h1>Каталог</h1>
        <div class="catalog">
            

            <div class="catalog-grid">
                <?php foreach ($courses as $item): ?>
                    <?php 
                    $teacher = $database->query("SELECT * FROM `users` WHERE `id` = " . $item['teacher'])->fetch(2); 
                    $lessons = $database->query("SELECT * FROM `lessons` WHERE `courseId` = " . $item['id'])->fetchAll(2); 
                    ?>
                    <div class="catalog-item">
                        <img src="<?= $item['img'] ?>" alt="">
                        <div class="catalog-item-info">
                            <p class="lazure">
                                <?= $teacher['surname'] ?>
                                <?= $teacher['name'] ?>
                            </p>
                            <div class="item-info">
                                <div class="item-name">
                                    <?= $item['name'] ?>
                                </div>
                                <div class="item-about">
                                    <?= $item['about'] ?>
                                </div>
                            </div>
                            <?php 
                            $count = count($lessons);
                            ?>
                            <div class="quantity">
                                <?= $count ?> уроков / <?= $count ?> домашних заданий
                            </div>
                            <div class="price-and-button">
                                <div class="item-price">
                                    <?= $item['price'] ?>₽
                                </div>
                                <a href="?page=course&id=<?= $item['id'] ?>" class="btn">
                                    Подробнее ›
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>


            </div>
        </div>
    </div>
</div>