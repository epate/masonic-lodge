<!-- -*- mode: html -*- -->
<?php set_include_path(".:/usr/local/lib/php:$_SERVER[DOCUMENT_ROOT]"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html lang="en">
  <head>
    <title>Kempsville Lodge No. 196 - 2017</title>
    <link rel="stylesheet" href="/css/stylesheet.css" type="text/css"></link>
    <? include "header.html"; ?>
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
		<li>Ray Baez - Tiler</li>
		<li>Bill Nelligar - Treasurer</li>
		<li>John Settle, III - Junior Deacon</li>
		<li>Chris Anders - Senior Warden</li>
		<li>Dickie Cooper - Marshal</li>
		<li>Dave Trzeciakiewicz - Senior Deacon</li>
	      </ol>
	    </td>
	    <td>
	      <ol start=7>
		<li>Greg Muir - Worshipful Master</li>
		<li>Mike Denning - Chaplain</li>
		<li>Scott Foxwell - Musician</li>
		<li>Roger Taylor - Junior Warden</li>
		<li>Dennis Eaton - Senior Steward</li>
		<li>Bob Stanek - Secretary</li>
		<li>Todd Moissett - Junior Steward (not shown)</li>
	      </ol>
	    </td>
	  </tr>
	</table>
	<? EndImage(); ?>

	<? LodgeOfSorrow("2017"); ?>
	
	<? Newsletters("2017"); ?>
      </div>
    </div>
    <? include "footer.php"; ?>
  </body>
</html>
