<!-- -*- mode: html -*- -->
<!DOCTYPE html>
<?php set_include_path(".:/usr/local/lib/php:$_SERVER[DOCUMENT_ROOT]"); ?>
<html lang="en">
  <head>
    <link rel="stylesheet" href="/css/stylesheet.css" type="text/css" />
    <? include "$_SERVER[DOCUMENT_ROOT]/inc/header.html"; ?>
    <title>Contact Us - <?= $cnf_lodgeNameNumber ?></title>
  </head>
  <body>
    
    <? loadOfficers(); ?>
    <style> h2 { margin-top:20px; } </style>
    
    <h1>How to Contact Us</h1>
    
    <h2><span class="glyphicon glyphicon-map-marker"></span> Address</h2>
    <?= $cnf_lodgeAddress ?><br /><?= $cnf_lodgeCityStateZip ?>

    <!-- <iframe width="100%" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps/ms?msa=0&amp;msid=204977446898439537882.0004d8d48996178d8c8ca&amp;ie=UTF8&amp;t=m&amp;ll=36.821997,-76.150703&amp;spn=0.037789,0.060081&amp;z=14&amp;output=embed"></iframe><br /> -->

    <h2><span class="glyphicon glyphicon-phone-alt"></span> Phone</h2>
    <?= $officerArray["Worshipful Master"]["Title"] ?>: <?= $officerArray["Worshipful Master"]["Name"] ?>, <?= $officerArray["Worshipful Master"]["Phone"] ?><br />
    <?= $officerArray["Secretary"]["Title"] ?>: <?= $officerArray["Secretary"]["Name"] ?>, <?= $officerArray["Secretary"]["Phone"] ?><br />

    <h2><span class="glyphicon glyphicon-envelope"></span> Email</h2>

    <?= $officerArray["Worshipful Master"]["Title"] ?>: <?= $officerArray["Worshipful Master"]["Name"] ?>, <a href="mailto:<?= $officerArray["Worshipful Master"]["EmailAddress"] ?>"><?= $officerArray["Worshipful Master"]["EmailAddress"] ?></a><br />
    <?= $officerArray["Secretary"]["Title"] ?>: <?= $officerArray["Secretary"]["Name"] ?>, <a href="mailto:<?= $officerArray["Secretary"]["EmailAddress"] ?>"><?= $officerArray["Secretary"]["EmailAddress"] ?></a><br />
    Webmaster: <?= $cnf_webmasterName ?>, <a href="mailto:<?= $cnf_webmasterEmail ?>"><?= $cnf_webmasterEmail ?></a><br />

    <h2><span class="glyphicon glyphicon-time"></span> Schedule</h2>
    Stated Meetings: <?= $cnf_statedMeetings ?><br>
    Work Nights: <?= $cnf_workMeetings ?><br>
    Complete Schedule can be found on the <a href="/calendar/">Lodge Calendar</a>
    <? include "$_SERVER[DOCUMENT_ROOT]/inc/footer.php"; ?>

  </body>
</html>
