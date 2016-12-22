<?php
$file = $_SERVER[DOCUMENT_ROOT] . "/museum/newsletters/previews/" . $_GET['p'];
$image = @imagecreatefromgif($file);
$cropped = imagecreatetruecolor(300,300);
imagecopy($cropped, $image, 0, 0, 0, 0, 300, 300);

// header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
// header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header('Content-Type: image/jpeg');
imagejpeg($cropped);
?>
