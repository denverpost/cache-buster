<?php
function purge_cache($url)
{
    $ch=curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PURGE');
    curl_exec($ch);
    curl_close($ch);
}

// Handle purge requests from the bookmarklet
if ( isset($_GET['url']) ):
    $url = htmlspecialchars($_GET['url']);
    if ( strpos($url, 'denverpost') !== FALSE ):
        purge_cache($url);
    endif;
endif;
