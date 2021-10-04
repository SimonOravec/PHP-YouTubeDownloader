<?php
namespace SimonOravec\YTDL;

use DateInterval;

class YoutubeAPI {
    
    private $baseApiUri = 'https://www.googleapis.com/youtube/v3/';

    private $config;
    private $video = null;

    function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * Convert URI to video ID
     * @param string $uri Video URI
     * 
     * @return string|null Video ID
     */
    public function convertUriToVideoID($uri)
    {
        preg_match('~(?:https?://)?(?:www.)?(?:youtube.com|youtu.be)/(?:watch\?v=)?([^\s]+)~', $uri, $match);

        if (sizeof($match) < 2)
        {
            return null;
        }
        return $match[1];
    }

    /**
     * Loads video data
     * @param string $id Youtube video ID
     * 
     * @return boolean If data loaded successfully
    */
    public function loadVideo($id)
    {
        $data = file_get_contents($this->baseApiUri."videos?key={$this->config['YOUTUBE-API-KEY']}&id={$id}&part=snippet,contentDetails");

        if ($data != false)
        {
            $this->video = json_decode($data, true);
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * Returns all video data
     * @return array Video data
    */
    public function getAllVideoData() 
    {
        return $this->video;
    }

    /**
     * Checks if video exists
     * @return boolean If video exists
    */
    public function videoExists() 
    {
        if ($this->video == null) return false;

        if (sizeof($this->video['items']) == 1) return true;
        return false;
    }

    /**
     * Return video title
     * @return string Video title
    */
    public function getTitle() 
    {
        if (!$this->videoExists()) return null;

        return $this->video['items'][0]['snippet']['title'];
    }

    /**
     * Return video duration
     * @return int Video lenght in seconds
    */
    public function getLength() 
    {
        if (!$this->videoExists()) return -1;

        return $this->convertYouTubeTimeToSeconds($this->video['items'][0]['contentDetails']['duration']);
    }

    /**
     * Convert YouTube video duration to seconds
     * @param string $ytTime Time string provided by YouTube
     * 
     * @return int Time in seconds
    */
    private function convertYouTubeTimeToSeconds($ytTime) 
    {
        $interval = new DateInterval($ytTime);
        return $interval->days * 86400 + $interval->h * 3600 + $interval->i * 60 + $interval->s;
    }

}
?>