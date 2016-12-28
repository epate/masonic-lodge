<?php // -*- mode: php -*-

date_default_timezone_set("America/New_York");
$sqlitedb = new SQLite3("$_SERVER[DOCUMENT_ROOT]/data/$cnf_database");

echo "
<style>
:root {
    --main-color: $cnf_mainColor;
    --main-color-dark: $cnf_mainColorDark;
}
</style>
";

function getlastmod_multi()
{
    $numargs = func_num_args();
    if ($numargs == 0) { return getlastmod(); }
    else
        {
            $t = 0;
            $arg_list = func_get_args();
            for ($i=0; $i<$numargs; $i++)
                {
                    if ($t < filemtime($arg_list[$i])) { $t = filemtime($arg_list[$i]); }
                }
            return $t;
        }
}

function NumberOfPhotos($Year = "")
{
    $count  = count(glob("$_SERVER[DOCUMENT_ROOT]/photos/*.jpg"));
    $count += count(glob("$_SERVER[DOCUMENT_ROOT]/museum/pins/*.jpg"));
    $count += count(glob("$_SERVER[DOCUMENT_ROOT]/museum/coins/*.jpg"));
    $count += count(glob("$_SERVER[DOCUMENT_ROOT]/museum/newsletters/*.pdf"));
    return intval(($count / 10)) * 10;
}

function NumberOfPins()
{
    $count  = count(glob("$_SERVER[DOCUMENT_ROOT]/museum/pins/*.jpg"));
    return intval(($count / 10)) * 10;
}

function NumberOfCoins()
{
    $count  = count(glob("$_SERVER[DOCUMENT_ROOT]/museum/coins/*.jpg"));
    return intval((($count / 2) / 10)) * 10;
}

function Image($img, $align="top")
{
    list($w, $h) = getimagesize("$_SERVER[DOCUMENT_ROOT]$img");
    echo "<img src=$img width=$w height=$h align=$align class=\"img-responsive\">";
}

function ImageResponsive($img, $align="top")
{
    list($w, $h) = getimagesize("$_SERVER[DOCUMENT_ROOT]$img");
    echo "<div class=\"photo-wrapper\" style=\"max-width:${w}px;\">";
    echo "<a href=\"$img\" class=\"thickbox\">";
    echo "<img src=$img width=$w height=$h align=$align class=\"img-responsive photo\">";
    echo "</a>\n";
}
function EndImage()
{
    echo "</div>";
}

function GetBiography($Year)
{
    global $sqlitedb;

    $results = $sqlitedb->query("SELECT Name, Photo, Biography FROM pastmasters WHERE Year=$Year");
    $row = $results->fetchArray(SQLITE3_ASSOC);

    $Biography = $row['Biography'] . "\n";
    $Biography = preg_replace("/(.*)\n/", "<li>\\1<br />\n", $Biography);
    if (substr_count($Biography, "\n") > 7)
        {
            $offset = strpos_offset_recursive("<br />", $Biography, 7);
            $Biography = substr($Biography, 0, $offset) .
                "</ul><div class=\"more\"><p class=\"more_link\">More <span class=\"glyphicon glyphicon-chevron-down\">" .
                "</span></p><div class=\"more_body\"><ul style=\"padding-left:20px; margin-bottom:0px;\">" .
                substr($Biography, $offset+6) .
                "</div></div>";
        }

    echo "<h2>$row[Name]</h2>";
    echo "<table border=0 width=100%>\n";
    echo " <tr>\n";
    echo "  <td valign=top width=130>";
    echo "<a href=\"/photos/large/$row[Photo]\" class=\"thickbox\" title=\"$row[Name]\">";
    echo "<img src=/photos/$row[Photo] class=\"img-thumbnail\"></a></td>\n";
    echo "  <td valign=top>\n";
    echo "   <ul style=\"padding-left:20px; margin-bottom:0px;\">\n";
    echo "$Biography";
    echo "   </ul>\n";
    echo "  </td>\n";
    echo " </tr>\n";
    echo "</table>\n";
}

function strpos_offset_recursive($needle,$haystack,$occurence){
    if(($o=strpos($haystack,$needle))===false) return false;
    if($occurence>1){
        $found=strpos_offset_recursive($needle,substr($haystack,$o+strlen($needle)),$occurence-1);
        return ($found!==false)?$o+$found+strlen($needle):false;
    }
    return $o;
}

function RandomOfficers($Year)
{
    $Decade = substr($Year, 0, 3);
    $OfficerPhotos  = glob("$_SERVER[DOCUMENT_ROOT]/photos/" . $Decade . "?-Officers.jpg");
    $Photo = basename($OfficerPhotos[array_rand($OfficerPhotos)]);
    $Year = substr($Photo, 0, 4);
    echo "<a href=/photos/$Photo class=\"thickbox\" title=\"Lodge Officers - $Year\"><img src=/photos/$Photo class=\"img-responsive photo\" xwidth=225></a><h2>$Year</h2>";
}

function YearlyMinutes($Year = "")
{
    $minutes = glob("$_SERVER[DOCUMENT_ROOT]/museum/minutes/$Year*.pdf");
    usort($minutes, "cmp");
   
    $pyear = 0;
    foreach ($minutes as $m)
        {
            $file = basename($m);
            $year = substr($file, 0, 4);
            if ($year != $pyear)
                {
                    if ($pyear != 0)
                        {
                            echo "  </ul>\n";
                            echo " </td>\n";
                            for ($i=$column; $i<6; $i++) { echo " <td>\n </td>\n"; }
                            echo "</tr>\n";
                            echo "</table>\n";
                        }
	  
                    if ($Year) { printf("<h2>Meeting Minutes</h2>\n"); }
                    else { printf("<h2>%d (A.L. %d)</h2>\n", $year, $year+4000); }
                    echo "<table border=0 width=100%>\n";
                    echo "<tr>\n";
                    echo " <td valign=top width=17%>\n";
                    echo "  <ul>\n";
                    $mcount = 1;
                    $column = 1;
                    $pyear = $year;
                }
      
            $date = date("F j", strtotime(substr($file, 0, 8)));
            echo "   <li><a href=/museum/minutes/$file>$date</a>\n";
            if ($mcount % 10 == 0)
                {
                    echo "  </ul>\n";
                    echo " </td>\n";
                    echo " <td valign=top width=17%>\n";
                    $column++;
                }
            $mcount++;
        }

    echo "  </ul>\n";
    echo " </td>\n";
    for ($i=$column; $i<6; $i++) { echo " <td>\n </td>\n"; }
    echo "</tr>\n";
    echo "</table>\n";
}

function cmp($a, $b)
{
    $a = basename($a);
    $b = basename($b);
  
    if (substr($a,0,4) != substr($b,0,4))
        {
            return strcmp(substr($b,0,4), substr($a,0,4));
        }
    elseif (substr($a,4,2) != substr($b,4,2))
        {
            return strcmp(substr($a,4,2), substr($b,4,2));
        }
    else
        {
            return strcmp(substr($a,6,2), substr($b,6,2));
        }
}

function Newsletters($Year = "")
{
    $newsletters = glob("$_SERVER[DOCUMENT_ROOT]/museum/newsletters/$Year" . "[0-9]*.pdf");
    if (! $newsletters) { return; }
    usort($newsletters, "cmp");
   
    $pyear = 0;
    foreach ($newsletters as $newsletter)
        {
            $file = basename($newsletter);
            $year = substr($file, 0, 4);
            if ($year != $pyear)
                {
                    if ($pyear != 0)
                        {
                            echo "  </ul>\n";
                            echo " </td>\n";
                            for ($i=$column; $i<4; $i++) { echo " <td>\n </td>\n"; }
                            echo "</tr>\n";
                            echo "</table></div>\n";
                        }
	  
                    if ($Year) { printf("<h2>Newsletters</h2>\n"); }
                    else { printf("<h2>%d</h2>\n", $year); }
                    echo "<div class=\"table-responsive\"><table border=0 width=100%>\n";
                    echo "<tr>\n";
                    echo " <td valign=top width=25%>\n";
                    echo "  <ul>\n";
                    $ncount = 1;
                    $column = 1;
                    $pyear = $year;
                }
      
            $date = date("F", strtotime(substr($file, 0, 6)."01"));
            $preview = str_replace(".pdf", ".gif", $file);
            $issue = str_replace(".pdf", "", $file);
            $title = urlencode($date . " " . $year);
            echo "   <li><a href=/museum/newsletters/issue.php?issue=$issue&title=$title class=\"thickbox\">$date</a>";
            if (substr($file, 6, 2) == "ra") { echo "*"; }

            echo "\n";

            if ($ncount % 4 == 0)
                {
                    echo "  </ul>\n";
                    echo " </td>\n";
                    echo " <td valign=top width=25%>\n";
                    echo "  <ul>\n";
                    $column++;
                }
            $ncount++;
        }

    echo "  </ul>\n";
    echo " </td>\n";
    for ($i=$column; $i<4; $i++) { echo " <td>\n </td>\n"; }
    echo "</tr>\n";
    echo "</table></div>\n";
}

function RecentAshlars()
{
    $ashlars = glob("$_SERVER[DOCUMENT_ROOT]/museum/newsletters/[0-9]*.pdf");
    rsort($ashlars);
  
    echo "\n<table border= width=100%>\n";
    echo "<tr>\n";
    echo " <td nowrap valign=top width=33%>\n";
    echo "  <ul>\n";
    $count = 0;
    $column = 0;

    foreach ($ashlars as $m)
        {
            $file = basename($m);
            $year = substr($file, 0, 4);
            $date = date("F 'y", strtotime(substr($file, 0, 6)."01"));

            if (($count > 0) & ($count % 6 == 0))
                {
                    echo "  </ul>\n";
                    echo " </td>\n";
                    echo " <td nowrap valign=top width=33%>\n";
                    echo "  <ul>\n";
                    $column++;
                }
            $issue = str_replace(".pdf", "", $file);
            $title = urlencode($date . " " . $year);
            echo "   <li><a href=/museum/newsletters/issue.php?issue=$issue&title=$title class=\"thickbox\">$date</a>\n";

            if (++$count >= 12) { break; }
        }

    echo "  </ul>\n";
    echo " </td>\n";
    echo "</tr>\n";
    echo "</table>\n";
}

function RecentAshlarsSlider()
{
    $ashlars = glob("$_SERVER[DOCUMENT_ROOT]/museum/newsletters/[0-9]*.pdf");
    rsort($ashlars);
  
    echo "  <ul class=\"bxslider\">\n";
    $count = 0;
    $column = 0;

    foreach ($ashlars as $m)
        {
            $file = basename($m);
            $year = substr($file, 0, 4);
            $date = date("F 'y", strtotime(substr($file, 0, 6)."01"));
            $issue = str_replace(".pdf", "", $file);
            $title = urlencode($date);

            echo "   <li><a href=/museum/newsletters/${file} target=\"_blank\"><img src=/deanimate/${issue}.gif title=\"$date\" /></a>\n";
            if (++$count >= 12) { break; }
        }

    echo "  </ul>\n";
}

function CalendarListView($Limit = 999)
{
    global $sqlitedb;
    
    $sql  = "SELECT StartDateTime, EndTime, Description, Location, Category FROM calendar ";
    $sql .= "WHERE StartDateTime>strftime('%Y-%m-%d %H:00','now','" . date("P") . "') ORDER BY StartDateTime LIMIT $Limit";
    $results = $sqlitedb->query($sql);

    $PrevMonthString = "";
    $PrevYearString = "";
    $EventNumber = 1;

    while ($row = $results->fetchArray(SQLITE3_ASSOC))
        {
            $StartTime = TimeString($row['StartDateTime']);
            if (! isset($EndTime)) { $EndDateAndTime = date("YmdHi", strtotime($row['StartDateTime']) + (2 * 60 * 60)); }
            else { $EndDateAndTime = substr($row['StartDateTime'],0,8).$row['EndTime']; }
            $EndTime = TimeString($EndDateAndTime);

            $MonthString = date("F", strtotime($row['StartDateTime']));
            $YearString = date("Y", strtotime($row['StartDateTime']));

            if (($YearString != $PrevYearString) && ($Limit == 999)) { echo "<tr><td colspan=3 align=center><h2>$YearString</h2></td></tr>"; $PrevYearString = $YearString; }

            $Style = $row['Category'];
            if ($row['Location']) { $Style = "elsewhere"; }

            echo "<tr>";
            echo "<td valign=top><b>";
            if ($MonthString != $PrevMonthString) { echo $MonthString; $PrevMonthString = $MonthString; }
            echo "&nbsp;&nbsp;</b></td>";
            echo "<td align=right valign=top>" . date("j", strtotime($row['StartDateTime'])) . "&nbsp;&nbsp;</td>";
            echo "<td valign=top class=\"$Style\">$row[Description]";
            
            $EndDateAndTime = substr($row['StartDateTime'],0,11).$row['EndTime'];

            // no minutes needed
            if (date("i", strtotime($row['StartDateTime'])) != '00') { $fmtString = ", g:i"; } else { $fmtString = ", g"; }
            echo date($fmtString, strtotime($row['StartDateTime']));
            
            // show AM/PM for start time when:
            // less than 2 hours (no end time shown)
            // beginning and end time during different AM/PM (regardless of duration)
            if ((strtotime($EndDateAndTime)-strtotime($row['StartDateTime']) <= (2 * 60 * 60)) ||
            (date("A", strtotime($row['StartDateTime'])) != date("A", strtotime($EndDateAndTime))))
                {
                    echo date('A', strtotime($row['StartDateTime']));
                }
            
            // duration over 2 hours, show end time
            if (strtotime($EndDateAndTime)-strtotime($row['StartDateTime']) > (2 * 60 * 60)) {
                if (date("i", strtotime($EndDateAndTime)) != '00') { $fmtString = "-g:iA"; } else { $fmtString = "-gA"; }
                echo date($fmtString, strtotime($EndDateAndTime));
            }

            if ($row['Location']) { echo " (at " . $row['Location'] . ")"; }

            if (strtotime(substr($row['StartDateTime'],0,10)) - mktime(0,0,0) == 0) { echo " <b><i><font color=red>Today!</font></i></b>"; }
            if (strtotime(substr($row['StartDateTime'],0,10)) - mktime(0,0,0) == 86400) { echo " <b><i><font color=red>Tomorrow!</font></i></b>"; }
            echo "</td>";
            echo "</tr>\n";
        }
}

function ThisWeek($Limit = 999)
{
    global $sqlitedb;
    
    $sql  = "SELECT StartDateTime, EndTime, Description, Location FROM calendar ";
    $sql .= "WHERE StartDateTime>strftime('%Y-%m-%d %H:00','now','" . date("P") . "') ORDER BY StartDateTime LIMIT $Limit";
    $results = $sqlitedb->query($sql);

    $PrevMonthString = "";
    $PrevYearString = "";
    $EventNumber = 1;

    while ($row = $results->fetchArray(SQLITE3_ASSOC))
        {
            $StartTime = TimeString($row['StartDateTime']);
            $EndDateAndTime = substr($row['StartDateTime'],0,11).$row['EndTime'];
            $EndTime = TimeString($EndDateAndTime);

            $Description = $row['Description'];
            $Style = $row['Style'];
            if ($row['Location']) { $Style = "elsewhere"; }
            if ($Style == 'memorial') { $Description .= " passed to the Celestial Lodge"; }

            echo "<tr>";
            echo "<td valign=top nowrap style=\"padding-right:10px\">";

            // less than 2 hours: 7PM 'gA'
            // start and end during same period: 7-9PM 'g-gA'
            // start and end during diff period: 7AM-1PM 'gA-gA'
            echo date("l", strtotime($row['StartDateTime']));
            if ($Style != 'holiday')
                {
                    // no minutes needed
                    if (date("i", strtotime($row['StartDateTime'])) != '00') { $fmtString = ", g:i"; } else { $fmtString = ", g"; }
                    echo date($fmtString, strtotime($row['StartDateTime']));

                    // show AM/PM for start time when:
                    // less than 2 hours (no end time shown)
                    // beginning and end time during different AM/PM (regardless of duration)
                    if ((strtotime($EndDateAndTime)-strtotime($row['StartDateTime']) <= (2 * 60 * 60)) ||
                    (date("A", strtotime($row['StartDateTime'])) != date("A", strtotime($EndDateAndTime))))
                    {
                        echo date('A', strtotime($row['StartDateTime']));
                    }

                    // duration over 2 hours, show end time
                    if (strtotime($EndDateAndTime)-strtotime($row['StartDateTime']) > (2 * 60 * 60)) {
                        if (date("i", strtotime($EndDateAndTime)) != '00') { $fmtString = "-g:iA"; } else { $fmtString = "-gA"; }
                        echo date($fmtString, strtotime($EndDateAndTime));
                    }

                }
            echo "</td>";
            
            echo "<td valign=top class=\"$Style\">$Description";
            if ($row['Location']) { echo " (at " . $row['Location'] . ")"; }

            if (strtotime(substr($row['StartDateTime'],0,10)) - mktime(0,0,0) == 0) { echo " <b><i><font color=red>Today!</font></i></b>"; }
            if (strtotime(substr($row['StartDateTime'],0,10)) - mktime(0,0,0) == 86400) { echo " <b><i><font color=red>Tomorrow!</font></i></b>"; }
            echo "</td>";
            echo "</tr>\n";
        }
}

function TimeString($S)
{
    if (intval(date("i",  strtotime($S)))) { $T = date("g:iA", strtotime($S)); }
    else { $T = date("gA", strtotime($S)); }
    return $T;
}

function LodgeOfficers()
{
    global $sqlitedb;
    
    $results = $sqlitedb->query('SELECT Title, Email, Name, Phone FROM officers ORDER BY Rank');
    
    echo "<table width=100%>\n";
    while ($row = $results->fetchArray(SQLITE3_ASSOC))
        {
            echo "<tr><td valign=top>" . $row['Title'] . "</td>";
            echo "<td valign=top>";
            if ($row['Email']) { echo "<a href=\"mailto:" . $row['Email'] . "\">"; }
            echo $row['Name'];
            if ($row['Email']) { echo "</a>"; }
            echo "</td>";
            echo "<td valign=top align=right nowrap>" . $row['Phone'] . "</td></tr>\n";
        }
    echo "</table>\n";
}

function MajorEvents($year="", $anchor=false)
{
    global $sqlitedb;

    if ($year == "") { $year = date("Y"); }
    $sql  = "SELECT StartDateTime, EndTime, Description, Location FROM calendar ";
    $sql .= "WHERE StartDateTime LIKE \"$year-%\" AND Category=\"major\" ORDER BY StartDateTime";
    $results = $sqlitedb->query($sql);

    $PrevMonthString = "";
    while ($row = $results->fetchArray(SQLITE3_ASSOC))
        {
            $StartTime = TimeString($row['StartDateTime']);
            $EndDateAndTime = substr($row['StartDateTime'],0,11).$row['EndTime'];
            $EndTime = TimeString($EndDateAndTime);
      
            $MonthString = date("F", strtotime($row['StartDateTime']));

            $bgcolor = "#FFFFFF";
            if ($MonthString == date("F") && date("Y") == date("Y", strtotime($row['StartDateTime'])))
                { $bgcolor="#E0E0E0"; $bgcolor="#DBE8F4"; }

            echo "<tr bgcolor=$bgcolor>";
            echo "<td valign=top";
            if ($anchor && ($MonthString != $PrevMonthString)) { echo " id=\"$MonthString\""; }
            echo "><b>";
            if ($MonthString != $PrevMonthString) {
                echo $MonthString;
                $PrevMonthString = $MonthString;
            }
            echo "</b>&nbsp;&nbsp;</td>";
            echo "<td align=right valign=top>" . date("j", strtotime($row['StartDateTime'])) . "&nbsp;&nbsp;</td>";
            echo "<td valign=top>$row[Description]";

            $EndDateAndTime = substr($row['StartDateTime'],0,11).$row['EndTime'];

            // no minutes needed
            if (date("i", strtotime($row['StartDateTime'])) != '00') { $fmtString = ", g:i"; } else { $fmtString = ", g"; }
            echo date($fmtString, strtotime($row['StartDateTime']));
            
            // show AM/PM for start time when:
            // less than 2 hours (no end time shown)
            // beginning and end time during different AM/PM (regardless of duration)
            if ((strtotime($EndDateAndTime)-strtotime($row['StartDateTime']) <= (2 * 60 * 60)) ||
            (date("A", strtotime($row['StartDateTime'])) != date("A", strtotime($EndDateAndTime))))
                {
                    echo date('A', strtotime($row['StartDateTime']));
                }
            
            // duration over 2 hours, show end time
            if (strtotime($EndDateAndTime)-strtotime($row['StartDateTime']) > (2 * 60 * 60)) {
                if (date("i", strtotime($EndDateAndTime)) != '00') { $fmtString = "-g:iA"; } else { $fmtString = "-gA"; }
                echo date($fmtString, strtotime($EndDateAndTime));
            }
            
            if ($row['Location']) { echo " (at " . $row['Location'] . ")"; }

            if (strtotime(substr($StartDateAndTime,0,10)) - mktime(0,0,0) == 0) { echo " <b><i><font color=red>Today!<font></i></b>"; }
            if (strtotime(substr($StartDateAndTime,0,10)) - mktime(0,0,0) == 86400) { echo " <b><i><font color=red>Tomorrow!</font></i></b>"; }
            echo "</td>";
            echo "</tr>\n";
        }
}

function LodgeOfSorrow($Year)
{
    global $sqlitedb, $cnf_annualStated;

    //$start = strtotime("second tuesday", mktime(0, 0, 0, 12, 1, $Year-1));
    //$end = strtotime("second tuesday", mktime(0, 0, 0, 12, 1, $Year));
    $start = strtotime("$cnf_annualStated" . intval($Year-1));
    $end = strtotime("$cnf_annualStated" . intval($Year));
      
    // $sql = "SELECT Date, Name, Titles FROM memorial WHERE Date>strftime(\"%Y-%m-%d\", datetime($start, 'unixepoch')) AND Date<=strftime(\"%Y-%m-%d\", datetime($end, 'unixepoch')) ORDER BY Date";
    $sql = "SELECT Date, Name, Titles FROM memorial WHERE Date>'" . date('Y-m-d', $start) . "' AND Date<='" . date('Y-m-d', $end) . "' ORDER BY Date";
    
    $results = $sqlitedb->query($sql);

    $GotOne = false;
    while ($row = $results->fetchArray(SQLITE3_ASSOC))
        {
            $Date = $row['Date'];
            $Name = $row['Name'];
            $Title = $row['Titles'];
            
            $died = strtotime($Date);
            if (! $GotOne) { echo "<h2>Lodge Of Sorrow</h2>\n<ul>\n"; $GotOne = true; }
            echo "<li>";
            echo "$Name - ";
            echo date("m/d/Y", strtotime($Date));
            echo "\n";

        }
    if ($GotOne) { echo "</ul>\n"; }
}

function loadOfficers()
{
    global $officerArray;
    global $sqlitedb;
    
    $officerArray = array();
    $results = $sqlitedb->query('SELECT Title, Email, Name, Phone FROM officers');
    
    while ($row = $results->fetchArray(SQLITE3_ASSOC))
        {
            $officerArray[$row['Title']] = array(
                "Title" => $row['Title'],
                "EmailAddress" => $row['Email'],
                "Name" => $row['Name'],
                "Phone" => $row['Phone'],
                "Image" => str_replace(' ', '', $row['Title']));
        }
}

function GetTopMenu($m)
{
    $items = file("$_SERVER[DOCUMENT_ROOT]/inc/$m", FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES);
    foreach ($items as $item)
        {
            $item = preg_replace("/ class=\".*\"/", '', $item);
            echo "            <li class=\"visible-xs\">$item</li>\n";
        }
}

?>
