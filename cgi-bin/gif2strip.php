<?php
$im = new Imagick(__DIR__ . "/../museum/newsletters/previews/" . $_GET['p']);
$im->setiteratorindex(0);
$im->setImageFormat('png');
$imageStrip = $im->appendImages(false);
$imageStrip->resizeImage(640,0,Imagick::FILTER_LANCZOS,1);
header('Content-Type: image/png');
echo $imageStrip->getImagesBlob();
?>
