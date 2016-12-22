<?php // -*- mode: php -*-

date_default_timezone_set("America/New_York");
$sqlitedb = new SQLite3("$_SERVER[DOCUMENT_ROOT]/data/database.db");

$results = $sqlitedb->query('SELECT Title, Email, Name, Phone FROM officers ORDER BY Rank');

$officerArray = array();
while ($row = $results->fetchArray(SQLITE3_ASSOC))
    {
        $officerArray[] = $row;
    }
header('Content-Type: application/json');
echo json_encode($officerArray);

?>
