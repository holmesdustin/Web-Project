<?php

/**
 * Used to store website configuration information.
 *
 * @var string or null
 */
function config($key = '')
{
    $config = [
        'name' => 'Cinematic Explorer',
        'pretty_uri' => false,
        'site_url' => 'https://web-project-team-gao.herokuapp.com/',
        'nav_menu' => [
            '' => 'Home',
            'trending' => 'Trending',
            'about-us' => 'About Us',
            'contact' => 'Contact Us'
            
        ],
        'template_path' => 'template',
        'content_path' => 'content',
        'version' => 'October 29th, 2019',
        'omdb_api_key' => '2b352ccb',
        'reCAPTCHA_api_key' => '6LfcwL4UAAAAAI9nT6jzJ_iWIoJVboMJdJtHQQhF'
    ];
    return isset($config[$key]) ? $config[$key] : null;
}
