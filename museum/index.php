<!-- -*- mode: html -*- -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<?php set_include_path(".:/usr/local/lib/php:$_SERVER[DOCUMENT_ROOT]"); ?>
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:og="http://ogp.me/ns#"
      xmlns:fb="http://www.facebook.com/2008/fbml">
  <head>
    <title>Virtual Museum - Kempsville Lodge No. 196</title>
    <link rel="stylesheet" href="/css/stylesheet.css" type="text/css">

    <meta property="og:url" content="http://kempsvillelodge.org/museum/" />
    <meta property="og:site_name" content="Kempsville Lodge No. 196" />
    <meta property="og:title" content="Kempsville Lodge Virtual Museum" />
    <meta property="og:image" content="http://kempsvillelodge.org/photos/1955-Officers.jpg" />
    <meta property="og:description" content="Take a virtual stroll down memory lane and enjoy hundreds of old photos, newsletters, lodge memorabilia, and more." />
    <!-- use https://developers.facebook.com/tools/debug/og/object/ to debug and force re-scrape -->
    <? include "$_SERVER[DOCUMENT_ROOT]/inc/header.html"; ?>
  </head>
  <body>
    
    <style>
      h2 { margin-top: 0px; }
    </style>

    <h1>The Virtual Museum</h1>
    <p>Take a virtual stroll down memory lane and enjoy over
      <?= NumberOfPhotos(); ?> old photos, newsletters, lodge memorabilia, and more.</p>
    
    <div class="row">
      <div class="col-sm-6">
	<h2>The Early Years</h2>
	<ul>
	  <li><a href=/years/1954.php>1954 (UD): Right Worshipful William Hollowell Pierce</a></li>
	  <li><a href=/years/1955.php>1955: Right Worshipful William Hollowell Pierce</a></li>
	  <li><a href=/years/1956.php>1956: Right Worshipful George Raymond Ferrell</a></li>
	  <li><a href=/years/1957.php>1957: Worshipful Augustus Manley Powers, Jr.</a></li>
	  <li><a href=/years/1958.php>1958: Worshipful Marshall Aubrey Williams</a></li>
	  <li><a href=/years/1959.php>1959: Worshipful Thomas Wesley Poindexter, Sr</a></li>
	</ul>
      </div>
      <div class="col-sm-6 hidden-xs text-center photo-wrapper">
	<? RandomOfficers(1950); ?>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-6">
	<h2>The 60&#39;s</h2>
	<ul>
	  <li><a href=/years/1960.php>1960: Right Worshipful Lewis Raymond Snyder</a></li>
	  <li><a href=/years/1961.php>1961: Worshipful Russell Willoughby</a></li>
	  <li><a href=/years/1962.php>1962: Worshipful Norman Temple Heath</a></li>
	  <li><a href=/years/1963.php>1963: Worshipful Thornton Stith Bernard, Jr.</a></li>
	  <li><a href=/years/1964.php>1964: Worshipful Grayson Amazaih Pearce</a></li>
	  <li><a href=/years/1965.php>1965: Worshipful Elwood Marvin Grant</a></li>
	  <li><a href=/years/1966.php>1966: Right Worshipful Earl Lewis Polhamus, Jr.</a></li>
	  <li><a href=/years/1967.php>1967: Worshipful Arthur Bulman, Jr.</a></li>
	  <li><a href=/years/1968.php>1968: Right Worshipful William Harry Holland</a></li>
	  <li><a href=/years/1969.php>1969: Right Worshipful Dwight Paul Jones</a></li>
	</ul>
      </div>
      <div class="col-sm-6 hidden-xs text-center photo-wrapper">
	<? RandomOfficers(1960); ?>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-6">
	<h2>The 70's</h2>
	<ul>
	  <li><a href=/years/1970.php>1970: Worshipful William Thomas Haste</a></li>
	  <li><a href=/years/1971.php>1971: Worshipful Franklin Linwood Beard, Sr.</a></li>
	  <li><a href=/years/1972.php>1972: Right Worshipful George Joseph Wallace</a></li>
	  <li><a href=/years/1973.php>1973: Worshipful Lee Kelberg</a></li>
	  <li><a href=/years/1974.php>1974: Worshipful Michael Lombardo</a></li>
	  <li><a href=/years/1975.php>1975: Right Worshipful Richard Alfred Davis, Jr.</a></li>
	  <li><a href=/years/1976.php>1976: Right Worshipful Vernon Bernell Benjaminson</a></li>
	  <li><a href=/years/1977.php>1977: Worshipful Clarence Gwaltney Felts</a></li>
	  <li><a href=/years/1978.php>1978: Worshipful Monte Pearson Howell</a></li>
	  <li><a href=/years/1979.php>1979: Worshipful Ejnar Olaf Jorgensen</a></li>
	</ul>
      </div>
      <div class="col-sm-6 hidden-xs text-center photo-wrapper">
	<? RandomOfficers(1970); ?>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-6">
	<h2>The 80's</h2>
	<ul>
	  <li><a href=/years/1980.php>1980: Worshipful Frank Leroy Creasy</a></li>
	  <li><a href=/years/1981.php>1981: Worshipful Charles Raymond Cochran</a></li>
	  <li><a href=/years/1982.php>1982: Right Worshipful William Ray Knowles Sr.</a></li>
	  <li><a href=/years/1983.php>1983: Right Worshipful Thomas McGowan</a></li>
	  <li><a href=/years/1984.php>1984: Worshipful Joseph Francis Thornton</a></li>
	  <li><a href=/years/1985.php>1985: Worshipful Wallace Tuck Pittard</a></li>
	  <li><a href=/years/1986.php>1986: Worshipful Jimmie Wilder</a></li>
	  <li><a href=/years/1987.php>1987: Worshipful Ralph Weldon Ward</a></li>
	  <li><a href=/years/1988.php>1988: Worshipful Raymond Elnor Hall, Jr.</a></li>
	  <li><a href=/years/1989.php>1989: Worshipful James Charles Gardner</a></li>
	</ul>
      </div>
      <div class="col-sm-6 hidden-xs text-center photo-wrapper">
	<? RandomOfficers(1980); ?>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-6">
	<h2>The 90&#39;s</h2>
	<ul>
	  <li><a href=/years/1990.php>1990: Worshipful Moran Keith Morris</a></li>
	  <li><a href=/years/1991.php>1991: Worshipful Bobby Gene Spruill</a></li>
	  <li><a href=/years/1992.php>1992: Worshipful Donald Edward Meyer</a></li>
	  <li><a href=/years/1993.php>1993: Worshipful Dennis Robert Harrison</a></li>
	  <li><a href=/years/1994.php>1994: Worshipful Carl William Nolan</a></li>
	  <li><a href=/years/1995.php>1995: Worshipful Allen Victor Wyatt</a></li>
	  <li><a href=/years/1996.php>1996: Worshipful Robert Wesley Stanek</a></li>
	  <li><a href=/years/1997.php>1997: Worshipful Eugene LeJeune</a></li>
	  <li><a href=/years/1998.php>1998: Worshipful Claude William Watkins, Jr.</a></li>
	  <li><a href=/years/1999.php>1999: Worshipful Morris Donovan White</a></li>
	</ul>
      </div>
      <div class="col-sm-6 hidden-xs text-center photo-wrapper">
	<? RandomOfficers(1990); ?>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-6">
	<h2>Into the 21st Century</h2>
	<ul>
	  <li><a href=/years/2000.php>2000: Worshipful Donald Kenneth Robinson</a></li>
	  <li><a href=/years/2001.php>2001: Worshipful Michael Ryan Sheehan</a></li>
	  <li><a href=/years/2002.php>2002: Worshipful S. Ray Connard</a></li>
	  <li><a href=/years/2003.php>2003: Worshipful G. Wilson "Bill" Nelligar</a></li>
	  <li><a href=/years/2004.php>2004: Worshipful Prentice G. Tuck, Jr.</a></li>
	  <li><a href=/years/2005.php>2005: Right Worshipful Emmett Moseley "Buddy" Pate, Jr.</a></li>
	  <li><a href=/years/2006.php>2006</a></li>
	  <li><a href=/years/2007.php>2007: Right Worshipful Roger Cort</a></li>
	  <li><a href=/years/2008.php>2008</a></li>
	  <li><a href=/years/2009.php>2009: Worshipful Ronald Stewart Jacobson</a></li>
	</ul>
      </div>
      <div class="col-sm-6 hidden-xs text-center photo-wrapper">
	<? RandomOfficers(2000); ?>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-6">
	<h2>2010 through 2019</h2>
	<ul>
	  <li><a href=/years/2010.php>2010: Worshipful William Harold Rawson</a></li>
	  <li><a href=/years/2011.php>2011: Worshipful Michael Duane Johnstone</a></li>
	  <li><a href=/years/2012.php>2012: Worshipful William Peterson</a></li>
	  <li><a href=/years/2013.php>2013: Worshipful Jerry Hallal</a></li>
	  <li><a href=/years/2014.php>2014: Worshipful Steve Ridgeway</a></li>
	  <li><a href=/years/2015.php>2015: Worshipful William Peterson</a></li>
	  <li><a href=/years/2016.php>2016: Worshipful Scott Foxwell</a></li>
	  <li><a href=/years/2017.php>2017: Worshipful Greg Muir</a></li>
	</ul>
      </div>
      <div class="col-sm-6 hidden-xs text-center photo-wrapper">
	<? RandomOfficers(2010); ?>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-12">
	<h2>Other Exhibits</h2>
	<ul>
	  <li><a href="/years/">Past Masters Gallery</a></li>
	  <li><a href="/museum/officers.php">Lodge Officers Through the Years</a></li>
	  <li><a href="/museum/pastmastersnight.php">Past Masters Night</a></li>
	  <li><a href="/museum/armedforcesnight.php">Armed Forces Night</a></li>
	  <li><a href="/museum/visitors.php">Notable Visitors Through the Years</a></li>
	  <li><a href="/museum/pins.php">Pins, Coins, Hats, and Coffee Cups</a></li>
	  <li><a href="/museum/rosters.php">Lodge Roster Covers Through the Years</a></li>
	  <li><a href="/museum/newsletters/">Newsletter Archive</a></li>
	  <li><a href="/museum/building.php">The Lodge Building</a></li>
	  <!-- <li><a href="/pano/">Virtual Lodge Room</a></li> -->
	  <li><a href="/museum/gmpins.php">Grand Lodge Pins Through the Years</a> - A collection of lapel pins from the Grand Lodge of Virginia beginning in 1988.</li>
	  <li><a href="/museum/pins/">Masonic Lapel Pin Collection</a> - A virtual collection of over <?= NumberOfPins(); ?> Masonic Lodge, 
	    Grand Lodge, and Shrine Pins owned by our members.</li>
	  <li><a href="/museum/coins/">Masonic Coin Collection</a> - A virtual collection of over <?= NumberOfCoins(); ?> Masonic coins owned by our members.</li>
	  <li><a href="/museum/general/">Masonry in General</a> - Miscellaneous Masonic odds and ends.</li>
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
    <? include "$_SERVER[DOCUMENT_ROOT]/inc/footer.php"; ?>
  </body>
</html>
