<?php
namespace SimonOravec\YTDL;

require('./app/autoload.php');

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] != 'POST') die(json_encode(['success'=>false,'error'=>'Invalid request']));

$action = $_POST["action"];

switch ($action)
{
    case 'download_mp3':
        if ($cfg['ENABLE-RECAPTCHA'] && empty($_POST["recaptcha_token"])) 
        {
            die(json_encode(["success"=>false,"error"=>'Captcha error']));
        }

        $recaptcha_ok = true;
        if ($cfg['ENABLE-RECAPTCHA']) 
        {
            $recaptcha = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$cfg['RECAPTCHA-SECRET']."&response={$_POST["recaptcha_token"]}&remoteip={$_SERVER['REMOTE_ADDR']}"), true);
            if ($recaptcha["success"] !== true ) $recaptcha_ok = false;
        }

        if ($recaptcha_ok)
        {
            $ytdl = new YouTubeDL($cfg);
            $dl = $ytdl->downloadMP3(htmlspecialchars($_POST["yt_uri"]));
            if ($dl == false) {
                die(json_encode(["success"=>false,"error"=>'Download failed']));
            } else {
                $name = $ytdl->getYouTubeAPI()->getTitle();
                die(json_encode(["success"=>true,"id"=>$dl,"name"=>base64_encode($name)]));
            }
        }
        else
        {
            die(json_encode(["success"=>false,"error"=>'Captcha error']));
        }

    default:
        die(json_encode(['success'=>false,'error'=>'Invalid action']));
}
?>