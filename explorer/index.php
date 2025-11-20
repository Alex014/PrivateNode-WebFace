<?php
require '../config.php';
//phpinfo();
// var_dump($_SERVER['SERVER_PORT']);
define('BASE_URL', "http://127.0.0.1:6422/");

$url = BASE_URL;
$url_params = '';
$headers = [];

if (! empty($_GET)) {
    $url = BASE_URL . urldecode($_GET['path']);
    $params = $_GET;
    unset($params['path']);

    if (!empty ($params)) {
        $url_params = http_build_query($params);
        $url .= '?' . $url_params;
    }
}

// if (strpos($url, 'verify') !== false) {
//     var_dump($url, $_SERVER['REQUEST_METHOD'], file_get_contents('php://input'), getallheaders()); die();
// }

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);

if ('post' === strtolower($_SERVER['REQUEST_METHOD'])) {
    curl_setopt($ch, CURLOPT_POST, true);
    // curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
    // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, file_get_contents('php://input'));
}

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

foreach (getallheaders() as $header => $value) {
    if ('X-CSRF-Token' === $header) {
        $headers[] = "X-CSRF-Token: " . $value;
    } elseif ('Content-Encoding' === $header) {
        $headers[] = "Content-Encoding: " . $value;
    } elseif ('Content-Type' === $header) {
        $headers[] = "Content-Type: " . $value;
    } elseif ('Content-Length' === $header) {
        $headers[] = "Content-Length: " . $value;
    }
    // $headers[] = $header . ': ' . $value;
}

curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$body = curl_exec($ch);

if ( !curl_errno($ch)) {
    header ("Content-type: ".curl_getinfo($ch, CURLINFO_CONTENT_TYPE)."");
    header ("Content-Length: ".curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD)."");
} else {
    echo 'Curl error: ' . curl_error($ch);
    die(1);
}

curl_close($ch);

echo $body;
