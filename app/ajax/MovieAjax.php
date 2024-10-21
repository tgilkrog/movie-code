<?php

require_once __DIR__ . '/../controllers/MovieController.php';
require_once __DIR__ . '/../controllers/SessionController.php';

$movieController = new MovieController();
$sessionController = new SessionController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {

        // Switch statement to handle different 'action' cases
        switch ($_POST['action']) {

                // get a movie by its id
            case 'get_movie_by_id':
                // Check if there is a movie_id
                if (isset($_POST['movie_id'])) {
                    // Call the controller function to get movie with ajax
                    $movieController->ajaxFetchMovieById();
                } else {
                    // Return an error if 'movie_id' is missing
                    echo json_encode(['error' => 'Movie ID not provided.']);
                }
                break;

                // Save movie to favorite list
            case 'save_to_favorites':
                if (isset($_POST['movie_id'])) {
                    // Call the controller function to save data in php session
                    $sessionController->saveSessionData();
                } else {
                    echo json_encode(['error' => 'Movie ID not provided.']);
                }
                break;

                // Get the favorite list from the session
            case 'get_favorite_list':
                echo json_encode($sessionController->getSessionData());
                break;

                // Default case: Invalid action
            default:
                // Return an error if the action is not recognized
                echo json_encode(['error' => 'Invalid action.']);
                break;
        }
    } else {
        echo json_encode(['error' => 'Action not provided.']);
    }
} else {
    echo json_encode(['error' => 'Invalid request method.']);
}
