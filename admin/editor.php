<?php
if (array_key_exists('table', $_REQUEST)) { $table = $_REQUEST['table']; }
if (array_key_exists('rowid', $_REQUEST)) { $rowid = $_REQUEST['rowid']; }

include __DIR__ . "/../inc/config.inc";
$sqlitedb = new SQLite3(__DIR__ . "/../data/$cnf_database");
$results = $sqlitedb->query("SELECT * FROM $table WHERE rowid=$rowid");

$row = $results->fetchArray(SQLITE3_NUM);
//echo "<pre>\n";
//var_dump($row);
//echo "</pre>";

echo "<form id=\"miscEditorForm\" method=\"post\">\n";
echo "<input type=\"hidden\" name=\"rowid\" value=\"$rowid\">\n";
echo "<input type=\"hidden\" name=\"table\" value=\"$table\">\n";
echo "<div class=\"form-group well\">\n";
for ($i=0; $i<$results->numColumns(); $i++)
    {
        $colName = $results->columnName($i);
        $colLength = strlen($row[$i]);
	if ($colName == 'Biography') {
            $lines = substr_count($row[$i], "\n") + 3;
            echo "<textarea type=\"text\" rows=\"$lines\" class=\"form-control\" name=\"$colName\" placeholder=\"$colName\" value=\"$row[$i]\">";
            echo $row[$i];
            echo "</textarea>";
        }
        else {
            echo "<input type=\"text\" class=\"form-control\" name=\"$colName\" placeholder=\"$colName\" value=\"$row[$i]\">\n";
        }

    }
if ($rowid > 0)
    {
        echo "<div class=\"checkbox alert alert-danger\"><label><input type=\"checkbox\" name=\"deleteEvent\"> Delete Record</label></div>\n";
    }
echo "</div></form>\n";
?>
