<?php
namespace SimonOravec\YTDL;

use SimonOravec\YTDL\YoutubeAPI;

class YouTubeDL {

    private $config;
    private $ytApi;

    function __construct($config)
    {
        $this->config = $config;
        $this->ytApi = new YoutubeAPI($config);
    }


    /**
     * @param string $uri YouTube video URI
     * 
     * @return string|false Downloaded file ID or false if download failed
     */
    public function downloadMP3($uri)
    {

        $id = $this->ytApi->convertUriToVideoID($uri);
        if ($id == null ) return false;

        $this->ytApi->loadVideo($id);

        if (!$this->ytApi->videoExists()) return false;

        $title = $this->ytApi->getTitle();
        $title_sha1 = sha1($title);

        $length = $this->ytApi->getLength();
        if ($length > 1800) return false;

        if (file_exists($this->config['MP3-DIR-PATH']."{$title_sha1}.mp3"))
        {
            touch($this->config['MP3-DIR-PATH']."{$title_sha1}.mp3", time());
            return $title_sha1;
        } 
        else 
        {
            shell_exec($this->config['YOUTUBE-DL-PATH'].' --prefer-ffmpeg --ffmpeg-location '.$this->config['FFMPEG-PATH'].' --extract-audio --audio-format mp3 --output "'.$this->config['MP3-DIR-PATH'].$title_sha1.'.%(ext)s" https://www.youtube.com/watch?v='.$id);

            if (file_exists($this->config['MP3-DIR-PATH']."{$title_sha1}.mp3"))
            {
                touch($this->config['MP3-DIR-PATH']."{$title_sha1}.mp3", time());
                return $title_sha1;
            }
            else
            {
                return false;
            }
        }
    }

    /**
     * Returns YouTube API object
     * @return object YouTubeAPI
     */
    public function getYouTubeAPI()
    {
        return $this->ytApi;
    }

}
?>