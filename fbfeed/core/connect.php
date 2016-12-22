<?php

//Get Access Token from settings file
require_once( '../fbfeed-settings.php' );

if ( empty($settings['access_token']) || $settings['access_token'] == 'OPTIONAL_ACCESS_TOKEN_HERE' || $settings['access_token'] == 'YOUR_ACCESS_TOKEN_HERE' ){
    $access_token_array = array(
        '809956782391601|ISt-Q8WeUNuCHHv8ntK2pLDeWP8',
        '769354546452714|AY4KEhP-5ArilKL07N7FzG4I6lI'
    );
    $access_token = $access_token_array[rand(0, 1)];
} else {
    $access_token = $settings['access_token'];
}

//Include this function as it isn't automatically included if the wp-config.php file can't be found
function cff_fetchUrl($url){
    //Can we use cURL?
    if(is_callable('curl_init')){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate,sdch');
        $feedData = curl_exec($ch);
        curl_close($ch);
    //If not then use file_get_contents
    } elseif ( ini_get('allow_url_fopen') == 1 || ini_get('allow_url_fopen') === TRUE ) {
        $feedData = @file_get_contents($url);
    //Or else use the WP HTTP API
    } else {
        $request = new WP_Http;
        $response = $request->request($urls, array('timeout' => 60, 'sslverify' => false));
        if( is_wp_error( $response ) ) {
            //Don't display an error, just use the Server config Error Reference message
           echo '';
        } else {
            $feedData = wp_remote_retrieve_body($response);
        }
    }
    
    return $feedData;
}

?>