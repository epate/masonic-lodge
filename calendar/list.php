<!-- -*- mode: html -*- -->
<!DOCTYPE html>
<?php set_include_path(".:/usr/local/lib/php:$_SERVER[DOCUMENT_ROOT]"); ?>
<html>
<head>
  <title>Coming Up at Kempsville Lodge No. 196</title>
  <link rel="stylesheet" href="/css/stylesheet.css" type="text/css"></link>
  <link type="text/css" href="/calendar/calendar.css" rel="stylesheet" />
</head>
<body>

<? include "header.html"; ?>

<h1>Coming Up at Kempsville Lodge</h1>

<span class=keymajor>Major Event</span>,
<span class=keyappendant>Appendant Body</span>,
<span class=keyelsewhere>Event Held Elsewhere</span><p>

<table cellspacing=0>
<? CalendarListView(); ?>
</table>

<? include "footer.php"; ?>

</body>
</html>
