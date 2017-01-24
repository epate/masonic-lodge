<?php
$file = __DIR__ . "/../museum/newsletters/previews/" . $_GET['p'];
$image = @imagecreatefromgif($file);
$cropped = imagecreatetruecolor(300,300);
imagecopy($cropped, $image, 0, 0, 0, 0, 300, 300);
header('Content-Type: image/jpeg');
imagejpeg($cropped);
?>
