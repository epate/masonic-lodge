<!-- -*- mode: html -*- -->
<!DOCTYPE html>
<?php set_include_path(".:/usr/local/lib/php:$_SERVER[DOCUMENT_ROOT]"); ?>
<html lang="en">
  <head>
    <link rel="stylesheet" href="/css/stylesheet.css" type="text/css" />
    <? include "$_SERVER[DOCUMENT_ROOT]/inc/header.html"; ?>
    <title>History - <?= $cnf_lodgeNameNumber ?></title>
  </head>
  <body>

    <h2>The History of <?= $cnf_lodgeNameNumber ?></h2>

    Our lodge history goes here...
    
      <? include "$_SERVER[DOCUMENT_ROOT]/inc/footer.php"; ?>

  </body>
</html>
