<?php

// Include necessary models and controllers
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
        // Instantiate the different variables
        $this->model = new MovieModel();
        $this->videoController = new VideoController();
        $this->peopleController = new PeopleController();
        $this->sessionController = new SessionController();
    }

    // function to handle displaying a single movie view
    public function single_movie_view($id)
    {
        // Get favorite movies from the session
        $favorites = $this->sessionController->getSessionData();

        // Get movie details, related videos, and people by movie ID
        $movie = $this->model->getMovieById($id);
        $videos = $this->videoController->get_videos_by_movie_id($id);
        $people = $this->peopleController->get_people_by_movie_id($id);

        // Loop through the videos to find the first trailer available
        foreach ($videos['results'] as $video) {
            if ($video['type'] === 'Trailer') {
                $firstTrailer = $video; 
                break; 
            }
        }

        // Check if the movie exists, and if so, display the single movie view
        if ($movie) {
            require_once 'app/views/SingleMovie.php';
        } else {
            echo "Movie not found.";
        }
    }

    // function to fetch movies by genre id
    public function getMoviesByGenre($id)
    {
        // Fetch movies by genre id
        $movies = $this->model->getMoviesByGenre($id);

        // Define a mapping of genre ids to genre names
        // Change later to be more dynamic
        $genres = [
            28 => 'Action',
            35 => 'Comedy',
            53 => 'Thriller',
            10752 => 'War',
            10749 => 'Romance',
            18 => 'Drama',
            80 => 'Crime',
            99 => 'Documentary',
            27 => 'Horror'
        ];

        // If movies are found, get the genre name and load the view
        if ($movies) {
            $favorites = $this->sessionController->getSessionData();
            $genre = $genres[$id]; // Get the genre name based on the id
            require_once 'app/views/GenreView.php'; 
        }
    }

    // function to show movies on the front page, grouped by genre
    public function showMoviesFrontPage()
    {
        // Get the movies by genre id
        $action = $this->model->getMoviesByGenre(28);
        $comedy = $this->model->getMoviesByGenre(35);
        $thriller = $this->model->getMoviesByGenre(53);
        $war = $this->model->getMoviesByGenre(10752);
        $romance = $this->model->getMoviesByGenre(10749);
        $drama = $this->model->getMoviesByGenre(18);
        $crime = $this->model->getMoviesByGenre(80);
        $doc = $this->model->getMoviesByGenre(99);
        $horror = $this->model->getMoviesByGenre(27);

        // Combine the genre name, id and their movies 
        $movies = [
            [
                'genre_name' => 'Action',
                'genre_id' => 28,
                'movies' => $action
            ],
            [
                'genre_name' => 'Comedy',
                'genre_id' => 35,
                'movies' => $comedy
            ],
            [
                'genre_name' => 'Thriller',
                'genre_id' => 53,
                'movies' => $thriller
            ],
            [
                'genre_name' => 'War',
                'genre_id' => 10752,
                'movies' => $war
            ],
            [
                'genre_name' => 'Romance',
                'genre_id' => 10749,
                'movies' => $romance
            ],
            [
                'genre_name' => 'Drama',
                'genre_id' => 18,
                'movies' => $drama
            ],
            [
                'genre_name' => 'Crime',
                'genre_id' => 80,
                'movies' => $crime
            ],
            [
                'genre_name' => 'Documentary',
                'genre_id' => 99,
                'movies' => $doc
            ],
            [
                'genre_name' => 'Horror',
                'genre_id' => 27,
                'movies' => $horror
            ]
        ];

        // Fetch a hero movie for the homepage (by a specific movie ID)
        // Which will be shown as standard in the top when page is loaded 
        $hero = $this->model->getMovieById(64690);

        // Get user's favorite movies from the session
        $favorites = $this->sessionController->getSessionData();

        require_once 'app/views/HomeView.php';
    }

    // function to fetch a movie by its ID using an AJAX request
    public function ajaxFetchMovieById()
    {
        // Check if the movie_id is provided in the POST request
        if (isset($_POST['movie_id'])) {
            $movie_id = intval($_POST['movie_id']);

            $movie = $this->model->getMovieById($movie_id);

            // If the movie exists, return it as JSON, otherwise return an error message
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
