<?php

class MovieModel
{
    // Base URL for The Movie Database (TMDb) API and the API key
    private $apiUrl = 'https://api.themoviedb.org/3/';
    private $apiKey = 'cdd2559f8c31cf5e7e8a2e99e39bb685';

    // function to get a movie's details by its ID
    public function getMovieById($movieId)
    {
        // Construct the URL for the API request to get a movie by its ID
        $url = $this->apiUrl . 'movie' . '/' . $movieId .  '?api_key=' . $this->apiKey;
        
        // Call the private method to make the API request
        return $this->makeApiRequest($url);
    }

    // function to get a list of movies based on a specific genre ID
    public function getMoviesByGenre($genre_id)
    {
        // Construct the URL for the API request to get movies by genre
        $url = $this->apiUrl . 'discover/movie' . '?api_key=' . $this->apiKey . '&with_genres=' . $genre_id . '&include_adult=false';

        // Call the function to make the API request
        return $this->makeApiRequest($url);
    }

    // function to make API requests using cURL
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
