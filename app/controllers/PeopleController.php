<?php

require_once __DIR__ . '/../models/PeopleModel.php';
class PeopleController{
    private $model;

    public function __construct()
    {
        $this->model = new PeopleModel();
    }

    public function get_people_by_movie_id($movie_id) {
        return $this->model->get_people_by_movie_id($movie_id);
    }
}