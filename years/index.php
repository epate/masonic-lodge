<!-- -*- mode: html -*- -->
<!DOCTYPE html>
<?php set_include_path(".:/usr/local/lib/php:$_SERVER[DOCUMENT_ROOT]"); ?>
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:og="http://ogp.me/ns#"
      xmlns:fb="http://www.facebook.com/2008/fbml">
  <head>
    <link rel="stylesheet" href="/css/stylesheet.css" type="text/css"></link>
    <? include "$_SERVER[DOCUMENT_ROOT]/inc/header.html"; ?>
    <title>Past Masters - <?= $cnf_lodgeNameNumber ?></title>
    <meta property="og:url" content="http://<?= $_SERVER[SERVER_NAME] ?>/years/" />
    <meta property="og:site_name" content="<?= $cnf_lodgeNameNumber ?>" />
    <meta property="og:title" content="Past Masters Gallery" />
    <meta property="og:image" content="http://<?= $_SERVER[SERVER_NAME] ?>/photos/large/1955-Pierce.jpg" />
    <meta property="og:description" content="The Past Masters of <?= $cnf_lodgeNameNumber ?>" />
  </head>
  <body>

  <style>
    .pastmaster {
      font-family: Arial;
      font-weight: bold;
      font-size: 18px;
    }
    h2 { margin-top: 0px; }
    ul { padding-left:20px; margin-bottom:0px; }
  </style>
  <link rel="stylesheet" href="/css/thickbox.css" type="text/css"></link>

  <h1>Past Masters Gallery</h1>
  <p><? PMCarousel("pastmasters"); ?></p>
  <p><? GetPastMasters("pastmasters", true); ?></p>

  <h1>Affiliated Past Masters</h1>
  <p><? GetPastMasters("affiliated", false); ?></p>

<?
function PMCarousel($table)
{
    global $sqlitedb;
    
    $results = $sqlitedb->query("SELECT Photo, Year FROM $table ORDER BY Year");
    echo "<div class=\"pmslider\">\n";
    while ($row = $results->fetchArray(SQLITE3_ASSOC))
    {
      echo "<div><img src=\"/photos/$row[Photo]\" class=\"pm-img\" width=109 height=150 title=\"$row[Year]\" /></div>\n";
    }
  echo "</div>\n";
}

function GetPastMasters($table, $ylink)
{
    global $sqlitedb;

    $results = $sqlitedb->query("SELECT Year, Name, Photo, Biography FROM $table ORDER BY Year");
    while ($row = $results->fetchArray(SQLITE3_ASSOC))
        {
            $Biography = $row['Biography'] . "\n";
            $Biography = preg_replace("/(.*)\n/", "<li>\\1<br/>\n", $Biography);
            if (substr_count($Biography, "\n") > 5)
                {
                    $o = strpos_offset_recursive("<br/>", $Biography, 5);
                    $Biography = substr($Biography, 0, $o) .
                        "</ul>\n<div class=\"more\"><p class=\"more_link\">More <span class=\"glyphicon glyphicon-chevron-down\">" .
                        "</span></p><div class=\"more_body\"><ul>" .
                        substr($Biography, $o+6) .
                        "</div>" . "</div>\n ";
                }
            
            echo "<div class=\"row\">\n";
            echo "  <div class=\"col-xs-2 col-sm-2 col-md-2 col-lg-2\">\n";
            echo "    <h2>";
	    if ($ylink && file_exists($row[Year] . ".php")) { echo "<a href=\"$row[Year].php\" id=\"$row[Year]\" />"; }
            echo "$row[Year]";
            if ($ylink && file_exists($row[Year] . ".php")) { echo "</a>"; }
            echo "</h2>\n";
            echo "  </div>\n";
            echo "  <div class=\"col-xs-12 col-sm-10 col-md-10 col-lg-10\">\n";
            echo "    <div style=\"width:100%\">\n";
            echo "      <div style=\"float:left;width:130px;\">\n";
            echo "	<a href=\"/photos/large/$row[Photo]\" class=\"thickbox\" title=\"$row[Name]\">\n";
            echo "	  <img src=\"/photos/$row[Photo]\" class=\"img-thumbnail\" /></a>\n";
            echo "      </div>\n";
            echo "      <div style=\"margin-left:130px;\">\n";
            echo "	<h2>$row[Name]</h2>\n";
            echo "	<ul>\n";
            echo "$Biography\n";
            echo "	</ul>\n";
            echo "      </div>\n";
            echo "    </div>\n";
            echo "  </div>\n";
            echo "</div>\n";
            echo "<p>\n";
        }
}
?>

<? include "$_SERVER[DOCUMENT_ROOT]/inc/footer.php"; ?>

<script src="/js/jquery.bxslider/jquery.bxslider.js"></script>
<link href="/js/jquery.bxslider/jquery.bxslider.css" rel="stylesheet" />
<style>
    .bx-wrapper .bx-caption {
	position: absolute;
	bottom: 0;
	left: 0;
	background: rgba(100, 100, 100, 0.8);
	width: 100%;
    }
    .bx-wrapper .bx-caption span {
        color: white;
	font-weight: bold;
	display: block;
	font-size: 1em;
	padding: 3px;
	text-align: center;
    }
</style>

<script>
  $(document).ready(function() {
    $(".pmslider").bxSlider({
      mode: 'horizontal',
      captions: true,
      useCSS: false,
      pager: false,
      minSlides: 2,
      maxSlides: 8,
      moveSlides: 2,
      slideWidth: 109,
      slideMargin: 5
    });
    $('img.pm-img').click(function() {
      $(document.body).animate( { 'scrollTop': $('#'+this.title).offset().top - $('#navbar').height() }, 500);
    });
  });
</script>

</body>
</html>
