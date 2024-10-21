<?php

require_once __DIR__ . '/../models/SessionModel.php';

class SessionController
{
    private $sessionModel;

    public function __construct()
    {
        $this->sessionModel = new SessionModel();
    }

    // function to save or remove movie data to/from the session
    public function saveSessionData()
    {
        // Retrieve movie data from the POST request, with fallback to null if not set
        $movie_id = isset($_POST['movie_id']) ? $_POST['movie_id'] : null;
        $movie_title = isset($_POST['movie_title']) ? $_POST['movie_title'] : null;
        $movie_poster = isset($_POST['movie_poster']) ? $_POST['movie_poster'] : null;

        // Ensure that all movie data (ID, title, poster) is provided
        if ($movie_id && $movie_title && $movie_poster) {
            // Get the existing 'movie_list' from the session, or initialize an empty array if not set
            $movie_list = $this->sessionModel->get('movie_list') ?? [];

            // search the array and check if movie allready exists
            $movie_index = array_search($movie_id, array_column($movie_list, 'movie_id'));

            if ($movie_index !== false) {
                // If movie exists in the list, remove it
                unset($movie_list[$movie_index]);
                echo "Movie ID $movie_id removed from the list.";
            } else {
                // If movie doesn't exist in the list, add it to the sessioin
                $movie_list[] = [
                    'movie_id' => $movie_id,
                    'movie_title' => $movie_title,
                    'movie_poster' => $movie_poster
                ];
                echo "Movie ID $movie_id added to the list.";
            }

            $this->sessionModel->set('movie_list', array_values($movie_list));
        } else {
            echo "Invalid movie data.";
        }
    }

    // function to retrieve the list of saved movies from the session
    public function getSessionData()
    {
        // Fetch the 'movie_list' from the session model
        $movie_list = $this->sessionModel->get('movie_list');

        // If a movie list exists, return it
        if ($movie_list) {
            return $movie_list;
        }
    }

    // function to clear all session data (e.g., logging out or resetting)
    public function clearSessionData()
    {
        // Call the session model to clear all session data
        $this->sessionModel->clear();
        echo "Session data cleared!";
    }
}
