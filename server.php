<?php

if ($_POST && $_POST['originUrl'] && $_SERVER["REQUEST_METHOD"] == "POST") {
    $allUrls = json_decode(file_get_contents('array.json'), true);
    $originUrl = $_POST['originUrl'];
    $newUrl = $_SERVER['HTTP_HOST'] . '/test/server.php/' .md5(uniqid(rand(), true));
    $allUrls[$newUrl] = $originUrl;
    file_put_contents("array.json", json_encode($allUrls));
    echo $newUrl;
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $allUrls = json_decode(file_get_contents('array.json'), true);
    $reqUri = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    echo 'result =====' . $reqUri;
    if ($allUrls[$reqUri]) {
        header("Location: " . $allUrls[$reqUri]);
        die();
    }else{
        echo 'URL NOT FOUNDED';
    }
}
