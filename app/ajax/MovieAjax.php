<?php

require_once __DIR__ . '/../controllers/MovieController.php';

$controller = new MovieController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['movie_id'])) {
        $controller->ajaxFetchMovieById();
    } else {
        echo json_encode(['error' => 'Movie ID not provided.']);
    }
} else {
    echo json_encode(['error' => 'Invalid request method.']);
}
