<!-- -*- mode: php -*- -->
<!DOCTYPE html>
<?php set_include_path(".:/usr/local/lib/php:$_SERVER[DOCUMENT_ROOT]"); ?>
  <head>
    <link rel="stylesheet" href="/css/stylesheet.css" type="text/css" />
    <? include "../header.html"; ?>
    <title>Life Members In Perpetuity - <?= $cnf_lodgeNameNumber ?></title>
  </head>
  <body>

    <h1>Life Members In Perpetuity</h1>
    The Life Membership In Perpituity program continues to make payments
    to both the Grand Lodge of Virginia and <?= $cnf_lodgeName ?> for as long as
    the Lodge holds its Charter. More information can be found at the
    Grand Lodge of Virginia 
    <a href=https://grandlodgeofvirginia.org/members/life-membership-in-perpetuity target=_blank>
      Committee On Life Membership In Perpetuity</a> web site.<p/>

    <? LifeMemberList(); ?>

    <div class="visible-xs visible-sm">*Passed to the Celestial Lodge above</div>

    <? include "footer.php"; ?>

  </body>
</html>

<?
function LifeMemberList()
{
    global $sqlitedb;

    $results = $sqlitedb->query('SELECT Name, Year FROM lmip ORDER BY Year ASC');
    echo "<div class=\"visible-md visible-lg\">\n";
    while ($row = $results->fetchArray(SQLITE3_ASSOC))
        {
            if ($row['Name'][strlen($row['Name'])-1] == '*') {
                echo "<div class=\"plate\" style=\"background-image:url(/graphics/black-plate-1.jpg);\">";
                echo "<div class=\"inscription\" style=\"color:#f4e0b4\">";
            }
            else {
                echo "<div class=\"plate\">";
                echo "<div class=\"inscription\">";
            }
            echo $row['Name'] . "<br>" . $row['Year'];
            echo "</div></div>\n";
        }
    echo "</div>\n";
    
    $results->reset();
    echo "<div class=\"visible-xs visible-sm\"><ol>\n";
    while ($row = $results->fetchArray(SQLITE3_ASSOC))
        {
            echo "<li>$row[Name], $row[Year]";
        }
    echo "</ol></div>\n";
}
?>
<html lang="en">
