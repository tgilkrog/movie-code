<?php

class PeopleModel{
    private $apiUrl = 'https://api.themoviedb.org/3/';
    private $apiKey = 'cdd2559f8c31cf5e7e8a2e99e39bb685';

    public function get_people_by_movie_id($movie_id)
    {
        $url = $this->apiUrl . 'movie' . '/' . $movie_id .  '/credits?api_key=' . $this->apiKey;
        return $this->makeApiRequest($url);
    }

    private function makeApiRequest($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }
}