<?php

class Omdb {
    private $omdb_key;

    public function __construct() {
        $this->omdb_key = $_ENV['omdb_key'];
    }

    public function search_movie($title) {
      $query_url = "http://www.omdbapi.com/?apikey=". $this->omdb_key ."&t=" . urlencode($title);
      $response = file_get_contents($query_url);
      return json_decode($response, true);
    }

}
