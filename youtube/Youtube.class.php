<?php

/**
 * Class Youtube
 * Connectie met de Youtube Data API.
 * Check the guide voor mee info
 * https://developers.google.com/youtube/v3/docs/search/list
 */
class Youtube extends Api {

    private static $key = 'AIzaSyDwlKHBI7CiHaqTNqOZSn7lzmYNMD8GQ8M';
    private static $baseUrl = 'https://www.googleapis.com/youtube/v3/search';
    private static $videoBaseUrl = 'http://www.youtube.com/embed/';

    /**
     * @param string $q
     * @return mixed|string
     */
    function search($q = '') {
        $tracks = array();

        if (!empty($q)) {
            $params = array(
                'maxResults' => $this->getMaxResults(),
                'key' => self::$key,
                'part' => 'snippet',
                'type' => 'video',
                'videoDefinition' => 'any',
                'videoEmbeddable' => 'true',
                'q' => $q
            );
            $url = self::$baseUrl . '?' . http_build_query($params);

            $result = $this->getRequest($url);

            if ($result !== false) {
                // Converteer de array naar een generieke array zodat alle api classes hetzelfde formaat teruggeven.
                foreach ($result->items as $item) {
                    $tracks[] = array(
                        'title' => $item->snippet->title,
                        'url' => self::$videoBaseUrl . $item->id->videoId,
                        'playerUrl' => self::$videoBaseUrl . $item->id->videoId,
                        'type' => 'video/mp4',
                        'source' => 'youtube',
                        'id' => $item->id->videoId,
                    );
                }
            }
        }


        // Return
        return $tracks;
    }

}