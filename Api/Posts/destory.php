<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
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


// id 
$post->id = $data->id;

if($post->destory()) {
    echo json_encode([
        'message' => 'post deleted'
    ]);
} else {
    echo json_encode([
        'message' => 'post not deleted'
    ]);
};