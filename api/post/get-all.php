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
$result = $post->getAll();
$rowCount = $result->rowCount();

if ($rowCount > 0) {
    echo json_encode($result->fetchAll());
} else {
    echo json_encode([
        'message' => 'no posts found'
    ]);
}
