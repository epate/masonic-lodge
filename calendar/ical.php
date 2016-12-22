<?php
date_default_timezone_set('America/New_York');

$sqlitedb = new SQLite3('/home/epate/public_html/kempsvillelodge.org/data/kempsville.db');

$start = 0; $end = 9999999999;
if (array_key_exists('start', $_REQUEST)) { $start = $_REQUEST['start']; }
if (array_key_exists('end', $_REQUEST)) { $end = $_REQUEST['end']; }

$sql  = "SELECT StartDateTime, EndTime, Description, Location, Category FROM calendar ";
$sql .= "WHERE StartDateTime>strftime(\"%Y-%m-%d\", datetime($start, 'unixepoch')) AND StartDateTime<=strftime(\"%Y-%m-%d\", datetime($end, 'unixepoch')) ";
$sql .= "ORDER BY StartDateTime";
$results = $sqlitedb->query($sql);

if (0) { print "<pre>\n"; }
else
  {
    print header("Pragma: public");
    print header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    print header("Expires: 0");
    print header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    print header("Cache-Control: no-store, no-cache, private, must-revalidate");
    print header('Content-type: text/calendar; charset=utf-8');
    print header('Content-Disposition: inline; filename="calendar.ics"');
    print header("Cache-Control: post-check=0, pre-check=0", false);
    print header('Content-Transfer-Encoding: none');
    print header("Pragma: no-cache");
  }

printf("BEGIN:VCALENDAR\n");
printf("VERSION:2.0\n");
printf("BEGIN:VTIMEZONE\n");
printf("TZID:US/Eastern\n");
printf("BEGIN:DAYLIGHT\n");
printf("DTSTART:20070311T020000\n");
printf("RRULE:FREQ=YEARLY;BYDAY=2SU;BYMONTH=3\n");
printf("TZNAME:EDT\n");
printf("TZOFFSETFROM:-0500\n");
printf("TZOFFSETTO:-0400\n");
printf("END:DAYLIGHT\n");
printf("BEGIN:STANDARD\n");
printf("DTSTART:20071104T020000\n");
printf("RRULE:FREQ=YEARLY;BYDAY=1SU;BYMONTH=11\n");
printf("TZNAME:EST\n");
printf("TZOFFSETFROM:-0400\n");
printf("TZOFFSETTO:-0500\n");
printf("END:STANDARD\n");
printf("END:VTIMEZONE\n");

while ($row = $results->fetchArray(SQLITE3_ASSOC))
{
    $StartDateAndTime = $row[StartDateTime];
    $Description = $row[Description];
    $EndTime = $row[EndTime];
    $Location = $row[Location];

    if (! $Location) { $Location = "Kempsville Lodge No. 196"; }
    $EndDateAndTime = substr($StartDateAndTime,0,10).$EndTime;
    
    if ((strtotime($StartDateAndTime) >= $start) && (strtotime($StartDateAndTime) <= $end))
        {
            printf("BEGIN:VEVENT\n");
            // printf("DTSTART;VALUE=DATE:%s\n", date('Ymd', strtotime($StartDateAndTime)));
            // printf("DTEND;VALUE=DATE:%s\n", date('Ymd', strtotime($EndDateAndTime)));
            printf("DTSTART;TZID=US/Eastern:%s\n", date('Ymd\THis', strtotime($StartDateAndTime)));
            printf("DTEND;TZID=US/Eastern:%s\n", date('Ymd\THis', strtotime($EndDateAndTime)));
            printf("SUMMARY:$Description\n");
            printf("LOCATION:$Location\n");
            printf("END:VEVENT\n");
        }
}
printf("END:VCALENDAR\n");
?>
