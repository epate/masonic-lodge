<!-- -*- mode: php -*- -->
<!DOCTYPE html>
<?php set_include_path(".:/usr/local/lib/php:$_SERVER[DOCUMENT_ROOT]"); ?>
<?
function MemorialList()
{
    global $sqlitedb;
    $results = $sqlitedb->query('SELECT Date, Name, Titles FROM memorial ORDER BY Date');
    
    echo "<div class=\"visible-md visible-lg\">\n";
    while ($row = $results->fetchArray(SQLITE3_ASSOC))
    {
        $MonthString = date("F", strtotime($row['Date']));
        
        echo "<div class=\"plate\" style=\"background-image:url(/graphics/black-plate-1.jpg);\">";
        echo "<div class=\"inscription\" style=\"color:#f4e0b4";
        if ($row['Titles']) { echo ";margin-top:-32px;"; }
        echo "\">";
        echo $row['Name'] . "<br>";
        echo date("m-d-Y", strtotime($row['Date']));
        if ($row['Titles']) { echo "<br>" . $row['Titles']; }
        echo "</div></div>\n";
    }
    echo "</div>\n";
    
    $results->reset();
    echo "<div class=\"visible-sm visible-xs\"><ol>\n";
    while ($row = $results->fetchArray(SQLITE3_ASSOC))
    {

        $MonthString = date("F", strtotime($row['Date']));
        
        echo "<li>$row[Name], ";
        echo date("m-d-Y", strtotime($row['Date']));
        if (isset($Title)) { echo ", " . $row['Titles']; }
    }
    echo "</ol></div>\n";
}
?>
<html lang="en">
  <head>
    <link rel="stylesheet" href="/css/stylesheet.css" type="text/css" />
    <? include "../header.html"; ?>
    <title>Memorial - <?= $cnf_lodgeNameNumber ?></title>
  </head>
  <body>

    <h1>Brethren Who Have Passed to the Celestial Lodge Above</h1>
    <? MemorialList(); ?>

    <? include "footer.php"; ?>

  </body>
</html>
