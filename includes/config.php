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
            'about-us' => 'About Us',
            'contact' => 'Contact Us'
        ],
        'template_path' => 'template',
        'content_path' => 'content',
        'version' => 'October 3rd, 2019',
        'api_key' => '2b352ccb',
    ];
    return isset($config[$key]) ? $config[$key] : null;
}
