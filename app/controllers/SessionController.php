<?php

require_once __DIR__ . '/../models/SessionModel.php';

class SessionController {
    private $sessionModel;

    public function __construct() {
        // Initialize the SessionModel
        $this->sessionModel = new SessionModel();
    }

    public function saveSessionData() {
        $movie_id = isset($_POST['movie_id']) ? $_POST['movie_id'] : null;
        $movie_title = isset($_POST['movie_title']) ? $_POST['movie_title'] : null;
        $movie_poster = isset($_POST['movie_poster']) ? $_POST['movie_poster'] : null;    

        if ($movie_id && $movie_title && $movie_poster) {
            // Retrieve the current movie list from the session or initialize an empty array
            $movie_list = $this->sessionModel->get('movie_list') ?? [];
    
            // Find if the movie already exists in the list
            $movie_index = array_search($movie_id, array_column($movie_list, 'movie_id'));
    
            if ($movie_index !== false) {
                // Movie exists, remove it from the list
                unset($movie_list[$movie_index]);
                echo "Movie ID $movie_id removed from the list.";
            } else {
                // Movie doesn't exist, add it to the list
                $movie_list[] = [
                    'movie_id' => $movie_id,
                    'movie_title' => $movie_title,
                    'movie_poster' => $movie_poster
                ];
                echo "Movie ID $movie_id added to the list.";
            }
    
            // Save the updated movie list back to the session
            $this->sessionModel->set('movie_list', array_values($movie_list)); // Re-index array after unset
        } else {
            echo "Invalid movie data.";
        }
    }

    public function getSessionData() {
        $movie_list = $this->sessionModel->get('movie_list');

        if ($movie_list) {
            return $movie_list;
        }
    }

    public function clearSessionData() {
        // Clear all session data using the model
        $this->sessionModel->clear();
        echo "Session data cleared!";
    }
}
