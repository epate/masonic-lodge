<!-- -*- mode: html -*- -->
<!DOCTYPE html>
<?
   $newsletters = glob("$_SERVER[DOCUMENT_ROOT]/museum/newsletters/[0-9]*.pdf");
   rsort($newsletters);
   $file = basename($newsletters[0]);
   $image = str_replace(".pdf", ".gif", $file);
   $year = substr($file, 0, 4);
   $date = date("F Y", strtotime(substr($file, 0, 6)."01"));
?>
<html>
  <head>
    <link rel="stylesheet" href=../../css/stylesheet.css" type="text/css" />
    <? include "../../inc/header.html"; ?>
    <title>Newsletter Archive - <?= $cnf_lodgeNameNumber ?></title>
    <link rel="image_src" type="image/gif" href=/cgi-bin/deanimate" />
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

    <? include "../../inc/footer.php"; ?>
  </body>
</html>
