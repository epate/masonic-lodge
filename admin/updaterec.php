<?php
date_default_timezone_set('America/New_York');
$sqlitedb = new SQLite3($_SERVER[DOCUMENT_ROOT] . "/data/database.db");
//error_log('updaterec.php');
$rowid = $_POST['rowid'];
$table = $_POST['table'];

// update record
if ($rowid)
    {
        foreach ($_POST as $param_name => $param_val)
            {
                if ($param_name == 'rowid') { continue; }
                if ($param_name == 'table') { continue; }
                $sql = '';
                
                if ($param_name == 'deleteEvent') {
                    $sql = "DELETE FROM $table where rowid=$rowid";
                }
                else {
                    if ($_POST['deleteEvent'] != 'on') { $sql = "UPDATE $table SET $param_name=\"$param_val\" where rowid=$rowid"; }
                }
                if ($sql) {
                    $sqlitedb->exec($sql);
                    //error_log("$sql");
                }
            }
    }
// insert record
else
    {
        $sql = "INSERT INTO $table ";
        $fields = "(";
        $values = "(";
        foreach ($_POST as $param_name => $param_val)
            {
                if ($param_name == 'rowid') { continue; }
                if ($param_name == 'table') { continue; }

                $fields .= "$param_name, ";
                $values .= "'" . $param_val . "', ";

            }
        $fields = rtrim($fields, ", ");
        $values = rtrim($values, ", ");
        $sql .= "$fields) VALUES $values)";
        $sqlitedb->exec($sql);
        //error_log($sql);
    }
?>
