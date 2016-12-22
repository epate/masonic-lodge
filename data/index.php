<!DOCTYPE html>
<html lang="en">
<head>
    <title>Kempsville Lodge - Data Sources</title>
</head>

<h1>Data Sources</h1>
<ul>
<li><a href="#officers">Lodge Officers</a></li>
<li><a href="#majorevents">Major Events</a></li>
<li><a href="#comingup">Minor Events</a></li>
<li><a href="#appendants">Appendant Body Schedule</a></li>
<li><a href="#awards">Lodge Awards</a></li>
<li><a href="#lmip">Life Members in Perpetuity</a></li>
<li><a href="#memorial">Memorial</a></li>
<li><a href="#moty">Mason of the Year</a></li>
<li><a href="#veterans">Veterans</a></li>
<li><a href="#pastmasters">Past Masters</a></li>
<li><a href="#affiliated">Affiliated Past Masters</a></li>
</ul>

<h2 id="officers">Lodge Officers</h2><? DumpTable("officers"); ?>
<h2 id="majorevents">Major Events</h2><? DumpCalendar("major"); ?>
<h2 id="comingup">Minor Events</h2><? DumpCalendar("minor"); ?>
<h2 id="appendants">Appendant Body Schedule</h2><? DumpCalendar("appendant"); ?>
<h2 id="awards">Lodge Awards</h2><? DumpTable("awards"); ?>
<h2 id="lmip">Life Members in Perpetuity</h2><? DumpTable("lmip"); ?>
<h2 id="memorial">Memorial</a></h2><? DumpTable("memorial"); ?>
<h2 id="moty">Mason of the Year</h2><? DumpTable("moty"); ?>
<h2 id="veterans">Veterans</h2><? DumpTable("veterans"); ?>
<h2 id="pastmasters">Past Masters</h2><? DumpPastMastersTable("pastmasters"); ?>
<h2 id="affiliated">Affiliated Past Masters</h2><? DumpPastMastersTable("affiliated"); ?>

<style>
  table {
  border-collapse: collapse;
}
  td {
    vertical-align: top;
  }
</style>

<?
function DumpTable($table)
{
    $sqlitedb = new SQLite3('/home/epate/public_html/kempsvillelodge.org/data/kempsville.db');
    $results = $sqlitedb->query("SELECT * FROM $table");
    $results = $sqlitedb->query("SELECT * FROM $table order by " . $results->columnName(0) . " ASC");

    print "<table border=1 width=100%>\n";
    print "<tr>";
    for ($i=0; $i<$results->numColumns(); $i++)
        {
            echo "<td align=center><b>" . $results->columnName($i) . "</b></td>";
        }
    print "</tr>\n";

    while ($row = $results->fetchArray(SQLITE3_NUM)) {
        print "<tr>";
        for ($i=0; $i<$results->numColumns(); $i++)
          {
              echo "<td>" . $row[$i] . "</td>";
          }
        print "</tr>\n";
    }
    print "</table>\n";
}

function DumpCalendar($category)
{
    $sqlitedb = new SQLite3('/home/epate/public_html/kempsvillelodge.org/data/kempsville.db');
    $results = $sqlitedb->query("SELECT * FROM calendar");
    $results = $sqlitedb->query("SELECT * FROM calendar WhERE Category='" . $category . "' AND StartDateTime>Date('now') ORDER BY " . $results->columnName(0) . " ASC");

    print "<table border=1 width=100%>\n";
    print "<tr>";
    for ($i=0; $i<$results->numColumns(); $i++)
        {
            echo "<td align=center><b>" . $results->columnName($i) . "</b></td>";
        }
    print "</tr>\n";

    while ($row = $results->fetchArray(SQLITE3_NUM)) {
        print "<tr>";
        for ($i=0; $i<$results->numColumns(); $i++)
          {
              echo "<td>" . $row[$i] . "</td>";
          }
        print "</tr>\n";
    }
    print "</table>\n";
}

function DumpPastMastersTable($table)
{
    $sqlitedb = new SQLite3('/home/epate/public_html/kempsvillelodge.org/data/kempsville.db');
    $results = $sqlitedb->query("SELECT * FROM $table");
    $results = $sqlitedb->query("SELECT * FROM $table order by " . $results->columnName(0) . " ASC");

    print "<table border=1 width=100%>\n";
    print "<tr>";
    for ($i=0; $i<$results->numColumns(); $i++)
        {
            echo "<td align=center><b>" . $results->columnName($i) . "</b></td>";
        }
    print "</tr>\n";

    while ($row = $results->fetchArray(SQLITE3_NUM)) {
        print "<tr>";
        for ($i=0; $i<$results->numColumns()-1; $i++)
          {
              echo "<td nowrap>" . $row[$i] . "</td>";
          }
        $Biography = str_replace("\n", "<br>", $row[$results->numColumns()-1]);
        echo "<td>$Biography</td>";
        print "</tr>\n";
    }
    print "</table>\n";
}

function DumpCSV($file)
{
  $data = file($file, FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES);

  print "<table border=1 width=100%>\n";
  $fields = explode("\t", $data[0]);
  $numFields = count($fields);
  print "<tr>\n";
  for ($i=0; $i<$numFields; $i++) { print "<td align=center><b>" . $fields[$i] . "</b></td>"; }
  print "</tr>\n";
  array_shift($data);
  
  foreach ($data as $line)
    {
      $fields = explode("\t", $line);
      print "<tr>\n";
      for ($i=0; $i<$numFields; $i++) { 
	print "<td>" . $fields[$i] . "</td>";
      }
      print "</tr>\n";
    }
  print "</table>\n";
}

function DumpPastMasters($file)
{
    $data = file($file, FILE_IGNORE_NEW_LINES);
    foreach ($data as $line)
      {
	echo "$line<br>\n";
      }
}

?>
