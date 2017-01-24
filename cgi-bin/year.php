<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html lang="en">
<head>
<link rel="stylesheet" href="/css/stylesheet.css" type="text/css"></link>
<? include __DIR__ . "/../inc/header.html"; ?>
<title><?= $cnf_lodgeNameNumber ?> - 2017</title>
</head>
<body>
<div class="row">
<div class="col-md-12">

<?php
   echo "<h1>" . $_GET['y'] . "</h1>";
GetBiography($_GET['y']);

GetTimeline($_GET['y']);

LodgeOfSorrow($_GET['y']);
Newsletters($_GET['y']);
?>

</div>
</div>
<? include __DIR__ . "/../inc/footer.php"; ?>
</body>
</html>

<?
function GetTimeline($Year)
{
  global $sqlitedb;

  $sql  = "SELECT title, photo, caption, credit FROM years ";
  $sql .= "WHERE year='$Year' ORDER BY placement ASC";
  $results = $sqlitedb->query($sql);

  while ($row = $results->fetchArray(SQLITE3_ASSOC))
    {
      $hasImage = false;
      
      echo "<h2>" . $row['Title'] . "</h2>";
      if (file_exists(__DIR__ . "/../photos/" . $row['Photo']))
	{
	  ImageResponsive('../photos/' . $row['Photo']);
	  if ($row['Credit']) {
	      echo "<span class=\"courtesyof\">Photo courtesy of " . $row['Credit'] . "</span><br/>";
	    }
	  $hasImage = true;
	}
      echo $row['Caption'];
      if ($hasImage) { EndImage(); }
    }
}
?>