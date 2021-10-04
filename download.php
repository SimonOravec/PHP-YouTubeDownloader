<?php
namespace SimonOravec\YTDL;
require('./app/autoload.php');

$q = $_GET['q'];
$n = $_GET['n'];

if (empty($q) || empty($n)) 
{
    header('Content-Type: text/plain');
    die("400 - Bad request");
}

$name = base64_decode($n, true);
if (sha1($name) != $q)
{
    header('Content-Type: text/plain');
    die("400 - Bad request");
}

$file = $cfg['MP3-DIR-PATH'].$q.'.mp3';
$name = str_replace(['"', '\''], '', $name);

if (file_exists($file))
{
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.$name.'.mp3"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: '.filesize($file));
    readfile($file);
    exit;
}
else
{
    header('Content-Type: text/plain');
    die("404 - Not Found");
}
?>