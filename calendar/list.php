<!-- -*- mode: html -*- -->
<!DOCTYPE html>
<?php set_include_path(".:/usr/local/lib/php:$_SERVER[DOCUMENT_ROOT]"); ?>
<html>
<head>
  <link rel="stylesheet" href="/css/stylesheet.css" type="text/css"></link>
  <link type="text/css" href="/calendar/calendar.css" rel="stylesheet" />
  <? include __DIR__ . "/../inc/header.html"; ?>
  <title>Coming Up - <?= $cnf_lodgeNameNumber ?></title>
</head>
<body>

<h1>Coming Up at <?= $cnf_lodgeName ?></h1>

<span class=keymajor>Major Event</span>,
<span class=keyappendant>Appendant Body</span>,
<span class=keyelsewhere>Event Held Elsewhere</span><p>

<table cellspacing=0>
<? CalendarListView(); ?>
</table>

<? include __DIR__ . "/../inc/footer.php"; ?>

</body>
</html>
