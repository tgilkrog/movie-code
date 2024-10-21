<?php
//Require Router php rile
require_once 'router.php';

//Get the path
$path = isset($_GET['path']) ? $_GET['path'] : '';
//get id
$id = isset($_GET['id']) ? intval($_GET['id']) : null; 

Router::route($path, $id);
