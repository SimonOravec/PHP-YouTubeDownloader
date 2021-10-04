<?php
namespace SimonOravec\YTDL;

$cfg = [
    //Mandatory settings
    'YOUTUBE-API-KEY'     => 'How to obtain your YouTube API key: https://developers.google.com/youtube/v3/getting-started',

    'YOUTUBE-DL-PATH'     => '/usr/local/bin/youtube-dl',
    'FFMPEG-PATH'         => '/usr/bin/ffmpeg',

    'MP3-DIR-PATH'        => '/var/www/ytdl/files/',
    //End of mandatory settings

    //Optional settings
    'ENABLE-RECAPTCHA'    => false,
    'RECAPTCHA-SITEKEY'   => 'Register your Google reCAPTCHA v2 here: https://www.google.com/recaptcha/about/',
    'RECAPTCHA-SECRET'    => 'Register your Google reCAPTCHA v2 here: https://www.google.com/recaptcha/about/'
    //End of optional settings
];
?>
