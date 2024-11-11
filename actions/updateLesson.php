<?php
require ('../connect/connect.php');

// Проверяем, существует ли идентификатор урока
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $lessonId = $_GET['id'];

    // Получаем данные урока из базы данных
    $lesson = $database->query("SELECT * FROM `lessons` WHERE `id` = " . $lessonId)->fetch(2);


    if ($lesson) {
        // Получаем данные из формы
        $about = isset($_POST['about']) ? htmlspecialchars(trim($_POST['about'])) : $lesson['about'];
        $dateFrom = isset($_POST['dateFrom']) ? htmlspecialchars(trim($_POST['dateFrom'])) : $lesson['dateFrom'];
        $dateTo = isset($_POST['dateTo']) ? htmlspecialchars(trim($_POST['dateTo'])) : $lesson['dateTo'];

        // Предполагается, что данные для заголовка и описания также передаются из формы 

        $api_key = '6d8c234a-26c7-4bf2-984b-1005040cfd38';


        if (isset($_FILES['video']) && $_FILES['video']['error'] !== UPLOAD_ERR_NO_FILE) {
            $video_file_path = $_FILES['video']['tmp_name'];

            $url = 'https://uploader.kinescope.io/video';
            $headers = [
                'X-Video-Title: ' . $_FILES['video']['name'],
                'X-Video-Description: ' . $about,
                'X-File-Name: ' . $_FILES['video']['name'],
                'Authorization: Bearer ' . $api_key
            ];

            // Открываем файл для чтения бинарных данных
            $file_handle = fopen($video_file_path, 'rb');

            // Инициализация cURL-сеанса
            $curl = curl_init($url);

            // Установка необходимых опций
            curl_setopt_array($curl, [
                CURLOPT_POST => true,
                CURLOPT_HTTPHEADER => $headers,
                CURLOPT_POSTFIELDS => stream_get_contents($file_handle), // Отправляем содержимое файла как тело запроса
                CURLOPT_RETURNTRANSFER => true
            ]);

            // Выполнение запроса
            $response = curl_exec($curl);

            // Проверка на наличие ошибок
            if (curl_errno($curl)) {
                echo 'Ошибка cURL: ' . curl_error($curl);
            } else {
                // Распечатка ответа
                // Декодирование JSON
                $response_data = json_decode($response, true);

                // Получение play_link
                $play_link = $response_data['data']['play_link'];
                // Обновляем данные урока в базе данных
                $sql = "UPDATE lessons SET about = :about, dateFrom = :dateFrom, dateTo = :dateTo, video = :video WHERE id = :id";
                $stmt = $database->prepare($sql);
                $stmt->execute([
                    'about' => $about,
                    'dateFrom' => $dateFrom,
                    'dateTo' => $dateTo,
                    'video' => $play_link,
                    'id' => $lessonId
                ]);


            }

            // Закрываем файл и cURL-сеанс
            fclose($file_handle);
            curl_close($curl);
            header("Location: /?page=updateLesson&id=" . urlencode($lessonId));


        } else {
            $sql = "UPDATE lessons SET about = :about, dateFrom = :dateFrom, dateTo = :dateTo WHERE id = :id";
            $stmt = $database->prepare($sql);
            $stmt->execute([
                'about' => $about,
                'dateFrom' => $dateFrom,
                'dateTo' => $dateTo,
                'id' => $lessonId
            ]);

            header("Location: /?page=updateLesson&id=" . urlencode($lessonId));
        }




    } else {
        echo 'Урок не найден';
    }
} else {
    echo 'Идентификатор урока не предоставлен';
}

?>