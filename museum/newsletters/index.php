<!-- -*- mode: html -*- -->
<!DOCTYPE html>
<?
   $ashlars = glob("$_SERVER[DOCUMENT_ROOT]/museum/newsletters/[0-9]*.pdf");
   rsort($ashlars);
   $file = basename($ashlars[0]);
   $image = str_replace(".pdf", ".gif", $file);
   $year = substr($file, 0, 4);
   $date = date("F Y", strtotime(substr($file, 0, 6)."01"));
   ?>
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:og="http://ogp.me/ns#"
      xmlns:fb="http://www.facebook.com/2008/fbml">
  <head>
    <title>Newsletter Archive - Kempsville Lodge No. 196</title>
    <link rel="stylesheet" href="/css/stylesheet.css" type="text/css" />
    <link rel="stylesheet" href="/css/stylesheet.css" type="text/css" />
    <link rel="image_src" type="image/gif" href=/cgi-bin/deanimate" />

    <meta property="og:url" content="http://kempsvillelodge.org/museum/newsletters/" />
    <meta property="og:site_name" content="Kempsville Lodge No. 196" />
    <meta property="og:title" content="The Ashlar - <?= $date ?>" />
    <meta property="og:description" content="The monthly newsletter of Kempsville Lodge No. 196" />
    <meta property="og:image:width" content="300" />
    <meta property="og:image:height" content="300" />
    <meta property="og:image:type" content="image/jpeg" />
    <meta property="og:image" content="http://kempsvillelodge.org/cgi-bin/deanimate/<?= $image ?>?x=<? echo filemtime("previews/$image") ?>">
    <!-- meta property="og:image" content="http://kempsvillelodge.org/museum/newsletters/previews/<?= $image ?>?x=<? echo filemtime("previews/$image") ?>" -->

    <!-- use https://developers.facebook.com/tools/debug/og/object/ to debug and force re-scrape -->

    <? include "../../header.html"; ?>
  </head>
  <body>

    <h1>Current Issue: <?= $date ?></h1>
    <div class="visible-sm visible-xs">
      <a href="<?= $file ?>" target=_blank>
	<p align=center><img src="previews/<?= $image ?>" class="img-responsive photo-wrapper"><br/>
	  (click above to view PDF)</p></a>
    </div>
    <div class="visible-md visible-lg">
      <a href="<?= $file ?>" target=_blank>
	<p align=center><img src="/cgi-bin/gif2strip.php?p=<?= $image ?>" class="img-responsive photo-wrapper" /><br/>
	  (click above to view PDF)</p></a>
    </div>

    <h1>Newsletter Archive</h1>
    <? Newsletters(); ?>

    <? include "footer.php"; ?>
  </body>
</html>
