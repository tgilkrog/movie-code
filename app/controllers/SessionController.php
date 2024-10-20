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
        echo $movie_id;
        if ($movie_id) {
            $movie_list = $this->sessionModel->get('movie_list') ?? [];

            if (in_array($movie_id, $movie_list)) {
                $movie_list = array_diff($movie_list, [$movie_id]);
                echo "Movie ID $movie_id removed from the list.";
            } else {
                $movie_list[] = $movie_id;
                echo "Movie ID $movie_id added to the list.";
            }

            $this->sessionModel->set('movie_list', $movie_list);
        } else {
            echo "Invalid movie ID.";
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
