<?php
require '../config.php';

$filename = $_FILES['file']['name'];
$location = UPLOAD_DIR . '/' . $filename;

if ( move_uploaded_file($_FILES['file']['tmp_name'], $location) ) { 
  echo 'Success'; 
} else { 
  echo 'Failure'; 
}