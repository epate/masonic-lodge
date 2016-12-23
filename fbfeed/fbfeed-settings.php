<?php
$settings = array(
     /* mandatory settings */
    'license'           => 'b34882e33e29f9c2bf0b5436be31df90',
    'access_token'      => 'OPTIONAL_ACCESS_TOKEN_HERE',
    'id'                => 'GrandLodgeVirginia',
    'pagetype'          => 'page',

    /* options */
    'layout' => 'thumb',
    'mediaposition' => 'above',
    'number' => '10',
    'limit' => '10',
    'width' => '100%',
    'height' => '300px',
    'enablenarrow' => false,
    'expandcomments' => true,
    'likeboxcover' => true,
    'showfacebooklink' => false,
    'likeboxwidth' => '100%',
    'exclude' => 'author,link',
    'dateformat' => '2',
    'sepcolor' => '428bca',
    'sepsize' => '2',

    'path'              => isset($fbfeed_path) ? $fbfeed_path : ''
);

if (isset($fbfeed_path)) include $fbfeed_path . '/core/custom-facebook-feed.php';
error_reporting(0);
?>
