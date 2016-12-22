<!-- -*- mode: html; -*- -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Kempsville Masonic Lodge - Admin">
    <meta name="author" content="Emmett M. Pate, Jr.">
    <link href="/graphics/favicon.ico" rel="shortcut icon"></link>

    <title>Kempsville Masonic Lodge - Admin</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">

    <!-- Just for debugging purposes. -->
    <!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->

    <link href="responsive-calendar/0.9/css/responsive-calendar.css" rel="stylesheet" media="screen">
  </head>

  <? include "modules.inc"; ?>

  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/admin/"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a>
          <a class="navbar-brand" href="/admin/">Website Admin</a>
        </div>

        <div id="navbar" class="navbar-collapse collapse">
          <ul class="list-unstyled visible-xs">
	    <li><a href="?module=calendar">Events</a></li>
	    <li><a href="?module=miscellaneous&table=officers&action=view&sort=Rank">Lodge Officers</a></li>
	    <li><a href="?module=roster&table=pastmasters&action=view">Past Masters</a></li>
	    <li><a href="?module=roster&table=affiliated&action=view">Affiliated Past Masters</a></li>
	    <li><a href="?module=miscellaneous&table=memorial&action=view&sort=Date">Memorial List</a></li>
	    <li><a href="?module=miscellaneous&table=lmip&action=view&sort=Year">Life Members in Perpetuity</a></li>
	    <li><a href="?module=miscellaneous&table=moty&action=view&sort=Year">Mason of the Year</a></li>
	    <li><a href="?module=miscellaneous&table=veterans&action=view&sort=Years,LastName">Masonic Veterans</a></li>
	    <li><a href="?module=miscellaneous&table=awards&action=view&sort=Year">Lodge Awards</a></li>
	    <li><a href="/index.php" target="_blank">View Website</a></li>
	    <li><a href="phpliteadmin/index.php" target="_blank">phpLiteAdmin</a></li>
	  </ul>
        </div>

      </div>
    </nav>

    <div class="container-fluid">

      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
	  <h4>Calendar Management</h4>
          <ul class="nav nav-sidebar">
	    <li><a href="?module=calendar">Events</a></li>
	  </ul>

	  <h4>Roster Management</h4>
          <ul class="nav nav-sidebar">
	    <li><a href="?module=miscellaneous&table=officers&action=view&sort=Rank">Lodge Officers</a></li>
	    <li><a href="?module=roster&table=pastmasters&action=view">Past Masters</a></li>
	    <li><a href="?module=roster&table=affiliated&action=view">Affiliated Past Masters</a></li>
          </ul>

	  <h4>Miscellaneous</h4>
	  <ul class="nav nav-sidebar">
	    <li><a href="?module=miscellaneous&table=memorial&action=view&sort=Date">Memorial List</a></li>
	    <li><a href="?module=miscellaneous&table=lmip&action=view&sort=Year">Life Members in Perpetuity</a></li>
	    <li><a href="?module=miscellaneous&table=moty&action=view&sort=Year">Mason of the Year</a></li>
	    <li><a href="?module=miscellaneous&table=veterans&action=view&sort=Years,LastName">Masonic Veterans</a></li>
	    <li><a href="?module=miscellaneous&table=awards&action=view&sort=Year">Lodge Awards</a></li>
	  </ul>

	  <h4>Utilities</h4>
	  <ul class="nav nav-sidebar">
	    <li><a href="/index.php" target="_blank">View Website</a></li>
	    <li><a href="phpliteadmin/index.php" target="_blank">phpLiteAdmin</a></li>
	  </ul>
	  
        </div>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

          <? Module(); ?>

        </div>

      </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    
    <script>window.jQuery || document.write('<script src="assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <!-- Just to make our placeholder images work. Dont actually copy the next line! -->
    <script src="assets/js/vendor/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>

    <script type="text/javascript" src="/js/fullcalendar-2.6.1/lib/moment.min.js"></script>
    <script type="text/javascript" src="/js/fullcalendar-2.6.1/fullcalendar.min.js"></script>
    <link type="text/css" href="/js/fullcalendar-2.6.1/fullcalendar.css" rel="stylesheet" />
    <link type="text/css" href="css/calendar.css" rel="stylesheet" />

    <link href="/css/thickbox.css" rel="stylesheet" type="text/css"></link>
    <link href="/js/colorbox-master/example1/colorbox.css" rel="stylesheet" type="text/css"></link>
    <script src="/js/colorbox-master/jquery.colorbox-min.js"></script>
    
    <script>
    $(document).ready(function() {
	// page is now ready, initialize the calendar...
	$('#calendar').fullCalendar({
            header: {
		right: 'today prev,next',
		left: 'title',
	    },
            allDayDefault: false,
	    displayEventEnd: true,
	    firstDay: 1,
	    //height: 'auto',
	    //contentHeight: 'auto',
	    //aspectRatio: 0.58,
	    events: 'events.php',
	    viewRender: function(view, element) {
		if (view.name === "month") {
		    $("#calendar").fullCalendar('option', 'height',
						$(document).height()-$('.navbar').outerHeight(true)-$('.fc-toolbar').outerHeight(true))
		}
	    },
	    windowResize: function(view) {
		if (view.name === "month") {
		    $("#calendar").fullCalendar('option', 'height',
						$(document).height()-$('.navbar').outerHeight(true)-$('.fc-toolbar').outerHeight(true))
		    $("#calendar").fullCalendar('render');
		}
	    },
	    eventClick: function(calEvent, jsEvent, view) {
		$.ajax({
		    type: 'get',
		    url: 'events.php',
		    data: 'editday='+calEvent.start.format("YYYY-MM-DD"),
		    success: function(r) {
			$('#calEditor').modal({
			    keyboard: false
			}),
			$('.modal-body').show().html(r);
		    }
		})
	    },
	    dayClick: function(date, jsEvent, view) {
		$.ajax({
		    type: 'get',
		    url: 'events.php',
		    data: 'editday='+date.format("YYYY-MM-DD"),
		    success: function(r) {
			$('#calEditor').modal({
			    keyboard: false
			}),
			$('.modal-body').show().html(r);
		    }
		})
	    },
	})
	$('#calFormSubmit').click(function(e) {
	    e.preventDefault();
	    $.post('updatecal.php',
		   $("#calForm").serialize(),
		   function(data, status, xhr) { $('#calendar').fullCalendar('refetchEvents'); }
		  );
	});

	$('#miscEditor').on('show.bs.modal', function (event) {
	    var button = $(event.relatedTarget);
	    var title = button.data('title');
	    var table = button.data('table');
	    var rowid = button.data('rowid');
	    
	    var modal = $(this)
	    modal.find('.modal-title').text(title + ' Editor');
	    $.ajax({
		type: 'get',
		url: 'editor.php',
		data: 'table='+table+'&rowid='+rowid,
		success: function(r) {
		    $('.modal-body').show().html(r);
		}
	    })
	})
	$('#miscEditorFormSubmit').click(function(e) {
	    e.preventDefault();
	    $.post('updaterec.php',
		   $("#miscEditorForm").serialize(),
		   function(data, status, xhr) { location.reload(); }
		  );
	});
	
	$(".thickbox").colorbox({maxWidth:'95%', maxHeight:'95%'});
    })
    </script>

</body>
</html>
