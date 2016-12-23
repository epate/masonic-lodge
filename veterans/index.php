<!-- -*- mode: php -*- -->
<!DOCTYPE html>
<?php set_include_path(".:/usr/local/lib/php:$_SERVER[DOCUMENT_ROOT]"); ?>
<?
function VeteransList($y)
{
    global $sqlitedb;

    $results = $sqlitedb->query('SELECT LastName, FirstMiddleName, Years FROM veterans ORDER BY LastName');
    echo "<div class=\"visible-md visible-lg\">\n";
    while ($row = $results->fetchArray(SQLITE3_ASSOC))
        {
            if ($row['Years'] != $y) { continue; }
            echo "<div class=\"plate\">";
            echo "<div class=\"inscription\">";
            echo $row['FirstMiddleName'] . " " . $row['LastName']; // <br>$Years Years";
            echo "</div></div>\n";
        }
    echo "<br clear=all>\n";
    echo "</div>\n";
    
    $results->reset();
    echo "<div class=\"visible-xs visible-sm\"><ol>\n";
    while ($row = $results->fetchArray(SQLITE3_ASSOC))
         {
            if ($row['Years'] != $y) { continue; }
            echo "<li>" . $row['FirstMiddleName'] . " " . $row['LastName'] . "\n"; //, $Years Years";
        }
    echo "</ol></div>\n";
}
?>
<html lang="en">
  <head>
    <link rel="stylesheet" href="/css/stylesheet.css" type="text/css" />
    <? include "../header.html"; ?>
    <title>Masonic Veterans - <?= $cnf_lodgeNameNumber ?></title>
  </head>
  <body>
  <style>
  .inscription {
    margin-top:-11px;
  }
  </style>

    <h1>60 Year Masonic Veterans</h1>
    <? VeteransList(60); ?>

    <h1>50 Year Masonic Veterans</h1>
    <? VeteransList(50); ?>

    <? include "footer.php"; ?>
  </body>
</html>

