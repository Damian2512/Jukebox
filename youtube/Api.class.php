<?php


class Api {

    private $maxResults = 25;
    private $curl;

    /**
     * Api constructor.
     * Hier kunnen we het curl object van initialiseren
     */
    function __construct() {
        $this->curl = curl_init();
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, 0);
    }

    /**
     * @param int $n
     */
    public function setMaxResults($n = 25) {
        $this->maxResults = $n;
    }

    /**
     * @return int
     */
    public function getMaxResults() {
        return $this->maxResults;
    }

    /**
     * @param $url
     * @param $headers
     * @param string $data
     * @return mixed
     */
    public function postRequest($url, $headers=[], $data='') {
        curl_setopt($this->curl, CURLOPT_POST, 1);
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $data);
        return $this->_request($url, $headers);
    }

    /**
     * @param $url
     * @param $headers
     * @return mixed
     */
    public function getRequest($url, $headers=[]) {
        curl_setopt($this->curl, CURLOPT_POST, 0);
        return $this->_request($url, $headers);
    }

    /**
     * @param $url
     * @param $headers
     * @return mixed
     * @throws Exception
     */
    private function _request($url, $headers) {

        //basic url validation
        if (!preg_match("/^https?:\/\//i", $url)) {
            throw new Exception('invalid url input');
        }

        curl_setopt($this->curl, CURLOPT_URL, $url);
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($this->curl);

        // throw an exception if the request returns an error
        if($errno = curl_errno($this->curl)) {
            $error_message = curl_strerror($errno);
            throw new Exception("Error bij het uitvoeren van de API request: ({$errno}):\n {$error_message}");
        }

        // Resultaat van json naar array converteren
        // In de meeste gevallen retourneert een API een json.
        // Soms xml, dan kunnen we deze class uitbreiden.
        return json_decode($response);
    }

    /**
     * Hier kunnen we de curl weer sluiten.
     */
    public function __destruct() {
        curl_close($this->curl);
    }


}