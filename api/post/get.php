<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once '../../config/Database.php';
require_once '../../models/Post.php';

// Instantitate DB & connect 
$database = new Database();
$db = $database->connect();

// Instantitate blog post object
$post = new Post($db);

$post->id = isset($_GET['id']) ? $_GET['id']: abort(404);

$result = $post->get();
$rowCount = $result->rowCount();

if ($rowCount > 0) {
    echo json_encode($result->fetch());
} else {
    echo json_encode([
        'message' => 'post not found'
    ]);
}
