<?php
$apiKey = 'c6c0181c-77d7-4f3e-8ffa-cd99bdfccd4c';
$videoFile = '';

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api.kinescope.io/v1/upload');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: Bearer ' . $apiKey,
    'Content-Type: multipart/form-data'
));

$videoData = array(
    'file' => new CURLFile($videoFile)
);

curl_setopt($ch, CURLOPT_POSTFIELDS, $videoData);

$response = curl_exec($ch);

if ($response === false) {
    echo 'Ошибка Curl: ' . curl_error($ch);
} else {
    $responseData = json_decode($response, true);
    if (isset($responseData['data']['url'])) {
        $videoUrl = $responseData['data']['url'];
        // Сохранение URL видео в базе данных
        // ...
    } else {
        echo 'Ошибка при загрузке видео: ' . $response;
    }
}

curl_close($ch);
?>