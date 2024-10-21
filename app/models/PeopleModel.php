<?php

class PeopleModel
{
    // Base URL for The Movie Database (TMDb) API and the API key
    private $apiUrl = 'https://api.themoviedb.org/3/';
    private $apiKey = 'cdd2559f8c31cf5e7e8a2e99e39bb685';

    // function to get the cast and crew for a specific movie by its ID
    public function get_people_by_movie_id($movie_id)
    {
        // Construct the URL for the API request to get cast and crew for the movie
        $url = $this->apiUrl . 'movie' . '/' . $movie_id .  '/credits?api_key=' . $this->apiKey;

        // Call the private method to make the API request
        return $this->makeApiRequest($url);
    }

    // Private method to make API requests using cURL
    private function makeApiRequest($url)
    {
        // Initialize a cURL session
        $ch = curl_init();
        // Set the URL to fetch
        curl_setopt($ch, CURLOPT_URL, $url);
        // Return the response as a string instead of outputting it
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Execute the cURL request and store the response
        $response = curl_exec($ch);
        // Close the cURL session to free up resources
        curl_close($ch);

        // Decode the JSON response and return it as an associative array
        return json_decode($response, true);
    }
}
