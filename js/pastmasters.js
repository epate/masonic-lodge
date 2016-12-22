$(document).ready(function()
{
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
