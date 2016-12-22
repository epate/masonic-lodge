$(document).ready(function() {
    /* Google Analytics */
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			     m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			    })(window,document,'script',"//www.google-analytics.com/analytics.js",'ga');
    ga('create', 'UA-341287-8', 'kempsvillelodge.org');
    ga('send', 'pageview');

    /* Facebook Like Box initialization */
    /*
    if ($('#fb-root').length) {
	window.fbAsyncInit = function() {
	    // init the FB JS SDK
	    FB.init({
		appId      : '1397803273815357', // App ID from the App Dashboard
		channelUrl : '//kempsvillelodge.org/channel.php', // Channel File for x-domain communication
		status     : true, // check the login status upon init?
		cookie     : true, // set sessions cookies to allow your server to access the session?
		xfbml      : true,  // parse XFBML tags on this page?
		version    : 'v2.0'
	    });
	    
	    // Additional initialization code such as adding Event Listeners goes here

	};
	(function(d, s, id) {
	    var js, fjs = d.getElementsByTagName(s)[0];
	    if (d.getElementById(id)) return;
	    js = d.createElement(s); js.id = id;
	    js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=1397803273815357&version=v2.0";
	    fjs.parentNode.insertBefore(js, fjs);
	} (document, 'script', 'facebook-jssdk'));
    }
    */

    Date.prototype.getMonthName = function() {
        var monthNames = [ "January", "February", "March", "April", "May", "June", 
                           "July", "August", "September", "October", "November", "December" ];
        return monthNames[this.getMonth()];
    }
    var month_Name = new Date().getMonthName();
    if ($('#majoreventsdiv').length) {
	 $("#majoreventsdiv").animate({'scrollTop': $('#'+month_Name).position().top-$('#January').position().top }, "slow");
    }

    if ($('.bxslider').length) {
	$(".bxslider").bxSlider({
	    mode: 'horizontal',
	    captions: true,
	    useCSS: false,
	    minSlides: 1,
	    maxSlides: 3,
	    slideWidth: 300,
	    slideMargin: 0
	});
    }

    $('#topbutton').hide();
    $('#topbuttondiv').affix({ offset: { top: 60 }});
    $('#topbuttondiv').click(function() {
	$('body,html').animate( { scrollTop:"0px" }, 500);
    });
    $(window).scroll(function() {
	if ($('#sidebar').height() > document.body.scrollTop) { $('#topbutton').hide(); }
	else { $('#topbutton').show("slow"); }
    });
    $(window).resize(function() {
	$(window).off('.affix');
	$('#topbuttondiv').removeData('bs.affix').removeClass('affix affix-top affix-bottom');
	$('#topbuttondiv').affix({ offset: { top: $('#sidebar').height() }});
        sidebarHeight = $('#sidebar').height();
    });

    $(".thickbox").colorbox({maxWidth:'95%', maxHeight:'95%'});
    //hide the all of the element with class msg_body
    $(".more_body").hide();
    //toggle the component with class msg_body
    $(".more_link").click(function()
			  {
			      $(this).next(".more_body").slideToggle(300);
			      $(this).hide();
			  });
});
