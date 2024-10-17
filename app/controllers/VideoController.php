<?php

require_once __DIR__ . '/../models/VideoModel.php';

class VideoController
{
    private $model;

    public function __construct()
    {
        $this->model = new VideoModel();
    }

    public function get_videos_by_movie_id($movie_id) {
        return $this->model->get_video_by_movie_id($movie_id);
    }
}