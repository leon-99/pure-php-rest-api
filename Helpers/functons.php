<?php

function abort($code) {
    http_response_code($code);
    echo json_encode([
        'message' => 'not found',
        'status' => $code
    ]);
    die();
};

function dd($var) {
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
    die();
}
   
    