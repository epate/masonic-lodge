<!-- -*- mode: html -*- -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<?php set_include_path(".:/usr/local/lib/php:$_SERVER[DOCUMENT_ROOT]"); ?>
<html lang="en">
  <head>
    <title>Masonry in General - Kempsville Lodge No. 196</title>
    <link rel="stylesheet" href="/css/stylesheet.css" type="text/css"></link>
    <? include "header.html"; ?>
  </head>
  <body>

    <div class="row">
      <div class="col-md-12">

	<h1>Masonry in General</h1>
	
	<h2>English Masonic Watch Fob</h2>
	<? ImageResponsive('/museum/general/General-WatchFob1.jpg'); ?>
	English Opening Ball or Orb Masonic Watch Fob. Measures approximately 3/4 inches in diameter when closed.
	<? EndImage(); ?>
	<? ImageResponsive('General-WatchFob2.jpg'); ?><? EndImage(); ?>
	<? ImageResponsive('General-WatchFob3.jpg'); ?>
	Measures approximate 1 3/4 inches by 1 1/4 inches when open.
	Provided by Right Worshipful Bill Knowles.
	<? EndImage(); ?>
	
      </div>
    </div>

    <? include "footer.php"; ?>
    <link rel="stylesheet" href="/js/jquery-ui-themes-1.9.2/themes/base/jquery-ui.css" />
    <script src="/js/jquery-ui-1.9.2.custom/js/jquery-ui-1.9.2.custom.min.js"></script>
    <script>
      $(document).ready(function() {
      $("#tabs").tabs();
      $("#platemap1 area").colorbox();
      $("#platemap2 area").colorbox();
      });
    </script>
  </body>
</html>
