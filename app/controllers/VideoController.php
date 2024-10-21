<?php
require_once __DIR__ . '/../models/VideoModel.php';

class VideoController
{
    private $model;

    public function __construct()
    {
        $this->model = new VideoModel();
    }

    // function to get videos associated with a specific movie by movie ID
    public function get_videos_by_movie_id($movie_id)
    {
        // Call the model's method to fetch videos related to the given movie ID
        return $this->model->get_video_by_movie_id($movie_id);
    }
}
