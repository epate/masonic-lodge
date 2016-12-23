<!-- -*- mode: html -*- -->
<!DOCTYPE html>
<?php set_include_path(".:/usr/local/lib/php:$_SERVER[DOCUMENT_ROOT]"); ?>
<html xmlns="http://www.w3.org/1999/xhtml"
  xmlns:og="http://ogp.me/ns#"
  xmlns:fb="http://www.facebook.com/2008/fbml">
 <head>
  <link rel="stylesheet" href="/css/stylesheet.css" type="text/css"></link>
  <!-- use https://developers.facebook.com/tools/debug/og/object/ to debug and force re-scrape -->
  <? include "$_SERVER[DOCUMENT_ROOT]/inc/header.html"; ?>
  <title>Calendar - <?= $cnf_lodgeNameNumber ?></title>
  <meta property="og:url" content="http://<?= $_SERVER[SERVER_NAME] ?>/calendar/" />
  <meta property="og:site_name" content="<?= $cnf_lodgeNameNumber ?>" />
  <meta property="og:title" content="Calendar of Events" />
  <meta property="og:description" content="Calendar of events for <?= $cnf_lodgeNameNumber ?> as well as the appendant bodies hosted there." />
 </head>
 <body>

 <h1>Calendar of Events</h1>
   
<div class="row">
  <div class="col-md-12 hidden-sm hidden-xs">
    <!-- <span class=comingup>Work Night</span>, -->
    <font size=+1><span class="label label-default major">Major Event</span></font>&nbsp;
    <font size=+1><span class="label label-default appendant">Appendant Body</span></font>&nbsp;
    <font size=+1><span class="label label-default elsewhere">Event Held Elsewhere</span></font><p>
    <div id="calendar"></div>
  </div>
  <div class="col-md-12 visible-sm visible-xs">
    <div>
      <span class=keymajor>Major Event</span>,
      <span class=keyappendant>Appendant Body</span>,
      <span class=keyelsewhere>Event Held Elsewhere</span><p>
    </div>
    <p><table border=0>
	<? CalendarListView(999); ?>
    </table></p>
  </div>
</div>

<p><a href=list.php>List View</a>&nbsp;|&nbsp;<a href=ical.php>Subscribe</a></p>
<? include "$_SERVER[DOCUMENT_ROOT]/inc/footer.php"; ?>

<script type="text/javascript" src="/js/fullcalendar-2.6.1/lib/moment.min.js"></script>
<script type="text/javascript" src="/js/fullcalendar-2.6.1/fullcalendar.min.js"></script>
<link type="text/css" href="/js/fullcalendar-2.6.1/fullcalendar.css" rel="stylesheet" />
<link type="text/css" href="/calendar/calendar.css" rel="stylesheet" />

<script>
$(document).ready(function() {
    // page is now ready, initialize the calendar...
    $('#calendar').fullCalendar({
            header: {
		right: 'today prev,next',
		left: 'title',
	    },
            allDayDefault: false,
    	    eventSources: ['/calendar/events.php'],
	  })
});
</script>

</body>
</html>
