<?php
date_default_timezone_set('America/New_York');
include "$_SERVER[DOCUMENT_ROOT]/inc/config.inc";
$sqlitedb = new SQLite3($_SERVER[DOCUMENT_ROOT] . "/data/$cnf_database");
foreach ($_POST as $param_name => $param_val)
    {
        $sql = '';
        list($field_name, $rowid) = explode("-", $param_name);

        if ($rowid) {
            if ($field_name == 'deleteEvent') {
                $sql = "DELETE FROM calendar where rowid=$rowid";
            }
            else {
                if ($_POST['deleteEvent-' . $rowid] != 'on') { $sql = "UPDATE calendar SET $field_name=\"$param_val\" where rowid=$rowid"; }
            }
            if ($sql) {
                $sqlitedb->exec($sql);
                //error_log("$sql");
            }
        }
    }

if ($_POST['Description-0'])
    {
        $Description = $_POST['Description-0'];
        $StartDateTime = $_POST['StartDateTime-0'];
        $EndTime = $_POST['EndTime-0'];
        $Location = $_POST['Location-0'];
        $Category = $_POST['Category-0'];

        if (! $StartDateTime) { $StartDateTime = date('Y-m-d') . " 19:00"; }
        if (! $EndTime) { $EndTime = "21:00"; }
        
        $sql  = "INSERT INTO calendar (Description, StartDateTime, EndTime, Location, Category) ";
        $sql .= "VALUES (\"$Description\", \"$StartDateTime\", \"$EndTime\", \"$Location\", \"$Category\")";
        $sqlitedb->exec($sql);
        // error_log($sql);
    }
?>
