<!-- -*- mode: html -*- -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<?php set_include_path(".:/usr/local/lib/php:$_SERVER[DOCUMENT_ROOT]"); ?>
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:og="http://ogp.me/ns#"
      xmlns:fb="http://www.facebook.com/2008/fbml">
  <head>
    <link rel="stylesheet" href="/css/stylesheet.css" type="text/css">
    <!-- use https://developers.facebook.com/tools/debug/og/object/ to debug and force re-scrape -->
    <? include __DIR__ . "/../inc/header.html"; ?>
    <title>Virtual Museum - <?= $cnf_lodgeNameNumber ?></title>
    <meta property="og:url" content="http://<?= $_SERVER[SERVER_NAME] ?>/museum/" />
    <meta property="og:site_name" content="<?= $cnf_lodgeNameNumber ?>" />
    <meta property="og:title" content="<?= $cnf_lodgeName ?> Virtual Museum" />
    <meta property="og:description" content="Take a virtual stroll down memory lane and enjoy hundreds of old photos, newsletters, lodge memorabilia, and more." />
  </head>
  <body>
    
    <style>
      h2 { margin-top: 0px; }
    </style>

    <h1>The Virtual Museum</h1>
    <p>Take a virtual stroll down memory lane and enjoy over
      <?= NumberOfPhotos(); ?> old photos, newsletters, lodge memorabilia, and more.</p>

    <div class="row">
      <div class="col-sm-12">
	<h2>Through the Years</h2>
        <? GetYears("pastmasters", true); ?>
      </div>
    </div>
    
    <div class="row">
      <div class="col-sm-12">
	<h2>Other Exhibits</h2>
	<ul>
	  <li><a href="/years/">Past Masters Gallery</a></li>
	  <li><a href="/museum/newsletters/">Newsletter Archive</a></li>
	</ul>
	<h2>Virtual Plaques</h2>
	<ul>
	  <li><a href="/memorial/">In Memoriam</a></li>
	  <li><a href="/moty/">Mason of the Year Recipients</a></li>
	  <li><a href="/veterans/">Masonic Veterans</a></li>
	  <li><a href="/lmip/">Life Members in Perpetuity</a></li>
	  <li><a href="/awards/">Lodge Awards and Recognition</a></li>
	</ul>

      </div>
    </div>
    <? include __DIR__ . "/../inc/footer.php"; ?>
  </body>
</html>

<?
   function GetYears($table, $ylink)
    {
      global $sqlitedb;
      
      $results = $sqlitedb->query("SELECT Year, Name, Photo, Biography FROM $table ORDER BY Year");
      echo "<ul>\n";
      while ($row = $results->fetchArray(SQLITE3_ASSOC))
        {
	  if ($ylink && file_exists(__DIR__ . "/../years/" . $row[Year] . ".php"))
	    {
	      echo "<a href=\"/years/$row[Year].php\" />";
	      $anchor = true;
	    }
	  else
	    {
	      echo "<a href=\"/years/$row[Year]\" />";
	    }
	  echo "<li>$row[Year]: $row[Name]</li>";
	  if ($anchor) { echo "</a>"; }
        }
      echo "</ul>\n";
    }
?>
