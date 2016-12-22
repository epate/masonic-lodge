<?php

/*================== Custom Facebook Feed Standalone ===================

Author: Smash Balloon
Support Website: http://smashballoon.com/custom-facebook-feed/support
Version: 2.5.3
Copyright: Smash Balloon
License: Non-distributable, not for resale

*/
include 'cff_autolink.php';
function fbFeed($settings, $custom=false) {

    $cff_license  = $settings[ 'license' ];

    //***CONFIGURATION***//
    $access_token_array = array('809956782391601|ISt-Q8WeUNuCHHv8ntK2pLDeWP8','769354546452714|AY4KEhP-5ArilKL07N7FzG4I6lI');
    $default_token = $access_token_array[rand(0, 1)];
    isset($custom['access_token']) ? $access_token = trim($custom[ 'access_token' ]) : ( isset( $settings[ 'access_token' ] ) ? $access_token = trim($settings[ 'access_token' ]) : $access_token = $default_token );
    if( $settings[ 'access_token' ] == 'OPTIONAL_ACCESS_TOKEN_HERE' || $settings[ 'access_token' ] == 'YOUR_ACCESS_TOKEN_HERE' ) $access_token = $default_token;
    isset($custom['id']) ? $page_id = trim($custom[ 'id' ]) : $page_id = trim($settings[ 'id' ]);

    //Cache time
    isset($custom['cachetime']) ? $cff_cache_time = $custom[ 'cachetime' ] : (isset($settings['cachetime']) ? $cff_cache_time = $settings[ 'cachetime' ] : $cff_cache_time = 1);
    isset($custom['cacheunit']) ? $cff_cache_time_unit = $custom[ 'cacheunit' ] : (isset($settings['cacheunit']) ? $cff_cache_time_unit = $settings[ 'cacheunit' ] : $cff_cache_time_unit = 'hour');



    //Is the page type set in $custom? If not then is it set in $settings? If not then defaults to 'page'.
    isset($custom['pagetype']) ? $cff_page_type = $custom[ 'pagetype' ] : (isset($settings['pagetype']) ? $cff_page_type = $settings[ 'pagetype' ] : $cff_page_type = 'page');
    isset($custom['number']) ? $show_posts = $custom[ 'number' ] : (isset($settings['number']) ? $show_posts = $settings[ 'number' ] : $show_posts = 25);
    isset($custom['limit']) ? $cff_post_limit = $custom[ 'limit' ] : (isset($settings['limit']) ? $cff_post_limit = $settings[ 'limit' ] : $cff_post_limit = '');
    isset($custom['offset']) ? $cff_post_offset = $custom[ 'offset' ] : (isset($settings['offset']) ? $cff_post_offset = $settings[ 'offset' ] : $cff_post_offset = '');
    isset($custom['showothers']) ? $show_others = $custom[ 'showothers' ] : (isset($settings['showothers']) ? $show_others = $settings[ 'showothers' ] : $show_others = false);

    isset($custom['showpostsby']) ? $show_posts_by = $custom[ 'showpostsby' ] : (isset($settings['showpostsby']) ? $show_posts_by = $settings[ 'showpostsby' ] : $show_posts_by = 'me');
    isset($custom['locale']) ? $cff_locale = $custom[ 'locale' ] : (isset($settings['locale']) ? $cff_locale = $settings[ 'locale' ] : $cff_locale = 'en_US');
    isset($custom['ajax']) ? $cff_ajax = $custom[ 'ajax' ] : (isset($settings['ajax']) ? $cff_ajax = $settings[ 'ajax' ] : $cff_ajax = false);
    isset($custom['ssl']) ? $cff_ssl = $custom[ 'ssl' ] : (isset($settings['ssl']) ? $cff_ssl = $settings[ 'ssl' ] : $cff_ssl = false);


    //***LAYOUT & STYLE SETTINGS***//
    isset($custom['width']) ? $cff_feed_width = $custom[ 'width' ] : (isset($settings['width']) ? $cff_feed_width = $settings[ 'width' ] : $cff_feed_width = '');
    isset($custom['height']) ? $cff_feed_height = $custom[ 'height' ] : (isset($settings['height']) ? $cff_feed_height = $settings[ 'height' ] : $cff_feed_height = '');
    isset($custom['padding']) ? $cff_feed_padding = $custom[ 'padding' ] : (isset($settings['padding']) ? $cff_feed_padding = $settings[ 'padding' ] : $cff_feed_padding = '');
    isset($custom['bgcolor']) ? $cff_bg_color = $custom[ 'bgcolor' ] : (isset($settings['bgcolor']) ? $cff_bg_color = $settings[ 'bgcolor' ] : $cff_bg_color = '');
    isset($custom['showauthor']) ? $cff_show_author_new = $custom[ 'showauthor' ] : (isset($settings['showauthor']) ? $cff_show_author_new = $settings[ 'showauthor' ] : $cff_show_author_new = '');
    isset($custom['disablelightbox']) ? $cff_disable_lightbox = $custom[ 'disablelightbox' ] : (isset($settings['disablelightbox']) ? $cff_disable_lightbox = $settings[ 'disablelightbox' ] : $cff_disable_lightbox = false);
    isset($custom['class']) ? $cff_class = $custom[ 'class' ] : (isset($settings['class']) ? $cff_class = $settings[ 'class' ] : $cff_class = '');
    isset($custom['eventsource']) ? $cff_events_source = $custom[ 'eventsource' ] : (isset($settings['eventsource']) ? $cff_events_source = $settings[ 'eventsource' ] : $cff_events_source = 'eventspage');
    isset($custom['eventoffset']) ? $cff_event_offset = $custom[ 'eventoffset' ] : (isset($settings['eventoffset']) ? $cff_event_offset = $settings[ 'eventoffset' ] : $cff_event_offset = 6);
    isset($custom['eventimage']) ? $cff_event_image_size = $custom[ 'eventimage' ] : (isset($settings['eventimage']) ? $cff_event_image_size = $settings[ 'eventimage' ] : $cff_event_image_size = 'full');
    isset($custom['pastevents']) ? $cff_past_events = $custom[ 'pastevents' ] : (isset($settings['pastevents']) ? $cff_past_events = $settings[ 'pastevents' ] : $cff_past_events = false);
    isset($custom['filter']) ? $cff_filter_string = $custom[ 'filter' ] : (isset($settings['filter']) ? $cff_filter_string = $settings[ 'filter' ] : $cff_filter_string = '');
    isset($custom['exfilter']) ? $cff_exclude_string = $custom[ 'exfilter' ] : (isset($settings['exfilter']) ? $cff_exclude_string = $settings[ 'exfilter' ] : $cff_exclude_string = '');

    //PHOTOS ONLY
    isset($custom['photosource']) ? $cff_photos_source = $custom[ 'photosource' ] : (isset($settings['photosource']) ? $cff_photos_source = $settings[ 'photosource' ] : $cff_photos_source = 'timeline');
    isset($custom['photocols']) ? $cff_photos_cols = $custom[ 'photocols' ] : (isset($settings['photocols']) ? $cff_photos_cols = $settings[ 'photocols' ] : $cff_photos_cols = '1');

    //ALBUMS ONLY
    isset($custom['albumsource']) ? $cff_albums_source = $custom[ 'albumsource' ] : (isset($settings['albumsource']) ? $cff_albums_source = $settings[ 'albumsource' ] : $cff_albums_source = 'photospage');
    isset($custom['albumcols']) ? $cff_album_cols = $custom[ 'albumcols' ] : (isset($settings['albumcols']) ? $cff_album_cols = $settings[ 'albumcols' ] : $cff_album_cols = '4');
    isset($custom['showalbumtitle']) ? $cff_show_album_title = $custom[ 'showalbumtitle' ] : (isset($settings['showalbumtitle']) ? $cff_show_album_title = $settings[ 'showalbumtitle' ] : $cff_show_album_title = true);
    isset($custom['showalbumnum']) ? $cff_show_album_number = $custom[ 'showalbumnum' ] : (isset($settings['showalbumnum']) ? $cff_show_album_number = $settings[ 'showalbumnum' ] : $cff_show_album_number = true);

    //VIDEOS ONLY
    isset($custom['videosource']) ? $cff_videos_source = $custom[ 'videosource' ] : (isset($settings['videosource']) ? $cff_videos_source = $settings[ 'videosource' ] : $cff_videos_source = 'videospage');
    isset($custom['videocols']) ? $cff_video_cols = $custom[ 'videocols' ] : (isset($settings['videocols']) ? $cff_video_cols = $settings[ 'videocols' ] : $cff_video_cols = '4');
    isset($custom['showvideoname']) ? $cff_show_video_name = $custom[ 'showvideoname' ] : (isset($settings['showvideoname']) ? $cff_show_video_name = $settings[ 'showvideoname' ] : $cff_show_video_name = true);
    isset($custom['showvideodesc']) ? $cff_show_video_desc = $custom[ 'showvideodesc' ] : (isset($settings['showvideodesc']) ? $cff_show_video_desc = $settings[ 'showvideodesc' ] : $cff_show_video_desc = true);

    //***POST LAYOUT***
    isset($custom['layout']) ? $cff_preset_layout = $custom[ 'layout' ] : (isset($settings['layout']) ? $cff_preset_layout = $settings[ 'layout' ] : $cff_preset_layout = 'thumb');
    isset($custom['enablenarrow']) ? $cff_enable_narrow = $custom[ 'enablenarrow' ] : (isset($settings['enablenarrow']) ? $cff_enable_narrow = $settings[ 'enablenarrow' ] : $cff_enable_narrow = true);
    ( ($cff_enable_narrow == 'true' || $cff_enable_narrow == true) && $cff_enable_narrow !== 'false' ) ? $cff_enable_narrow = true : $cff_enable_narrow = false;
    isset($custom['mediaposition']) ? $cff_media_position = $custom[ 'mediaposition' ] : (isset($settings['mediaposition']) ? $cff_media_position = $settings[ 'mediaposition' ] : $cff_media_position = 'below');

    //***POST TYPES***
    isset($custom['type']) ? $cff_type = $custom[ 'type' ] : (isset($settings['type']) ? $cff_type = $settings[ 'type' ] : $cff_type = 'status,events,videos,photos,links,albums');
    //Set to false by default
    $cff_show_links_type = false;
    $cff_show_event_type = false;
    $cff_show_video_type = false;
    $cff_show_photos_type = false;
    $cff_show_status_type = false;
    $cff_show_albums_type = false;
    //Look for non-plural version of string in the types string in case user specifies singular in settings
    if ( stripos($cff_type, 'link') !== false ) $cff_show_links_type = true;
    if ( stripos($cff_type, 'event') !== false ) $cff_show_event_type = true;
    if ( stripos($cff_type, 'video') !== false ) $cff_show_video_type = true;
    if ( stripos($cff_type, 'photo') !== false ) $cff_show_photos_type = true;
    if ( stripos($cff_type, 'status') !== false ) $cff_show_status_type = true;
    if ( stripos($cff_type, 'album') !== false ) $cff_show_albums_type = true;

    //***POST INCLUDES***
    isset($custom['include']) ? $cff_includes = $custom[ 'include' ] : (isset($settings['include']) ? $cff_includes = $settings[ 'include' ] : $cff_includes = 'author,text,desc,sharedlinks,date,media,eventtitle,eventdetails,social,link,likebox');
    //Look for non-plural version of string in the types string in case user specifies singular in settings
    $cff_show_author = false;
    $cff_show_text = false;
    $cff_show_desc = false;
    $cff_show_shared_links = false;
    $cff_show_date = false;
    $cff_show_media = false;
    $cff_show_event_title = false;
    $cff_show_event_details = false;
    $cff_show_meta = false;
    $cff_show_link = false;
    $cff_show_like_box = false;
    if ( stripos($cff_includes, 'author') !== false ) $cff_show_author = true;
    if ( stripos($cff_includes, 'text') !== false ) $cff_show_text = true;
    if ( stripos($cff_includes, 'desc') !== false ) $cff_show_desc = true;
    if ( stripos($cff_includes, 'sharedlink') !== false ) $cff_show_shared_links = true;
    if ( stripos($cff_includes, 'date') !== false ) $cff_show_date = true;
    if ( stripos($cff_includes, 'media') !== false ) $cff_show_media = true;
    if ( stripos($cff_includes, 'eventtitle') !== false ) $cff_show_event_title = true;
    if ( stripos($cff_includes, 'eventdetail') !== false ) $cff_show_event_details = true;
    if ( stripos($cff_includes, 'social') !== false ) $cff_show_meta = true;
    if ( stripos($cff_includes, ',link') !== false ) $cff_show_link = true;
    if ( stripos($cff_includes, 'like') !== false ) $cff_show_like_box = true;
    
    //Exclude
    isset($custom['exclude']) ? $cff_excludes = $custom[ 'exclude' ] : (isset($settings['exclude']) ? $cff_excludes = $settings[ 'exclude' ] : $cff_excludes = '');
    //Look for non-plural version of string in the types string in case user specifies singular in shortcode
    if ( stripos($cff_excludes, 'author') !== false ) $cff_show_author = false;
    if ( stripos($cff_excludes, 'text') !== false ) $cff_show_text = false;
    if ( stripos($cff_excludes, 'desc') !== false ) $cff_show_desc = false;
    if ( stripos($cff_excludes, 'sharedlink') !== false ) $cff_show_shared_links = false;
    if ( stripos($cff_excludes, 'date') !== false ) $cff_show_date = false;
    if ( stripos($cff_excludes, 'media') !== false ) $cff_show_media = false;
    if ( stripos($cff_excludes, 'eventtitle') !== false ) $cff_show_event_title = false;
    if ( stripos($cff_excludes, 'eventdetail') !== false ) $cff_show_event_details = false;
    if ( stripos($cff_excludes, 'social') !== false ) $cff_show_meta = false;
    if ( stripos($cff_excludes, ',link') !== false ) $cff_show_link = false;
    if ( stripos($cff_excludes, 'like') !== false ) $cff_show_like_box = false;

    //*Post Styling*
    isset($custom['postbgcolor']) ? $cff_post_bg_color = $custom[ 'postbgcolor' ] : (isset($settings['postbgcolor']) ? $cff_post_bg_color = $settings[ 'postbgcolor' ] : $cff_post_bg_color = '');
    isset($custom['postcorners']) ? $cff_post_rounded = $custom[ 'postcorners' ] : (isset($settings['postcorners']) ? $cff_post_rounded = $settings[ 'postcorners' ] : $cff_post_rounded = '0');


    //***TYPOGRAPHY***
    //*Text limits*
    isset($custom['textlength']) ? $title_limit = $custom[ 'textlength' ] : (isset($settings['textlength']) ? $title_limit = $settings[ 'textlength' ] : $title_limit = 99999);
    isset($custom['desclength']) ? $body_limit = $custom[ 'desclength' ] : (isset($settings['desclength']) ? $body_limit = $settings[ 'desclength' ] : $body_limit = 99999);

    //*Author*
    isset($custom['authorsize']) ? $cff_author_size = $custom[ 'authorsize' ] : (isset($settings['authorsize']) ? $cff_author_size = $settings[ 'authorsize' ] : $cff_author_size = '');
    isset($custom['authorcolor']) ? $cff_author_color = $custom[ 'authorcolor' ] : (isset($settings['authorcolor']) ? $cff_author_color = $settings[ 'authorcolor' ] : $cff_author_color = '');

    //*Post text*
    isset($custom['textformat']) ? $cff_title_format = $custom[ 'textformat' ] : (isset($settings['textformat']) ? $cff_title_format = $settings[ 'textformat' ] : $cff_title_format = '');
    isset($custom['textsize']) ? $cff_title_size = $custom[ 'textsize' ] : (isset($settings['textsize']) ? $cff_title_size = $settings[ 'textsize' ] : $cff_title_size = '');
    isset($custom['textweight']) ? $cff_title_weight = $custom[ 'textweight' ] : (isset($settings['textweight']) ? $cff_title_weight = $settings[ 'textweight' ] : $cff_title_weight = '');
    isset($custom['textcolor']) ? $cff_title_color = $custom[ 'textcolor' ] : (isset($settings['textcolor']) ? $cff_title_color = $settings[ 'textcolor' ] : $cff_title_color = '');
    isset($custom['textlink']) ? $cff_title_link = $custom[ 'textlink' ] : (isset($settings['textlink']) ? $cff_title_link = $settings[ 'textlink' ] : $cff_title_link = false);
    isset($custom['posttags']) ? $cff_post_tags = $custom[ 'posttags' ] : (isset($settings['posttags']) ? $cff_post_tags = $settings[ 'posttags' ] : $cff_post_tags = true);
    isset($custom['textlinkcolor']) ? $cff_posttext_link_color = $custom[ 'textlinkcolor' ] : (isset($settings['textlinkcolor']) ? $cff_posttext_link_color = $settings[ 'textlinkcolor' ] : $cff_posttext_link_color = '');
    isset($custom['linkhashtags']) ? $cff_link_hashtags = $custom[ 'linkhashtags' ] : (isset($settings['linkhashtags']) ? $cff_link_hashtags = $settings[ 'linkhashtags' ] : $cff_link_hashtags = true);



    //*Description text*
    isset($custom['descsize']) ? $cff_body_size = $custom[ 'descsize' ] : (isset($settings['descsize']) ? $cff_body_size = $settings[ 'descsize' ] : $cff_body_size = '12');
    isset($custom['descweight']) ? $cff_body_weight = $custom[ 'descweight' ] : (isset($settings['descweight']) ? $cff_body_weight = $settings[ 'descweight' ] : $cff_body_weight = '');
    isset($custom['desccolor']) ? $cff_body_color = $custom[ 'desccolor' ] : (isset($settings['desccolor']) ? $cff_body_color = $settings[ 'desccolor' ] : $cff_body_color = '');

    //*Shared link box*
    isset($custom['linktitleformat']) ? $cff_link_title_format = $custom[ 'linktitleformat' ] : (isset($settings['linktitleformat']) ? $cff_link_title_format = $settings[ 'linktitleformat' ] : $cff_link_title_format = 'p');
    isset($custom['linktitlesize']) ? $cff_link_title_size = $custom[ 'linktitlesize' ] : (isset($settings['linktitlesize']) ? $cff_link_title_size = $settings[ 'linktitlesize' ] : $cff_link_title_size = '');
    isset($custom['linktitlecolor']) ? $cff_link_title_color = $custom[ 'linktitlecolor' ] : (isset($settings['linktitlecolor']) ? $cff_link_title_color = $settings[ 'linktitlecolor' ] : $cff_link_title_color = '');
    isset($custom['linkurlcolor']) ? $cff_link_url_color = $custom[ 'linkurlcolor' ] : (isset($settings['linkurlcolor']) ? $cff_link_url_color = $settings[ 'linkurlcolor' ] : $cff_link_url_color = '');
    isset($custom['linkbgcolor']) ? $cff_link_bg_color = $custom[ 'linkbgcolor' ] : (isset($settings['linkbgcolor']) ? $cff_link_bg_color = $settings[ 'linkbgcolor' ] : $cff_link_bg_color = '');
    isset($custom['linkbordercolor']) ? $cff_link_border_color = $custom[ 'linkbordercolor' ] : (isset($settings['linkbordercolor']) ? $cff_link_border_color = $settings[ 'linkbordercolor' ] : $cff_link_border_color = '');
    isset($custom['disablelinkbox']) ? $cff_disable_link_box = $custom[ 'disablelinkbox' ] : (isset($settings['disablelinkbox']) ? $cff_disable_link_box = $settings[ 'disablelinkbox' ] : $cff_disable_link_box = false);
    ( ($cff_disable_link_box == 'true' || $cff_disable_link_box == true) && $cff_disable_link_box !== 'false' ) ? $cff_disable_link_box = true : $cff_disable_link_box = false;
    isset($custom['fulllinkimages']) ? $cff_full_link_images = $custom[ 'fulllinkimages' ] : (isset($settings['fulllinkimages']) ? $cff_full_link_images = $settings[ 'fulllinkimages' ] : $cff_full_link_images = false);

    //*Event title*
    isset($custom['eventtitleformat']) ? $cff_event_title_format = $custom[ 'eventtitleformat' ] : (isset($settings['eventtitleformat']) ? $cff_event_title_format = $settings[ 'eventtitleformat' ] : $cff_event_title_format = 'p');
    isset($custom['eventtitlesize']) ? $cff_event_title_size = $custom[ 'eventtitlesize' ] : (isset($settings['eventtitlesize']) ? $cff_event_title_size = $settings[ 'eventtitlesize' ] : $cff_event_title_size = '');
    isset($custom['eventtitleweight']) ? $cff_event_title_weight = $custom[ 'eventtitleweight' ] : (isset($settings['eventtitleweight']) ? $cff_event_title_weight = $settings[ 'eventtitleweight' ] : $cff_event_title_weight = '');
    isset($custom['eventtitlecolor']) ? $cff_event_title_color = $custom[ 'eventtitlecolor' ] : (isset($settings['eventtitlecolor']) ? $cff_event_title_color = $settings[ 'eventtitlecolor' ] : $cff_event_title_color = '');
    isset($custom['eventtitlelink']) ? $cff_event_title_link = $custom[ 'eventtitlelink' ] : (isset($settings['eventtitlelink']) ? $cff_event_title_link = $settings[ 'eventtitlelink' ] : $cff_event_title_link = false);
    //*Event details text*
    isset($custom['eventdetailssize']) ? $cff_event_details_size = $custom[ 'eventdetailssize' ] : (isset($settings['eventdetailssize']) ? $cff_event_details_size = $settings[ 'eventdetailssize' ] : $cff_event_details_size = '');
    isset($custom['eventdetailsweight']) ? $cff_event_details_weight = $custom[ 'eventdetailsweight' ] : (isset($settings['eventdetailsweight']) ? $cff_event_details_weight = $settings[ 'eventdetailsweight' ] : $cff_event_details_weight = '');
    isset($custom['eventdetailscolor']) ? $cff_event_details_color = $custom[ 'eventdetailscolor' ] : (isset($settings['eventdetailscolor']) ? $cff_event_details_color = $settings[ 'eventdetailscolor' ] : $cff_event_details_color = '');
    isset($custom['eventlinkcolor']) ? $cff_event_link_color = $custom[ 'eventlinkcolor' ] : (isset($settings['eventlinkcolor']) ? $cff_event_link_color = $settings[ 'eventlinkcolor' ] : $cff_event_link_color = '');

    //Event date
    isset($custom['eventdatesize']) ? $cff_event_date_size = $custom[ 'eventdatesize' ] : (isset($settings['eventdatesize']) ? $cff_event_date_size = $settings[ 'eventdatesize' ] : $cff_event_date_size = '');
    isset($custom['eventdateweight']) ? $cff_event_date_weight = $custom[ 'eventdateweight' ] : (isset($settings['eventdateweight']) ? $cff_event_date_weight = $settings[ 'eventdateweight' ] : $cff_event_date_weight = '');
    isset($custom['eventdatecolor']) ? $cff_event_date_color = $custom[ 'eventdatecolor' ] : (isset($settings['eventdatecolor']) ? $cff_event_date_color = $settings[ 'eventdatecolor' ] : $cff_event_date_color = '');
    isset($custom['eventdatepos']) ? $cff_event_date_position = $custom[ 'eventdatepos' ] : (isset($settings['eventdatepos']) ? $cff_event_date_position = $settings[ 'eventdatepos' ] : $cff_event_date_position = 'top');
    isset($custom['eventdateformat']) ? $cff_event_date_formatting = $custom[ 'eventdateformat' ] : (isset($settings['eventdateformat']) ? $cff_event_date_formatting = $settings[ 'eventdateformat' ] : $cff_event_date_formatting = 1);
    isset($custom['eventdatecustom']) ? $cff_event_date_custom = $custom[ 'eventdatecustom' ] : (isset($settings['eventdatecustom']) ? $cff_event_date_custom = $settings[ 'eventdatecustom' ] : $cff_event_date_custom = '');
    //*Post date*
    isset($custom['datepos']) ? $cff_date_position = $custom[ 'datepos' ] : (isset($settings['datepos']) ? $cff_date_position = $settings[ 'datepos' ] : $cff_date_position = 'author');
    isset($custom['datesize']) ? $cff_date_size = $custom[ 'datesize' ] : (isset($settings['datesize']) ? $cff_date_size = $settings[ 'datesize' ] : $cff_date_size = '');
    isset($custom['dateweight']) ? $cff_date_weight = $custom[ 'dateweight' ] : (isset($settings['dateweight']) ? $cff_date_weight = $settings[ 'dateweight' ] : $cff_date_weight = '');
    isset($custom['datecolor']) ? $cff_date_color = $custom[ 'datecolor' ] : (isset($settings['datecolor']) ? $cff_date_color = $settings[ 'datecolor' ] : $cff_date_color = '');
    isset($custom['dateformat']) ? $cff_date_formatting = $custom[ 'dateformat' ] : (isset($settings['dateformat']) ? $cff_date_formatting = $settings[ 'dateformat' ] : $cff_date_formatting = 1);
    isset($custom['datecustom']) ? $cff_date_custom = $custom[ 'datecustom' ] : (isset($settings['datecustom']) ? $cff_date_custom = $settings[ 'datecustom' ] : $cff_date_custom = '');
    isset($custom['beforedate']) ? $cff_date_before = $custom[ 'beforedate' ] : (isset($settings['beforedate']) ? $cff_date_before = $settings[ 'beforedate' ] : $cff_date_before = '');
    isset($custom['afterdate']) ? $cff_date_after = $custom[ 'afterdate' ] : (isset($settings['afterdate']) ? $cff_date_after = $settings[ 'afterdate' ] : $cff_date_after = '');
    isset($custom['timezone']) ? $cff_timezone = $custom[ 'timezone' ] : (isset($settings['timezone']) ? $cff_timezone = $settings[ 'timezone' ] : $cff_timezone = '');
    //*View on Facebook/View Link*
    isset($custom['linksize']) ? $cff_link_size = $custom[ 'linksize' ] : (isset($settings['linksize']) ? $cff_link_size = $settings[ 'linksize' ] : $cff_link_size = '');
    isset($custom['linkweight']) ? $cff_link_weight = $custom[ 'linkweight' ] : (isset($settings['linkweight']) ? $cff_link_weight = $settings[ 'linkweight' ] : $cff_link_weight = '');
    isset($custom['linkcolor']) ? $cff_link_color = $custom[ 'linkcolor' ] : (isset($settings['linkcolor']) ? $cff_link_color = $settings[ 'linkcolor' ] : $cff_link_color = '');
    isset($custom['showfacebooklink']) ? $cff_show_facebook_link = $custom[ 'showfacebooklink' ] : (isset($settings['showfacebooklink']) ? $cff_show_facebook_link = $settings[ 'showfacebooklink' ] : $cff_show_facebook_link = true);
    isset($custom['showsharelink']) ? $cff_show_facebook_share = $custom[ 'showsharelink' ] : (isset($settings['showsharelink']) ? $cff_show_facebook_share = $settings[ 'showsharelink' ] : $cff_show_facebook_share = true);


    //***LIKES, SHARES and COMMENTS***
    isset($custom['iconstyle']) ? $cff_icon_style = $custom[ 'iconstyle' ] : (isset($settings['iconstyle']) ? $cff_icon_style = $settings[ 'iconstyle' ] : $cff_icon_style = 'light');
    isset($custom['socialtextcolor']) ? $cff_meta_text_color = $custom[ 'socialtextcolor' ] : (isset($settings['socialtextcolor']) ? $cff_meta_text_color = $settings[ 'socialtextcolor' ] : $cff_meta_text_color = '');
    isset($custom['socialbgcolor']) ? $cff_meta_bg_color = $custom[ 'socialbgcolor' ] : (isset($settings['socialbgcolor']) ? $cff_meta_bg_color = $settings[ 'socialbgcolor' ] : $cff_meta_bg_color = '');
    isset($custom['sociallinkcolor']) ? $cff_meta_link_color = $custom[ 'sociallinkcolor' ] : (isset($settings['sociallinkcolor']) ? $cff_meta_link_color = $settings[ 'sociallinkcolor' ] : $cff_meta_link_color = '');



    isset($custom['expandcomments']) ? $cff_expand_comments = $custom[ 'expandcomments' ] : (isset($settings['expandcomments']) ? $cff_expand_comments = $settings[ 'expandcomments' ] : $cff_expand_comments = false);
    isset($custom['commentsnum']) ? $cff_comments_num = $custom[ 'commentsnum' ] : (isset($settings['commentsnum']) ? $cff_comments_num = $settings[ 'commentsnum' ] : $cff_comments_num = '4');
    isset($custom['hidecommentimages']) ? $cff_hide_comment_avatars = $custom[ 'hidecommentimages' ] : (isset($settings['hidecommentimages']) ? $cff_hide_comment_avatars = $settings[ 'hidecommentimages' ] : $cff_hide_comment_avatars = false);


    //***MISC***
    //*Like box*
    isset($custom['likeboxpos']) ? $cff_like_box_position = $custom[ 'likeboxpos' ] : (isset($settings['likeboxpos']) ? $cff_like_box_position = $settings[ 'likeboxpos' ] : $cff_like_box_position = 'bottom');
    isset($custom['likeboxoutside']) ? $cff_like_box_outside = $custom[ 'likeboxoutside' ] : (isset($settings['likeboxoutside']) ? $cff_like_box_outside = $settings[ 'likeboxoutside' ] : $cff_like_box_outside = false);
    isset($custom['likeboxcolor']) ? $cff_likebox_bg_color = $custom[ 'likeboxcolor' ] : (isset($settings['likeboxcolor']) ? $cff_likebox_bg_color = $settings[ 'likeboxcolor' ] : $cff_likebox_bg_color = '');
    isset($custom['likeboxtextcolor']) ? $cff_like_box_text_color = $custom[ 'likeboxtextcolor' ] : (isset($settings['likeboxtextcolor']) ? $cff_like_box_text_color = $settings[ 'likeboxtextcolor' ] : $cff_like_box_text_color = 'blue');
    isset($custom['likeboxwidth']) ? $cff_likebox_width = $custom[ 'likeboxwidth' ] : (isset($settings['likeboxwidth']) ? $cff_likebox_width = $settings[ 'likeboxwidth' ] : $cff_likebox_width = '');
    isset($custom['likeboxheight']) ? $cff_likebox_height = $custom[ 'likeboxheight' ] : (isset($settings['likeboxheight']) ? $cff_likebox_height = $settings[ 'likeboxheight' ] : $cff_likebox_height = '');
    isset($custom['likeboxfaces']) ? $cff_like_box_faces = $custom[ 'likeboxfaces' ] : (isset($settings['likeboxfaces']) ? $cff_like_box_faces = $settings[ 'likeboxfaces' ] : $cff_like_box_faces = false);
    isset($custom['likeboxborder']) ? $cff_like_box_border = $custom[ 'likeboxborder' ] : (isset($settings['likeboxborder']) ? $cff_like_box_border = $settings[ 'likeboxborder' ] : $cff_like_box_border = false);
    isset($custom['likeboxcover']) ? $cff_like_box_cover = $custom[ 'likeboxcover' ] : (isset($settings['likeboxcover']) ? $cff_like_box_cover = $settings[ 'likeboxcover' ] : $cff_like_box_cover = true);

    //*Page Header*
    isset($custom['showheader']) ? $cff_show_header = $custom[ 'showheader' ] : (isset($settings['showheader']) ? $cff_show_header = $settings[ 'showheader' ] : $cff_show_header = '');
    isset($custom['headeroutside']) ? $cff_header_outside = $custom[ 'headeroutside' ] : (isset($settings['headeroutside']) ? $cff_header_outside = $settings[ 'headeroutside' ] : $cff_header_outside = false);
    isset($custom['headertext']) ? $cff_header_text = $custom[ 'headertext' ] : (isset($settings['headertext']) ? $cff_header_text = $settings[ 'headertext' ] : $cff_header_text = 'Facebook Feed');
    isset($custom['headerbg']) ? $cff_header_bg_color = $custom[ 'headerbg' ] : (isset($settings['headerbg']) ? $cff_header_bg_color = $settings[ 'headerbg' ] : $cff_header_bg_color = '');
    isset($custom['headerpadding']) ? $cff_header_padding = $custom[ 'headerpadding' ] : (isset($settings['headerpadding']) ? $cff_header_padding = $settings[ 'headerpadding' ] : $cff_header_padding = '');
    isset($custom['headertextsize']) ? $cff_header_text_size = $custom[ 'headertextsize' ] : (isset($settings['headertextsize']) ? $cff_header_text_size = $settings[ 'headertextsize' ] : $cff_header_text_size = '');
    isset($custom['headertextweight']) ? $cff_header_text_weight = $custom[ 'headertextweight' ] : (isset($settings['headertextweight']) ? $cff_header_text_weight = $settings[ 'headertextweight' ] : $cff_header_text_weight = '');
    isset($custom['headertextcolor']) ? $cff_header_text_color = $custom[ 'headertextcolor' ] : (isset($settings['headertextcolor']) ? $cff_header_text_color = $settings[ 'headertextcolor' ] : $cff_header_text_color = '');
    isset($custom['headericon']) ? $cff_header_icon = $custom[ 'headericon' ] : (isset($settings['headericon']) ? $cff_header_icon = $settings[ 'headericon' ] : $cff_header_icon = 'none');
    isset($custom['headericoncolor']) ? $cff_header_icon_color = $custom[ 'headericoncolor' ] : (isset($settings['headericoncolor']) ? $cff_header_icon_color = $settings[ 'headericoncolor' ] : $cff_header_icon_color = '');
    isset($custom['headericonsize']) ? $cff_header_icon_size = $custom[ 'headericonsize' ] : (isset($settings['headericonsize']) ? $cff_header_icon_size = $settings[ 'headericonsize' ] : $cff_header_icon_size = '28');

    isset($custom['credit']) ? $cff_show_credit = $custom[ 'credit' ] : (isset($settings['credit']) ? $cff_show_credit = $settings[ 'credit' ] : $cff_show_credit = false);
    isset($custom['nofollow']) ? $cff_nofollow = $custom[ 'nofollow' ] : (isset($settings['nofollow']) ? $cff_nofollow = $settings[ 'nofollow' ] : $cff_nofollow = true);
    isset($custom['appid']) ? $cff_app_id = $custom[ 'appid' ] : (isset($settings['appid']) ? $cff_app_id = $settings[ 'appid' ] : $cff_app_id = '');


    //Video
    isset($custom['videoaction']) ? $cff_video_action = $custom[ 'videoaction' ] : (isset($settings['videoaction']) ? $cff_video_action = $settings[ 'videoaction' ] : $cff_video_action = 'playvideo');
    //*Separating line
    isset($custom['sepcolor']) ? $cff_sep_color = $custom[ 'sepcolor' ] : (isset($settings['sepcolor']) ? $cff_sep_color = $settings[ 'sepcolor' ] : $cff_sep_color = '');
    isset($custom['sepsize']) ? $cff_sep_size = $custom[ 'sepsize' ] : (isset($settings['sepsize']) ? $cff_sep_size = $settings[ 'sepsize' ] : $cff_sep_size = 1);

    //***CUSTOM TEXT / TRANSLATE***
    isset($custom['seemoretext']) ? $cff_see_more_text = $custom[ 'seemoretext' ] : (isset($settings['seemoretext']) ? $cff_see_more_text = $settings[ 'seemoretext' ] : $cff_see_more_text = 'See more');
    isset($custom['seelesstext']) ? $cff_see_less_text = $custom[ 'seelesstext' ] : (isset($settings['seelesstext']) ? $cff_see_less_text = $settings[ 'seelesstext' ] : $cff_see_less_text = 'See less');
    isset($custom['facebooklinktext']) ? $cff_facebook_link_text = $custom[ 'facebooklinktext' ] : (isset($settings['facebooklinktext']) ? $cff_facebook_link_text = $settings[ 'facebooklinktext' ] : $cff_facebook_link_text = 'View on Facebook');
    isset($custom['sharelinktext']) ? $cff_facebook_share_text = $custom[ 'sharelinktext' ] : (isset($settings['sharelinktext']) ? $cff_facebook_share_text = $settings[ 'sharelinktext' ] : $cff_facebook_share_text = 'Share');
    isset($custom['maptext']) ? $cff_map_text = $custom[ 'maptext' ] : (isset($settings['maptext']) ? $cff_map_text = $settings[ 'maptext' ] : $cff_map_text = 'Map');
    isset($custom['buyticketstext']) ? $cff_buy_tickets_text = $custom[ 'buyticketstext' ] : (isset($settings['buyticketstext']) ? $cff_buy_tickets_text = $settings[ 'buyticketstext' ] : $cff_buy_tickets_text = 'Buy tickets');

    //Translate - social
    isset($custom['previouscommentstext']) ? $cff_translate_view_previous_comments_text = $custom[ 'previouscommentstext' ] : (isset($settings['previouscommentstext']) ? $cff_translate_view_previous_comments_text = $settings[ 'previouscommentstext' ] : $cff_translate_view_previous_comments_text = 'View previous comments');
    isset($custom['commentonfacebooktext']) ? $cff_translate_comment_on_facebook_text = $custom[ 'commentonfacebooktext' ] : (isset($settings['commentonfacebooktext']) ? $cff_translate_comment_on_facebook_text = $settings[ 'commentonfacebooktext' ] : $cff_translate_comment_on_facebook_text = 'Comment on Facebook');
    isset($custom['photostext']) ? $cff_translate_photos_text = $custom[ 'photostext' ] : (isset($settings['photostext']) ? $cff_translate_photos_text = $settings[ 'photostext' ] : $cff_translate_photos_text = 'photos');
    isset($custom['likesthistext']) ? $cff_translate_likes_this_text = $custom[ 'likesthistext' ] : (isset($settings['likesthistext']) ? $cff_translate_likes_this_text = $settings[ 'likesthistext' ] : $cff_translate_likes_this_text = 'likes this');
    isset($custom['likethistext']) ? $cff_translate_like_this_text = $custom[ 'likethistext' ] : (isset($settings['likethistext']) ? $cff_translate_like_this_text = $settings[ 'likethistext' ] : $cff_translate_like_this_text = 'like this');
    isset($custom['andtext']) ? $cff_translate_and_text = $custom[ 'andtext' ] : (isset($settings['andtext']) ? $cff_translate_and_text = $settings[ 'andtext' ] : $cff_translate_and_text = 'and');
    isset($custom['othertext']) ? $cff_translate_other_text = $custom[ 'othertext' ] : (isset($settings['othertext']) ? $cff_translate_other_text = $settings[ 'othertext' ] : $cff_translate_other_text = 'other');
    isset($custom['otherstext']) ? $cff_translate_others_text = $custom[ 'otherstext' ] : (isset($settings['otherstext']) ? $cff_translate_others_text = $settings[ 'otherstext' ] : $cff_translate_others_text = 'others');
    isset($custom['noeventstext']) ? $cff_no_events_text = $custom[ 'noeventstext' ] : (isset($settings['noeventstext']) ? $cff_no_events_text = $settings[ 'noeventstext' ] : $cff_no_events_text = 'No upcoming events');

    isset($custom['replytext']) ? $cff_translate_reply_text = $custom[ 'replytext' ] : (isset($settings['replytext']) ? $cff_translate_reply_text = $settings[ 'replytext' ] : $cff_translate_reply_text = 'reply');
    isset($custom['repliestext']) ? $cff_translate_replies_text = $custom[ 'repliestext' ] : (isset($settings['repliestext']) ? $cff_translate_replies_text = $settings[ 'repliestext' ] : $cff_translate_replies_text = 'replies');



    //Translate - date
    isset($custom['second']) ? $cff_translate_second = $custom[ 'second' ] : (isset($settings['second']) ? $cff_translate_second = $settings[ 'second' ] : $cff_translate_second = 'second');
    isset($custom['seconds']) ? $cff_translate_seconds = $custom[ 'seconds' ] : (isset($settings['seconds']) ? $cff_translate_seconds = $settings[ 'seconds' ] : $cff_translate_seconds = 'seconds');
    isset($custom['minute']) ? $cff_translate_minute = $custom[ 'minute' ] : (isset($settings['minute']) ? $cff_translate_minute = $settings[ 'minute' ] : $cff_translate_minute = 'minute');
    isset($custom['minutes']) ? $cff_translate_minutes = $custom[ 'minutes' ] : (isset($settings['minutes']) ? $cff_translate_minutes = $settings[ 'minutes' ] : $cff_translate_minutes = 'minutes');
    isset($custom['hour']) ? $cff_translate_hour = $custom[ 'hour' ] : (isset($settings['hour']) ? $cff_translate_hour = $settings[ 'hour' ] : $cff_translate_hour = 'hour');
    isset($custom['hours']) ? $cff_translate_hours = $custom[ 'hours' ] : (isset($settings['hours']) ? $cff_translate_hours = $settings[ 'hours' ] : $cff_translate_hours = 'hours');
    isset($custom['day']) ? $cff_translate_day = $custom[ 'day' ] : (isset($settings['day']) ? $cff_translate_day = $settings[ 'day' ] : $cff_translate_day = 'day');
    isset($custom['days']) ? $cff_translate_days = $custom[ 'days' ] : (isset($settings['days']) ? $cff_translate_days = $settings[ 'days' ] : $cff_translate_days = 'days');
    isset($custom['week']) ? $cff_translate_week = $custom[ 'week' ] : (isset($settings['week']) ? $cff_translate_week = $settings[ 'week' ] : $cff_translate_week = 'week');
    isset($custom['weeks']) ? $cff_translate_weeks = $custom[ 'weeks' ] : (isset($settings['weeks']) ? $cff_translate_weeks = $settings[ 'weeks' ] : $cff_translate_weeks = 'weeks');
    isset($custom['month']) ? $cff_translate_month = $custom[ 'month' ] : (isset($settings['month']) ? $cff_translate_month = $settings[ 'month' ] : $cff_translate_month = 'month');
    isset($custom['months']) ? $cff_translate_months = $custom[ 'months' ] : (isset($settings['months']) ? $cff_translate_months = $settings[ 'months' ] : $cff_translate_months = 'months');
    isset($custom['year']) ? $cff_translate_year = $custom[ 'year' ] : (isset($settings['year']) ? $cff_translate_year = $settings[ 'year' ] : $cff_translate_year = 'year');
    isset($custom['years']) ? $cff_translate_years = $custom[ 'years' ] : (isset($settings['years']) ? $cff_translate_years = $settings[ 'years' ] : $cff_translate_years = 'years');
    isset($custom['ago']) ? $cff_translate_ago = $custom[ 'ago' ] : (isset($settings['ago']) ? $cff_translate_ago = $settings[ 'ago' ] : $cff_translate_ago = 'ago');

    //Extensions
    isset($custom['album']) ? $cff_album_id = $custom[ 'album' ] : (isset($settings['album']) ? $cff_album_id = $settings[ 'album' ] : $cff_album_id = '');

    //Compile an array to pass to date functions
    $date_translate_arr = array(
        '$cff_translate_second' => $cff_translate_second,
        '$cff_translate_seconds' => $cff_translate_seconds,
        '$cff_translate_minute' => $cff_translate_minute,
        '$cff_translate_minutes' => $cff_translate_minutes,
        '$cff_translate_hour' => $cff_translate_hour,
        '$cff_translate_hours' => $cff_translate_hours,
        '$cff_translate_day' => $cff_translate_day,
        '$cff_translate_days' => $cff_translate_days,
        '$cff_translate_week' => $cff_translate_week,
        '$cff_translate_weeks' => $cff_translate_weeks,
        '$cff_translate_month' => $cff_translate_month,
        '$cff_translate_months' => $cff_translate_months,
        '$cff_translate_year' => $cff_translate_year,
        '$cff_translate_years' => $cff_translate_years,
        '$cff_translate_ago' => $cff_translate_ago,
    );

    //STANDALONE ONLY
    if( $access_token == $default_token ) $cff_show_access_token = true;
    $cff_ext_multifeed_active = true;
    $cff_ext_date_active = false;
    $cff_featured_post_active = false;
    $cff_album_active = true;

    //COMPILE OPTIONS
    
    /********** GENERAL **********/
    $cff_is_group = false;
    if ($cff_page_type == 'group') $cff_is_group = true;

    if ( empty($cff_locale) || !isset($cff_locale) || $cff_locale == '' ) $cff_locale = 'en_US';

    //Add pixels to width, height and padding if they don't have a unit
    if ( is_numeric(substr($cff_feed_width, -1, 1)) ) $cff_feed_width = $cff_feed_width . 'px';
    if ( is_numeric(substr($cff_feed_height, -1, 1)) ) $cff_feed_height = $cff_feed_height . 'px';
    if ( is_numeric(substr($cff_feed_padding, -1, 1)) ) $cff_feed_padding = $cff_feed_padding . 'px';
    if ( is_numeric(substr($cff_header_padding, -1, 1)) ) $cff_header_padding = $cff_header_padding . 'px';


    //Allow the cache time to be set to zero for the PHP Standalone version so that it can be turned off easily


    //Compile feed styles
    $cff_feed_styles = '';
    if ( !empty($cff_feed_width) || !empty($cff_feed_height) || !empty($cff_feed_padding) || (!empty($cff_bg_color) && $cff_bg_color != '#') ) $cff_feed_styles .= 'style="';
    if ( !empty($cff_feed_width) ) $cff_feed_styles .= 'width:' . $cff_feed_width . '; ';
    if ( !empty($cff_feed_height) ) $cff_feed_styles .= 'height:' . $cff_feed_height . '; ';
    if ( !empty($cff_feed_padding) ) $cff_feed_styles .= 'padding:' . $cff_feed_padding . '; ';
    if ( !empty($cff_bg_color) && $cff_bg_color != '#' ) $cff_feed_styles .= 'background-color:#' . str_replace('#', '', $cff_bg_color) . '; ';
    if ( !empty($cff_feed_width) || !empty($cff_feed_height) || !empty($cff_feed_padding) || (!empty($cff_bg_color) && $cff_bg_color != '#') )$cff_feed_styles .= '"';

    //Like box
    //Open links in new window?
    $target = 'target="_blank"';
    
    //EVENTS ONLY
    $cff_events_only = false;
    if ( empty($cff_events_source) || !isset($cff_events_source) ) $cff_events_source = 'eventspage';
    //Are we showing ONLY events?
    if ($cff_show_event_type && !$cff_show_links_type && !$cff_show_video_type && !$cff_show_photos_type && !$cff_show_status_type) $cff_events_only = true;

    //PHOTOS ONLY
    $cff_photos_only = false;
    if ( ($cff_show_photos_type && $cff_photos_source == 'photospage') && !$cff_show_links_type && !$cff_show_video_type && !$cff_show_event_type && !$cff_show_status_type && !$cff_show_albums_type) $cff_photos_only = true;

    //ALBUMS ONLY
    $cff_albums_only = false;
    if ($cff_show_albums_type && !$cff_show_links_type && !$cff_show_video_type && !$cff_show_photos_type && !$cff_show_status_type && !$cff_show_event_type) $cff_albums_only = true;

    //VIDEOS ONLY
    $cff_videos_only = false;
    if ( ($cff_show_video_type && $cff_videos_source == 'videospage') && !$cff_show_albums_type && !$cff_show_links_type && !$cff_show_photos_type && !$cff_show_status_type && !$cff_show_event_type) $cff_videos_only = true;


    //Default is thumbnail layout
    $cff_thumb_layout = false;
    $cff_half_layout = false;
    $cff_full_layout = true;
    if (($cff_preset_layout == 'thumb' || empty($cff_preset_layout)) && $cff_show_media) {
        $cff_thumb_layout = true;
    } else if ($cff_preset_layout == 'half'  && $cff_show_media) {
        $cff_half_layout = true;
    } else {
        $cff_full_layout = true;
    }

    //Get the media position
    if ( $cff_thumb_layout || $cff_half_layout) $cff_media_position = 'below';
    
    /********** META **********/
    $cff_meta_styles = '';
    if ( !empty($cff_meta_text_color) || ( !empty($cff_meta_bg_color) && $cff_meta_bg_color !== '#' ) ) $cff_meta_styles = 'style="';
    if ( !empty($cff_meta_text_color) ) $cff_meta_styles .= 'color:#' . str_replace('#', '', $cff_meta_text_color) . ';';
    if ( !empty($cff_meta_bg_color) && $cff_meta_bg_color !== '#' ) $cff_meta_styles .= 'background-color:#' . str_replace('#', '', $cff_meta_bg_color) . ';';
    if ( !empty($cff_meta_text_color) || ( !empty($cff_meta_bg_color) && $cff_meta_bg_color !== '#' ) ) $cff_meta_styles .= '"';

    $cff_meta_link_color = 'style="color:#' . str_replace('#', '', $cff_meta_link_color) . ';"';


    /********** TYPOGRAPHY **********/

    //Title
    if (empty($cff_title_format)) $cff_title_format = 'p';
    $cff_title_styles = '';
    if( ( !empty($cff_title_size) && $cff_title_size != 'inherit' ) || ( !empty($cff_title_weight) && $cff_title_weight != 'inherit' ) || ( !empty($cff_title_color) && $cff_title_color !== '#' ) ) $cff_title_styles = 'style="';
        if ( !empty($cff_title_size) && $cff_title_size != 'inherit' ) $cff_title_styles .=  'font-size:' . $cff_title_size . 'px; ';
        if ( !empty($cff_title_weight) && $cff_title_weight != 'inherit' ) $cff_title_styles .= 'font-weight:' . $cff_title_weight . '; ';
        if ( !empty($cff_title_color) && $cff_title_color !== '#' ) $cff_title_styles .= 'color:#' . str_replace('#', '', $cff_title_color) . ';';
    if( ( !empty($cff_title_size) && $cff_title_size != 'inherit' ) || ( !empty($cff_title_weight) && $cff_title_weight != 'inherit' ) || ( !empty($cff_title_color) && $cff_title_color !== '#' ) ) $cff_title_styles .= '"';

    //Author
    $cff_author_styles = '';
    if( ( !empty($cff_author_size) && $cff_author_size != 'inherit' ) || ( !empty($cff_author_color) && $cff_author_color !== '#' ) ) $cff_author_styles = 'style="';
        if ( !empty($cff_author_size) && $cff_author_size != 'inherit' ) $cff_author_styles .=  'font-size:' . $cff_author_size . 'px; ';
        if ( !empty($cff_author_color) && $cff_author_color !== '#' ) $cff_author_styles .= 'color:#' . str_replace('#', '', $cff_author_color) . ';';
    if( ( !empty($cff_author_size) && $cff_author_size != 'inherit' ) || ( !empty($cff_author_color) && $cff_author_color !== '#' ) ) $cff_author_styles .= '"';

    //Description
    $cff_body_styles = '';
    if( ( !empty($cff_body_size) && $cff_body_size != 'inherit' ) || ( !empty($cff_body_weight) && $cff_body_weight != 'inherit' ) || ( !empty($cff_body_color) && $cff_body_color !== '#' ) ) $cff_body_styles = 'style="';
        if ( !empty($cff_body_size) && $cff_body_size != 'inherit' ) $cff_body_styles .=  'font-size:' . $cff_body_size . 'px; ';
        if ( !empty($cff_body_weight) && $cff_body_weight != 'inherit' ) $cff_body_styles .= 'font-weight:' . $cff_body_weight . '; ';
        if ( !empty($cff_body_color) && $cff_body_color !== '#' ) $cff_body_styles .= 'color:#' . str_replace('#', '', $cff_body_color) . ';';
    if( ( !empty($cff_body_size) && $cff_body_size != 'inherit' ) || ( !empty($cff_body_weight) && $cff_body_weight != 'inherit' ) || ( !empty($cff_body_color) && $cff_body_color !== '#' ) ) $cff_body_styles .= '"';

    //Shared link title
    $cff_link_title_styles = '';
    if ( !empty($cff_link_title_size) && $cff_link_title_size != 'inherit' ) $cff_link_title_styles =  'style="font-size:' . $cff_link_title_size . 'px;"';

    //Shared link box
    $cff_link_box_styles = '';
    if( !empty($cff_link_border_color) || (!empty($cff_link_bg_color) && $cff_link_bg_color !== '#') ) $cff_link_box_styles = 'style="';
        if ( !empty($cff_link_border_color) ) $cff_link_box_styles .=  'border: 1px solid #' . str_replace('#', '', $cff_link_border_color) . '; ';
        if ( !empty($cff_link_bg_color) && $cff_link_bg_color !== '#' ) $cff_link_box_styles .= 'background-color: #' . str_replace('#', '', $cff_link_bg_color) . ';';
    if( !empty($cff_link_border_color) || (!empty($cff_link_bg_color) && $cff_link_bg_color !== '#') ) $cff_link_box_styles .= '"';

    //Event Title
    $cff_event_title_styles = '';
    if( ( !empty($cff_event_title_size) && $cff_event_title_size != 'inherit' ) || ( !empty($cff_event_title_weight) && $cff_event_title_weight != 'inherit' ) || ( !empty($cff_event_title_color) && $cff_event_title_color !== '#' ) ) $cff_event_title_styles = 'style="';
        if ( !empty($cff_event_title_size) && $cff_event_title_size != 'inherit' ) $cff_event_title_styles .=  'font-size:' . $cff_event_title_size . 'px; ';
        if ( !empty($cff_event_title_weight) && $cff_event_title_weight != 'inherit' ) $cff_event_title_styles .= 'font-weight:' . $cff_event_title_weight . '; ';
        if ( !empty($cff_event_title_color) && $cff_event_title_color !== '#' ) $cff_event_title_styles .= 'color:#' . str_replace('#', '', $cff_event_title_color) . ';';
    if( ( !empty($cff_event_title_size) && $cff_event_title_size != 'inherit' ) || ( !empty($cff_event_title_weight) && $cff_event_title_weight != 'inherit' ) || ( !empty($cff_event_title_color) && $cff_event_title_color !== '#' ) ) $cff_event_title_styles .= '"';

    //Event Date
    $cff_event_date_styles = '';
    if( ( !empty($cff_event_date_size) && $cff_event_date_size != 'inherit' ) || ( !empty($cff_event_date_weight) && $cff_event_date_weight != 'inherit' ) || ( !empty($cff_event_date_color) && $cff_event_date_color !== '#' ) ) $cff_event_date_styles = 'style="';
        if ( !empty($cff_event_date_size) && $cff_event_date_size != 'inherit' ) $cff_event_date_styles .=  'font-size:' . $cff_event_date_size . 'px; ';
        if ( !empty($cff_event_date_weight) && $cff_event_date_weight != 'inherit' ) $cff_event_date_styles .= 'font-weight:' . $cff_event_date_weight . '; ';
        if ( !empty($cff_event_date_color) && $cff_event_date_color !== '#' ) $cff_event_date_styles .= 'color:#' . str_replace('#', '', $cff_event_date_color) . ';';
    if( ( !empty($cff_event_date_size) && $cff_event_date_size != 'inherit' ) || ( !empty($cff_event_date_weight) && $cff_event_date_weight != 'inherit' ) || ( !empty($cff_event_date_color) && $cff_event_date_color !== '#' ) ) $cff_event_date_styles .= '"';

    //Event Details
    $cff_event_details_styles = '';
    if( ( !empty($cff_event_details_size) && $cff_event_details_size != 'inherit' ) || ( !empty($cff_event_details_weight) && $cff_event_details_weight != 'inherit' ) || ( !empty($cff_event_details_color) && $cff_event_details_color !== '#' ) ) $cff_event_details_styles = 'style="';
        if ( !empty($cff_event_details_size) && $cff_event_details_size != 'inherit' ) $cff_event_details_styles .=  'font-size:' . $cff_event_details_size . 'px; ';
        if ( !empty($cff_event_details_weight) && $cff_event_details_weight != 'inherit' ) $cff_event_details_styles .= 'font-weight:' . $cff_event_details_weight . '; ';
        if ( !empty($cff_event_details_color) && $cff_event_details_color !== '#' ) $cff_event_details_styles .= 'color:#' . str_replace('#', '', $cff_event_details_color) . ';';
    if( ( !empty($cff_event_details_size) && $cff_event_details_size != 'inherit' ) || ( !empty($cff_event_details_weight) && $cff_event_details_weight != 'inherit' ) || ( !empty($cff_event_details_color) && $cff_event_details_color !== '#' ) ) $cff_event_details_styles .= '"';

    //Date
    if (!isset($cff_date_position)) $cff_date_position = 'author';
    $cff_date_styles = '';
    if( ( !empty($cff_date_size) && $cff_date_size != 'inherit' ) || ( !empty($cff_date_weight) && $cff_date_weight != 'inherit' ) || ( !empty($cff_date_color) && $cff_date_color !== '#' ) ) $cff_date_styles = 'style="';
        if ( !empty($cff_date_size) && $cff_date_size != 'inherit' ) $cff_date_styles .=  'font-size:' . $cff_date_size . 'px; ';
        if ( !empty($cff_date_weight) && $cff_date_weight != 'inherit' ) $cff_date_styles .= 'font-weight:' . $cff_date_weight . '; ';
        if ( !empty($cff_date_color) && $cff_date_color !== '#' ) $cff_date_styles .= 'color:#' . str_replace('#', '', $cff_date_color) . ';';
    if( ( !empty($cff_date_size) && $cff_date_size != 'inherit' ) || ( !empty($cff_date_weight) && $cff_date_weight != 'inherit' ) || ( !empty($cff_date_color) && $cff_date_color !== '#' ) ) $cff_date_styles .= '"';    

    //Set user's timezone based on setting
    $cff_orig_timezone = date_default_timezone_get();
    if(!empty($cff_timezone)) date_default_timezone_set($cff_timezone);

    //Link to Facebook
    $cff_link_styles = '';
    if( ( !empty($cff_link_size) && $cff_link_size != 'inherit' ) || ( !empty($cff_link_weight) && $cff_link_weight != 'inherit' ) || ( !empty($cff_link_color) && $cff_link_color !== '#' ) ) $cff_link_styles = 'style="';
        if ( !empty($cff_link_size) && $cff_link_size != 'inherit' ) $cff_link_styles .=  'font-size:' . $cff_link_size . 'px; ';
        if ( !empty($cff_link_weight) && $cff_link_weight != 'inherit' ) $cff_link_styles .= 'font-weight:' . $cff_link_weight . '; ';
        if ( !empty($cff_link_color) && $cff_link_color !== '#' ) $cff_link_styles .= 'color:#' . str_replace('#', '', $cff_link_color) . ';';
    if( ( !empty($cff_link_size) && $cff_link_size != 'inherit' ) || ( !empty($cff_link_weight) && $cff_link_weight != 'inherit' ) || ( !empty($cff_link_color) && $cff_link_color !== '#' ) ) $cff_link_styles .= '"';

    /********** MISC **********/
    //Like Box styles
    $cff_like_box_colorscheme = 'light';
    if ($cff_like_box_text_color == 'white') $cff_like_box_colorscheme = 'dark';
    $cff_likebox_height = preg_replace('/px$/', '', $cff_likebox_height);

    if ( !isset($cff_likebox_width) || empty($cff_likebox_width) || $cff_likebox_width == '' ) $cff_likebox_width = '100%';
    if ( !isset($cff_like_box_faces) || empty($cff_like_box_faces) ) $cff_like_box_faces = 'false';
    if ($cff_like_box_cover) {
        $cff_like_box_cover = 'false';
    } else {
        $cff_like_box_cover = 'true';
    }

    //Compile Like box styles
    $cff_likebox_styles = 'style="width: ' . $cff_likebox_width . ';';
    if ( !empty($cff_likebox_bg_color) ) $cff_likebox_styles .= ' background-color:#' . str_replace('#', '', $cff_likebox_bg_color) . ';';

    //Set the left margin on the like box based on how it's being displayed
    if ( (!empty($cff_likebox_bg_color) && $cff_likebox_bg_color != '#') || ($cff_like_box_faces == 'true' || $cff_like_box_faces == 'on') ) $cff_likebox_styles .= ' margin-left: 0px;';  

    $cff_likebox_styles .= '"';

    //Get feed header settings
    if ( is_numeric(substr($cff_header_padding, -1, 1)) ) $cff_header_padding = $cff_header_padding . 'px';

    //Compile feed header styles
    $cff_header_styles = '';
    if( ( !empty($cff_header_bg_color) && $cff_header_bg_color !== '#' ) || !empty($cff_header_padding) || ( !empty($cff_header_text_size) && $cff_header_text_size != 'inherit' ) || ( !empty($cff_header_text_weight) && $cff_header_text_weight != 'inherit' ) || (!empty($cff_header_text_color) && $cff_header_text_color !== '#') ) $cff_header_styles = 'style="';
        if ( !empty($cff_header_bg_color) && $cff_header_bg_color !== '#' ) $cff_header_styles .= 'background-color: #' . str_replace('#', '', $cff_header_bg_color) . '; ';
        if ( !empty($cff_header_padding) ) $cff_header_styles .= 'padding: ' . $cff_header_padding . '; ';
        if ( !empty($cff_header_text_size) && $cff_header_text_size != 'inherit' ) $cff_header_styles .= 'font-size: ' . $cff_header_text_size . 'px; ';
        if ( !empty($cff_header_text_weight) && $cff_header_text_weight != 'inherit' ) $cff_header_styles .= 'font-weight: ' . $cff_header_text_weight . '; ';
        if ( !empty($cff_header_text_color) && $cff_header_text_color !== '#' ) $cff_header_styles .= 'color: #' . str_replace('#', '', $cff_header_text_color) . '; ';
    if( ( !empty($cff_header_bg_color) && $cff_header_bg_color !== '#' ) || !empty($cff_header_padding) || ( !empty($cff_header_text_size) && $cff_header_text_size != 'inherit' ) || ( !empty($cff_header_text_weight) && $cff_header_text_weight != 'inherit' ) || (!empty($cff_header_text_color) && $cff_header_text_color !== '#') ) $cff_header_styles .= '"';


    //If empty then set a 0px border
    if (empty($cff_sep_color)) $cff_sep_color = 'ddd';
    if ( empty($cff_sep_size) || $cff_sep_size == '' ) {
        $cff_sep_size = 0;
        //Need to set a color otherwise the CSS is invalid
        $cff_sep_color = 'fff';
    }
    ($cff_post_bg_color !== '#' && $cff_post_bg_color !== '') ? $cff_post_bg_color_check = true : $cff_post_bg_color_check = false;
    ($cff_sep_color !== '#' && $cff_sep_color !== '') ? $cff_sep_color_check = true : $cff_sep_color_check = false;


    //CFF item styles
    $cff_item_styles = '';
    if( $cff_sep_color_check || $cff_post_bg_color_check ){
        $cff_item_styles = 'style="';
        if($cff_sep_color_check && !$cff_post_bg_color_check) $cff_item_styles .= 'border-bottom: ' . $cff_sep_size . 'px solid #' . str_replace('#', '', $cff_sep_color) . '; ';
        if($cff_post_bg_color_check) $cff_item_styles .= 'background-color: #' . str_replace('#', '', $cff_post_bg_color ) . '; ';
        if(isset($cff_post_rounded) && $cff_post_rounded !== '0') $cff_item_styles .= '-webkit-border-radius: ' . $cff_post_rounded . 'px; -moz-border-radius: ' . $cff_post_rounded . 'px; border-radius: ' . $cff_post_rounded . 'px; ';
        $cff_item_styles .= '"';
    }
   
    //Text limits
    if (!isset($title_limit)) $title_limit = 9999;

    //If user pastes their full URL into the Page ID field then strip it out
    $cff_facebook_string = 'facebook.com';
    ( stripos($page_id, $cff_facebook_string) !== false) ? $cff_page_id_url_check = true : $cff_page_id_url_check = false;
    
    if ( $cff_page_id_url_check === true ) {
        //Remove trailing slash if exists
        $page_id = preg_replace('{/$}', '', $page_id);
        //Get last part of url
        $page_id = substr( $page_id, strrpos( $page_id, '/' )+1 );
    }

    //If the Page ID contains a query string at the end then remove it
    if ( stripos( $page_id, '?') !== false ) $page_id = substr($page_id, 0, strrpos($page_id, '?'));


    //Get show posts attribute. If not set then default to 25
    if (empty($show_posts)) $show_posts = 25;
    if ( $show_posts == 0 || $show_posts == 'undefined' ) $show_posts = 25;

    //FQL tokens
    $access_token_array_fql = array(
        '282595515249010|6WgldrfrkAB3R4pQQ3gw8sBB17M'
    );
    //If displaying events only, photos only or featured post then use an FQL token
    if ( ($cff_events_only && !$cff_is_group) || $cff_photos_only ) $access_token = $access_token_array_fql[0];


    //Check whether a Page ID has been defined
    if ($page_id == '') {
        echo "Please enter the Page ID of the Facebook feed you'd like to display. You can do this in either the fbfeed-settings.php file or in the 'fbFeed' function itself.";
        return false;
    }

    //Is it SSL?
    if ($cff_ssl) $cff_ssl = '&return_ssl_resources=true';

    //Use posts? or feed?
    $graph_query = 'posts';
    $cff_show_only_others = false;

    //If 'others' shortcode option is used then it overrides any other option
    if ($show_others) {

        //Show posts by everyone
        if ( $show_others == 'on' || $show_others == 'true' || $show_others == true || $cff_is_group ) $graph_query = 'feed';

        //Only show posts by me
        if ( $show_others == 'false' ) $graph_query = 'posts';

    } else {
    //Else use the settings page option or the 'showpostsby' shortcode option

        //Only show posts by me
        if ( $show_posts_by == 'me' ) $graph_query = 'posts';

        //Show posts by everyone
        if ( $show_posts_by == 'others' || $cff_is_group ) $graph_query = 'feed';

        //Show posts ONLY by others
        if ( $show_posts_by == 'onlyothers' && !$cff_is_group ) {
            $graph_query = 'feed';
            $cff_show_only_others = true;
        }

    }

    //If the limit isn't set then set it to be 5 more than the number of posts defined
    if ( empty($cff_post_limit) || $cff_post_limit == '' ) {
        $cff_post_limit = intval(intval($show_posts) + 7);
    }

    //Calculate the cache time in seconds
    if($cff_cache_time_unit == 'minutes') $cff_cache_time_unit = 60;
    if($cff_cache_time_unit == 'hours') $cff_cache_time_unit = 60*60;
    if($cff_cache_time_unit == 'days') $cff_cache_time_unit = 60*60*24;
    $cache_seconds = $cff_cache_time * $cff_cache_time_unit;

    //Set like box variable
    ( isset($cff_app_id) && !empty($cff_app_id) ) ? $cff_like_box_params = '&appId=' .$cff_app_id : $cff_like_box_params = '';
    $like_box_page_id = explode(",", str_replace(' ', '', $page_id) );
    $like_box = '<div class="cff-likebox';
    if ($cff_like_box_outside) $like_box .= ' cff-outside';
    $like_box .= ($cff_like_box_position == 'top') ? ' cff-top' : ' cff-bottom';
    $like_box .= '" ><script src="https://connect.facebook.net/' . $cff_locale . '/all.js#xfbml=1'.$cff_like_box_params.'"></script><div class="fb-page" data-href="https://www.facebook.com/'.$like_box_page_id[0].'" data-width="'.$cff_likebox_width.'" data-hide-cover="'.$cff_like_box_cover.'" data-show-facepile="'.$cff_like_box_faces.'" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/'.$like_box_page_id[0].'"><a href="https://www.facebook.com/'.$like_box_page_id[0].'">'.$cff_facebook_link_text.'</a></blockquote></div></div><div id="fb-root"></div></div>';

    //Don't show like box if it's a group
    if($cff_is_group) $like_box = '';

    //Feed header
    $cff_header = '<h3 class="cff-header';
    if ($cff_header_outside) $cff_header .= ' cff-outside';
    $cff_header .= '" ' . $cff_header_styles . '>';
    $cff_header .= '<i class="fa fa-' . $cff_header_icon . '"';
    if(!empty($cff_header_icon_color) || !empty($cff_header_icon_size)) $cff_header .= ' style="';
    if(!empty($cff_header_icon_color)) $cff_header .= 'color: #' . str_replace('#', '', $cff_header_icon_color) . ';';
    if(!empty($cff_header_icon_size)) $cff_header .= ' font-size: ' . $cff_header_icon_size . 'px;';
    if(!empty($cff_header_icon_color) || !empty($cff_header_icon_size))$cff_header .= '"';
    $cff_header .= '></i>';
    $cff_header .= '<span class="cff-header-text" style="height: '.$cff_header_icon_size.'px;">' . $cff_header_text . '</span>';
    $cff_header .= '</h3>';


    //If the number of posts is set to zero then don't show any and set limit to one
    if ( $show_posts == 0 || $show_posts == '0' ){
        $show_posts = 0;
        $cff_post_limit = 1;
    }
    
    //***START FEED***
    $cff_content = '';

    //Add the page header to the outside of the top of feed
    if ($cff_show_header && $cff_header_outside) $cff_content .= $cff_header;

    //Add like box to the outside of the top of feed
    if ($cff_like_box_position == 'top' && $cff_show_like_box && $cff_like_box_outside) $cff_content .= $like_box;

    //Create CFF container HTML
    $cff_content .= '<div class="cff-wrapper">';
    $cff_content .= '<div id="cff" ';
    if( !empty($title_limit) ) $cff_content .= 'data-char="'.$title_limit.'" ';
    $cff_content .= 'class="';
    if( !empty($cff_class) ) $cff_content .= $cff_class . ' ';
    if ( !empty($cff_feed_height) ) $cff_content .= 'cff-fixed-height ';
    if ( $cff_thumb_layout ) $cff_content .= 'cff-thumb-layout ';
    if ( $cff_half_layout ) $cff_content .= 'cff-half-layout ';
    if ( !$cff_enable_narrow ) $cff_content .= 'cff-disable-narrow';
    if ( !$cff_disable_lightbox ) $cff_content .= ' cff-lb';
    $cff_content .= '" ' . $cff_feed_styles;
    $cff_content .= ' data-fb-text="'.$cff_facebook_link_text.'"';
    $cff_content .= '>';
    //Add the page header to the inside of the top of feed
    if ($cff_show_header && !$cff_header_outside) $cff_content .= $cff_header;

    //Add like box to the inside of the top of feed
    if ($cff_like_box_position == 'top' && $cff_show_like_box && !$cff_like_box_outside) $cff_content .= $like_box;
    //Limit var
    $i = 0;


    //Multifeed extension
    ( $cff_ext_multifeed_active ) ? $page_ids = cff_multifeed_ids($page_id) : $page_ids = array($page_id);

    //Define array for post items
    $cff_posts_array = array();

    //LOOP THROUGH PAGE IDs
    foreach ( $page_ids as $page_id ) {
    
        //EVENTS ONLY
        if ($cff_events_only && $cff_events_source == 'eventspage'){

            //Get the user's ID
            $get_page_info = cff_fetchUrl('https://graph.facebook.com/' . $page_id . '?fields=name,id&access_token=' . $access_token);
            $page_info = json_decode($get_page_info);
            //Get user ID
            $u_id = $page_info->id;

            //Add 6 hours to the current time. This means events will still be shown for 6 hours after their start time has passed.
            $cff_event_offset_time = '-' . $cff_event_offset . ' hours';
            $curtimeplus = strtotime($cff_event_offset_time, time());

            //Start time string
            $cff_start_time_string = "start_time>=".$curtimeplus;

            //Set the query URL
            $fql = "SELECT%20eid,name,attending_count,pic_big,pic_cover,start_time,end_time,timezone,venue,location,description,ticket_uri%20FROM%20event%20WHERE%20eid%20IN%20(SELECT%20eid%20FROM%20event_member%20WHERE%20uid='".$u_id."')%20AND%20".$cff_start_time_string."%20ORDER%20BY%20start_time%20&access_token=" . $access_token . '&format=json-strings' . $cff_ssl;
            
            // Get any existing copy of our transient data
            $cff_events_json_url = "https://graph.facebook.com/fql?q=" . $fql;

            //Past events
            ( $cff_past_events !== 'false' && $cff_past_events ) ? $cff_past_events = true : $cff_past_events = false;

            //Get past events. Limit must be set high to get all past events and be able to show the newest ones first
            if($cff_past_events) $cff_events_json_url = 'https://graph.facebook.com/'.$u_id.'/events?fields=name,id,description,start_time,end_time,timezone,location,venue,ticket_uri,cover&limit=200&until='.date('Y-m-d').'&access_token='.$access_token;

            if($cff_is_group) $cff_events_json_url = 'https://graph.facebook.com/' . $page_id . '/events?fields=name,id,description,start_time,end_time,timezone,location,venue,ticket_uri,cover&limit=200&since='.date('Y-m-d').'&access_token=' . $access_token;



            //Don't use caching if the cache time is set to zero or the PHP version is less than 5
            if ($cff_cache_time != 0 && intval(PHP_VERSION) >= 5 ){

                // Set the caching file name
                $transient_name = 'cff_events_json_' . $page_id . '_' . $cff_past_events . $cff_page_type;

                $cff_cache_file = $settings[ 'path' ] . '/core/cache/'. $transient_name .'.txt';

                // If the file exists and is less than 5 minutes old then use it
                if ( file_exists( $cff_cache_file ) && ( filemtime($cff_cache_file) > ( time() - $cache_seconds ) ) ) {

                    //Get the cache contents
                    $events_json = file_get_contents($cff_cache_file);

                    //If we can't find the transient then fall back to just getting the json from the api
                    if ($events_json == false) $events_json = cff_fetchUrl($cff_events_json_url);

                // Get the contents from the Facebook API and set the cache
                } else {
                    
                    //Get the contents of the Facebook page
                    $events_json = cff_fetchUrl($cff_events_json_url);
                    
                    //Create the file or write the posts JSON to it
                    file_put_contents($cff_cache_file, $events_json);

                }
            } else {
                $events_json = cff_fetchUrl($cff_events_json_url);
            }

            

            //Interpret data with JSON
            //Convert eid integer to a string otherwise json_decode returns it as a float
            $events_json = preg_replace('/"eid":(\d+)/', '"eid":"$1"', $events_json);
            $events_json = preg_replace('/"id":(\d+)/', '"id":"$1"', $events_json);
            $event_data = json_decode($events_json);
            //EVENTS LOOP
            foreach ($event_data->data as $event )
            {
                //Only create posts for the amount of posts specified
                // if ( $i == $show_posts ) break;
                $i++;
                //Past events
                if($cff_past_events || $cff_is_group) {
                    isset($event->id) ? $id = $event->id : $id = '';
                } else {
                    isset($event->eid) ? $id = $event->eid : $id = '';
                }
                isset($event->name) ? $event_name = $event->name : $event_name = '';
                isset($event->attending_count) ? $attending_count = $event->attending_count : $attending_count = '';

                //Picture source
                if($cff_past_events || $cff_is_group) {
                    ( isset($event->cover) ) ? $pic_big = $event->cover->source : $pic_big = $settings[ 'path' ] . '/core/img/event-image.png';
                } else {
                    ( $cff_event_image_size == 'cropped' ) ? $crop_event_pic = true : $crop_event_pic = false;
                    ( isset($event->pic_cover) && !$crop_event_pic ) ? $pic_big = $event->pic_cover->source : $pic_big = $event->pic_big;
                }

                isset($event->start_time) ? $start_time = $event->start_time : $start_time = '';
                isset($event->end_time) ? $end_time = $event->end_time : $end_time = '';
                isset($event->timezone) ? $timezone = $event->timezone : $timezone = '';
                //Venue
                isset($event->venue->latitude) ? $venue_latitude = $event->venue->latitude : $venue_latitude = '';
                isset($event->venue->longitude) ? $venue_longitude = $event->venue->longitude : $venue_longitude = '';
                isset($event->venue->city) ? $venue_city = $event->venue->city : $venue_city = '';
                isset($event->venue->state) ? $venue_state = $event->venue->state : $venue_state = '';
                isset($event->venue->country ) ? $venue_country = $event->venue->country : $venue_country = '';
                isset($event->venue->id) ? $venue_id = $event->venue->id : $venue_id = '';
                $venue_link = 'https://facebook.com/' . $venue_id;
                isset($event->venue->street) ? $venue_street = $event->venue->street : $venue_street = '';
                isset($event->venue->zip) ? $venue_zip = $event->venue->zip : $venue_zip = '';
                isset($event->location) ? $location = $event->location : $location = '';
                isset($event->description) ? $description = $event->description : $description = '';
                $event_link = 'https://facebook.com/events/' . $id;
                isset($event->ticket_uri) ? $ticket_uri = $event->ticket_uri : $ticket_uri = '';

                //Event date
                $event_time = $start_time;
                //If timezone migration is enabled then remove last 5 characters
                if ( strlen($event_time) == 24 ) $event_time = substr($event_time, 0, -5);


                if (!empty($start_time)) $cff_event_date = '<p class="cff-date" '.$cff_event_date_styles.'><span class="cff-start-date">' . cff_eventdate(strtotime($event_time), $cff_event_date_formatting, $cff_event_date_custom) . '</span>';
                if( isset($event->end_time) ) $cff_event_date .= ' - <span class="cff-end-date">' . cff_eventdate(strtotime($end_time), $cff_event_date_formatting, $cff_event_date_custom) . '</span>';
                $cff_event_date .= '</p>';


                //Event title
                $cff_event_title = '';
                if ($cff_event_title_link) $cff_event_title .= '<a href="'.$event_link.'" '.$target.$cff_nofollow.'>';
                $cff_event_title .= '<' . $cff_event_title_format . ' ' . $cff_event_title_styles . '>' . $event_name . '</' . $cff_event_title_format . '>';
                if ($cff_event_title_link) $cff_event_title .= '</a>';
                
                //***************************//
                //***CREATE THE EVENT HTML***//
                //***************************//
                $cff_post_item = '<div class="cff-item cff-event author-'. cff_to_slug($page_id);
                if ($cff_post_bg_color_check) $cff_post_item .= ' cff-box';
                $cff_post_item .= '" id="cff_'. $id .'" ' . $cff_item_styles . '>';
                //Picture
                if($cff_show_media) $cff_post_item .= '<a title="' . $cff_facebook_link_text . '" class="cff-photo" href="'.$event_link.'" '.$target.$cff_nofollow.'><img src="'. $pic_big .'" /></a>';
                //Start text wrapper
                if ( ($cff_thumb_layout || $cff_half_layout) ) $cff_post_item .= '<div class="cff-details">';
                    //show event date above title
                    if ($cff_show_date && $cff_event_date_position == 'above') $cff_post_item .= $cff_event_date;
                    //Show event title
                    if ($cff_show_event_title && !empty($event_name)) $cff_post_item .= $cff_event_title;
                    //show event date below title
                    if ($cff_show_date && $cff_event_date_position !== 'above') $cff_post_item .= $cff_event_date;
                    //Show event details
                    if ($cff_show_event_details){
                        if (!empty($location)) $cff_post_item .= '<p class="cff-location" ' . $cff_event_details_styles . '>';
                        if (!empty($venue_id)) $cff_post_item .= '<a href="'. $venue_link .'" '.$target.$cff_nofollow.' style="color:#' . $cff_event_link_color . ';">';
                        if (!empty($location)) $cff_post_item .= '<b>' . $location . '</b>';
                        if (!empty($venue_id)) $cff_post_item .= '</a>';
                        if (!empty($venue_street)) $cff_post_item .= '<br />' . $venue_street;
                        if (!empty($venue_city)) $cff_post_item .= '<br />' . $venue_city . ', ' . $venue_state . ' &nbsp;' . $venue_zip;
                        if (!empty($venue_latitude)) $cff_post_item .= ' <a href="https://maps.google.com/maps?q=' . $venue_latitude . ',+' . $venue_longitude . '" '.$target.$cff_nofollow.' style="color:#' . $cff_event_link_color . ';">'.$cff_map_text.'</a>';
                        if (!empty($location)) $cff_post_item .= '</p>';
                        if (!empty($description)){
                            
                            $cff_post_item .= '<p class="cff-desc" ';

                            //Set the char limit on the element
                            if (!empty($body_limit)) {
                                if (strlen($description) > $body_limit) $cff_post_item .= 'data-char="'. $body_limit .'" ';
                            }

                            $cff_post_item .= $cff_event_details_styles . '><span class="cff-desc-text">' . cff_autolink($description, $link_color=$cff_event_link_color) . '</span>';

                            //Add the See More and See Less links if needed
                            if (!empty($body_limit)) {
                                if (strlen($description) > $body_limit) $cff_post_item .= '<span class="cff-expand">... <a href="#" style="color: #'.$cff_posttext_link_color.'"><span class="cff-more">' . $cff_see_more_text . '</span><span class="cff-less">' . $cff_see_less_text . '</span></a></span>';
                            }

                            $cff_post_item .= '</p>';

                        }
                    }
                //End details
                if ( ($cff_thumb_layout || $cff_half_layout) ) $cff_post_item .= '</div>';
                $cff_post_item .= '<div class="cff-meta-wrap">';



                $cff_post_item .= '<div class="cff-post-links">';


                //Social media sharing URLs
                $cff_share_facebook = 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode($event_link);
                $cff_share_twitter = 'https://twitter.com/intent/tweet?text=' . urlencode($event_link);
                $cff_share_google = 'https://plus.google.com/share?url=' . urlencode($event_link);
                $cff_share_linkedin = 'https://www.linkedin.com/shareArticle?mini=true&amp;url=' . urlencode($event_link) . '&amp;title=' . rawurlencode( strip_tags($cff_event_title) . ' - ' . strip_tags($cff_event_date) );
                $cff_share_email = 'mailto:?subject=Facebook&amp;body=' . urlencode($event_link) . '%20-%20' . rawurlencode( strip_tags($cff_event_title) . ' - ' . strip_tags($cff_event_date) );


                    //View on Facebook link
                    if($cff_show_facebook_link) $cff_post_item .= '<a class="cff-viewpost" href="' . $event_link . '" ' . $target . $cff_nofollow.' ' . $cff_link_styles . '>'.$cff_facebook_link_text.'</a>';

                    //Share link
                    if($cff_show_facebook_share){
                        $cff_post_item .= '<div class="cff-share-container">';
                        
                        if($cff_show_facebook_link) $cff_post_item .= '<span class="cff-dot" ' . $cff_link_styles . '>&middot;</span>';

                        $cff_post_item .= '<a class="cff-share-link" href="javascript:void(0);" title="' . $cff_facebook_share_text . '" ' . $cff_link_styles . '>' . $cff_facebook_share_text . '</a>';
                        $cff_post_item .= "<p class='cff-share-tooltip'><a href='".$cff_share_facebook."' target='_blank' class='cff-facebook-icon'><i class='fa fa-facebook-square'></i></a><a href='".$cff_share_twitter."' target='_blank' class='cff-twitter-icon'><i class='fa fa-twitter'></i></a><a href='".$cff_share_google."' target='_blank' class='cff-google-icon'><i class='fa fa-google-plus'></i></a><a href='".$cff_share_linkedin."' target='_blank' class='cff-linkedin-icon'><i class='fa fa-linkedin'></i></a><a href='".$cff_share_email."' target='_blank' class='cff-email-icon'><i class='fa fa-envelope'></i></a><i class='fa fa-play fa-rotate-90'></i></p></div>";
                    }
                    
                    $cff_post_item .= '</div>'; 

                $cff_post_item .= '</div></div><div class="cff-clear"></div>';



                //Get the filter string
                //Create a string from the event title, location and address to use in the filter check below
                $cff_event_address_string = $cff_event_title . $location . $venue_street . $venue_city . $venue_state . $venue_zip;

                $cff_show_post = true;
                if ( $cff_filter_string != '' ){
                    //Explode it into multiples
                    $cff_filter_strings_array = explode(',', $cff_filter_string);
                    //Hide the post if both the post text and description don't contain the string
                    $string_in_address = true;
                    $string_in_desc = true;
                    if ( cff_stripos_arr($cff_event_address_string, $cff_filter_strings_array) === false ) $string_in_address = false;
                    if ( cff_stripos_arr($description, $cff_filter_strings_array) === false ) $string_in_desc = false;

                    if( $string_in_address == false && $string_in_desc == false ) $cff_show_post = false;
                }

                if ( $cff_exclude_string != '' ){
                    //Explode it into multiples
                    $cff_exclude_strings_array = explode(',', $cff_exclude_string);
                    //Hide the post if both the post text and description don't contain the string
                    $string_in_address = false;
                    $string_in_desc = false;

                    if ( cff_stripos_arr($cff_event_address_string, $cff_exclude_strings_array) !== false ) $string_in_address = true;
                    if ( cff_stripos_arr($description, $cff_exclude_strings_array) !== false ) $string_in_desc = true;

                    if( $string_in_address == true || $string_in_desc == true ) $cff_show_post = false;
                }

                //Offset. If the post index ($i) is less than the offset then don't show the post
                if( intval($i) < intval($cff_post_offset) ){
                    $cff_show_post = false;
                    $i++;
                }

                //Change the seconds value of the event_time unix value so that if more than 1 event has the same start time then it doesn't get replaced in the posts array
                $event_time_unix = strtotime($event_time);
                $event_time = substr( $event_time_unix , 0, -1) . rand(1, 9);

                //PUSH TO ARRAY if the post should be shown
                if( $cff_show_post !== false ) $cff_posts_array = cff_array_push_assoc($cff_posts_array, $event_time, $cff_post_item);

            } // End the loop

            //Sort all of the events by all page IDs to show the most recent upcoming events first
            if(!$cff_past_events) ksort($cff_posts_array);

            //If there are no upcoming events then display a message
            if( !$cff_past_events && empty($cff_posts_array) ) $cff_posts_array = cff_array_push_assoc($cff_posts_array, 1, '<p class="cff-no-events">'.$cff_no_events_text.'</p>');

            // if($cff_past_events) usort($cff_posts_array, 'sortByOrder');
            if($cff_past_events) krsort($cff_posts_array);

        } //End EVENTS ONLY
        
        //ALL POSTS
        if (!$cff_events_only || ($cff_events_only && $cff_events_source == 'timeline') ){

            $cff_posts_json_url = 'https://graph.facebook.com/v2.5/' . $page_id . '/' . $graph_query . '?fields=id,from{name,id},message,message_tags,story,story_tags,picture,full_picture,link,source,name,caption,description,type,status_type,object_id,created_time,attachments{subattachments},shares,likes{id,name},comments{attachment,id,from,message,message_tags,created_time,like_count,comment_count}&access_token=' . $access_token . '&limit=' . $cff_post_limit . '&locale=' . $cff_locale . $cff_ssl;

            //VIDEOS ONLY
            if($cff_videos_only){
                $cff_posts_json_url = 'https://graph.facebook.com/'.$page_id.'?fields=videos{source,name,description,embed_html,format{picture}}&access_token='.$access_token.'&locale='.$cff_locale;
            }

            //PHOTOS ONLY
            if($cff_photos_only){
                //Get the user's ID
                $get_page_info = cff_fetchUrl('https://graph.facebook.com/' . $page_id . '?fields=name,id&access_token=' . $access_token);
                $page_info = json_decode($get_page_info);
                //Get user ID
                $u_id = $page_info->id;

                //PHOTOS ONLY
                if($cff_is_group){
                    //For groups
                    $cff_posts_json_url = "https://graph.facebook.com/fql?q=SELECT%20pid,created,src_big,link,caption%20FROM%20photo%20WHERE%20pid%20IN%20(SELECT%20pid%20FROM%20photo_tag%20WHERE%20subject='".$u_id."')%20OR%20pid%20IN%20(SELECT%20pid%20FROM%20photo%20WHERE%20aid%20IN%20(SELECT%20aid%20FROM%20album%20WHERE%20owner='".$u_id."'%20AND%20type!='profile'))%20LIMIT%20".$cff_post_limit."%20&access_token=".$access_token;
                } else {
                    //For pages
                    $cff_posts_json_url = "https://graph.facebook.com/fql?q=SELECT%20pid,created,src_big,link,caption%20FROM%20photo%20WHERE%20pid%20IN%20(SELECT%20pid%20FROM%20photo%20WHERE%20owner='".$u_id."')%20LIMIT%20".$cff_post_limit."%20&access_token=".$access_token;
                }
            }

            //ALBUMS ONLY
            if($cff_albums_only && $cff_albums_source == 'photospage') $cff_posts_json_url = 'https://graph.facebook.com/' . $page_id . '/albums?fields=id,name,description,link,cover_photo,count,created_time&access_token=' . $access_token . '&limit=' . $cff_post_limit. '&locale=' . $cff_locale;


            //ALBUM EMBED
            if( $cff_album_active && !empty($cff_album_id) ) {

                //Get the JSON back from the Album extension
                $cff_album_json_url = cff_album_id( trim( $cff_album_id ), $access_token, $cff_post_limit );

                //Don't use caching if the cache time is set to zero or the PHP version is less than 5
                if ($cff_cache_time != 0 && intval(PHP_VERSION) >= 5 ){

                    // Set the caching file name
                    $transient_name = 'cff_album_json_' . $cff_album_id;

                    $cff_cache_file = $settings[ 'path' ] . '/core/cache/'. $transient_name .'.txt';

                    // If the file exists and is less than 5 minutes old then use it
                    if ( file_exists( $cff_cache_file ) && ( filemtime($cff_cache_file) > ( time() - $cache_seconds ) ) ) {

                        //Get the cache contents
                        $album_json = file_get_contents($cff_cache_file);

                        //If we can't find the transient then fall back to just getting the json from the api
                        if ($album_json == false) $album_json = cff_fetchUrl($cff_album_json_url);

                    // Get the contents from the Facebook API and set the cache
                    } else {
                        
                        //Get the contents of the Facebook page
                        $album_json = cff_fetchUrl($cff_album_json_url);
                        
                        //Check whether any data is returned from the API. If it isn't then don't cache the error response and instead keep checking the API on every page load until data is returned.
                        $FBdata = json_decode($album_json);
                        if( !empty($FBdata->data) ) {
                            //Create the file or write the posts JSON to it
                            file_put_contents($cff_cache_file, $album_json);
                        }

                    }
                } else {
                    $album_json = cff_fetchUrl($cff_album_json_url);
                }

            }



            //Don't use caching if the cache time is set to zero or the PHP version is less than 5
            if ($cff_cache_time != 0 && intval(PHP_VERSION) >= 5 ){

                // Set the caching file name
                $transient_name = 'cff_' . $page_id . '_' . $cff_albums_only . $cff_albums_source . $cff_photos_only . $cff_videos_only . $cff_post_limit . $show_posts_by;

                $cff_cache_file = $settings[ 'path' ] . '/core/cache/'. $transient_name .'.txt';

                // If the file exists and is less than 5 minutes old then use it
                if ( file_exists( $cff_cache_file ) && ( filemtime($cff_cache_file) > ( time() - $cache_seconds ) ) ) {

                    //Get the cache contents
                    $posts_json = file_get_contents($cff_cache_file);

                    //If we can't find the transient then fall back to just getting the json from the api
                    if ($posts_json == false) $posts_json = cff_fetchUrl($cff_posts_json_url);

                // Get the contents from the Facebook API and set the cache
                } else {
                    
                    //Get the contents of the Facebook page
                    $posts_json = cff_fetchUrl($cff_posts_json_url);
                    
                    //Check whether any data is returned from the API. If it isn't then don't cache the error response and instead keep checking the API on every page load until data is returned.
                    $FBdata = json_decode($posts_json);
                    if( !empty($FBdata->data) ) {
                        //Create the file or write the posts JSON to it
                        file_put_contents($cff_cache_file, $posts_json);
                    }

                }
            } else {
                $posts_json = cff_fetchUrl($cff_posts_json_url);
            }
            

            if ( $cff_show_only_others ) {
                //Get the numeric ID of the page so can compare it to the author of each post
                $page_object = cff_fetchUrl('https://graph.facebook.com/' . $page_id . '?fields=name,id&access_token=' . $access_token);
                $page_object = json_decode($page_object);
                $numeric_page_id = $page_object->id;
            }
            

            //Interpret data with JSON
            $FBdata = json_decode($posts_json);

            //If there's no data then show a pretty error message
            if( empty($FBdata->data) && empty($FBdata->videos) && !$cff_ext_multifeed_active ) {
                $cff_content .= '<div class="cff-error-msg"><p>Unable to display Facebook posts.<br/><a href="javascript:void(0);" id="cff-show-error" onclick="cffShowError()">Show error</a>';
                $cff_content .= '<script type="text/javascript">function cffShowError() { document.getElementById("cff-error-reason").style.display = "block"; document.getElementById("cff-show-error").style.display = "none"; }</script>';
                $cff_content .= '</p><div id="cff-error-reason">';
                
                if( isset($FBdata->error->message) ) $cff_content .= 'Error: ' . $FBdata->error->message;
                if( isset($FBdata->error->type) ) $cff_content .= '<br />Type: ' . $FBdata->error->type;
                if( isset($FBdata->error->code) ) $cff_content .= '<br />Code: ' . $FBdata->error->code;
                if( isset($FBdata->error->error_subcode) ) $cff_content .= '<br />Subcode: ' . $FBdata->error->error_subcode;

                if( isset($FBdata->error_msg) ) $cff_content .= 'Error: ' . $FBdata->error_msg;
                if( isset($FBdata->error_code) ) $cff_content .= '<br />Code: ' . $FBdata->error_code;
                
                if($FBdata == null) $cff_content .= 'Error: Server configuration issue';

                if( empty($FBdata->error) && empty($FBdata->error_msg) && $FBdata !== null ) $cff_content .= 'Error: No posts available for this Facebook ID';

                $cff_content .= '<br />Please refer to our <a href="https://smashballoon.com/custom-facebook-feed/docs/errors/" target="_blank">Error Message Reference</a>.';
                $cff_content .= '</div></div>'; //End .cff-error-msg and #cff-error-reason
                $cff_content .= '</div></div>'; //End #cff and .cff-wrapper

                return $cff_content;
            }

            //ALBUM EMBED
            if( $cff_album_active && !empty($cff_album_id) ) $FBdata = json_decode($album_json);

            //***STARTS POSTS LOOP***
            $fbdata_string = '';
            
            if( $cff_videos_only && isset($FBdata->videos) ){
                //Videos only
                $fbdata_string = $FBdata->videos->data;
            } else {
                //All other posts
                if( isset($FBdata->data) ) $fbdata_string = $FBdata->data;
            }
                

            foreach ($fbdata_string as $news)
            {
                $cff_post_item = '';

                //Explode News and Page ID's into 2 values
                $PostID = '';
                if( isset($news->id) ){
                    $cff_post_id = $news->id;
                    $PostID = explode("_", $cff_post_id);
                }
                if( isset($PostID[0]) ) $orig_post_id = $PostID[0];
                if( isset($PostID[1]) ) $orig_post_id .= '_' . $PostID[1];

                //Check the post type
                isset($news->type) ? $cff_post_type = $news->type : $cff_post_type = '';
                if ($cff_post_type == 'link') {
                    isset($news->story) ? $story = $news->story : $story = '';
                    //Check whether it's an event
                    $event_link_check = "facebook.com/events/";
                    //Make sure URL doesn't include 'permalink' as that indicates someone else sharing a post from within an event (eg: https://www.facebook.com/events/617323338414282/permalink/617324268414189/) and the event ID is then not retrieved properly from the event URL as it's formatted like so: facebook.com/events/EVENT_ID/permalink/POST_ID
                    $event_link_check = stripos($news->link, $event_link_check);
                    $event_link_check_2 = stripos($news->link, "permalink/");
                    if ( $event_link_check && !$event_link_check_2 ) $cff_post_type = 'event';
                }

                //Set the post link
                isset($news->link) ? $link = htmlspecialchars($news->link) : $link = '';

                //If there's no link provided then link to the individual post
                if (empty($news->link)) {
                    //Link to individual post
                    if( isset($PostID[1]) ) $link = "https://www.facebook.com/" . $page_id . "/posts/" . $PostID[1];
                }

                //If it's an event then check whether the URL contains facebook.com
                if(isset($news->link)){
                    if( stripos($news->link, "events/") && $cff_post_type == 'event' ){
                        //Facebook changed the event link from absolute to relative, and so if the link isn't absolute then add facebook.com to front
                        ( stripos($link, 'facebook.com') ) ? $link = $link : $link = 'https://facebook.com' . $link;
                    }
                }

                //Is it an album?
                $cff_album = false;
                $num_photos = 0;

                if( isset($news->status_type) ){
                    if( $news->status_type == 'added_photos' ){
                        //Check 'story' to see whether it contains a number
                        (isset($news->story)) ? $str = $news->story : $str = '';
                        
                        //Only matches number with a space after them
                        preg_match('!\d+ !', $str, $matches);


                        (isset($matches[0])) ? $num_photos = $matches[0] : $num_photos = 0;

                        //If the story contains a number...
                        if ( $num_photos > 1 ) {

                            //... and the link is to an album then it most likely has photo attachments
                            $albumLinkArr1 = explode('photos/a.', $link);
                            $albumLinkArr2 = explode('.', $albumLinkArr1[1]);

                            //If it has an album link then set the post type to be album
                            if( isset($albumLinkArr1[1]) ){

                                $cff_album = true;

                                //If the post has subattachments then don't change the post ID to the album ID. If it doesn't then change it to the album ID so that we can at least show the photos from the album
                                if( !isset($news->attachments) ){
                                    //Change the Post ID to be to the post about adding photos to the album
                                    $cff_post_id = $PostID[0] . '_' . $albumLinkArr2[0];
                                }

                                //Link to the album instead of the photo
                                $album_link = str_replace('photo.php?','media/set/?',$link);
                                $link = "https://www.facebook.com/" . $page_id . "/posts/" . $PostID[1];

                                //If the album link is a new format then link it to the post
                                $album_link_check = 'media/set/?';
                                if( stripos($album_link, $album_link_check) !== true ) $album_link = $link;

                            }
                            
                        }
                    }
                }


                //Should we show this post or not?
                $cff_show_post = false;
                switch ($cff_post_type) {
                    case 'link':
                        if ( $cff_show_links_type ) $cff_show_post = true;
                        break;
                    case 'event':
                        if ( $cff_show_event_type ) $cff_show_post = true;
                        break;
                    case 'video':
                         if ( $cff_show_video_type ) $cff_show_post = true;
                        break;
                    case 'swf':
                         if ( $cff_show_video_type ) $cff_show_post = true;
                        break;
                    case 'photo':
                         if ( $cff_show_photos_type && !$cff_album ) $cff_show_post = true;
                         if ( $cff_show_albums_type && $cff_album ) $cff_show_post = true;
                        break;
                    case 'offer':
                        //Show offer posts if links are shown
                         if ( $cff_show_links_type ) $cff_show_post = true;
                        break;
                    case 'music':
                        //Show music posts if statuses are shown
                         if ( $cff_show_status_type ) $cff_show_post = true;
                        break;
                    case 'status':
                        //Check whether it's a status (author comment or like)
                        if ( $cff_show_status_type && !empty($news->message) ) $cff_show_post = true;
                        break;
                }


                //ONLY show posts by others
                if ( $cff_show_only_others ) {
                    //If the post author's ID is the same as the page ID then don't show the post
                    if ( $numeric_page_id == $news->from->id ) $cff_show_post = false;
                }

                //Only show posts containing specified string
                //Get post text
                $post_text = '';
                if (!empty($news->story)) $post_text = $news->story;
                if (!empty($news->message)) $post_text = $news->message;
                if (!empty($news->name) && empty($news->story) && empty($news->message)) $post_text = $news->name;

                //Get description text
                if( isset($news->description) ){
                    $description_text = $news->description;
                } else {
                    isset( $news->caption ) ? $description_text = $news->caption : $description_text = '';
                }


                //Filter
                if ( $cff_filter_string != '' ){
                    //Explode it into multiples
                    $cff_filter_strings_array = explode(',', $cff_filter_string);
                    //Hide the post if both the post text and description don't contain the string
                    $string_in_post_text = true;
                    $string_in_desc = true;
                    if ( cff_stripos_arr($post_text, $cff_filter_strings_array) === false ) $string_in_post_text = false;
                    if ( cff_stripos_arr($description_text, $cff_filter_strings_array) === false ) $string_in_desc = false;

                    if( $string_in_post_text == false && $string_in_desc == false ) $cff_show_post = false;
                }

                if ( $cff_exclude_string != '' ){
                    //Explode it into multiples
                    $cff_exclude_strings_array = explode(',', $cff_exclude_string);
                    //Hide the post if both the post text and description don't contain the string
                    $string_in_post_text = false;
                    $string_in_desc = false;

                    if ( cff_stripos_arr($post_text, $cff_exclude_strings_array) !== false ) $string_in_post_text = true;
                    if ( cff_stripos_arr($description_text, $cff_exclude_strings_array) !== false ) $string_in_desc = true;

                    if( $string_in_post_text == true || $string_in_desc == true ) $cff_show_post = false;
                }


                //Is it a duplicate post?
                if (!isset($prev_post_message)) $prev_post_message = '';
                if (!isset($prev_post_link)) $prev_post_link = '';
                if (!isset($prev_post_description)) $prev_post_description = '';
                isset($news->message) ? $pm = $news->message : $pm = '';
                isset($news->link) ? $pl = $news->link : $pl = '';
                isset($news->description) ? $pd = $news->description : $pd = '';

                if ( ($prev_post_message == $pm) && ($prev_post_link == $pl) && ($prev_post_description == $pd) ) $cff_show_post = false;

                //ALBUMS ONLY
                if($cff_albums_only && $cff_albums_source == 'photospage') $cff_show_post = true;

                //ALBUM EMBED
                if( $cff_album_active && !empty($cff_album_id) ) $cff_show_post = true;

                //PHOTOS ONLY
                if($cff_photos_only) $cff_show_post = true;

                //VIDEOS ONLY
                if($cff_videos_only) $cff_show_post = true;

                //Check post type and display post if selected
                if ( $cff_show_post ) {
                    //If it isn't then create the post

                    $cff_offset_show_post = true;
                    //Offset. If the post index ($i) is less than the offset then don't show the post
                    if( intval($i) < intval($cff_post_offset) ){
                        $cff_offset_show_post = false;
                        $i++;
                    }

                    //If there's an offset then show the post until it's set to false above. This has been moved here so that the offset works correctly when only displaying specific post types, as previously it only worked accurately when all posts were shown
                    if($cff_offset_show_post){

                        if( !$cff_ext_multifeed_active ){
                            //Only create posts for the amount of posts specified
                            if( intval($cff_post_offset) > 0 ){
                                //If offset is being used then stop after showing the number of posts + the offset
                                if ( $i == (intval($show_posts) + intval($cff_post_offset)) ) break;
                            } else {
                                //Else just stop after the number of posts to be displayed is reached, unless it's albums only or photos only
                                if( ($cff_albums_only && $cff_albums_source == 'photospage') || ( $cff_photos_only && empty($cff_album_id) ) || $cff_videos_only ){
                                    //Keep going
                                } else {
                                    if ( $i == $show_posts ) break;
                                }
                                
                            }
                        }
                        $i++;

                        
                        //********************************//
                        //***COMPILE SECTION VARIABLES***//
                        //********************************//
                        //Change image size based on layout
                        if (!empty($news->picture) && !empty($news->object_id)) {
                            $object_id = $news->object_id;
                            $picture = 'https://graph.facebook.com/'.$object_id.'/picture?type=normal&amp;width=9999&amp;height=9999';
                        }

                        //DATE
                        isset($news->created_time) ? $post_time = $news->created_time : $post_time = '';
                        $cff_date = '<p class="cff-date" '.$cff_date_styles.'>'. $cff_date_before . ' ' . cff_getdate(strtotime($post_time), $cff_date_formatting, $cff_date_custom, $date_translate_arr) . ' ' . $cff_date_after;
                        $cff_date .= '</p>';

                        //Only run if NOT only showing photos from the photos page, or albums, or an album embed
                        if( !$cff_photos_only && !$cff_videos_only && !($cff_albums_only && $cff_albums_source == 'photospage') && empty($cff_album_id) ){


                            //POST AUTHOR
                            $cff_author = '<div class="cff-author">';
                            
                            //Author text
                            $cff_author .= '<a href="https://facebook.com/' . $news->from->id . '" '.$target.$cff_nofollow.' title="'.$news->from->name.' on Facebook" '.$cff_author_styles.'><div class="cff-author-text">';

                            if($cff_show_date && $cff_date_position !== 'above' && $cff_date_position !== 'below'){
                                $cff_author .= '<p class="cff-page-name cff-author-date">'.$news->from->name.'</p>';
                                $cff_author .= $cff_date;
                            } else {
                                $cff_author .= '<span class="cff-page-name">'.$news->from->name.'</span>';
                            }

                            $cff_author .= '</div>';

                            //Author image
                            //Set the author image as a variable. If it already exists then don't query the api for it again.
                            $cff_author_img_var = '$cff_author_img_' . $news->from->id;
                            if ( !isset($$cff_author_img_var) ) $$cff_author_img_var = 'https://graph.facebook.com/' . $news->from->id . '/picture?type=square';
                            $cff_author .= '<div class="cff-author-img"><img src="'.$$cff_author_img_var.'" title="'.$news->from->name.'" alt="'.$news->from->name.'" width=40 height=40></div>';

                            $cff_author .= '</a></div>'; //End .cff-author


                            //POST TEXT
                            $cff_post_text = '<' . $cff_title_format . ' class="cff-post-text" ' . $cff_title_styles . '>';
                            
                            //Get the actual post text
                            //Which content should we use?
                            $post_text = '';
                            $cff_post_text_type = '';
                            $cff_story_raw = '';
                            $cff_message_raw = '';
                            $cff_name_raw = '';
                            $text_tags = '';
                            $post_text_story = '';
                            $post_text_message = '';

                            //MESSAGE TAGS
                            //Use the story
                            if (!empty($news->story)) {
                                $cff_story_raw = $news->story;
                                $post_text_story .= htmlspecialchars($cff_story_raw);
                                $cff_post_text_type = 'story';


                                //Add message and story tags if there are any and the post text is the message or the story
                                if( $cff_post_tags && isset($news->story_tags) && !$cff_title_link){
                                    
                                    $text_tags = $news->story_tags;

                                    //Does the Post Text contain any html tags? - the & symbol is the best indicator of this
                                    $cff_html_check_array = array('&lt;', '’', '“', '&quot;', '&amp;', '&gt;&gt;');

                                    //always use the text replace method
                                    if( cff_stripos_arr($post_text_story, $cff_html_check_array) !== false ) {
                                        //Loop through the tags
                                        foreach($text_tags as $message_tag ) {

                                            ( isset($message_tag->id) ) ? $message_tag = $message_tag : $message_tag = $message_tag[0];

                                            $tag_name = $message_tag->name;
                                            $tag_link = '<a href="http://facebook.com/' . $message_tag->id . '">' . $message_tag->name . '</a>';

                                            $post_text_story = str_replace($tag_name, $tag_link, $post_text_story);
                                        }

                                    } else {
                                    //If it doesn't contain HTMl tags then use the offset to replace message tags
                                        $message_tags_arr = array();

                                        $tag = 0;
                                        foreach($text_tags as $message_tag ) {
                                            $tag++;
                                            ( isset($message_tag->id) ) ? $message_tag = $message_tag : $message_tag = $message_tag[0];

                                            isset($message_tag->type) ? $tag_type = $message_tag->type : $tag_type = '';

                                            if($tag_type == 'event'){
                                                //Don't use the story tag in this case otherwise it changes '__ created an event' to '__ created an Name Of Event'
                                            } else {
                                                $message_tags_arr = cff_array_push_assoc(
                                                    $message_tags_arr,
                                                    $tag,
                                                    array(
                                                        'id' => $message_tag->id,
                                                        'name' => $message_tag->name,
                                                        'type' => isset($message_tag->type) ? $message_tag->type : '',
                                                        'offset' => $message_tag->offset,
                                                        'length' => $message_tag->length
                                                    )
                                                );    
                                            }
                                            
                                        }

                                        for($tag = count($message_tags_arr); $tag >= 1; $tag--) {

                                            //If the name is blank (aka the story tag doesn't work properly) then don't use it
                                            if( $message_tags_arr[$tag]['name'] !== '' ) {
                                           
                                                if( $message_tags_arr[$tag]['type'] == 'event' ){
                                                    //Don't use the story tag in this case otherwise it changes '__ created an event' to '__ created an Name Of Event'
                                                } else {
                                                    $b = '<a href="http://facebook.com/' . $message_tags_arr[$tag]['id'] . '">' . $message_tags_arr[$tag]['name'] . '</a>';
                                                    $c = $message_tags_arr[$tag]['offset'];
                                                    $d = $message_tags_arr[$tag]['length'];

                                                    $post_text_story = cff_mb_substr_replace( $post_text_story, $b, $c, $d);
                                                }

                                            }

                                        }


                                    } // end if/else


                                } //END MESSAGE TAGS


                            }
                            //Use the message
                            if (!empty($news->message)) {
                                $cff_message_raw = $news->message;
                                
                                $post_text_message = htmlspecialchars($cff_message_raw);
                                $cff_post_text_type = 'message';


                                //Add message and story tags if there are any and the post text is the message or the story
                                if( $cff_post_tags && isset($news->message_tags) && !$cff_title_link){
                                    
                                    $text_tags = $news->message_tags;

                                    //Does the Post Text contain any html tags? - the & symbol is the best indicator of this
                                    $cff_html_check_array = array('&lt;', '’', '“', '&quot;', '&amp;', '&gt;&gt;');

                                    //always use the text replace method
                                    if( cff_stripos_arr($post_text_message, $cff_html_check_array) !== false ) {
                                        //Loop through the tags
                                        foreach($text_tags as $message_tag ) {

                                            ( isset($message_tag->id) ) ? $message_tag = $message_tag : $message_tag = $message_tag[0];

                                            $tag_name = $message_tag->name;
                                            $tag_link = '<a href="http://facebook.com/' . $message_tag->id . '">' . $message_tag->name . '</a>';

                                            $post_text_message = str_replace($tag_name, $tag_link, $post_text_message);
                                        }

                                    } else {
                                    //If it doesn't contain HTMl tags then use the offset to replace message tags
                                        $message_tags_arr = array();

                                        $tag = 0;
                                        foreach($text_tags as $message_tag ) {
                                            $tag++;

                                            ( isset($message_tag->id) ) ? $message_tag = $message_tag : $message_tag = $message_tag[0];

                                            $message_tags_arr = cff_array_push_assoc(
                                                $message_tags_arr,
                                                $tag,
                                                array(
                                                    'id' => $message_tag->id,
                                                    'name' => $message_tag->name,
                                                    'type' => isset($message_tag->type) ? $message_tag->type : '',
                                                    'offset' => $message_tag->offset,
                                                    'length' => $message_tag->length
                                                )
                                            );
                                        }

                                        for($tag = count($message_tags_arr); $tag >= 1; $tag--) {

                                            //If the name is blank (aka the story tag doesn't work properly) then don't use it
                                            if( $message_tags_arr[$tag]['name'] !== '' ) {
                                           
                                                $b = '<a href="http://facebook.com/' . $message_tags_arr[$tag]['id'] . '">' . $message_tags_arr[$tag]['name'] . '</a>';
                                                $c = $message_tags_arr[$tag]['offset'];
                                                $d = $message_tags_arr[$tag]['length'];

                                                $post_text_message = cff_mb_substr_replace( $post_text_message, $b, $c, $d);
                                            }

                                        }   

                                    } // end if/else

                                } //END MESSAGE TAGS

                            }


                            //Add the story and message together
                            $post_text = '<span class="cff-story">' . $post_text_story;
                            if(!empty($post_text_story) && !empty($post_text_message)) $post_text .= "<br /><br />";
                            $post_text .= '</span>';

                            //Check to see whether it's an embedded video so that we can show the name above the post text if necessary
                            $cff_soundcloud = false;
                            $cff_is_video_embed = false;
                            if ($news->type == 'video'){
                                $url = $news->source;
                                //Embeddable video strings
                                $youtube = 'youtube';
                                $youtu = 'youtu';
                                $vimeo = 'vimeo';
                                $youtubeembed = 'youtube.com/embed';
                                $soundcloud = 'player.soundcloud.com';
                                $swf = '.swf';
                                //Check whether it's a youtube video
                                $youtube = stripos($url, $youtube);
                                $youtu = stripos($url, $youtu);
                                $youtubeembed = stripos($url, $youtubeembed);
                                //Check whether it's a SoundCloud embed
                                $soundcloudembed = stripos($url, $soundcloud);
                                //Check whether it's a youtube video
                                if($youtube || $youtu || $youtubeembed || (stripos($url, $vimeo) !== false)) {
                                    $cff_is_video_embed = true;
                                }
                                //If it's soundcloud then add it into the shared link box at the bottom of the post
                                if( $soundcloudembed ) $cff_soundcloud = true;

                                //If the name exists and it's a non-embedded video then show the name at the top of the post text
                                if( isset($news->name) && !$cff_is_video_embed ){

                                    if( empty($post_text_message) ) $post_text .= "<br /><br />";

                                    if (!$cff_title_link) $post_text .= '<a href="'.$link.'" '.$target.$cff_nofollow.' style="color: #'.$cff_posttext_link_color.'">';
                                    $post_text .= htmlspecialchars($news->name);
                                    if (!$cff_title_link) $post_text .= '</a>';
                                    $post_text .= '<br />';
                                }
                            }

                            //Add the message
                            $post_text .= $post_text_message;


                            //Use the name
                            if (!empty($news->name) && empty($news->story) && empty($news->message)) {
                                $cff_name_raw = $news->name;
                                $post_text = htmlspecialchars($cff_name_raw);
                                $cff_post_text_type = 'name';
                            }
                            // if ($cff_album) {
                            //     if (!empty($news->name)) {
                            //         $post_text .= htmlspecialchars($news->name);
                            //         $cff_post_text_type = 'name';
                            //     }
                            //     // if (!empty($news->message) && empty($news->name)) {
                            //     if (!empty($news->message)) {
                            //         $post_text .= htmlspecialchars($news->message);
                            //         $cff_post_text_type = 'message';
                            //     }
                            //     // if ($num_photos > 1)  $post_text .= ' (' . trim($num_photos) . ' '.$cff_translate_photos_text.')';
                            // }


                            //OFFER TEXT
                            if ($cff_post_type == 'offer'){
                                isset($news->story) ? $post_text = htmlspecialchars($news->story) . '<br /><br />' : $post_text = '';
                                $post_text .= htmlspecialchars($news->name);
                                $cff_post_text_type = 'story';
                            }

                            //Start HTML for post text
                            $cff_post_text .= '<span class="cff-text" data-color="'.$cff_posttext_link_color.'">';
                            if ($cff_title_link) $cff_post_text .= '<a class="cff-post-text-link" '.$cff_title_styles.' href="'.$link.'" '.$target.$cff_nofollow.'>';
                            

                            //Replace line breaks in text (needed for IE8)
                            $post_text = preg_replace("/\r\n|\r|\n/",'<br/>', $post_text);

                            //If the text is wrapped in a link then don't hyperlink any text within
                            if ($cff_title_link) {
                                //Wrap links in a span so we can break the text if it's too long
                                $cff_post_text .= cff_wrap_span( $post_text ) . ' ';
                            } else {
                                //Don't use htmlspecialchars for post_text as it's added above so that it doesn't mess up the message_tag offsets
                                $cff_post_text .= cff_autolink( $post_text ) . ' ';
                            }
                            
                            if ($cff_title_link) $cff_post_text .= '</a>';
                            $cff_post_text .= '</span>';
                            //'See More' link
                            $cff_post_text .= '<span class="cff-expand">... <a href="#" style="color: #'.$cff_posttext_link_color.'"><span class="cff-more">' . $cff_see_more_text . '</span><span class="cff-less">' . $cff_see_less_text . '</span></a></span>';
                            $cff_post_text .= '</' . $cff_title_format . '>';
                            // $cff_post_text .= '</div>';

                            //DESCRIPTION
                            $cff_description = '';
                            if ( !empty($news->description) || !empty($news->caption) ) {
                                $description_text = '';
                                if ( !empty($news->description) ) {
                                    $description_text = $news->description;
                                } else {
                                    $description_text = $news->caption;
                                }

                                //If the description is the same as the post text then don't show it
                                if( $description_text ==  $cff_story_raw || $description_text ==  $cff_message_raw || $description_text ==  $cff_name_raw ){
                                    $cff_description = '';
                                } else {
                                    //Truncate desc
                                    if (!empty($body_limit)) {
                                        if (strlen($description_text) > $body_limit) $description_text = substr($description_text, 0, $body_limit) . '...';
                                    }
                                    //Add links and create HTML
                                    $cff_description .= '<p class="cff-post-desc" '.$cff_body_styles.'><span>' . cff_autolink( htmlspecialchars($description_text), $link_color=$cff_posttext_link_color )  . ' </span></p>';
                                }
                                
                                if( $cff_post_type == 'event' ) $cff_description = '';
                            }

                            //LINK
                            $cff_shared_link = '';
                            //Display shared link
                            if ($cff_post_type == 'link' || $cff_soundcloud) {

                                if( $cff_soundcloud ){
                                    //Put this here so that is also hidden when hiding shared links in the Post Layout settings
                                    if($cff_soundcloud) $cff_shared_link .= '<iframe class="cff-soundcloud" width="100%" height="100" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=' . $news->link . '&amp;auto_play=false&amp;hide_related=true&amp;show_comments=false&amp;show_user=true&amp;show_reposts=false&amp;visual=false"></iframe>';
                                } else {

                                    $cff_shared_link .= '<div class="cff-shared-link';
                                    if($cff_disable_link_box) $cff_shared_link .= ' cff-no-styles';

                                    if($cff_full_link_images) $cff_shared_link .= ' cff-full-size';

                                    $cff_shared_link .= '" ';

                                    if(!$cff_disable_link_box) $cff_shared_link .= $cff_link_box_styles;
                                    $cff_shared_link .= '>';
                                    $cff_link_image = '';

                                    if ( isset($news->picture) ){

                                        if (!empty($news->picture)) {
                                            $picture = $news->picture;

                                            /*If the image doesn't have a _b version then the URL looks like this:
                                            http://photos-h.ak.fbcdn.net/hphotos-ak-prn1/v/1600273_348160658659104_383135394_s.jpg?oh=23124db338cd899962fa7fb2d7285306&oe=52D5F9BE&__gda__=1389770591_64da0df3e725ca2d1fd026b0e922c58b
                                            So check for this kind of string below and don't replace _s. with _b.
                                            */
                                            $bigjpg = '_s.jpg?';
                                            $bigpng = '_s.png?';
                                            $biggif = '_s.gif?';
                                            $bigbmp = '_s.bmp?';
                                            $bigtjpg = '_t.jpg?';
                                            $bigtpng = '_t.png?';
                                            $bigtgif = '_t.gif?';
                                            $bigtbmp = '_t.bmp?';
                                            $imagecheck1 = stripos($picture, $bigjpg);
                                            $imagecheck2 = stripos($picture, $bigpng);
                                            $imagecheck3 = stripos($picture, $biggif);
                                            $imagecheck4 = stripos($picture, $bigbmp);
                                            $imagecheck5 = stripos($picture, $bigtjpg);
                                            $imagecheck6 = stripos($picture, $bigtpng);
                                            $imagecheck7 = stripos($picture, $bigtgif);
                                            $imagecheck8 = stripos($picture, $bigtbmp);

                                            if ( !($imagecheck1 || $imagecheck2 || $imagecheck3 || $imagecheck4 || $imagecheck5 || $imagecheck6 || $imagecheck7 || $imagecheck8) ) {
                                                //Show larger image
                                                $picture = str_replace('_s.','_b.',$picture);
                                                $picture = str_replace('_q.','_b.',$picture);
                                                $picture = str_replace('_t.','_b.',$picture);
                                            }

                                            if ( isset($news->picture) && !empty($news->picture) ) $picture = $news->picture;
                                            ( isset($news->full_picture) && !empty($news->full_picture) ) ? $full_picture = $news->full_picture : $full_picture = $picture;

                                            //Set the link image to be the full-size image
                                            if($cff_full_link_images) $picture = $news->full_picture;
                                        }

                                        //Check whether the image is a 1x1 placeholder
                                        $cff_link_image = true;
                                        $cff_one_x_one = '1x1.';
                                        if( stripos($news->picture, $cff_one_x_one) == true || empty($news->picture) ) $cff_link_image = false;

                                        //If there's a picture accompanying the link then display it
                                        if ($cff_link_image && $cff_show_media) {
                                            $cff_shared_link .= '<a class="cff-link" href="'.$link.'" '.$target.$cff_nofollow.' data-full="'.$full_picture.'">';
                                            $cff_shared_link .= '<img src="'. $picture .'" />';
                                            $cff_shared_link .= '</a>';
                                        }
                                    }

                                    //Display link name and description
                                    // if (!empty($news->description)) {
                                    $cff_shared_link .= '<div class="cff-text-link ';
                                    if (!$cff_link_image) $cff_shared_link .= 'cff-no-image';
                                    //The link title:
                                    $cff_shared_link .= '"><'.$cff_link_title_format.' class="cff-link-title" '.$cff_link_title_styles.'><a href="'.$link.'" '.$target.$cff_nofollow.' style="color:#' . $cff_link_title_color . ';">'. $news->name . '</a></'.$cff_link_title_format.'>';
                                    //The link source:
                                    (!empty($news->caption)) ? $cff_link_caption = $news->caption : $cff_link_caption = '';
                                    if(!empty($cff_link_caption)) $cff_shared_link .= '<p class="cff-link-caption" style="color:#' . str_replace('#', '', $cff_link_url_color) . ';">'.$cff_link_caption.'</p>';
                                    if ($cff_show_desc) {
                                        if( $description_text != $cff_link_caption ) $cff_shared_link .= $cff_description;
                                    }

                                    $cff_shared_link .= '</div>';
                                    // }

                                    $cff_shared_link .= '</div>';

                                } //End soundcloud check

                            }

                            //EVENT
                            $cff_event = '';
                            if ($cff_show_event_title || $cff_show_event_details) {
                                //Check for media
                                if ($cff_post_type == 'event') {

                                    //Get the event id from the event URL. eg: http://www.facebook.com/events/123451234512345/
                                    $event_url = parse_url($link);
                                    $url_parts = explode('/', $event_url['path']);
                                    //Get the id from the parts
                                    $eventID = $url_parts[count($url_parts)-2];
                                    
                                    //Facebook changed the event link from absolute to relative, and so if the link isn't absolute then add facebook.com to front
                                    ( stripos($link, 'facebook.com') ) ? $link = $link : $link = 'https://facebook.com' . $link;

                                    //New tokens which are 2.3 and newer don't allow us to get the location or venue of timeline events so use older tokens for timeline events
                                    $access_token = $access_token_array_fql[0];

                                    //Get the contents of the event
                                    $event_json_url = 'https://graph.facebook.com/v2.2/'.$eventID.'?fields=description,location,name,owner,start_time,timezone,venue,id,likes,comments&access_token=' . $access_token . $cff_ssl;


                                    //Don't use caching if the cache time is set to zero or the PHP version is less than 5
                                    if ($cff_cache_time != 0 && intval(PHP_VERSION) >= 5 ){
                                        // Set the caching file name
                                        $transient_name = 'cff_tl_event_json_' . $eventID;

                                        $cff_cache_file = $settings[ 'path' ] . '/core/cache/'. $transient_name .'.txt';

                                        // If the file exists and is less than 5 minutes old then use it
                                        if ( file_exists( $cff_cache_file ) && ( filemtime($cff_cache_file) > ( time() - $cache_seconds ) ) ) {

                                            //Get the cache contents
                                            $event_json = file_get_contents($cff_cache_file);

                                            //If we can't find the transient then fall back to just getting the json from the api
                                            if ($event_json == false) $event_json = cff_fetchUrl($event_json_url);

                                        // Get the contents from the Facebook API and set the cache
                                        } else {
                                            
                                            //Get the contents of the Facebook page
                                            $event_json = cff_fetchUrl($event_json_url);
                                            
                                            //Create the file or write the posts JSON to it
                                            file_put_contents($cff_cache_file, $event_json);

                                        }
                                    } else {
                                        $event_json = cff_fetchUrl($event_json_url);
                                    }
                                    

                                    //Interpret data with JSON
                                    $event_object = json_decode($event_json);
                                    //Picture
                                    if($cff_show_media) $cff_event .= '<a title="'.$cff_facebook_link_text.'" class="cff-event-thumb" href="'.$link.'" '.$target.$cff_nofollow.'><img src="https://graph.facebook.com/'.$eventID.'/picture?width=200&amp;height=200" alt="'.$cff_facebook_link_text.'" /></a>';

                                    //Event date
                                    isset($event_object->start_time)? $event_time = $event_object->start_time : $event_time = '';
                                    isset($event_object->end_time) ? $event_end_time = ' - <span class="cff-end-date">' . cff_eventdate(strtotime($event_object->end_time), $cff_event_date_formatting, $cff_event_date_custom) . '</span>' : $event_end_time = '';
                                    //If timezone migration is enabled then remove last 5 characters
                                    if ( strlen($event_time) == 24 ) $event_time = substr($event_time, 0, -5);
                                    $cff_event_date = '';
                                    if (!empty($event_time)) $cff_event_date = '<p class="cff-date" '.$cff_event_date_styles.'><span class="cff-start-date">' . cff_eventdate(strtotime($event_time), $cff_event_date_formatting, $cff_event_date_custom) . '</span>' . $event_end_time.'</p>';

                                    //EVENT
                                    //Display the event details
                                    $cff_event .= '<div class="cff-details">';
                                    //show event date above title
                                    if ($cff_event_date_position == 'above') $cff_event .= $cff_event_date;
                                    //Show event title
                                    if ($cff_show_event_title && !empty($event_object->name)) {
                                        if ($cff_event_title_link) $cff_event .= '<a href="'.$link.'" '.$target.$cff_nofollow.'>';
                                        $cff_event .= '<' . $cff_event_title_format . ' ' . $cff_event_title_styles . '>' . $event_object->name . '</' . $cff_event_title_format . '>';
                                        if ($cff_event_title_link) $cff_event .= '</a>';
                                    }
                                    //show event date below title
                                    if ($cff_event_date_position !== 'above') $cff_event .= $cff_event_date;
                                    //Show event details
                                    if ($cff_show_event_details){
                                        //Location
                                        if (!empty($event_object->location)) $cff_event .= '<p class="cff-where" ' . $cff_event_details_styles . '>' . $event_object->location . '</p>';
                                        //Description
                                        if (!empty($event_object->description)){
                                            $description = $event_object->description;
                                            if (!empty($body_limit)) {
                                                if (strlen($description) > $body_limit) $description = substr($description, 0, $body_limit) . '...';
                                            }
                                            $cff_event .= '<p class="cff-info" ' . $cff_event_details_styles . '>' . cff_autolink($description, $link_color=$cff_event_link_color) . '</p>';
                                        }
                                    }
                                    $cff_event .= '</div>';
                                    
                                }
                            }

                            //MEDIA
                            $cff_media = '';
                            //If it's a photo or a Featured post which is an image
                            if ($news->type == 'photo' || $news->type == 'offer' ) {
                                if ($cff_post_type == 'offer' && !empty($news->picture)){
                                    $picture = $news->picture;
                                    /*If the image doesn't have a _b version then the URL looks like this:
                                    http://photos-h.ak.fbcdn.net/hphotos-ak-prn1/v/1600273_348160658659104_383135394_s.jpg?oh=23124db338cd899962fa7fb2d7285306&oe=52D5F9BE&__gda__=1389770591_64da0df3e725ca2d1fd026b0e922c58b
                                    So check for this kind of string below and don't replace _s. with _b.
                                    */
                                    $bigjpg = '_s.jpg?';
                                    $bigpng = '_s.png?';
                                    $biggif = '_s.gif?';
                                    $bigbmp = '_s.bmp?';
                                    $bigtjpg = '_t.jpg?';
                                    $bigtpng = '_t.png?';
                                    $bigtgif = '_t.gif?';
                                    $bigtbmp = '_t.bmp?';
                                    $imagecheck1 = stripos($picture, $bigjpg);
                                    $imagecheck2 = stripos($picture, $bigpng);
                                    $imagecheck3 = stripos($picture, $biggif);
                                    $imagecheck4 = stripos($picture, $bigbmp);
                                    $imagecheck5 = stripos($picture, $bigtjpg);
                                    $imagecheck6 = stripos($picture, $bigtpng);
                                    $imagecheck7 = stripos($picture, $bigtgif);
                                    $imagecheck8 = stripos($picture, $bigtbmp);

                                    if ( !($imagecheck1 || $imagecheck2 || $imagecheck3 || $imagecheck4 || $imagecheck5 || $imagecheck6 || $imagecheck7 || $imagecheck8) ) {
                                        //Show larger image
                                        $picture = str_replace('_s.','_b.',$picture);
                                        $picture = str_replace('_q.','_b.',$picture);
                                        $picture = str_replace('_t.','_b.',$picture);
                                    }
                                }

                                //If the full_picture option is available then use that instead of the object ID method
                                if( isset($news->full_picture) ) $picture = $news->full_picture;

                                if ($cff_facebook_link_text == '') $cff_facebook_link_text = 'View on Facebook';
                                $link_text = $cff_facebook_link_text;

                                $cff_media = '<a title="'.$link_text.'" class="cff-photo';
                                if($cff_media_position == 'above') $cff_media .= ' cff-media-above';
                                $cff_media .= '" href="';

                                //If it's an album then link the photo to the album
                                if ($cff_album) {
                                    $link = $album_link;
                                }

                                //If it's a shared post then change the link to use the Post ID so that it links to the shared post and not the original post that's being shared
                                if( isset($news->status_type) ){
                                    if( $news->status_type == 'shared_story' ) $link = "https://www.facebook.com/" . $cff_post_id;
                                }

                                $cff_media .= $link.'" '.$target.$cff_nofollow.'>';

                                //Alt text
                                isset( $news->caption ) ? $cff_alt_text = strip_tags($news->caption) : $cff_alt_text = $cff_facebook_link_text;

                                // if ($cff_album && $num_photos > 1) $cff_media .= '<div class="cff-album-icon">'.$num_photos.'</div>';
                                if ($cff_album) $cff_media .= '<div class="cff-album-icon"></div>';
                                $cff_media .= '<img src="'. $picture .'" alt="'.$cff_alt_text.'" />';
                                $cff_media .= '</a>';
                            }
                            if ($news->type == 'swf') {

                                if (!empty($news->picture)) {
                                    $picture = $news->picture;

                                    /*If the image doesn't have a _b version then the URL looks like this:
                                    http://photos-h.ak.fbcdn.net/hphotos-ak-prn1/v/1600273_348160658659104_383135394_s.jpg?oh=23124db338cd899962fa7fb2d7285306&oe=52D5F9BE&__gda__=1389770591_64da0df3e725ca2d1fd026b0e922c58b
                                    So check for this kind of string below and don't replace _s. with _b.
                                    */
                                    $bigjpg = '_s.jpg?';
                                    $bigpng = '_s.png?';
                                    $biggif = '_s.gif?';
                                    $bigbmp = '_s.bmp?';
                                    $bigtjpg = '_t.jpg?';
                                    $bigtpng = '_t.png?';
                                    $bigtgif = '_t.gif?';
                                    $bigtbmp = '_t.bmp?';
                                    $imagecheck1 = stripos($picture, $bigjpg);
                                    $imagecheck2 = stripos($picture, $bigpng);
                                    $imagecheck3 = stripos($picture, $biggif);
                                    $imagecheck4 = stripos($picture, $bigbmp);
                                    $imagecheck5 = stripos($picture, $bigtjpg);
                                    $imagecheck6 = stripos($picture, $bigtpng);
                                    $imagecheck7 = stripos($picture, $bigtgif);
                                    $imagecheck8 = stripos($picture, $bigtbmp);

                                    if ( !($imagecheck1 || $imagecheck2 || $imagecheck3 || $imagecheck4 || $imagecheck5 || $imagecheck6 || $imagecheck7 || $imagecheck8) ) {
                                        //Show larger image
                                        $picture = str_replace('_s.','_b.',$picture);
                                        $picture = str_replace('_q.','_b.',$picture);
                                        $picture = str_replace('_t.','_b.',$picture);
                                    }
                                }

                                $cff_swf_url = 'http://www.facebook.com/permalink.php?story_fbid='.$PostID["1"].'&amp;id='.$PostID['0'];
                                $cff_media = '<a href="'.$cff_swf_url.'" class="cff-photo';
                                if($cff_media_position == 'above') $cff_media .= ' cff-media-above';
                                $cff_media .= '" ' . $target . $cff_nofollow.'><img src="' . $picture . '" /></a>';
                            }

                            if ($news->type == 'video' && !$cff_soundcloud) {

                                if (!empty($news->picture)) {
                                    $picture = $news->picture;

                                    // $object_id = $news->object_id;
                                    // $picture = 'https://graph.facebook.com/'.$object_id.'/picture?type=normal&width=9999&height=9999';

                                    /*If the image doesn't have a _b version then the URL looks like this:
                                    http://photos-h.ak.fbcdn.net/hphotos-ak-prn1/v/1600273_348160658659104_383135394_s.jpg?oh=23124db338cd899962fa7fb2d7285306&oe=52D5F9BE&__gda__=1389770591_64da0df3e725ca2d1fd026b0e922c58b
                                    So check for this kind of string below and don't replace _s. with _b.
                                    */
                                    $bigjpg = '_s.jpg?';
                                    $bigpng = '_s.png?';
                                    $biggif = '_s.gif?';
                                    $bigbmp = '_s.bmp?';
                                    $bigtjpg = '_t.jpg?';
                                    $bigtpng = '_t.png?';
                                    $bigtgif = '_t.gif?';
                                    $bigtbmp = '_t.bmp?';
                                    $imagecheck1 = stripos($picture, $bigjpg);
                                    $imagecheck2 = stripos($picture, $bigpng);
                                    $imagecheck3 = stripos($picture, $biggif);
                                    $imagecheck4 = stripos($picture, $bigbmp);
                                    $imagecheck5 = stripos($picture, $bigtjpg);
                                    $imagecheck6 = stripos($picture, $bigtpng);
                                    $imagecheck7 = stripos($picture, $bigtgif);
                                    $imagecheck8 = stripos($picture, $bigtbmp);

                                    if ( !($imagecheck1 || $imagecheck2 || $imagecheck3 || $imagecheck4 || $imagecheck5 || $imagecheck6 || $imagecheck7 || $imagecheck8) ) {
                                        //Show larger image
                                        $picture = str_replace('_s.','_b.',$picture);
                                        $picture = str_replace('_q.','_b.',$picture);
                                        $picture = str_replace('_t.','_b.',$picture);
                                    }
                                }

                                // url of video
                                $url = $news->source;
                                
                                //Check whether it's a youtube video
                                if($youtube || $youtu || $youtubeembed) {
                                    //Get the unique video id from the url by matching the pattern
                                    if ($youtube || $youtubeembed) {
                                        if (preg_match("/v=([^&]+)/i", $url, $matches)) {
                                            $id = $matches[1];
                                        }   elseif(preg_match("/\/v\/([^&]+)/i", $url, $matches)) {
                                            $id = $matches[1];
                                        }   elseif(preg_match("/\/embed\/([^&]+)/i", $url, $matches)) {
                                            $id = $matches[1];
                                        }
                                    } elseif ($youtu) {
                                        $id = end(explode('/', $url));
                                    }
                                    $id = substr($id, 0, strrpos($id, '?'));
                                    // this is your template for generating embed codes
                                    $code = '<iframe class="youtube-player" type="text/html" src="https://www.youtube.com/embed/{id}" allowfullscreen></iframe>';
                                    // we replace each {id} with the actual ID of the video to get embed code for this particular video
                                    $code = str_replace('{id}', $id, $code);

                                    $cff_media_video = '<div class="cff-iframe-wrap" data-poster="'.$picture.'"';
                                    if(!empty($cff_video_height)) $cff_media_video .= 'style="height: '. $cff_video_height . '"';
                                    $cff_media_video .= '>';

                                    if($cff_video_action == 'facebook') $cff_media_video .= '<a href="http://facebook.com/'.$cff_post_id.'" target="_blank" class="cff-media-overlay"></a>';

                                    $cff_media_video .= $code . '</div>';

                                //Check whether it's a vimeo
                                } else if(stripos($url, $vimeo) !== false) {
                                    if (isset($news->source)) {

                                        $clip_id = '';
                                        //http://vimeo.com/moogaloop.swf?clip_id=101557016&autoplay=1
                                        $query = parse_url($news->source, PHP_URL_QUERY);
                                        parse_str($query, $params);
                                        if(isset($params['clip_id'])) $clip_id = $params['clip_id'];

                                        //https://player.vimeo.com/video/116446625?autoplay=1
                                        if( !isset($clip_id) || $clip_id == '' ){
                                            $vimeo_url = strtok($news->source,'?');
                                            $clip_id = end((explode('/', $vimeo_url)));
                                        }

                                        $cff_media_video = '<div class="cff-iframe-wrap" data-poster="'.$picture.'"';
                                        if(!empty($cff_video_height)) $cff_media_video .= 'style="height: '. $cff_video_height . '"';
                                        $cff_media_video .= '>';

                                        if($cff_video_action == 'facebook') $cff_media_video .= '<a href="http://facebook.com/'.$cff_post_id.'" target="_blank" class="cff-media-overlay"></a>';

                                        $cff_media_video .= '<iframe src="https://player.vimeo.com/video/'.$clip_id.'" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>';
                                    }

                                //Else link to the video file
                                } else {
                                    //Show play button over video thumbnail
                                    $vid_link = $news->source;
                                    //Check whether the video source contains an mp4, as the HTML5 video player can't play any other type
                                    $cff_mp4_check = stripos($vid_link, '.mp4');

                                    if ($cff_video_action == 'facebook' && $cff_disable_lightbox) $vid_link = $link;

                                    //Title & alt text
                                    isset( $news->name ) ? $vid_title = $news->name : $vid_title = $cff_facebook_link_text;

                                    if (empty($picture)) {
                                        $cff_is_video_embed = true;
                                        $cff_media_video = '<a class="cff-playbtn-solo" title="' . $vid_title . '" href="' . $vid_link . '" target="_blank"><i class="fa fa-play cff-playbtn no-poster"></i></a>';
                                    }

                                    ( isset($news->full_picture) && !empty($news->full_picture) ) ? $poster = $news->full_picture : $poster = $picture;

                                    //Check to see whether it's a swf file and if it is then load it into an iframe in the lightbox
                                    (stripos($url, $swf) !== false) ? $swf_file = true : $swf_file = false;

                                    //If the video action is file then add the HTML5 video tags
                                    $cff_media_video = '';
                                    if ( ($cff_video_action !== 'facebook' && $cff_mp4_check) || !$cff_disable_lightbox ){
                                        $cff_media_video .= '<div class="cff-html5-video';
                                        if( $swf_file ) $cff_media_video .= ' cff-swf';
                                        $cff_media_video .= '"><a href="http://facebook.com/'.$cff_post_id.'" class="cff-html5-play"><i class="fa fa-play cff-playbtn"></i></a><video src="'.$vid_link.'" poster="'.$poster.'" >';
                                    }

                                    $cff_media_video .= '<a title="' . $vid_title . '" class="cff-vidLink" href="' . $link . '" '.$target.$cff_nofollow.'><i class="fa fa-play cff-playbtn"></i><img class="cff-poster" src="' . $poster . '" alt="' . $vid_title . '" /></a>';

                                    if ( ($cff_video_action !== 'facebook' && $cff_mp4_check) || !$cff_disable_lightbox ) $cff_media_video .= '</video></div>';
                                }
                                //Add video to HTML
                                $cff_media = $cff_media_video;


                                //Add the name to the description if it's a video embed
                                if($cff_is_video_embed) {
                                    $cff_description = '<div class="cff-desc-wrap ';
                                    if (empty($picture)) $cff_description .= 'cff-no-image';
                                    $cff_description .= '"><'.$cff_link_title_format.' class="cff-link-title" '.$cff_link_title_styles.'><a href="'.$link.'" '.$target.$cff_nofollow.' style="color:#' . $cff_link_title_color . ';">'. $news->name . '</a></'.$cff_link_title_format.'>';

                                    if (!empty($body_limit)) {
                                        if (strlen($description_text) > $body_limit) $description_text = substr($description_text, 0, $body_limit) . '...';
                                    }

                                    $cff_description .= '<p class="cff-post-desc" '.$cff_body_styles.'><span>' . cff_autolink( htmlspecialchars($description_text), $link_color=$cff_posttext_link_color )  . ' </span></p></div>';
                                }
                            }
                            //META
                            //how many comments are there?
                            $comment_count = 0;
                            $comment_count_display = '0';

                            //Save the original $news object to a variable so can use it after the comments section
                            $news_event = $news;
                            //If it's a timeline event then switch to the event_object variable which contains the comments
                            if( $cff_post_type == 'event' ) $news = $event_object;

                            if (!empty($news->comments)) {
                                $comment_count = count($news->comments->data);
                                $comment_count_display = $comment_count;
                                if ($comment_count > 20){
                                    //If count is more than 20 then it could be in the cached array
                                    $item_arr_name = $news->id . '_comments';
                                    $comment_count_display = '<div class="cff-loader fa-spin"></div><span class="cff-replace">20+</span>';
                                }
                            }

                            $cff_meta_total = '<div class="cff-meta-wrap">';
                            //Check for likes
                            $cff_meta = '';
                            $cff_meta .= '<a href="javaScript:void(0);" class="cff-view-comments" ' . $cff_meta_styles . ' id="'.$orig_post_id.'"><ul class="cff-meta ';
                            $cff_meta .= $cff_icon_style;
                            $cff_meta .= '"><li class="cff-likes"><span class="cff-icon">Likes:</span> <span class="cff-count">';
                            //How many likes are there?
                            if (!empty($news->likes)) {
                                $like_count = count($news->likes->data);
                            } else {
                                $like_count = '0';
                            }
                            //If there is no likes then display zero
                            if ($like_count == 0) {
                                $cff_meta .= '0';
                            } else if ($like_count < 25) {
                                $cff_meta .= $like_count;
                            } else {

                                //If count is more than 20 then it could be in the cached array
                                $item_arr_name = $news->id . '_likes';
                                $cff_meta .= '<div class="cff-loader fa-spin"></div><span class="cff-replace">' . $like_count . '+</span>';
                                
                            }
                            //Check for shares
                            $cff_meta .= '</span></li><li class="cff-shares"><span class="cff-icon">Shares:</span> <span class="cff-count">';
                            if (empty($news->shares->count)) { $cff_meta .= '0'; }
                                else { $cff_meta .= $news->shares->count; }
                            //Check for comments
                            $cff_meta .= '</span></li><li class="cff-comments"><span class="cff-icon">Comments:</span> <span class="cff-count">';
                            //How many comments are there?
                            $cff_meta .= $comment_count_display;
                            $cff_meta .= '</span></li></ul></a>';
                            //Display the link to the Facebook post or external link
                            $cff_link = '';
                            //Default link
                            $cff_viewpost_class = 'cff-viewpost-facebook';
                            if ($cff_facebook_link_text == '') $cff_facebook_link_text = 'View on Facebook';
                            $link_text = $cff_facebook_link_text;

                            //Link to the Facebook post if it's a link or a video
                            if($cff_post_type == 'link' || $cff_post_type == 'video') $link = "https://www.facebook.com/" . $page_id . "/posts/" . $PostID[1];


                            //If it's a shared post then change the link to use the Post ID so that it links to the shared post and not the original post that's being shared
                            if( isset($news->status_type) ){
                                if( $news->status_type == 'shared_story' ) $link = "https://www.facebook.com/" . $cff_post_id;
                            }


                            //Social media sharing URLs
                            $cff_share_facebook = 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode($link);
                            $cff_share_twitter = 'https://twitter.com/intent/tweet?text=' . urlencode($link);
                            $cff_share_google = 'https://plus.google.com/share?url=' . urlencode($link);
                            $cff_share_linkedin = 'https://www.linkedin.com/shareArticle?mini=true&amp;url=' . urlencode($link) . '&amp;title=' . rawurlencode( strip_tags($cff_post_text) );
                            $cff_share_email = 'mailto:?subject=Facebook&amp;body=' . urlencode($link) . '%20-%20' . rawurlencode( strip_tags($cff_post_text) );


                            //If it's an offer post then change the text
                            if ($cff_post_type == 'offer') $link_text = 'View Offer';

                            //Create post action links HTML
                            $cff_link = '';
                            if($cff_show_facebook_link || $cff_show_facebook_share){
                                $cff_link .= '<div class="cff-post-links">';

                                //View on Facebook link
                                if($cff_show_facebook_link) $cff_link .= '<a class="' . $cff_viewpost_class . '" href="' . $link . '" title="' . $link_text . '" ' . $target . $cff_nofollow.' ' . $cff_link_styles . '>' . $link_text . '</a>';

                                //Share link
                                if($cff_show_facebook_share){
                                    $cff_link .= '<div class="cff-share-container">';
                                    //Only show separating dot if both links are enabled
                                    if($cff_show_facebook_link) $cff_link .= '<span class="cff-dot" ' . $cff_link_styles . '>&middot;</span>';
                                    $cff_link .= '<a class="cff-share-link" href="javascript:void(0);" title="' . $cff_facebook_share_text . '" ' . $cff_link_styles . '>' . $cff_facebook_share_text . '</a>';
                                    $cff_link .= "<p class='cff-share-tooltip'><a href='".$cff_share_facebook."' target='_blank' class='cff-facebook-icon'><i class='fa fa-facebook-square'></i></a><a href='".$cff_share_twitter."' target='_blank' class='cff-twitter-icon'><i class='fa fa-twitter'></i></a><a href='".$cff_share_google."' target='_blank' class='cff-google-icon'><i class='fa fa-google-plus'></i></a><a href='".$cff_share_linkedin."' target='_blank' class='cff-linkedin-icon'><i class='fa fa-linkedin'></i></a><a href='".$cff_share_email."' target='_blank' class='cff-email-icon'><i class='fa fa-envelope'></i></a><i class='fa fa-play fa-rotate-90'></i></p></div>";
                                }
                                
                                $cff_link .= '</div>'; 
                            }
                            
                            
                            //Compile the meta and link if included
                            if ($cff_show_link) $cff_meta_total .= $cff_link;
                            if ($cff_show_meta) $cff_meta_total .= $cff_meta;
                            $cff_meta_total .= '</div>';
                            $cff_comments = '';

                            //Custom text strings
                            if (!isset($cff_translate_view_previous_comments_text) || empty($cff_translate_view_previous_comments_text)) $cff_translate_view_previous_comments_text = 'View previous comments';
                            if (!isset($cff_translate_comment_on_facebook_text) || empty($cff_translate_comment_on_facebook_text)) $cff_translate_comment_on_facebook_text = 'Comment on Facebook';
                            if (!isset($cff_translate_likes_this_text) || empty($cff_translate_likes_this_text)) $cff_translate_likes_this_text = 'likes this';
                            if (!isset($cff_translate_like_this_text) || empty($cff_translate_like_this_text)) $cff_translate_like_this_text = 'like this';
                            if (!isset($cff_translate_and_text) || empty($cff_translate_and_text)) $cff_translate_and_text = 'and';
                            if (!isset($cff_translate_other_text) || empty($cff_translate_other_text)) $cff_translate_other_text = 'other';
                            if (!isset($cff_translate_others_text) || empty($cff_translate_others_text)) $cff_translate_others_text = 'others';

                            //Create the comments box
                            $cff_comments .= '<div class="cff-comments-box ' . $cff_icon_style;
                            if( $comment_count == 0 || $cff_comments_num == 0 ) $cff_comments .= ' cff-no-comments';
                            $cff_comments .= '"';

                            //Expand comments box initially
                            if( $cff_expand_comments ) $cff_comments .= ' style="display: block;"';
                            //Number of comments to show initially
                            $cff_comments .= ' data-num="' . $cff_comments_num . '"';
                            $cff_comments .= '>';
                            
                            //Get the likes
                            if (!empty($news->likes->data)){

                                $liker_one = '';
                                $liker_two = ''; 

                                if ( $news->likes->data[0] ) $liker_one = '<a href="https://facebook.com/'.$news->likes->data[0]->id.'" '.$cff_meta_link_color.' '.$target.$cff_nofollow.'>' . $news->likes->data[0]->name . '</a>';
                                if ( $like_count > 1 ) $liker_two = '<a href="https://facebook.com/'.$news->likes->data[1]->id.'" '.$cff_meta_link_color.' '.$target.$cff_nofollow.'>' . $news->likes->data[1]->name . '</a>';

                                if ($like_count > 0) $cff_comments .= '<p class="cff-comment-likes cff-likes" ' . $cff_meta_styles . '><span class="cff-icon"></span>';
                                if ($like_count == 1){
                                    $cff_comments .= $liker_one.' '.$cff_translate_likes_this_text;
                                } else if ($like_count == 2){
                                    $cff_comments .= $liker_one.' '.$cff_translate_and_text.' '.$liker_two.' '.$cff_translate_like_this_text;
                                } else if ($like_count == 3){
                                    $cff_comments .= $liker_one.', '.$liker_two.' '.$cff_translate_and_text.' 1 '.$cff_translate_other_text.' '.$cff_translate_like_this_text;
                                } else {
                                    $cff_comments .= $liker_one.', '.$liker_two.' '.$cff_translate_and_text.' ';
                                    if ($like_count == 25) $cff_comments .= '<span class="cff-comment-likes-count">';
                                    $cff_comments .= intval($like_count)-2;
                                    if ($like_count == 25) $cff_comments .= '</span>';
                                    $cff_comments .= ' '.$cff_translate_others_text.' '.$cff_translate_like_this_text;
                                }
                                if ($like_count > 0) $cff_comments .= '</p>';

                            }

                            //Show more comments
                            if ( $comment_count > $cff_comments_num ) $cff_comments .= '<p class="cff-comments cff-show-more-comments" ' . $cff_meta_styles . '><a href="javascript:void(0);" '.$cff_meta_link_color.'><span class="cff-icon"></span>'.$cff_translate_view_previous_comments_text.'</a></p>';

                            //Get the comments
                            if (!empty($news->comments->data)){
                                //Give the comment an index so we know which one it is
                                $comment_index = 0;

                                //Loop through comments
                                foreach ($news->comments->data as $comment_item ) {
                                    $comment_likes = $comment_item->like_count;
                                    $comment = htmlspecialchars($comment_item->message);

                                    //MESSAGE TAGS
                                    if( $cff_post_tags && isset($comment_item->message_tags) ){

                                        //Loop through the tags and use the name to replace them
                                        foreach($comment_item->message_tags as $message_tag ) {
                                            $tag_name = $message_tag->name;
                                            $tag_link = '<a href="http://facebook.com/' . $message_tag->id . '" '.$target.$cff_nofollow.' '.$cff_meta_link_color.'>' . $message_tag->name . '</a>';

                                            $comment = str_replace($tag_name, $tag_link, $comment);
                                        }

                                    } //END MESSAGE TAGS

                                    //Create comments
                                    $cff_comments .= '<div class="cff-comment" id="cff_'.$comment_item->from->id.'" data-id="'.$comment_item->from->id.'" ' . $cff_meta_styles . '>';

                                    $cff_comments .= '<div class="cff-comment-text-wrapper">';
                                    $cff_comments .= '<div class="cff-comment-text';
                                    if( $cff_hide_comment_avatars ) $cff_comments .= ' cff-no-image';
                                    $cff_comments .= '"><p><a href="https://facebook.com/'. $comment_item->from->id .'" class="cff-name" '.$target.$cff_nofollow.' ' . $cff_meta_link_color . '>' . $comment_item->from->name . '</a>' . cff_autolink( $comment, $link_color=str_replace('#', '', $cff_meta_link_color) ) . '</p>';

                                    //Add image attachment if exists
                                    if( isset($comment_item->attachment) ) $cff_comments .= '<a class="cff-comment-attachment" href="'.$comment_item->attachment->url.'" target="_blank"><img src="'.$comment_item->attachment->media->image->src.'" alt="'.$comment_item->attachment->title.'" /></a>';

                                    $cff_comments .= '<span class="cff-time">';
                                    $cff_comments .= cff_timeSince(strtotime($comment_item->created_time), $date_translate_arr) . ' ' . $cff_date_after;
                                    if ( $comment_likes > 0 ) $cff_comments .= '<span class="cff-comment-likes">&nbsp; &middot; &nbsp;<b></b>' . $comment_likes . '</span>';
                                    $cff_comments .= '</span>';

                                    if( isset( $comment_item->comment_count ) ){
                                        $cff_comment_count = intval($comment_item->comment_count);
                                        if( $cff_comment_count > 0 ){
                                            ($cff_comment_count == 1) ? $cff_replies_text_string = $cff_translate_reply_text : $cff_replies_text_string = $cff_translate_replies_text;
                                            $cff_comments .= '<p class="cff-comment-replies" data-id="'.$comment_item->id.'"><a href="javascript:void(0);" ' . $cff_meta_link_color . '><span class="cff-replies-icon"></span>' . $cff_comment_count . ' '.$cff_replies_text_string.'</a></p><div class="cff-comment-replies-box cff-empty"></div>';
                                        }

                                    }

                                    $cff_comments .= '</div>'; //End .cff-comment-text
                                    $cff_comments .= '</div>'; //End .cff-comment-text-wrapper

                                    $cff_comments .= '<div class="cff-comment-img"><a href="https://facebook.com/'. $comment_item->from->id .'" '.$target.$cff_nofollow. '>';

                                    //Only load the comment avatars if they're being displayed initially, otherwise load via JS on click
                                    if( !$cff_hide_comment_avatars ){
                                        if( $cff_expand_comments && ($comment_index >= $comment_count - $cff_comments_num) ) {
                                            $cff_comments .= '<img src="https://graph.facebook.com/'.$comment_item->from->id.'/picture" width=32 height=32  alt="'.$comment_item->from->name.'">';
                                        } else {
                                            $cff_comments .= '<img src="" width=32 height=32 alt="Avatar">';
                                        }
                                    }

                                    $cff_comments .= '</a></div>';
                                    $cff_comments .= '</div>'; //End .cff-comment

                                    $comment_index++;
                                }
                                
                            }
                            $cff_comments .= '<p class="cff-comments cff-comment-on-facebook" ' . $cff_meta_styles . '><a href="'.$link.'" '.$target.$cff_nofollow.' '.$cff_meta_link_color.'><span class="cff-icon"></span>'.$cff_translate_comment_on_facebook_text.'</a></p>';
                            $cff_comments .= '</div>';
                            
                            //Compile comments if meta is included
                            if ($cff_show_meta) $cff_meta_total .= $cff_comments;

                            //If it's an event then set the $news object back to the original posts data rather than the new event data object used to get the comments for the event
                            if( $cff_post_type == 'event' ) $news = $news_event;

                            //**************************//
                            //***CREATE THE POST HTML***//
                            //**************************//
                            //Start the container
                            $cff_post_item .= '<div class="cff-item ';
                            if ($cff_post_type == 'link') $cff_post_item .= 'cff-link-item';
                            if ($cff_post_type == 'event') $cff_post_item .= 'cff-timeline-event';
                            if ($cff_post_type == 'photo') $cff_post_item .= 'cff-photo-post';
                            if ($cff_post_type == 'video' && !$cff_soundcloud) $cff_post_item .= 'cff-video-post';
                            if ($cff_soundcloud) $cff_post_item .= 'cff-audio-post';

                            if ($cff_is_video_embed) $cff_post_item .= ' cff-embedded-video';
                            if ($cff_post_type == 'swf') $cff_post_item .= 'cff-swf-post';
                            if ($cff_post_type == 'status') $cff_post_item .= 'cff-status-post';
                            if ($cff_post_type == 'offer') $cff_post_item .= 'cff-offer-post';
                            if ($cff_album) $cff_post_item .= ' cff-album';
                            if ($cff_post_bg_color_check) $cff_post_item .= ' cff-box';
                            $cff_post_item .= ' author-';
                            if(isset($news->from->name)) $cff_post_item .= cff_to_slug($news->from->name);
                            $cff_post_item .= '" id="cff_'. $cff_post_id .'" ' . $cff_item_styles . '>';

                            //POST AUTHOR
                            $cff_is_video_embed = false;
                            if($cff_is_video_embed){
                                if($cff_show_author) $cff_post_item .= $cff_author;
                                //DATE ABOVE
                                if ($cff_show_date && $cff_date_position == 'above') $cff_post_item .= $cff_date;
                                //If embedded video then show post text above the wrapper
                                if($cff_show_text) $cff_post_item .= $cff_post_text;
                                
                                $cff_post_item .= '<div class="cff-embed-wrap">';
                            }

                            //Start text wrapper
                            if ( ($cff_thumb_layout || $cff_half_layout) && !empty($news->picture) && $cff_post_type != 'event' ) $cff_post_item .= '<div class="cff-text-wrapper">';
                                //POST AUTHOR
                                if($cff_show_author && !$cff_is_video_embed) $cff_post_item .= $cff_author;
                                //MEDIA
                                if($cff_show_media && $cff_media_position == 'above'){
                                    $cff_post_item .= $cff_media;
                                }
                                //DATE ABOVE
                                if ($cff_show_date && $cff_date_position == 'above' && !$cff_is_video_embed) $cff_post_item .= $cff_date;
                                //POST TEXT
                                if($cff_show_text && !$cff_is_video_embed) $cff_post_item .= $cff_post_text;
                                //DESCRIPTION
                                if($cff_show_desc && $cff_post_type != 'offer' && $cff_post_type != 'link') $cff_post_item .= $cff_description;
                                //LINK
                                if($cff_show_shared_links) $cff_post_item .= $cff_shared_link;
                                //DATE BELOW
                                if ( (!$cff_show_author && $cff_date_position == 'author') || $cff_show_date && $cff_date_position == 'below' && !$cff_is_video_embed ) {
                                    if($cff_show_date && $cff_post_type !== 'event') $cff_post_item .= $cff_date;
                                }

                            //End text wrapper
                            if ( ($cff_thumb_layout || $cff_half_layout) && !empty($news->picture) && $cff_post_type != 'event' ) $cff_post_item .= '</div>';
                            
                            //EVENT
                            if($cff_show_event_title || $cff_show_event_details) $cff_post_item .= $cff_event;
                            //MEDIA
                            if($cff_show_media && $cff_media_position !== 'above') {
                                $cff_post_item .= $cff_media;
                                if($cff_is_video_embed) $cff_post_item .= '</div>';
                            }
                            //DATE BELOW
                            if ($cff_show_date && $cff_date_position == 'below' && $cff_is_video_embed) $cff_post_item .= $cff_date;
                            if($cff_show_date && $cff_post_type == 'event' && ($cff_date_position == 'below' || ($cff_date_position == 'author' && !$cff_show_author) ) ){
                                $cff_post_item .= $cff_date;
                            }
                            //META
                            if($cff_show_meta || $cff_show_link) $cff_post_item .= $cff_meta_total;
                            //End the post item
                            $cff_post_item .= '</div>';
                            // $cff_post_item .= '<div class="cff-clear"></div>';

                        } // End !$cff_photos_only || albums only || album embed


                        //ALBUMS ONLY
                        if($cff_albums_only && $cff_albums_source == 'photospage'){

                            isset($news->link) ? $cff_album_link = $news->link : $cff_album_link = '';
                            isset($news->name) ? $cff_album_name = $news->name : $cff_album_name = '';
                            //Don't put this in for now as the description sometimes has @ markup in it which looks bad. eg: "on behalf of @[38494804824:274:Breakthrough Breast Cancer]."
                            // isset($news->description) ? $cff_album_description = $news->description : $cff_album_description = $cff_album_name;

                            $cff_show_post = true;

                            if ( $cff_filter_string != '' ){
                                //Explode it into multiples
                                $cff_filter_strings_array = explode(',', $cff_filter_string);
                                //Hide the post if both the post text and description don't contain the string
                                $string_in_post_text = true;
                                $string_in_desc = true;
                                if ( cff_stripos_arr($cff_album_name, $cff_filter_strings_array) === false ) $cff_show_post = false;
                            }

                            if ( $cff_exclude_string != '' ){
                                //Explode it into multiples
                                $cff_exclude_strings_array = explode(',', $cff_exclude_string);
                                //Hide the post if both the post text and description don't contain the string
                                $string_in_post_text = false;
                                $string_in_desc = false;
                                if ( cff_stripos_arr($cff_album_name, $cff_exclude_strings_array) !== false ) $cff_show_post = false;
                            }

                            if( $cff_show_post ){

                                //GROUP ALBUMS
                                if($cff_is_group){
                                    //Cover photos aren't available for group albums
                                    $cff_post_item = '<div class="cff-album-item cff-albums-only cff-col-';
                                    $cff_post_item .= $cff_album_cols;
                                    $cff_post_item .= '">';
                                    $cff_post_item .= '<h4><a href="' . $cff_album_link . '" '.$target.$cff_nofollow.'>' . $cff_album_name . '</a></h4>';
                                    $cff_post_item .= '</div>';

                                    //Group albums use 'created' instead of 'created_time' like other posts
                                    $post_time = $news->created;
                                } else {
                                    if( isset($news->cover_photo->id) ){
                                        $thumb = 'https://graph.facebook.com/' . $news->cover_photo->id . '/picture';
                                    } else if( isset($news->cover_photo) ){
                                        $thumb = 'https://graph.facebook.com/' . $news->cover_photo . '/picture';
                                    } else {
                                        $thumb = '';
                                    }
                                    
                                    isset($news->count) ? $cff_album_count = $news->count : $cff_album_count = '';

                                    $cff_post_item = '<div class="cff-album-item cff-albums-only cff-col-';
                                    $cff_post_item .= $cff_album_cols;
                                    $cff_post_item .= '" id="cff_'. $news->id .'">';

                                    $cff_post_item .= '<a href="' . $cff_album_link . '" class="cff-album-cover" '.$target.$cff_nofollow.'><img src="'.$thumb.'" alt="' . $cff_album_name . '" /></a>';
                                    if($cff_show_album_title || $cff_show_album_number) $cff_post_item .= '<div class="cff-album-info">';
                                    if($cff_show_album_title) $cff_post_item .= '<h4><a href="' . $cff_album_link . '" '.$target.$cff_nofollow.'>' . $cff_album_name . '</a></h4>';
                                    if( $cff_show_album_number && isset($news->count) ) $cff_post_item .= '<p>' . $cff_album_count . ' '. $cff_translate_photos_text . '</p>';
                                    if($cff_show_album_title || $cff_show_album_number) $cff_post_item .= '</div>';
                                    $cff_post_item .= '</div>';

                                    //If there's no photos in the album then don't show it
                                    if( !isset($news->cover_photo) ) $cff_post_item = '';
                                }

                            }
                            
                        }

                        //ALBUM EMBED
                        if( $cff_album_active && !empty($cff_album_id) ){
                            $cff_post_item = '<div class="cff-album-item cff-col-';
                            $cff_post_item .= $cff_album_cols;
                            $cff_post_item .= '" id="cff_'. $news->id .'">';
                            $cff_post_item .= '<a href="https://facebook.com/'.$news->id.'" class="cff-album-cover" '.$target.$cff_nofollow.'><img src="'. $news->source .'" alt="'.$news->name.'" /></a>';
                            $cff_post_item .= '</div>';
                            $post_time = $i;
                        }


                        //VIDEOS ONLY
                        if($cff_videos_only){
                            $cff_post_item = '';

                            if( $cff_show_post ){

                                foreach ($news->format as $value) {
                                    //If there's a large image then use it
                                    if( isset( $value->picture ) ){
                                        $poster = $value->picture;
                                    //Otherwise use the small one
                                    } else if( isset( $news->picture ) ) {
                                        $poster = $news->picture;
                                    } else {
                                        $poster = '';
                                    }
                                }

                                isset($news->description) ? $description_text = $news->description : $description_text = '';
                                isset($news->name) ? $video_name = $news->name : $video_name = '';

                                $poster_alt = $video_name;
                                if( !empty($video_name) && !empty($description_text) ) $poster_alt .= ' - ';
                                $poster_alt .= $description_text;

                                $cff_post_item .= '<div class="cff-album-item cff-col-'.$cff_video_cols.'" id="cff_'. $news->id .'">';
                                $cff_post_item .= '<a href="" class="cff-album-cover cff-video" '.$target.$cff_nofollow.' id="'.$news->id.'" data-source="'.$news->source.'"><i class="fa fa-play cff-playbtn"></i><img src="'. $poster .'" alt="'.$poster_alt.'" /></a>';

                                if($cff_show_video_name) $cff_post_item .= '<div class="cff-album-info">';
                                    if( $cff_show_video_name && !empty($video_name) ) $cff_post_item .= '<h4><a href="http://facebook.com/' . $news->id . '" '.$target.$cff_nofollow.'>' . $video_name . '</a></h4>';
                                    
                                    if($cff_show_video_desc){
                                        $cff_post_item .= '<p>' . substr($description_text, 0, 50);
                                        if( strlen($description_text) > 50 ) $cff_post_item .= '...';
                                        $cff_post_item .= '</p>';
                                    }

                                if($cff_show_video_name) $cff_post_item .= '</div>';

                                $cff_post_item .= '</div>';
                                $post_time = $i;
                            }
                        }


                        //PHOTOS ONLY
                        if($cff_photos_only && empty($cff_album_id)){
                            //Get the caption
                            !empty($news->caption) ? $cff_caption = htmlspecialchars($news->caption) : $cff_caption = ' ';

                            $cff_show_post = true;

                            if ( $cff_filter_string != '' ){
                                //Explode it into multiples
                                $cff_filter_strings_array = explode(',', $cff_filter_string);
                                //Hide the post if both the post text and description don't contain the string
                                $string_in_post_text = true;
                                $string_in_desc = true;
                                if ( cff_stripos_arr($cff_caption, $cff_filter_strings_array) === false ) $cff_show_post = false;
                            }

                            if ( $cff_exclude_string != '' ){
                                //Explode it into multiples
                                $cff_exclude_strings_array = explode(',', $cff_exclude_string);
                                //Hide the post if both the post text and description don't contain the string
                                $string_in_post_text = false;
                                $string_in_desc = false;
                                if ( cff_stripos_arr($cff_caption, $cff_exclude_strings_array) !== false ) $cff_show_post = false;
                            }

                            $cff_post_item = '';
                            if( $cff_show_post ){
                                $cff_post_item .= '<div class="cff-album-item cff-col-'.$cff_photos_cols.'" id="cff_'. $news->pid .'">';
                                $cff_post_item .= '<a href="'.$news->link.'" class="cff-album-cover" '.$target.$cff_nofollow.'><img src="'. $news->src_big .'" alt="'.$cff_caption.'" /></a>';
                                $cff_post_item .= '</div>';
                            }

                            if($cff_is_group){
                                //FOR GROUPS
                                $post_time = $news->created;
                                $cff_posts_array = cff_array_push_assoc_photos($cff_posts_array, $i, $cff_post_item, $post_time);
                            } else {
                                //FOR PAGES
                                if( $i <= $show_posts ) $cff_content .= $cff_post_item;
                            }                        

                        } else {
                            //PUSH POSTS TO ARRAY
                            $cff_posts_array = cff_array_push_assoc($cff_posts_array, $post_time, $cff_post_item);
                        }


                    } // End offset
                    

                } // End post type check
                if (isset($news->message)) $prev_post_message = $news->message;
                if (isset($news->link))  $prev_post_link = $news->link;
                if (isset($news->description))  $prev_post_description = $news->description;
            } // End the loop

            
            if($cff_photos_only){
                //PHOTOS ONLY
                usort($cff_posts_array, 'sortByOrder');
            } else if( $cff_album_active && !empty($cff_album_id) || $cff_videos_only ) {
                //ALBUM EMBED
                //Don't sort array. Display posts in their native order.
            } else {
                //Sort the array in reverse order (newest first)
                krsort($cff_posts_array);
            }

        } // End ALL POSTS

    } // END PAGE_IDS LOOP

    //Output the posts array
    if($cff_photos_only){
        //PHOTOS ONLY
        $p = 0;
        foreach ($cff_posts_array as $post ) {
            if ( $p == $show_posts ) break;
            $cff_content .= $post['post'];
            $p++;
        }
    } else {
        $p = 0;
        foreach ($cff_posts_array as $post ) {
            if ( $p == $show_posts ) break;
            $cff_content .= $post;
            $p++;
        }
    }

    //Reset the timezone
    date_default_timezone_set( $cff_orig_timezone );
    //Add the Like Box inside
    if ($cff_like_box_position == 'bottom' && $cff_show_like_box && !$cff_like_box_outside) $cff_content .= $like_box;
    /* Credit link */
    ($cff_show_credit == 'true' || $cff_show_credit == 'on') ? $cff_show_credit = true : $cff_show_credit = false;

    if($cff_show_credit) $cff_content .= '<p class="cff-credit"><a href="https://smashballoon.com/custom-facebook-feed/" target="_blank" style="color: #'.$link_color=$cff_posttext_link_color.'" title="Smash Balloon Custom Facebook Feed Plugin"><img src="'.$settings[ 'path' ].'/core/img/smashballoon-tiny.png" alt="Smash Balloon Custom Facebook Feed Plugin" />The Custom Facebook Feed plugin</a></p>';
    //End the feed
    $cff_content .= '</div>';
    $cff_content .= '<div class="cff-clear"></div>';
    //Add the Like Box outside
    if ($cff_like_box_position == 'bottom' && $cff_show_like_box && $cff_like_box_outside) $cff_content .= $like_box;

    //Pass linkhashtags var via JS
    ($cff_link_hashtags == 'true' || $cff_link_hashtags == 1) ? $cff_link_hashtags = 'true' : $cff_link_hashtags = 'false';
    if($cff_title_link == 'true' || $cff_title_link == 1) $cff_link_hashtags = 'false';
    $cff_content .= '<script type="text/javascript">var cffpath = "' . $settings[ 'path' ] . '", cfflinkhashtags = "' . $cff_link_hashtags . '";</script>';

    //If using Ajax then add JS file to end of the content
    if ($cff_ajax) $cff_content .= '<script type="text/javascript" src="' . $settings[ 'path' ] . '/core/js/cff.js?4"></script>';

    $cff_content .= '</div>';

    if( !empty( $cff_posttext_link_color ) ) $cff_content .= '<style>#cff .cff-post-text a{ color: #'.$cff_posttext_link_color.'; }</style>';

    //Return our feed HTML to display
    echo $cff_content;
}


//FUNCTIONS
function sortByOrder($a, $b) {
    return $b['post_time'] - $a['post_time'];
}

//Get JSON object of feed data
function cff_fetchUrl($url){
    //Can we use cURL?
    if(is_callable('curl_init')){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        $feedData = curl_exec($ch);
        curl_close($ch);
    //If not then use file_get_contents
    } elseif ( ini_get('allow_url_fopen') || ini_get('allow_url_fopen') == 1 || ini_get('allow_url_fopen') === TRUE ) {
        $feedData = @file_get_contents($url);
    } else {
        echo "Please enable either <b>'cURL'</b> or <b>'allow_url_fopen'</b> in your server php.ini file.";
    }
    
    if(isset($feedData)) return $feedData;
}

//Make links into span instead when the post text is made clickable
function cff_wrap_span($text) {
    $pattern  = '#\b(([\w-]+://?|www[.])[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/)))#';
    return preg_replace_callback($pattern, 'cff_wrap_span_callback', $text);
}
function cff_wrap_span_callback($matches) {
    $max_url_length = 50;
    $max_depth_if_over_length = 2;
    $ellipsis = '&hellip;';
    $target = 'target="_blank"';
    $url_full = $matches[0];
    $url_short = '';
    if (strlen($url_full) > $max_url_length) {
        $parts = parse_url($url_full);
        $url_short = $parts['scheme'] . '://' . preg_replace('/^www\./', '', $parts['host']) . '/';
        $path_components = explode('/', trim($parts['path'], '/'));
        foreach ($path_components as $dir) {
            $url_string_components[] = $dir . '/';
        }
        if (!empty($parts['query'])) {
            $url_string_components[] = '?' . $parts['query'];
        }
        if (!empty($parts['fragment'])) {
            $url_string_components[] = '#' . $parts['fragment'];
        }
        for ($k = 0; $k < count($url_string_components); $k++) {
            $curr_component = $url_string_components[$k];
            if ($k >= $max_depth_if_over_length || strlen($url_short) + strlen($curr_component) > $max_url_length) {
                if ($k == 0 && strlen($url_short) < $max_url_length) {
                    // Always show a portion of first directory
                    $url_short .= substr($curr_component, 0, $max_url_length - strlen($url_short));
                }
                $url_short .= $ellipsis;
                break;
            }
            $url_short .= $curr_component;
        }
    } else {
        $url_short = $url_full;
    }
    return "<span class='cff-break-word'>$url_short</span>";
}

function cff_mb_substr_replace($string, $replacement, $start, $length=NULL) {
    if (is_array($string)) {
        $num = count($string);
        // $replacement
        $replacement = is_array($replacement) ? array_slice($replacement, 0, $num) : array_pad(array($replacement), $num, $replacement);
        // $start
        if (is_array($start)) {
            $start = array_slice($start, 0, $num);
            foreach ($start as $key => $value)
                $start[$key] = is_int($value) ? $value : 0;
        }
        else {
            $start = array_pad(array($start), $num, $start);
        }
        // $length
        if (!isset($length)) {
            $length = array_fill(0, $num, 0);
        }
        elseif (is_array($length)) {
            $length = array_slice($length, 0, $num);
            foreach ($length as $key => $value)
                $length[$key] = isset($value) ? (is_int($value) ? $value : $num) : 0;
        }
        else {
            $length = array_pad(array($length), $num, $length);
        }
        // Recursive call
        return array_map(__FUNCTION__, $string, $replacement, $start, $length);
    }
    preg_match_all('/./us', (string)$string, $smatches);
    preg_match_all('/./us', (string)$replacement, $rmatches);
    if ($length === NULL) $length = mb_strlen($string);
    array_splice($smatches[0], $start, $length, $rmatches[0]);
    return join($smatches[0]);
}

//Display date - used for posts
function cff_getdate($original, $date_format, $custom_date, $date_translate_arr) {

    switch ($date_format) {
        
        case '2':
            $print = date('F jS, g:i a', $original);
            break;
        case '3':
            $print = date('F jS', $original);
            break;
        case '4':
            $print = date('D F jS', $original);
            break;
        case '5':
            $print = date('l F jS', $original);
            break;
        case '6':
            $print = date('D M jS, Y', $original);
            break;
        case '7':
            $print = date('l F jS, Y', $original);
            break;
        case '8':
            $print = date('l F jS, Y - g:i a', $original);
            break;
        case '9':
            $print = date("l M jS, 'y", $original);
            break;
        case '10':
            $print = date('m.d.y', $original);
            break;
        case '11':
            $print = date('m/d/y', $original);
            break;
        case '12':
            $print = date('d.m.y', $original);
            break;
        case '13':
            $print = date('d/m/y', $original);
            break;

        default:
            
            $periods = array(
                $date_translate_arr['$cff_translate_second'],
                $date_translate_arr['$cff_translate_minute'],
                $date_translate_arr['$cff_translate_hour'],
                $date_translate_arr['$cff_translate_day'],
                $date_translate_arr['$cff_translate_week'],
                $date_translate_arr['$cff_translate_month'],
                $date_translate_arr['$cff_translate_year'],
                "decade"
            );
            $periods_plural = array(
                $date_translate_arr['$cff_translate_seconds'],
                $date_translate_arr['$cff_translate_minutes'],
                $date_translate_arr['$cff_translate_hours'],
                $date_translate_arr['$cff_translate_days'],
                $date_translate_arr['$cff_translate_weeks'],
                $date_translate_arr['$cff_translate_months'],
                $date_translate_arr['$cff_translate_years'],
                "decade"
            );

            $lengths = array("60","60","24","7","4.35","12","10");
            $now = time();
            
            // is it future date or past date
            if($now > $original) {    
                $difference = $now - $original;
                $tense = $date_translate_arr['$cff_translate_ago'];
            } else {
                $difference = $original - $now;
                $tense = $date_translate_arr['$cff_translate_ago'];
            }
            for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
                $difference /= $lengths[$j];
            }
            
            $difference = round($difference);
            
            if($difference != 1) {
                $periods[$j] = $periods_plural[$j];
            }
            $print = "$difference $periods[$j] {$tense}";
            break;
        
    }
    if ( !empty($custom_date) ){
        $print = date($custom_date, $original);
    }
    return $print;
}

//Display date in event format
function cff_eventdate($original, $date_format, $custom_date) {
    switch ($date_format) {
        
        case '2':
            $print = date('<k>F jS, </k>g:ia', $original);
            break;
        case '3':
            $print = date('g:ia<k> - F jS</k>', $original);
            break;
        case '4':
            $print = date('g:ia<k>, F jS</k>', $original);
            break;
        case '5':
            $print = date('<k>l F jS - </k>g:ia', $original);
            break;
        case '6':
            $print = date('<k>D M jS, Y, </k>g:iA', $original);
            break;
        case '7':
            $print = date('<k>l F jS, Y, </k>g:iA', $original);
            break;
        case '8':
            $print = date('<k>l F jS, Y - </k>g:ia', $original);
            break;
        case '9':
            $print = date("<k>l M jS, 'y</k>", $original);
            break;
        case '10':
            $print = date('<k>m.d.y - </k>g:iA', $original);
            break;
        case '11':
            $print = date('<k>m/d/y, </k>g:ia', $original);
            break;
        case '12':
            $print = date('<k>d.m.y - </k>g:iA', $original);
            break;
        case '13':
            $print = date('<k>d/m/y, </k>g:ia', $original);
            break;

        default:
            $print = date('<k>F j, Y, </k>g:ia', $original);
            break;
    }
    if ( !empty($custom_date) ){
        $print = date($custom_date, $original);
    }
    return $print;
}


//Time stamp function - used for comments
function cff_timeSince($original, $date_translate_arr) {
            
    $periods = array(
        $date_translate_arr['$cff_translate_second'],
        $date_translate_arr['$cff_translate_minute'],
        $date_translate_arr['$cff_translate_hour'],
        $date_translate_arr['$cff_translate_day'],
        $date_translate_arr['$cff_translate_week'],
        $date_translate_arr['$cff_translate_month'],
        $date_translate_arr['$cff_translate_year'],
        "decade"
    );
    $periods_plural = array(
        $date_translate_arr['$cff_translate_seconds'],
        $date_translate_arr['$cff_translate_minutes'],
        $date_translate_arr['$cff_translate_hours'],
        $date_translate_arr['$cff_translate_days'],
        $date_translate_arr['$cff_translate_weeks'],
        $date_translate_arr['$cff_translate_months'],
        $date_translate_arr['$cff_translate_years'],
        "decade"
    );

    $lengths = array("60","60","24","7","4.35","12","10");
    $now = time();
    
    // is it future date or past date
    if($now > $original) {    
        $difference = $now - $original;
        $tense = $date_translate_arr['$cff_translate_ago'];
    } else {
        $difference = $original - $now;
        $tense = $date_translate_arr['$cff_translate_ago'];
    }
    for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
        $difference /= $lengths[$j];
    }
    
    $difference = round($difference);
    
    if($difference != 1) {
        $periods[$j] = $periods_plural[$j];
    }
    return "$difference $periods[$j] {$tense}";
            
}

//Verify license against database
global $cff_license;
function cff_verify_license( $data ) {

    $api_params = array(
        'url'           => $data['url'],
        'license'       => $data['license'],
        'name'          => $data['item_name']
    );
    $validate = array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params );
    $request = false;
    if ($validate == 'valid') $request = file_get_contents( $api_params['url'] . '/' . $api_params['name'] );

    if ( $request ):
        $request = json_decode( remote_retrieve_body( $request ) );
        if( $request && $validate )
            $request->sections = unserialize( $request->sections );
        return $request;
    else:
        return false;
    endif;
}

cff_verify_license( array(
        'url'       => 'https://license.smashballoon.com',
        'license'   => $cff_license,
        'item_name' => 'Custom Facebook Feed Standalone Version',
        'author'    => 'Smash Balloon'
    )
);
function cff_system_info(){
    $info = '<p style="font-size: 12px;"><b><u>System Info:</u></b><br />';
    $info .= 'PHP Version: <b>' . PHP_VERSION .'</b><br />';
    $info .= 'Web Server Info: <b>' . $_SERVER["SERVER_SOFTWARE"] . '</b><br />';

    //allow_url_fopen
    $info .= 'PHP allow_url_fopen: <b>';
    if (ini_get( "allow_url_fopen" ) ) {
        $info .= '<span style="color: green;">Yes</span>';
    } else {
        $info .= '<span style="color: red;">No</span>';
    }   
    $info .= '</b><br />';

    //cURL
    $info .= 'PHP cURL: <b>';
    if ( is_callable("curl_init") ) {
        $info .= '<span style="color: green;">Yes</span>';
    } else {
        $info .= '<span style="color: red;">No</span>';
    }
    $info .= '</b><br />';

    //JSON
    $info .= 'JSON: <b>';
    if ( function_exists("json_decode") ){
        $info .= '<span style="color: green;">Yes</span>';
    } else {
        $info .= '<span style="color: red;">No</span>';
    }
    $info .= '</b><br />';

    //SSL stream
    $info .= 'SSL Stream: <b>';
    if ( in_array('https', stream_get_wrappers()) ) {
        $info .= '<span style="color: green;">Yes</span>';
    } else {
        $info .= '<span style="color: red;">No</span>';
    }   
    $info .= '</b></p>';

    echo $info;
}

//Use custom stripos function if it's not available (only available in PHP 5+)
if(!is_callable('stripos')){
    function stripos($haystack, $needle){
        return strpos($haystack, stristr( $haystack, $needle ));
    }
}
function cff_stripos_arr($haystack, $needle) {
    if(!is_array($needle)) $needle = array($needle);
    foreach($needle as $what) {
        if(($pos = stripos($haystack, ltrim($what) ))!==false) return $pos;
    }
    return false;
}
//Push to assoc array
function cff_array_push_assoc($array, $key, $value){
    $array[$key] = $value;
    return $array;
}
//Push to assoc array
function cff_array_push_assoc_photos($array, $key, $value, $post_time){
    $array[$key]['post'] = $value;
    $array[$key]['post_time'] = $post_time;

    return $array;
}
//Convert string to slug
function cff_to_slug($string){
    return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string)));
}

//Multifeed Extension
function cff_multifeed_ids($page_id){
    $cff_multifeed_ids = explode(",", str_replace(' ', '', $page_id) );
    //Send it back
    return array_filter($cff_multifeed_ids);
}
//Album Extension
function cff_album_id($cff_album_id, $access_token, $cff_post_limit){
    return 'https://graph.facebook.com/'.$cff_album_id.'/photos?fields=source,name&access_token='. $access_token .'&limit=' . $cff_post_limit;
}

?>

<?php //Link to the plugin stylesheets ?>
<link rel="stylesheet" type="text/css" href="<?php echo $fbfeed_path ?>/core/css/font-awesome.min.css?2">
<link rel="stylesheet" type="text/css" href="<?php echo $fbfeed_path ?>/core/css/cff.css?21">