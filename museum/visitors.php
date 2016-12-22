<!-- -*- mode: html -*- -->
<!DOCTYPE html>
<?php set_include_path(".:/usr/local/lib/php:$_SERVER[DOCUMENT_ROOT]"); ?>
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:og="http://ogp.me/ns#"
      xmlns:fb="http://www.facebook.com/2008/fbml">
  <head>
    <title>Notable Visitors - Kempsville Lodge #196</title>
    <link rel="stylesheet" href="/css/stylesheet.css" type="text/css" />
    <meta property="og:url" content="http://kempsvillelodge.org/museum/visitors.php" />
    <meta property="og:site_name" content="Kempsville Lodge No. 196" />
    <meta property="og:title" content="Notable Visitors to Kempsville Lodge" />
    <meta property="og:image" content="http://kempsvillelodge.org/photos/1967-VisitorCort.jpg" />
    <meta property="og:image" content="http://kempsvillelodge.org/photos/1981-VisitorLockwood.jpg" />
    <meta property="og:image" content="http://kempsvillelodge.org/photos/1999-VisitorJaeger.jpg" />
    <meta property="og:image" content="http://kempsvillelodge.org/photos/1999-VisitorPennybacker.jpg" />
    <meta property="og:description" content="Some notable visitors to Kempsville Lodge" />
    <!-- use https://developers.facebook.com/tools/debug/og/object/ to debug and force re-scrape -->
    <? include "../header.html"; ?>
  </head>
  <body>
    
    <div class="row">
      <div class="col-md-12">

	<h1>Notable Visitors Through the Years</h1>
	<? GetVisitors(); ?>
	
      </div>
    </div>
    <? include "footer.php"; ?>
  </body>
</html>

<?
function GetVisitors()
{
  foreach (glob("../years/????.php") as $filename)
    {
      $url = str_replace("../", "http://kempsvillelodge.org/", $filename);
      $index = file_get_contents("$url");

      if (! preg_match("@<h2>Notable Visitors*</h2>(.*?)<h2>@s", $index, $matches)) { continue; }
      preg_match("@(\d{4})@", $filename, $year);
      echo "<h2><a href=/years/$year[0].php>$year[0]</a></h2>\n";
      echo "$matches[1]";
    }
  return;
}
?>
