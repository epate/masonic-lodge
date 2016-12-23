<!-- -*- mode: php -*- -->
<!DOCTYPE html>
<?php set_include_path(".:/usr/local/lib/php:$_SERVER[DOCUMENT_ROOT]"); ?>
<?
function AwardsRecognition()
{
    global $sqlitedb;
    $results = $sqlitedb->query('SELECT Year, Description FROM awards ORDER BY Year');

    echo "<div class=\"visible-md visible-lg\">";
    while ($row = $results->fetchArray(SQLITE3_ASSOC))
        {
            echo "<div class=\"plate\">";
            echo "<div class=\"inscription\" ";
            if (strpos($row['Description'],'<br>') !== FALSE) { echo "style=\"margin-top:-32px;"; }
            echo "\">";
            echo $row['Description'] . "<br>$row[Year]";
            echo "</div></div>\n";
        }
    echo "</div>\n";
    
    $results->reset();
    echo "<div class=\"visible-xs visible-sm\"><ol>\n";
    while ($row = $results->fetchArray(SQLITE3_ASSOC))
        {
            $Award = str_replace("<br>", " ", $row['Description']);
            echo "<li>$Award, $row[Year]\n";
        }
    echo "</ol></div>\n";
}
?>

<html lang="en">
  <head>
    <link rel="stylesheet" href="/css/stylesheet.css" type="text/css" />
    <? include "../header.html"; ?>
    <title>Awards and Recognition - <?= $cnf_lodgeNameNumber ?></title>
  </head>
  <body>

    <h1>Lodge Awards and Recognition</h1>
    <? AwardsRecognition(); ?>

    <? include "footer.php"; ?>

  </body>
</html>
