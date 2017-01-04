<?php
$sqlitedb = new SQLite3($_SERVER[DOCUMENT_ROOT] . "/data/$cnf_database");
date_default_timezone_set('America/New_York');
$moduleTitles = [
    "major" => "Major Events",
    "minor" => "Minor Events",
    "appendant" => "Appendant Body Events",
    "officers" => "Lodge Officers",
    "pastmasters" => "Past Masters",
    "affiliated" => "Affiliated Past Masters",
    "memorial" => "Memorial List",
    "lmip" => "Life Members in Perpetuity",
    "moty" => "Mason of the Year Award",
    "veterans" => "Masonic Veterans",
    "awards" => "Lodge Awards and Recognition",
];

function Module()
    {
       if(isset($_GET['module']))
           {
               switch($_GET['module'])
                   {
                   case "calendar":
		     DumpCalendarTable();
                   break;
                   
                   case "roster":
		     DumpPastMastersTable($_GET['table']);
                   break;
                   
                   case "miscellaneous":
		     DumpTable($_GET['table'], $_GET['sort']);
                   break;

                   case "yearly":
		     DumpTable("years", "year,placement");
                   break;
	       
                   }
           }
       else
           {
               DumpCalendarTable();
           }
   }

function DumpTable($table, $sort)
{
    global $sqlitedb;
    global $moduleTitles;

    include "miscellaneous.html";

    $results = $sqlitedb->query("SELECT rowid, * FROM $table ORDER BY $sort");

    print "<h2 style=\"margin-top:0\">$moduleTitles[$table]&nbsp;";
    echo "<span style=\"font-size:0.8em;color:green;cursor:pointer\" class=\"glyphicon glyphicon-plus\" aria-hidden=\"true\" onclick=\"input\" data-toggle=\"modal\" data-target=\"#miscEditor\" data-title=\"$moduleTitles[$table]\" data-table=\"$table\" data-rowid=\"0\"></span>";
    echo "</h2>\n";
    
    print "<div class=\"table-responsive\">\n";
    print "<table class=\"table table-striped table-condensed\">\n";
    print "<tr>";
    for ($i=1; $i<$results->numColumns(); $i++)
        {
            echo "<td align=center><b>" . $results->columnName($i) . "</b></td>";
        }
    print "</tr>\n";

    while ($row = $results->fetchArray(SQLITE3_NUM)) {
        print "<tr style=\"cursor:pointer\" onclick=\"input\" data-toggle=\"modal\" data-target=\"#miscEditor\" data-title=\"$moduleTitles[$table]\" data-table=\"$table\" data-rowid=\"$row[0]\">";

        for ($i=1; $i<$results->numColumns(); $i++)
          {
              echo "<td>" . str_replace("<br>", " ", $row[$i]) . "</td>";
          }
        print "</tr>\n";
    }
    print "</table></div>\n";
}

function DumpCalendarTable()
{
    global $sqlitedb;
    global $moduleTitles;

    include "calendar.html";
}

function DumpPastMastersTable($table)
{
    global $sqlitedb;
    global $moduleTitles;

    include "miscellaneous.html";
    
    $results = $sqlitedb->query("SELECT * FROM $table");
    $results = $sqlitedb->query("SELECT rowid, * FROM $table order by " . $results->columnName(0) . " ASC");

    print "<h2 style=\"margin-top:0\">$moduleTitles[$table]&nbsp;";
    echo "<span style=\"font-size:0.8em;color:green;cursor:pointer\" class=\"glyphicon glyphicon-plus\" aria-hidden=\"true\" onclick=\"input\" data-toggle=\"modal\" data-target=\"#miscEditor\" data-title=\"$moduleTitles[$table]\" data-table=\"$table\" data-rowid=\"0\"></span>";
    echo "</h2>\n";
    
    print "<div class=\"table-responsive\">\n";
    print "<table class=\"table table-striped table-condensed\">\n";
    print "<tr class=\"hidden-xs\">";
    echo "<td align=center><b>Year</b></td>";
    echo "<td align=center><b>Name<br>Photo</b></td>";
    echo "<td align=center><b>Biography</b></td>";
    print "</tr>\n";
    
    while ($row = $results->fetchArray(SQLITE3_BOTH)) {
        $Biography = str_replace("\n", "<br>", $row[Biography]);

        print "<tr style=\"cursor:pointer\" onclick=\"input\" data-toggle=\"modal\" data-target=\"#miscEditor\" data-title=\"$moduleTitles[$table]\" data-table=\"$table\" data-rowid=\"$row[0]\"  valign=top class=\"hidden-xs\">";
        echo "<td>$row[Year]</td>";
        echo "<td nowrap>$row[Name]<br>";
        echo "<a href=\"/photos/large/$row[Photo]\" class=\"thickbox\"><img src=\"/photos/$row[Photo]\" class=\"img-responsive img-thumbnail\"></a><br>$row[Photo]";
        echo "</td>";
        echo "<td>$Biography</td>";
        print "</tr>\n";

        print "<tr valign=top class=\"visible-xs\">";
        echo "<td nowrap><span class=\"glyphicon glyphicon-trash\" aria-hidden=\"true\"></span>&nbsp;&nbsp;";
        echo "<span class=\"glyphicon glyphicon-pencil\" aria-hidden=\"true\"></span></td>\n";
        echo "<td>$row[Year]<br>";
        echo "$row[Name]<br><a href=\"/photos/large/$row[Photo]\" class=\"thickbox\">$row[Photo]</a><br>";
        echo "$Biography</td>";
        print "</tr>\n";

    }
    print "</table></div>\n";
}

function TimeString($S)
{
    if (intval(date("i",  strtotime($S)))) { $T = date("g:iA", strtotime($S)); }
    else { $T = date("gA", strtotime($S)); }
    return $T;
}

?>
