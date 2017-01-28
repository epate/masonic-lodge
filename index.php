<!-- -*- mode: html; -*- -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<? set_include_path(".:/usr/local/lib/php"); ?>
<?
include $_SERVER['DOCUMENT_ROOT'] . "/inc/config.inc";
include $_SERVER['DOCUMENT_ROOT'] . "/inc/functions.inc";
$usefbfeed = true;
?>
<html lang="en" ng-app="Lodge">
  <head>
    <title><?= $cnf_lodgeNameNumber ?></title>
    <meta charset="utf-8"></meta>
    <meta HTTP-EQUIV="Refresh" CONTENT="<?= strtotime('tomorrow + 30 minutes')-time(); ?>"></meta>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"></meta>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"></meta>
    <meta name="description" content="<?= $cnf_lodgeNameNumber ?>"></meta>
    <meta name="author" content=""></meta>
    <link href="/graphics/favicon.ico" rel="shortcut icon"></link>
    <?
       if ($usefbfeed) {
       $fbfeed_path = 'fbfeed';
       include $fbfeed_path . '/fbfeed-settings.php';
       echo "\n";
       }
    ?>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    
    <!-- Custom styles for this template -->
    <link href="/css/offcanvas.less" rel="stylesheet/less"></link>
    <script src="/js/less.min.js" type="text/javascript"></script>
    <link href="/css/thickbox.css" rel="stylesheet" type="text/css"></link>
    <link href="/js/colorbox-master/example1/colorbox.css" rel="stylesheet" type="text/css"></link>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  
  <style>
  .fb-like-box, .fb-like-box span, .fb-like-box span iframe[style] { width: 100% !important; }
  td.majorevents {
      background-color: white;
      font-weight: bold;
      color: blue;
  }
  #topbuttondiv.affix {
      position: fixed;
      top: 60px;
      bottom: 60px;
      right: 10px;
  }
  </style>

  <body ng-controller="LodgeController as lodge" >
    <div id="navbar" class="navbar navbar-fixed-top navbar-inverse" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href=""><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="/misc/about.php">About</a></li>
            <li><a href="/misc/contact.php">Contact</a></li>
<? GetTopMenu("menu.inc"); ?>
          </ul>
        </div>
      </div>
    </div>
    
    <div class="container">
      <div class="row row-offcanvas row-offcanvas-right">
        <div class="col-xs-12 col-sm-9">

          <div class="jumbotron" id="jumbotrondiv">
	    <h1 align=center class="visible-xs"><?= $cnf_lodgeNameNumber ?></h1>

	    <div style="float:left;padding-right:10px;">
	      <img src="graphics/<?= $cnf_headerGraphicLeft ?>" width=64 height=126 class="img-responsive visible-sm visible-md visible-lg" />
	      <img src="graphics/<?= $cnf_headerGraphicLeft ?>" width=40 height=79 class="img-responsive visible-xs" />
            </div>
	    <div style="float:right;padding-left:10px">
	      <img src="graphics/<?= $cnf_headerGraphicRight ?>" width=64 height=126 class="img-responsive visible-sm visible-md visible-lg" />
	      <img src="graphics/<?= $cnf_headerGraphicRight ?>" width=40 height=79 class="img-responsive visible-xs" />
            </div>
	    <h1 align=center class="visible-sm visible-md visible-lg"><?= $cnf_lodgeNameNumber ?></h1>
	    <p align=center style="color:white">
	      <small>
		<?= $cnf_lodgeDescription ?>
		<br clear=all>
	      </small>
	    </p>
          </div>

          <div class="row">
	    <div class="col-md-6">
	      <p><a href="calendar/" class="btn btn-primary btn-lg btn-block">This Week at <?= $cnf_lodgeName ?></a>
		<table border=0 width=100%>
		  <? ThisWeek(7); ?>
		</table>
	      </p>

	      <div class="visible-sm visible-xs"  id="majorevents">
		<p><a href="years/<?= $cnf_yearShown ?>.php" class="btn btn-primary btn-lg btn-block">Major Events for <?= $cnf_yearShown ?></a></p>
		<div style="height:300px;overflow:auto" id="<?= $cnf_yearShown==date("Y", time())?"majoreventsdiv":""; ?>">
		  <table width=100% cellspacing=0>
		    <? MajorEvents($cnf_yearShown, true); ?>
		  </table>
		</div><br>
	      </div>

<? if ($cnf_facebook) { ?>
	      <p><a href="<?= $cnf_facebookPage ?>" target="_blank" class="btn btn-primary btn-lg btn-block">Find us on Facebook</a></p>
	      <!-- Facebook Panel on Home Page Only -->
	      <div id="fb-root"></div>
	      <? if ($usefbfeed) { ?>
	      <?php fbFeed($settings); ?><br/>
	      <? } else { ?>
	      <div style="height:400px" class="fb-like-box" data-href="<?= $cnf_facebookPage ?>" xdata-height="400" xdata-width="350" data-show-faces="false" data-header="false" data-stream="true" data-show-border="false" data-force-wall="false"></div>
	      
	      <script>
		(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=1397803273815357&version=v2.0";
		fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	      </script>
	      <? } ?>
<? } ?>

<? if ($cnf_menuNewsletters) { ?>
	      <p><a href="museum/newsletters/index.php?r=<?= time(); ?>" class="btn btn-primary btn-lg btn-block">Our Newsletter</a></p>
	      <? RecentNewslettersSlider(); ?>
<? } ?>
	      <p><a href="officers/" class="btn btn-primary btn-lg btn-block">Lodge Officers</a></p>
	      <table width=100%>
		<tr ng-repeat="officer in lodge.officers">
		  <td valign=top>{{officer.Title}}</td>
		  <td valign=top><a href="mailto:{{officer.Email}}">{{officer.Name}}</a></td>
		  <td valign=top align=right nowrap>{{officer.Phone}}</td>
		</tr>
	      </table>
	      
	    </div>

	    <div class="col-md-6 visible-lg visible-md" id="majorevents">
	      <p><a href="years/<?= $cnf_yearShown ?>.php" class="btn btn-primary btn-lg btn-block">Major Events for <?= $cnf_yearShown ?></a></p>
	      <div class="visible-lg visible-md">
		<table width=100% cellspacing=0>
		  <? MajorEvents($cnf_yearShown); ?>	
		</table>
	      </div>
	    </div>
	  </div>
	</div>
	
	<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
	  <div class="list-group">
	    <? include $_SERVER['DOCUMENT_ROOT'] . "/inc/menu.inc"; ?>
	  </div>
	  <div id="topbuttondiv" data-spy="affix">
	    <button id="topbutton" type="button" class="pull-right btn btn-primary btn-md">Top
	    <span class="glyphicon glyphicon-triangle-top"></span>
            </button>
          </div>
	</div>
      </div>

      <footer>
	Page Last Updated: <?= strftime("%D %r", getlastmod_multi("index.php")); ?><br/>
	Questions or comments can be sent to <a href=mailto:<?= $cnf_webmasterEmail ?>><?= $cnf_webmasterEmail ?></a>
      </footer>
      
    </div>
    
    <!-- Bootstrap core JavaScript -->
    <script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="/js/offcanvas.js"></script>
    <script src="/js/colorbox-master/jquery.colorbox-min.js"></script>
    <script src="/js/jquery.bxslider/jquery.bxslider.js"></script>
    <link href="/js/jquery.bxslider/jquery.bxslider.css" rel="stylesheet"></link>
    <script type="text/javascript" src="/js/main.js"></script>
    <script type="text/javascript" src="<?= $fbfeed_path ?>/core/js/cff.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.25/angular.min.js"></script>
    <script type="text/javascript" src="/js/app.js"></script>
  
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
  </body>
</html>
