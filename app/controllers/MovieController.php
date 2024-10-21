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

    public function single_movie_view($id) {
        $favorites = $this->sessionController->getSessionData();
        $movie = $this->model->getMovieById($id);
        $videos = $this->videoController->get_videos_by_movie_id($id);
        $people = $this->peopleController->get_people_by_movie_id($id);

        foreach($videos['results'] as $video){
            if ($video['type'] === 'Trailer') {
                $firstTrailer = $video;
                break; 
            }
        }
    
        if ($movie) {
            require_once 'app/views/SingleMovie.php';
        } else {
            echo "Movie not found.";
        }
    }

    public function getMoviesByGenre($id){
        $movies = $this->model->getMoviesByGenre($id);

        if($movies){
            require_once 'app/views/GenreView.php';
        }
    }

    public function showMoviesFrontPage()
    {
        $action = $this->model->getMoviesByGenre( 28);
        $comedy = $this->model->getMoviesByGenre( 35);
        $thriller = $this->model->getMoviesByGenre( 53);
        $war = $this->model->getMoviesByGenre(10752);
        $romance = $this->model->getMoviesByGenre(10749);
        $drama = $this->model->getMoviesByGenre(18);
        $crime = $this->model->getMoviesByGenre(80);
        $doc = $this->model->getMoviesByGenre(99);
        $horror = $this->model->getMoviesByGenre(27);

        $movies = [
            'Action' => $action,
            'Comedy' => $comedy,
            'Thriller' => $thriller,
            'War' => $war,
            'Romance' => $romance,
            'Drama' => $drama,
            'Crime' => $crime,
            'Documentary' => $doc,
            'Horror' => $horror
        ];

        $hero = $this->model->getMovieById(64690);
        $favorites = $this->sessionController->getSessionData();
        require_once 'app/views/HomeView.php';
    }

    //This function gets a movie by its id with Ajax
    public function ajaxFetchMovieById()
    {
        //check if movieid isset
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
