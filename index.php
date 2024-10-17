<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// index.php
require_once 'router.php';

// Get the current path from the URL
$path = isset($_GET['path']) ? $_GET['path'] : '';
$id = isset($_GET['id']) ? intval($_GET['id']) : null; 
//$path = trim($_SERVER['REQUEST_URI'], '/Wexo-code/');

// Route the request
Router::route($path, $id);
