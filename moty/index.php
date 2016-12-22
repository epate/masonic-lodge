<!-- -*- mode: php -*- -->
<!DOCTYPE html>
<?php set_include_path(".:/usr/local/lib/php:$_SERVER[DOCUMENT_ROOT]"); ?>
<html lang="en">
 <head>
  <title>Mason of the Year - Kempsville Lodge No. 196</title></head>
  <link rel="stylesheet" href="/css/stylesheet.css" type="text/css"></link>
<? include "../header.html"; ?>
 </head>
 <body>

<h1>William Hollowell Pierce<br>"Mason of the Year" Recipients</h1>
<? MasonOfTheYear(); ?>
<div class="visible-xs visible-sm">*Passed to the Celestial Lodge above</div>

<? include "footer.php"; ?>

</body>
</html>

<?
function MasonOfTheYear()
{
    global $sqlitedb;
    $results = $sqlitedb->query('SELECT Year, Name FROM moty ORDER BY Year');

    echo "<div class=\"visible-md visible-lg\">\n";
    while ($row = $results->fetchArray(SQLITE3_ASSOC))
    {
         if ($row['Name'][strlen($row['Name'])-1] == '*') {
            echo "<div class=\"plate\" style=\"background-image:url(/graphics/black-plate-1.jpg);\">";
            echo "<div class=\"inscription\" style=\"color:#f4e0b4\"";
            if (strpos($row['Name'],'<br>') !== FALSE) { echo ";margin-top:-26px;"; }
            echo "\">";
        }
        else {
            echo "<div class=\"plate\">";
            echo "<div class=\"inscription\" ";
            if (strpos($row['Name'],'<br>') !== FALSE) { echo "style=\"margin-top:-26px;"; }
            echo "\">";
        }
        echo "$row[Name]<br>$row[Year]";
        echo "</div></div>\n";
    }
    echo "</div>\n";
    
    $results->reset();
    echo "<div class=\"visible-xs visible-sm\"><ol>";
    while ($row = $results->fetchArray(SQLITE3_ASSOC))
        {
            $Name = str_replace("<br>", ", ", $row['Name']);
            echo "<li>$Name, $row[Year]</li>";
        }
    echo "</ol></div>\n";
}
?>
