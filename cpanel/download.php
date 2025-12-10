<?php
require '../config.php';

$files = glob(DOWNLOAD_DIR . '/*.tar.gz');

if (count($files) > 0) {
    rsort($files);
    $file = $files[0];
    $mime = mime_content_type($file);
    
    header('Content-Description: File Transfer');
    header('Content-type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($file).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);
} else {
    http_response_code(404);
}


