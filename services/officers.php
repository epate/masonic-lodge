<?php // -*- mode: php -*-
date_default_timezone_set("America/New_York");
include "$_SERVER[DOCUMENT_ROOT]/inc/config.inc";
$sqlitedb = new SQLite3("$_SERVER[DOCUMENT_ROOT]/data/$cnf_database");

$results = $sqlitedb->query('SELECT Title, Email, Name, Phone FROM officers ORDER BY Rank');

$officerArray = array();
while ($row = $results->fetchArray(SQLITE3_ASSOC))
    {
        $officerArray[] = $row;
    }
header('Content-Type: application/json');
echo json_encode($officerArray);

?>
