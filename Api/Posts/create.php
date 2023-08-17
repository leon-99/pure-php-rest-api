<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Allow-Access-Coltrol-Allow-Headers: Allow-Access-Coltrol-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorizaton, X-Requested-With');

include("../../autoload.php");

use Models\Post;
use config\Database;

// Instantitate DB & connect 
$database = new Database();
$db = $database->connect();

// Instantitate blog post object
$post = new Post($db);

// // Get data

$data = json_decode(file_get_contents("php://input"));

$post->title = $data->title;
$post->body = $data->body;
$post->author = $data->author;
$post->category_id = $data->category_id;

if($post->create()) {
    echo json_encode([
        'message' => 'post created'
    ]);
} else {
    echo json_encode([
        'message' => 'post not created'
    ]);
};