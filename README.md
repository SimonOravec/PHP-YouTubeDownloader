# PHP YouTube MP3 Downloader
<h3>**Recommended PHP version: 7.3** (should work using PHP 8, untested)</h3> 

This is a simple PHP application that downloads MP3s from YouTube. 

You will need a server with [youtube-dl](https://youtube-dl.org/) and [ffmpeg](https://www.ffmpeg.org/) installed for this to work.  
Tested only on Linux (may work on Windows too)

This application uses YouTube API v3, you will need to create your credentials (https://developers.google.com/youtube/v3/getting-started)

There is also optional reCAPTCHA v2 (invisble) support (Register here: https://www.google.com/recaptcha/about/)  
[!] *Using reCAPTCHA is highly advised if you want to host a public downloader to prevent spam*

Configuration file (config.int.php)
```PHP
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
```
