<!-- -*- mode: html -*- -->
<?php set_include_path(".:/usr/local/lib/php:$_SERVER[DOCUMENT_ROOT]"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html lang="en">
  <head>
    <link rel="stylesheet" href="/css/stylesheet.css" type="text/css"></link>
    <? include "$_SERVER[DOCUMENT_ROOT]/inc/header.html"; ?>
    <title><?= $cnf_lodgeNameNumber ?> - 2017</title>
  </head>

  <body>
    <div class="row">
      <div class="col-md-12">

	<h1>2005</h1>
	<? GetBiography("2005"); ?>
	
	<? LodgeOfSorrow("2005"); ?>
	
	<? Newsletters("2005"); ?>
      </div>
    </div>
    <? include "$_SERVER[DOCUMENT_ROOT]/inc/footer.php"; ?>
  </body>
</html>
