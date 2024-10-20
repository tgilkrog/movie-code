<?php

require_once __DIR__ . '/../models/MovieModel.php';
require_once __DIR__ . '/../controllers/VideoController.php';
require_once __DIR__ . '/../controllers/PeopleController.php';
require_once __DIR__ . '/../controllers/SessionController.php';

class MovieController
{
    private $model;
    private $videoController;
    private $peopleController;
    private $sessionController;

    public function __construct()
    {
        $this->model = new MovieModel();
        $this->videoController = new VideoController();
        $this->peopleController = new PeopleController();
        $this->sessionController = new SessionController();
    }

    public function view($id) {
        $movie = $this->model->getMovieById($id);
        $videos = $this->videoController->get_videos_by_movie_id($id);
        $people = $this->peopleController->get_people_by_movie_id($id);

        foreach($videos['results'] as $video){
            if ($video['type'] === 'Trailer') {
                $firstTrailer = $video;
                break; 
            }
        }
        //require_once 'app/views/SingleMovie.php';
        if ($movie) {
            require_once 'app/views/SingleMovie.php';
        } else {
            echo "Movie not found.";
        }
    }

    public function showMoviesFrontPage()
    {
        $action = $this->model->getMoviesByGenre( 28);
        $comedy = $this->model->getMoviesByGenre( 35);
        $thriller = $this->model->getMoviesByGenre( 53);
        $horror = $this->model->getMoviesByGenre(27);

        //war = 10752
        //romance = 10749
        //Drama = 18
        //crime = 80
        //doc = 99

        $movies = [
            'Action' => $action,
            'Comedy' => $comedy,
            'Thriller' => $thriller,
            'Horror' => $horror
        ];

        $hero = $this->model->getMovieById(64690);
        $favorites = $this->sessionController->getSessionData();
        require_once 'app/views/HomeView.php';
    }

    public function ajaxFetchMovieById()
    {
        if (isset($_POST['movie_id'])) {
            $movie_id = intval($_POST['movie_id']);
            $movie = $this->model->getMovieById($movie_id);

            if ($movie) {
                echo json_encode($movie);
            } else {
                echo json_encode(['error' => 'Movie not found.']);
            }
        } else {
            echo json_encode(['error' => 'Movie ID not provided.']);
        }
    }
}
