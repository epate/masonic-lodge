<?php
include __DIR__ . "/../inc/config.inc";
date_default_timezone_set('America/New_York');

$start = 0; $end = 9999999999;
if (array_key_exists('start', $_REQUEST)) { $start = $_REQUEST['start']; }
if (array_key_exists('end', $_REQUEST)) { $end = $_REQUEST['end']; }

$sqlitedb = new SQLite3(__DIR__ . "/../data/$cnf_database");

$sql  = "SELECT StartDateTime, EndTime, Description, Location, Category FROM calendar ";
$sql .= "WHERE StartDateTime>strftime(\"$start\") AND StartDateTime<=strftime(\"$end\") UNION ALL ";
$sql .= "SELECT Date AS StartDateTime, '' AS EndTime, Name AS Description, '' AS Location, 'memorial' AS Category FROM memorial WHERE Date>strftime(\"$start\") AND Date<=strftime(\"$end\") ";
$sql .= "ORDER BY StartDateTime";
$results = $sqlitedb->query($sql);

$cal = array();
$i = 0;
while ($row = $results->fetchArray(SQLITE3_ASSOC))
{
    $StartDateAndTime = $row['StartDateTime'];
    $Description = $row['Description'];
    $EndTime = $row['EndTime'];
    $Location = $row['Location'];
    $Category = $row['Category'];

    $EndDateAndTime = substr($StartDateAndTime,0,10).$EndTime;
    if ($Location) { $Description .= " (at $Location)"; $Category = "elsewhere"; }
    
    if ($Category == 'memorial') { $Description .= " passed to the Celestial Lodge"; }
    $cal[] = array(
        'id' => $i++,
        'title' => "$Description",
        'description' => "$Description",
        'allDay' => ($Category=='memorial'||date('H', strtotime($StartDateAndTime))=='00')?true:false,
        'start' => date('Y-m-d\TH:i:s', strtotime($StartDateAndTime)),
        'end' => date('Y-m-d\TH:i:s', strtotime($EndDateAndTime)),
        'className' => "$Category",
    );
}
echo json_encode($cal);
?>
