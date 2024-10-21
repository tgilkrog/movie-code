<?php

require_once __DIR__ . '/../models/PeopleModel.php';

class PeopleController
{
    private $model;

    public function __construct()
    {
        // Initialize the PeopleModel
        $this->model = new PeopleModel();
    }

    // function to get people associated with a specific movie by movie ID
    public function get_people_by_movie_id($movie_id)
    {
        // Call the model's method to fetch people related to the movie ID
        return $this->model->get_people_by_movie_id($movie_id);
    }
}
