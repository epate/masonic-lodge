</div>

<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
  <div class="list-group">
    <? include "menu.inc"; ?>
  </div>
</div>
<div id="topbuttondiv">
 <button type="button" id="topbutton" class="pull-right btn btn-primary btn-md">Top 
  <span class="glyphicon glyphicon-triangle-top"></span>
 </button>
</div>

</div>

<footer>
Page Last Updated: <?= strftime("%D %r", getlastmod()); ?><br>
Questions or comments can be sent to <a href=mailto:<?= $cnf_webmaster ?>><?= $cnf_webmaster ?></a>
</footer>

</div>

<!-- Bootstrap core JavaScript
<!-- Placed at the end of the document so the pages load faster -->
<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script src="/js/offcanvas.js"></script>
<script src="/js/colorbox-master/jquery.colorbox-min.js"></script>
<xscript type="text/javascript" src="/js/pastmasters.js"></script>
<script type="text/javascript" src="/js/main.js"></script>

</body>
</html>
