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

	<h1>2017</h1>
	<? GetBiography("2017"); ?>
	
	<h2>Lodge Officers</h2>
	<? ImageResponsive('/photos/2017-Officers.jpg'); ?>
	<span class="courtesyof">Photo courtesy of Right Worshipful Emmett "Buddy" Pate</span><br/>
	left to right<br/>
	<table>
	  <tr>
	    <td>
	      <ol>
		<li>John Doe - Tiler</li>
		<li>John Doe - Treasurer</li>
		<li>John Doe - Junior Deacon</li>
		<li>John Doe - Senior Warden</li>
		<li>John Doe - Marshal</li>
		<li>John Doe - Senior Deacon</li>
	      </ol>
	    </td>
	    <td>
	      <ol start=7>
		<li>John Doe - Worshipful Master</li>
		<li>John Doe - Chaplain</li>
		<li>John Doe - Musician</li>
		<li>John Doe - Junior Warden</li>
		<li>John Doe - Senior Steward</li>
		<li>John Doe - Secretary</li>
	      </ol>
	    </td>
	  </tr>
	</table>
	<? EndImage(); ?>

	<? LodgeOfSorrow("2017"); ?>
	
	<? Newsletters("2017"); ?>
      </div>
    </div>
    <? include "$_SERVER[DOCUMENT_ROOT]/inc/footer.php"; ?>
  </body>
</html>
