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
        'version' => 'October 6th, 2019',
        'api_key' => '2b352ccb',
        'email' => [
            'host' => 'smtp.gmail.com',
            'port' => 587,
            'username' => 'noreply.teamgao@gmail.com',
            'password' => 'P@ssw0rdtoor',
            'SMTPSecure' => 'tls'
        ],
    ];
    return isset($config[$key]) ? $config[$key] : null;
}
