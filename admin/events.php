<?php
date_default_timezone_set('America/New_York');

//$start = 0; $end = 9999999999;
if (array_key_exists('editday', $_REQUEST)) { $editday = $_REQUEST['editday']; }
if ($editday) { $start = $editday; $end = $editday; }

if (array_key_exists('start', $_REQUEST)) { $start = $_REQUEST['start']; }
if (array_key_exists('end', $_REQUEST)) { $end = $_REQUEST['end']; }
$sqlitedb = new SQLite3($_SERVER[DOCUMENT_ROOT] . "/data/database.db");

$sql  = "SELECT rowid, StartDateTime, EndTime, Description, Location, Category FROM calendar ";
$sql .= "WHERE strftime('%Y-%m-%d',StartDateTime)>=\"$start\" AND strftime('%Y-%m-%d',StartDateTime)<=\"$end\" ";
$sql .= "ORDER BY StartDateTime";
$results = $sqlitedb->query($sql);

if ($editday)
    {
        echo "<form id=\"calForm\" method=\"post\">\n";
        while ($row = $results->fetchArray(SQLITE3_ASSOC))
            {
                $rowid = $row[rowid];
                $StartDateAndTime = $row[StartDateTime];
                $Description = $row[Description];
                $EndTime = $row[EndTime];
                $Location = $row[Location];
                $Category = $row[Category];

                $OpenPanel  = "<a data-toggle=\"collapse\" href=\"#panel$rowid\"><span style=\"font-size: 1.5em\" class=\"glyphicon glyphicon-chevron-down\" aria-hidden=\"true\"></span></a>";
                $ClosePanel = "<a data-toggle=\"collapse\" href=\"#panel$rowid\"><span style=\"font-size: 1.5em\" class=\"glyphicon glyphicon-chevron-up\" aria-hidden=\"true\"></span></a>";

                echo "<script>\n";
                echo "\$(\"#panel$rowid\").on('show.bs.collapse', function () { \$(\"#glyph$rowid\").html('" . $ClosePanel . "'); })\n";
                echo "\$(\"#panel$rowid\").on('hidden.bs.collapse', function () { \$(\"#glyph$rowid\").html('" . $OpenPanel ."'); })\n";
                echo "</script>\n";
                
                echo "<div class=\"form-group well\">\n";
                echo "<div class=\"row\">";
                echo "<div class=\"col-xs-1\" id=\"glyph$rowid\">$OpenPanel</div>";
                echo "<div class=\"col-xs-10\"><input type=\"text\" class=\"form-control\" name=\"Description-$rowid\" value=\"$Description\">";
                echo "</div>\n";
                echo "</div>\n";

                echo "<div class=\"collapse\" id=\"panel$rowid\">\n";
                echo "<div class=\"row\">";
                echo "<div class=\"col-xs-1\">&nbsp;</div>";
                echo "<div class=\"col-xs-6\"><input type=\"text\" class=\"form-control\" name=\"StartDateTime-$rowid\" value=\"$StartDateAndTime\"></div>\n";
                echo "<div class=\"col-xs-4\"><input type=\"text\" class=\"form-control\" name=\"EndTime-$rowid\" value=\"$EndTime\"></div>\n";
                echo "</div>\n";
        
                echo "<div class=\"row\">";
                echo "<div class=\"col-xs-1\">&nbsp;</div>";
                echo "<div class=\"col-xs-10\"><input type=\"text\" class=\"form-control\" name=\"Location-$rowid\" placeholder=\"Location\" value=\"$Location\"></div>\n";
                echo "</div>\n";
                
                echo "<div class=\"row\">";
                echo "<div class=\"col-xs-1\">&nbsp;</div>";
                echo "<div class=\"col-xs-10\">";
                echo "<select class=\"form-control\" name=\"Category-$rowid\">";
                printf("<option value='major' %s>Major Event</option>", $Category=='major'?'selected':'');
                printf("<option value='minor' %s>Minor Event</option>", $Category=='minor'?'selected':'');
                printf("<option value='appendant' %s>Appendant Body Event</option>", $Category=='appendant'?'selected':'');
                printf("<option value='holiday' %s>Holiday</option>", $Category=='holiday'?'selected':'');                
                echo "</select></div>\n";
                echo "</div>\n";

                echo "<div class=\"row\">";
                echo "<div class=\"col-xs-1\">&nbsp;</div>";
                echo "<div class=\"col-xs-10\">";
                echo "<div class=\"checkbox alert alert-danger\"><label><input type=\"checkbox\" name=\"deleteEvent-$rowid\"> Delete Event</label></div>\n";
                echo "</div>\n";
                echo "</div>\n";                
                
                echo "</div>\n";
                echo "</div>\n";
            }
        
        echo "<div class=\"form-group well\">\n";
        echo "<div class=\"row\">";
        echo "<div class=\"col-xs-1\"><span class=\"glyphicon glyphicon-plus\" aria-hidden=\"true\"></span></div>";
        echo "<div class=\"col-xs-10\"><input type=\"text\" class=\"form-control\" name=\"Description-0\" placeholder=\"Description\"></div>\n";
        echo "</div>\n";

        echo "<div class=\"row\">";
        echo "<div class=\"col-xs-1\">&nbsp;</div>";
        echo "<div class=\"col-xs-6\"><input type=\"text\" class=\"form-control\" name=\"StartDateTime-0\" value=\"$editday 19:00\"></div>\n";
        echo "<div class=\"col-xs-4\"><input type=\"text\" class=\"form-control\" name=\"EndTime-0\" value=\"21:00\"></div>\n";
        echo "</div>\n";
        
        echo "<div class=\"row\">";
        echo "<div class=\"col-xs-1\">&nbsp;</div>";
        echo "<div class=\"col-xs-10\"><input type=\"text\" class=\"form-control\" name=\"Location-0\" placeholder=\"Location\"></div>\n";
        echo "</div>\n";
        
        echo "<div class=\"row\">";
        echo "<div class=\"col-xs-1\">&nbsp;</div>";
        echo "<div class=\"col-xs-10\">";
        echo "<select class=\"form-control\" name=\"Category-0\">";
        echo "<option value='major'>Major Event</option>";
        echo "<option value='minor'>Minor Event</option>";
        echo "<option value='appendant'>Appendant Body Event</option>";
        echo "<option value='holiday'>Holiday</option>";
        echo "</select></div>\n";
        echo "</div>\n";
        echo "</div>\n";

        echo "</form>\n";
    }
else
    {
        $cal = array();
        $id = 0;
        while ($row = $results->fetchArray(SQLITE3_ASSOC))
            {
                $StartDateAndTime = $row[StartDateTime];
                $Description = $row[Description];
                $EndTime = $row[EndTime];
                $Location = $row[Location];
                $Category = $row[Category];
                
                $EndDateAndTime = substr($StartDateAndTime,0,10).$EndTime;
                if ($Location) { $Description .= " (at $Location)"; $Category = "elsewhere"; }
                
                if ($Category == 'memorial') { $Description .= " passed to the Celestial Lodge"; }
                $cal[] = array(
                    'id' => $id++,
                    'title' => "$Description",
                    'description' => "$Description",
                    'allDay' => ($Category=='memorial'||$Category=='holiday')?true:false,
                    'start' => date('Y-m-d\TH:i:s', strtotime($StartDateAndTime)),
                    'end' => date('Y-m-d\TH:i:s', strtotime($EndDateAndTime)),
                    'className' => "$Category",
                );
            }
        echo json_encode($cal);
    }
?>
