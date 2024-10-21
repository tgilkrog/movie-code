<?php

class VideoModel
{
    // Base API URL and API key for accessing the TMDB API
    private $apiUrl = 'https://api.themoviedb.org/3/';
    private $apiKey = 'cdd2559f8c31cf5e7e8a2e99e39bb685';

    // function to retrieve videos associated with a specific movie ID
    public function get_video_by_movie_id($movie_id)
    {
        // Construct the API URL for fetching videos by movie ID
        $url = $this->apiUrl . 'movie' . '/' . $movie_id .  '/videos?api_key=' . $this->apiKey;
        
        // Make the API request and return the result
        return $this->makeApiRequest($url);
    }

    // Private method to handle making the API request
    private function makeApiRequest($url)
    {
        // Initialize a cURL session
        $ch = curl_init();
        // Set the cURL options to pass the URL and return the response as a string
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Execute the cURL session and store the response
        $response = curl_exec($ch);
        // Close the cURL session
        curl_close($ch);

        // Decode the JSON response into an associative array and return it
        return json_decode($response, true);
    }
}
