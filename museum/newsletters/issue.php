<?php
$issue = $_GET["issue"];
$title = $_GET["title"];
list($width, $height) = getimagesize("previews/${issue}.gif");

echo "<title>The Ashlar - $title</title>\n";

echo "<div>\n";
echo "<p align=center><b>$title</b><p align=center>\n";
echo "<a href=/museum/newsletters/${issue}.pdf target=\"_blank\">";
echo "<img src=/museum/newsletters/previews/${issue}.gif width=${width} height=${height} border=1>";
echo "</a>";
echo "<p align=center>(click above to view PDF)\n";
echo "</div>\n";

?>


