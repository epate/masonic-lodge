<!-- -*- mode: php -*- -->
<!DOCTYPE html>
<?php set_include_path(".:/usr/local/lib/php:$_SERVER[DOCUMENT_ROOT]"); ?>

<html lang="en">
  <head>
    <link rel="stylesheet" href="/css/stylesheet.css" type="text/css">
    <? include __DIR__ . "/../inc/header.html"; ?>
    <title>Lodge Officers - <?= $cnf_lodgeNameNumber ?></title>
  </head>
  <body>

    <? loadOfficers(); ?>

    <h1>Lodge Officers</h1>

    <? if (array_key_exists('Worshipful Master', $officerArray)) { ?>
    <div class="row">
      <div class="col-md-12">
	<p class="text-center">
	  <a href="large/<?= $officerArray["Worshipful Master"]["Image"] ?>.jpg" class="thickbox" title="<?= $officerArray["Worshipful Master"]["Name"] ?>">
	    <img src=large/<?= $officerArray["Worshipful Master"]["Image"] ?>.jpg width=250px class="img-thumbnail" /></a><br/>
	  <b><?= $officerArray["Worshipful Master"]["Title"] ?><br/>
	    <?= $officerArray["Worshipful Master"]["Name"] ?></b></p>
      </div>
    </div>
    <? } ?>
    
    <div class="row">
      <? if (array_key_exists('Senior Warden', $officerArray)) { ?>
      <div class="col-md-3 col-sm-6 col-xs-12">
	<p class="text-center">
	  <a href="large/<?= $officerArray["Senior Warden"]["Image"] ?>.jpg" class="thickbox" title="<?= $officerArray["Senior Warden"]["Name"] ?>">
	    <img src=<?= $officerArray["Senior Warden"]["Image"] ?>.jpg class="img-thumbnail" /></a><br/>
	  <b><?= $officerArray["Senior Warden"]["Title"] ?><br/>
	    <?= $officerArray["Senior Warden"]["Name"] ?></b></p>
      </div>
      <? } ?>
      <? if (array_key_exists('Junior Warden', $officerArray)) { ?>
      <div class="col-md-3 col-sm-6 col-xs-12">
	<p class="text-center">
	  <a href="large/<?= $officerArray["Junior Warden"]["Image"] ?>.jpg" class="thickbox" title="<?= $officerArray["Junior Warden"]["Name"] ?>">
	    <img src=<?= $officerArray["Junior Warden"]["Image"] ?>.jpg class="img-thumbnail" /></a><br/>
	  <b><?= $officerArray["Junior Warden"]["Title"] ?><br/>
	    <?= $officerArray["Junior Warden"]["Name"] ?></b></p>
      </div>
      <? } ?>      
      <? if (array_key_exists('Treasurer', $officerArray)) { ?>
      <div class="col-md-3 col-sm-6 col-xs-12">
	<p class="text-center">
	  <a href="large/<?= $officerArray["Treasurer"]["Image"] ?>.jpg" class="thickbox" title="<?= $officerArray["Treasurer"]["Name"] ?>">
	    <img src=<?= $officerArray["Treasurer"]["Image"] ?>.jpg class="img-thumbnail" /></a><br/>
	  <b><?= $officerArray["Treasurer"]["Title"] ?><br/>
	    <?= $officerArray["Treasurer"]["Name"] ?></b></p>
      </div>
      <? } ?>
      <? if (array_key_exists('Secretary', $officerArray)) { ?>
      <div class="col-md-3 col-sm-6 col-xs-12">
	<p class="text-center">
	  <a href="large/<?= $officerArray["Secretary"]["Image"] ?>.jpg" class="thickbox" title="<?= $officerArray["Secretary"]["Name"] ?>">
	    <img src=<?= $officerArray["Secretary"]["Image"] ?>.jpg class="img-thumbnail" /></a><br/>
	  <b><?= $officerArray["Secretary"]["Title"] ?><br/>
	    <?= $officerArray["Secretary"]["Name"] ?></b></p>
      </div>
      <? } ?>
    </div>

    <div class="row">
      <? if (array_key_exists('Senior Deacon', $officerArray)) { ?>
      <div class="col-md-3 col-sm-6 col-xs-12">
	<p class="text-center">
	  <a href="large/<?= $officerArray["Senior Deacon"]["Image"] ?>.jpg" class="thickbox" title="<?= $officerArray["Senior Deacon"]["Name"] ?>">
	    <img src=<?= $officerArray["Senior Deacon"]["Image"] ?>.jpg class="img-thumbnail" /></a><br/>
	  <b><?= $officerArray["Senior Deacon"]["Title"] ?><br/>
	    <?= $officerArray["Senior Deacon"]["Name"] ?></b></p>
      </div>
      <? } ?>
      <? if (array_key_exists('Junior Deacon', $officerArray)) { ?>
      <div class="col-md-3 col-sm-6 col-xs-12">
	<p class="text-center">
	  <a href="large/<?= $officerArray["Junior Deacon"]["Image"] ?>.jpg" class="thickbox" title="<?= $officerArray["Junior Deacon"]["Name"] ?>">
	    <img src=<?= $officerArray["Junior Deacon"]["Image"] ?>.jpg class="img-thumbnail" /></a><br/>
	  <b><?= $officerArray["Junior Deacon"]["Title"] ?><br/>
	    <?= $officerArray["Junior Deacon"]["Name"] ?></b></p>
      </div>
      <? } ?>
      <? if (array_key_exists('Senior Steward', $officerArray)) { ?>
      <div class="col-md-3 col-sm-6 col-xs-12">
	<p class="text-center">
	  <a href="large/<?= $officerArray["Senior Steward"]["Image"] ?>.jpg" class="thickbox" title="<?= $officerArray["Senior Steward"]["Name"] ?>">
	    <img src=<?= $officerArray["Senior Steward"]["Image"] ?>.jpg class="img-thumbnail" /></a><br/>
	  <b><?= $officerArray["Senior Steward"]["Title"] ?><br/>
	    <?= $officerArray["Senior Steward"]["Name"] ?></b></p>
      </div>
      <? } ?>
      <? if (array_key_exists('Junior Steward', $officerArray)) { ?>
      <div class="col-md-3 col-sm-6 col-xs-12">
	<p class="text-center">
	  <a href="large/<?= $officerArray["Junior Steward"]["Image"] ?>.jpg" class="thickbox" title="<?= $officerArray["Junior Steward"]["Name"] ?>">
	    <img src=<?= $officerArray["Junior Steward"]["Image"] ?>.jpg class="img-thumbnail" /></a><br/>
	  <b><?= $officerArray["Junior Steward"]["Title"] ?><br/>
	    <?= $officerArray["Junior Steward"]["Name"] ?></b></p>
      </div>

      <? } ?>
    </div>

    <div class="row">
      <? if (array_key_exists('Chaplain', $officerArray)) { ?>
      <div class="col-md-3 col-sm-6 col-xs-12">
	<p class="text-center">
	  <a href="large/<?= $officerArray["Chaplain"]["Image"] ?>.jpg" class="thickbox" title="<?= $officerArray["Chaplain"]["Name"] ?>">
	    <img src=<?= $officerArray["Chaplain"]["Image"] ?>.jpg class="img-thumbnail" /></a><br/>
	  <b><?= $officerArray["Chaplain"]["Title"] ?><br/>
	    <?= $officerArray["Chaplain"]["Name"] ?></b></p>
      </div>
      <? } ?>
      <? if (array_key_exists('Tiler', $officerArray)) { ?>
      <div class="col-md-3 col-sm-6 col-xs-12">
	<p class="text-center">
	  <a href="large/<?= $officerArray["Tiler"]["Image"] ?>.jpg" class="thickbox" title="<?= $officerArray["Tiler"]["Name"] ?>">
	    <img src=<?= $officerArray["Tiler"]["Image"] ?>.jpg class="img-thumbnail" /></a><br/>
	  <b><?= $officerArray["Tiler"]["Title"] ?><br/>
	    <?= $officerArray["Tiler"]["Name"] ?></b></p>
      </div>
      <? } ?>
      <? if (array_key_exists('Marshal', $officerArray)) { ?>
      <div class="col-md-3 col-sm-6 col-xs-12">
	<p class="text-center">
	  <a href="large/<?= $officerArray["Marshal"]["Image"] ?>.jpg" class="thickbox" title="<?= $officerArray["Marshal"]["Name"] ?>">
	    <img src=<?= $officerArray["Marshal"]["Image"] ?>.jpg class="img-thumbnail" /></a><br/>
	  <b><?= $officerArray["Marshal"]["Title"] ?><br/>
	    <?= $officerArray["Marshal"]["Name"] ?></b></p>
      </div>
      <? } ?>
      <? if (array_key_exists('Musician', $officerArray)) { ?>
      <div class="col-md-3 col-sm-6 col-xs-12">
	<p class="text-center">
	  <a href="large/<?= $officerArray["Musician"]["Image"] ?>.jpg" class="thickbox" title="<?= $officerArray["Musician"]["Name"] ?>">
	    <img src=<?= $officerArray["Musician"]["Image"] ?>.jpg class="img-thumbnail" /></a><br/>
	  <b><?= $officerArray["Musician"]["Title"] ?><br/>
	    <?= $officerArray["Musician"]["Name"] ?></b></p>
      </div>
      <? } ?>
    </div>

    <? include __DIR__ . "/../inc/footer.php"; ?>

  </body>
</html>
