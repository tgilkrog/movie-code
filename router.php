<?php
// router.php
class Router
{
    public static function route($path, $id = null)
    {
        error_log("Requested path: $path");
        switch ($path) {
            case '':
                require_once 'app/controllers/MovieController.php';
                $controller = new MovieController();
                $controller->showMoviesFrontPage();
                break;

            case 'movie':
                error_log("Movie path matched.");
                require_once 'app/controllers/MovieController.php';
                $controller = new MovieController();
                $controller->view($id); 
                break;

            case 'ajax/fetchMovieById':
                require_once 'app/ajax/MovieAjax.php';
                break;

            default:
                echo "404 - Page not found";
                break;
        }
    }
}
