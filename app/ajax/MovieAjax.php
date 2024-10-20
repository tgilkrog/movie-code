<?php

require_once __DIR__ . '/../controllers/MovieController.php';
require_once __DIR__ . '/../controllers/SessionController.php';

$movieController = new MovieController();
$sessionController = new SessionController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'get_movie_by_id':
                if (isset($_POST['movie_id'])) {
                    $movieController->ajaxFetchMovieById();
                } else {
                    echo json_encode(['error' => 'Movie ID not provided.']);
                }
                break;

            case 'save_to_favorites':
                if (isset($_POST['movie_id'])) {
                    $sessionController->saveSessionData();
                } else {
                    echo json_encode(['error' => 'User ID not provided.']);
                }
                break;

            case 'get_favorite_list':
                echo json_encode($sessionController->getSessionData());

            default:
                echo json_encode(['error' => 'Invalid action.']);
                break;
        }
    } else {
        echo json_encode(['error' => 'Action not provided.']);
    }
} else {
    echo json_encode(['error' => 'Invalid request method.']);
}