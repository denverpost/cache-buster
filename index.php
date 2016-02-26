<?php
function purge_cache($url)
{
    $ch=curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PURGE');
    curl_exec($ch);
    curl_close($ch);
    return 1;
}

// Handle purge requests from the bookmarklet
if ( isset($_GET['url']) ):
    $url = htmlspecialchars($_GET['url']);
    if ( strpos($url, 'denverpost') !== FALSE ):
        if ( purge_cache($url) == 1 ) echo "success";
    endif;
endif;

// Handle purge requests from pre-defined collections of URLs
if ( isset($_GET['urls']) ):
    $filename = htmlspecialchars(substr($_GET['urls'], 0, 100));
    $urls = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if ( count($urls) > 0 ):
        foreach ( $urls as $url ):
            if ( purge_cache($url) == 1 ) echo "success";
        endforeach;
    endif;
endif;
